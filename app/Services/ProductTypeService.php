<?php
/**
 * Created by PhpStorm.
 * User: zhangxiaoqiu
 * Date: 2015/11/24
 * Time: 15:30
 */

namespace App\Services;
use App\Services\BaseService;

use DB,Validator,Hash;
use App\Models\ProductType  as ProductType;
use App\Models\ProductTypePath  as ProductTypePath;

class ProductTypeService   extends BaseService
{
    //add category
    public function addCategory($data) {

        $pTypeID  =  ProductType::insertGetId([
            'PTypeName'=>$data['PTypeName'],
            'PTypeNaemEn'=>$data['PTypeNaemEn'],
            'PTypeNaemTw'=>$data['PTypeNaemTw'],
            'OrderNo'=>$data['OrderNo'],
            'Remark'=>$data['Remark']
        ]);

         // MySQL Hierarchical Data Closure Table Pattern
        $level = 0;

        $rows = DB::table("producttype_path")->where('PTypeID',(int)$data['parent_id']) ->orderby('Level','ASC')->get();

        foreach ($rows as $result) {
            DB::table("producttype_path")->insert(['PTypeID' => (int)$pTypeID ,'PathID' =>  (int)$result->PathID, 'Level' => (int)$level]);
            $level++;
        }

        DB::table("producttype_path")->insert(['PTypeID' =>(int)$pTypeID , 'PathID' =>  (int)$pTypeID, 'Level' =>  (int)$level]);
        return $pTypeID;
    }

    //获取id分类
    public function  getCategory($PTypeID)
    {
        $sql ="select c1.*,c2.PTypeName as ParentPTypeName from rap_producttype c1 left join rap_producttype c2 ON  c1.ParentPTypeID = c2.PTypeID WHERE c1.PTypeID=".(int)$PTypeID;
        $result = DB::select(DB::raw($sql));;
        return $result;
    }



    public function getCategoryPageHtml($url,$curPage,$total,$pageSize,$data)
    {
        $param = '';

        foreach($data as $key => $val)
        {
            if($key!="page")
            $param.="&$key=$val";
        }
        $totalPage=0;

        if($total%$pageSize>0)
        {
            $totalPage =$total/$pageSize +1;
        }
        else
        {
            $totalPage =$total/$pageSize ;
        };


        $html ="<ul class=\"pagination\">";

        for($i=1;$i<=$totalPage;$i++)
        {
            if($i ==1)
            {
                if($curPage==1)
                {
                    $html .= "<li class=\"disabled\"><span>《</span>";
                }else
                {
                    $html .= "<li><a href=\"$url?".$param."&page=".($curPage-1)."\" rel=\"pre\">《</a></li>";
                }
            }

            $html.= "<li><a href=\"$url?".$param."&page=".$i."\">".$i."</a></li>";


            if($i == $totalPage)
            {
                if($curPage==$totalPage)
                {
                    $html .= "<li class=\"disabled\"><span>》</span>";
                }else
                {
                    $html .= "<li><a href=\"$url?".$param."&page=".($curPage+1)."\" rel=\"next\">》</a></li>";
                }
            }

        }
        $html .="</ul>";

        return $html;

    }

    /**
     * 分类总数
     * @return mixed
     */
    public function getTotalCategories() {
        $query = DB::Table('producttype')->select(DB::raw("COUNT(*) AS total"))->get();

        return $query[0]->total;
    }


