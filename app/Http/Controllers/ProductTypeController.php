<?php
/**
 * Created by PhpStorm.
 * User: zhangxiaoqiu
 * Date: 2015/11/23
 * Time: 13:54
 */
 

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as AbstractController;
use App\Services\ProductTypeService as ProductTypeService;
use Illuminate\Http\Request;

class ProductTypeController extends  AbstractController
{
    public function __construct(ProductTypeService $typeService)
    {
        parent::__construct();
        $this->typeService=$typeService;
    }

    public function  index(Request $request)
    {
        $data = $request->input();
        $id=isset($data['id'])?($data['id']):1;

        $callback=$request->input('callback');

        $totalType = $this->typeService->getTotalCategories();
        if(!array_key_exists('page',$data))
        {
            $data['page'] =1;
        }

        $start = ($data['page']-1)*30;
        $pageHtml = $this->typeService->getCategoryPageHtml("/product/producttype_select",$data['page'],$totalType,30,$data);

        $types=  $this->typeService->getCategories(['start'=>$start,'limit'=>10]);
        return view('product.select')->with("types",$types)->with('displayid',$id)->with('pageHtml',$pageHtml)->with('callback',$callback);
    }

    public function multiSelect(Request $request)
    {
        $callback=$request->input('callback');
        $types=  $this->typeService->getCategoriesAlias();
        return view('product.multi')->with("types",$types)->with('callback',$callback);
    }


    public function listProductType(Request $request)
    {
        $data = $request->input();
        $id=isset($data['id'])?isset($data['id']):1;
        $callback=$request->input('callback');

        $totalType = $this->typeService->getTotalCategories();
        if(!array_key_exists('page',$data))
        {
            $data['page'] =1;
        }

        $start = ($data['page']-1)*30;
        $pageHtml = $this->typeService->getCategoryPageHtml("/product/producttype_list",$data['page'],$totalType,30,$data);

        $types=  $this->typeService->getCategories(['start'=>$start,'limit'=>30]);
        return view('product.type_list')->with("types",$types)->with('pageHtml',$pageHtml)->with('callback',$callback);
    }
    /**
     * @param $id
     */

    public function  delProductType($id)
    {
        $this->typeService->deleteCategory($id);
        return redirect('/product/producttype_list')->withErrors("删除产品分类成功");
    }
    public function createProductType()
    {
        return view('product.type_create');
    }

    public function storeProductType(Request $request)
    {
        $this->typeService->addCategory($request->input());

         return    redirect('/product/producttype_list')->withErrors("添加分类成功");
    }

    public function editProductType(Request $request)
    {
        $type=  $this->typeService->getCategory($request->input("PTypeID"));
        return view('product.type_edit')->with('type',$type[0]);
    }
    public function editSaveProductType(Request $request)
    {
        $type=  $this->typeService->editCategory($request->input("PTypeID"),$request->all());
        return redirect('/product/producttype_list')->withErrors("编辑分类成功");
    }

    public function  repairProductType()
    {
        ini_set('max_execution_time', '0');

        $this->typeService->repairCategories();
        return redirect('/product/producttype_list')->withErrors('重建完成');
    }
}