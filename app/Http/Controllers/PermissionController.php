<?php

namespace App\Http\Controllers;

use App\Services\PermissionService;
use App\Services\CommonService;
use App\Models\Role;
use Illuminate\Http\Request;
use Redirect;
use App\Models\Permission;
use App\Http\Requests\PermissionsRequest;
use Entrust,Route;
use App\Http\Controllers\AbstractController as AbstractController;

class PermissionController extends AbstractController
{

    public function __construct(PermissionService $permissionService)
    {
        parent::__construct();
        $this->permissionService = $permissionService;
    }

    /**
     * 主列表
     *
     * @param
     */
    public function index()
    {
        $permissionList = Permission::getPermission();
        return view('permission.list')->with('permissionList', $permissionList);
    }

    /**
     * 添加页面
     *
     * @param
     */
    public function add()
    {
        return view('/permission/add')->with(['pc' => Permission::getPermissionCat()]);
    }
    
    /**
     * 执行添加
     *
     * @param
     */
    public function save(PermissionsRequest $request)
    {
        $re = Permission::doPermissionAdd($request);
        if ($re) {
            return redirect('/permission')->withErrors('添加完成');
        } else {
            return redirect('/permission')->withErrors('添加失败');
        }
    }
    
    /**
     * 编辑页面
     *
     * @param
     */
    public function edit( Request $request )
    {
        $data = Permission::getPermissionById($request);
        return view('permission/edit',['permission_id'=>$request->id,'pc' => Permission::getPermissionCat()])->with('permission',$data);
    }
    
    /**
     * 保存
     *
     * @param
     */
    public function store( Request $request )
    {
        $request->id = $request->pid;
        $data = Permission::getPermissionById($request);
        
        $validateRule = ['display_name' => 'required|min:2', 'name' => 'required|min:2|unique:permissions'];
        
        if ($request->name == $data->name) {
            unset($validateRule['name']);
        }
        
        $this->validate($request, $validateRule);
        
        $re = Permission::doPermissionEdit($request);
        
        if ($re) {
            return redirect('/permission')->withErrors('修改完成');
        } else {
            return redirect('/permission')->withErrors('修改失败');
        }
    }

    /**
     * 删除
     *
     * @param
     */
    public function delete( Request $request )
    {
        $re = Permission::permissionDelete($request);
        if ($re) {
            return redirect('/permission')->withErrors('删除成功');
        }
    }

    

}//