    //编辑分类
    public function editCategory($PTypeID, $data) {

        ProductType::where('PTypeID', $PTypeID)
            ->update([
                    'PTypeName'=>$data['PTypeName'],
                    'PTypeNaemEn'=>$data['PTypeNaemEn'],
                    'PTypeNaemTw'=>$data['PTypeNaemTw'],
                    'OrderNo'=>$data['OrderNo'],
                    'Remark'=>$data['Remark']
            ]);

        // MySQL Hierarchical Data Closure Table Pattern
        $query=ProductTypePath::select("*")->where('PathID',$PTypeID)->orderby("Level","ASC")->get();

        if ($query) {
            foreach ($query as $Path) {
                // Delete the path below the current one

                ProductTypePath::where('PTypeID',$Path->PTypeID)->where("Level","<",$Path->Level)->delete();

                $pathArr = array();

                // Get the nodes new parents
                $query = ProductTypePath::select("*")->where('PTypeID',(int)$data['parent_id'])->orderby("Level","ASC")->get();


                foreach ($query as $result) {
                    $pathArr[] = $result->PathID;
                }

                // Get whats left of the nodes current path
                $query = ProductTypePath::select("*")->where('PathID',(int)$Path->PTypeID)->orderby("Level","ASC")->get();


                foreach ($query as $result) {
                    $pathArr[] = $result->PathID;
                }

                // Combine the paths with a new level
                $level = 0;

                foreach ($pathArr as $pathID) {
                    DB::statement("REPLACE INTO rap_producttype_path SET PTypeID = '" . (int)$Path->PTypeID . "', PathID = '" . (int)$pathID . "', Level = '" . (int)$level . "'");
                    $level++;
                }
            }
        } else {
            // Delete the path below the current one
            ProductTypePath::where('PTypeID',$PTypeID).delete();

            // Fix for records with no paths
            $level = 0;

            $query=ProductTypePath::where('PTypeID',(int)$data['parent_id'])->orderby("Level","ASC");

            foreach ($query as $result) {
                ProductTypePath::insert([
                    'PTypeID'=>$PTypeID,
                    'PathID'=>$result->PathID,
                    'Level'=>(int)$level
                ]);
                $level++;
            }

             DB::statement("REPLACE INTO rap_producttype_path  SET PTypeID = '" . (int)$PTypeID . "', `PathID` = '" . (int)$PTypeID . "', Level = '" . (int)$level . "'");
        }
    }

    //删除分类
    public function deleteCategory($PTypeID) {

        DB::table('producttype_path')->where('PTypeID','=',$PTypeID)->delete();

        $query=ProductTypePath::select("*")->where('PathID','=',$PTypeID)->get();

        foreach ($query as $result) {
            $this->deleteCategory($result->PTypeID);
        }
        ProductType::where('PTypeID','=',$PTypeID)->delete();

    }

    //修复分类表数据
    public function repairCategories($parent_id = 0) {
        $types = ProductType::where('ParentPTypeID', (int)$parent_id )->get();

        foreach ($types as $type) {
            // Delete the path below the current one
            ProductTypePath::where('PTypeID',(int)$type->PTypeID )->delete();

            // Fix for records with no paths
            $level = 0;

            $rows = ProductTypePath::where('PTypeID',(int)$parent_id ) ->orderBy('Level', 'asc')->get();


            foreach ($rows as $result) {
                ProductTypePath::insert(['PTypeID' =>(int)$type->PTypeID, 'PathID' => (int)$result->PathID , 'Level' => (int)$level]);
                $level++;
            }

            DB::statement("REPLACE INTO rap_producttype_path SET PTypeID = '" . (int)$type->PTypeID . "', PathID = '" . (int)$type->PTypeID . "', Level = '" . (int)$level . "'");

           $this->repairCategories($type->PTypeID);
        }

    }

    //获取分类
    public function getCategories($data = array()) {

        $sql = "SELECT cp.PTypeID AS PTypeID,c2.PTypeNaemEn as PTypeNaemEn,c2.PTypeNaemTw as PTypeNaemTw,GROUP_CONCAT(c1.PTypeName ORDER BY cp.Level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name,c2.ParentPTypeID, c2.OrderNo"
            ." FROM  rap_producttype_path  cp "
            ."LEFT JOIN  rap_producttype c1 ON (cp.PathID = c1.PTypeID) "
            ."LEFT JOIN  rap_producttype c2 ON (cp.PTypeID = c2.PTypeID)";
        $sql .= " GROUP BY cp.PTypeID ORDER BY c2.ParentPTypeID  ASC, c2.OrderNo ASC";

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 10;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }


        $result = DB::select(DB::raw($sql));;

        return $result;
    }

    public function getCategoriesAlias() {

        $sql = "SELECT cp.PTypeID AS PTypeID,c2.PTypeNaemEn as PTypeNaemEn,c2.PTypeNaemTw as PTypeNaemTw,GROUP_CONCAT(c1.PTypeName ORDER BY cp.Level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name,c2.ParentPTypeID, c2.OrderNo"
            ." FROM  rap_producttype_path  cp "
            ."LEFT JOIN  rap_producttype c1 ON (cp.PathID = c1.PTypeID) "
            ."LEFT JOIN  rap_producttype c2 ON (cp.PTypeID = c2.PTypeID)";
        $sql .= " GROUP BY cp.PTypeID ORDER BY c2.ParentPTypeID  ASC, c2.OrderNo ASC";

        $result = DB::select(DB::raw($sql));;

        return $result;
    }
}