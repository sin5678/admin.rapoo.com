<?php

namespace App\Http\Controllers;

use App\Services\BasecolorService;
use App\Services\CommonService;
use App\Models\Role;
use App\Models\Basecolor;
use Illuminate\Http\Request;
use App\Http\Requests\BasecolorRequest;
use App\Models\Permission;
use Entrust,Redirect;
use App\Services\Search\Search;
use App\Http\Controllers\AbstractController as AbstractController;


class BasecolorController extends AbstractController
{

    private $Basecolor;

    public function __construct(BasecolorService $BasecolorService )
    {
        parent::__construct();
        $this->BasecolorService = $BasecolorService;
        $this->Basecolor =  new Basecolor();
        
    }
    
     /**
     * 列出主页
     *
     * @param 
     */
    public function index(Search $search)
    {
        $basecolor  = $this->BasecolorService->index($search);
        
        return View('basecolor.list',compact('basecolor'));
    }
     /**
     * 搜索
     *
     * @param 
     */
    public function action(Request $request)
    {
        $basecolor  = $this->BasecolorService->action($request->basecolorname);
        
        return View('basecolor.list',compact('basecolor'));
    }

    /**
     * 添加页面
     *
     * @param
     */
    public function add(Request $request) 
    {
    
        $data['roles'] = Role::all();
        return view('basecolor.add', $data);
    }

    /**
     * 执行添加
     *
     * @param
     */
    public function save(Request $request)
    {

        $this->BasecolorService->createUser($request);
        return redirect('/basecolor/index')->withErrors('颜色创建完成');
        
    }
    
    /**
     * 编辑页面
     *
     * @param
     */
    public function edit( Request $request, $id )
    {

        $Basecolor = $this->Basecolor->getBasecolor($id);
        
        return view('basecolor.edit')->with(['ColorID' => $request->ColorID, 'Basecolor' => $Basecolor]);
    }
   
    

    /**
     * 编辑保存
     *
     * @param
     */
    public function store( Request $request, $id )
    {
        
        $re = $this->BasecolorService->store($request ,$id);
      
        if ($re) {
            return redirect('/basecolor/index')->withErrors('修改完成');
        } else {
            return Redirect::to('/basecolor/edit/'.$id);
        }
    }


    /**
     * 删除
     *
     * @param
     */
    public function delete( Request $request )
    {
        
        $userInfo = $this->BasecolorService->delete($request->id);
        return redirect('/basecolor/index')->withErrors('删除完成');
    }

    
}//