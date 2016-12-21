<?php

namespace App\Http\Controllers;

use App\Services\RolesService;
use App\Services\CommonService;
use App\Models\Role;
use Illuminate\Http\Request;
use Redirect,Entrust,Route;
use App\Models\Permission;
use App\Http\Requests\RolesRequest;
use App\Http\Controllers\AbstractController as AbstractController;

class RolesController extends AbstractController
{

    public function __construct(RolesService $roleService)
    {
        parent::__construct();
        $this->rolesService = $roleService;
    }

    /**
     * 主列表
     *
     * @param
     */
    public function index()
    {
        $rolesList = Role::get_roles_list();
        return view('roles.list')->with('roles_list', $rolesList);
    }

    /**
     * 添加角色页
     *
     * @param
     */
    public function add()
    {
        $permissionList = Permission::getPermission();
        return view('roles.add')->with(['permissionList'=> $permissionList]);
    }
    
    /**
     * 保存
     *
     * @param ob $request
     */
    public function save(RolesRequest $request)
    {
        $role_id = Role::do_roles_add($request);

        if ($request->permission_id) {
            $request->role_id = $role_id;
            $re = Permission::rolesAddPermission($request);
        }
        
        if ($role_id) {
            return redirect('/roles')->withErrors('操作完成');
        }else{
            return redirect('/roles')->withErrors('操作失败');
        }
    }
    
    /**
     * 编辑表
     *
     * @param ob $request
     */
    public function edit( Request $request )
    {
        $role_info = Role::getRoleInfo($request);
        
        $role_permission_list = $this->rolesService->handlePermissiont($request);
        
        return view('roles.edit')->with( 
            [
                'permissionList' => $role_permission_list,
                'role_info' => $role_info,
                'role_id'   => $request->role_id
            ]
        );
    }
    
    /**
     * 保存
     *
     * @param ob $request
     */
    public function store( Request $request )
    {
        $roleInfo = Role::getRoleInfo( $request );
        $validateRule = array(
            'name'  => 'required|min:2|unique:roles',
            'display_name'    => 'required|min:2',
        );
        
        if($roleInfo->name == $request->name ){
            unset($validateRule['name']);
        }
        
        $this->validate($request, $validateRule);
        $re = Role::doRoleEdit($request);
        
        if ($re) {
            return redirect('/roles')->withErrors('修改完成');
        } else {
            return redirect('/roles')->withErrors('修改失败');
        }
        
    }
    
    /**
     * 编辑角色的权限
     *
     * @param ob $request
     */
    public function rolePermissionEdit( Request $request )
    {
        $role_id = $request->id;
        $permissionList = Permission::getPermission();

        //获得permission_role by role id
        $rolePermissionList = Permission::getRolePermission($request);
  
        $data = [];
        for($i=0; $i < count($rolePermissionList); $i++){
            $data[] = $rolePermissionList[$i]->permission_id;
        }
        
        //标记现有的权限
        for( $k=0; $k<count($permissionList);$k++){
            if (in_array($permissionList[$k]->id, $data)) {
                $permissionList[$k]->checked = 'checked';
            } else {
                $permissionList[$k]->checked = false;
            }
        }
        
        //获得角色名字
        $roleinfo = Role::getRoleInfo( $request );
        
        if (empty($role_id)) {
            return Redirect::to('/roles');
        }
        return view('roles.permission_edit')->with(['permissionList'=> $permissionList,'role_id'=>$role_id,'roleinfo'=>$roleinfo]);
    } 

    /**
     * 保存编辑角色权限
     *
     * @param ob $request
     */
    public function rolePermissionStore( Request $request )
    {
        //没有权限执行清空权限操作
        if ($request->permission_id==null) {
            Permission::clearPermission($request->role_id);
            return redirect('/roles')->withErrors('操作完成');
        }
        
        if ($request->permission_id) {
            $re = Permission::rolesAddPermission($request);
            if ($re) {
                return redirect('/roles')->withErrors('操作完成');
            }
        }
        // return Redirect::to('/admins/roles_edit');
        return redirect('/roles/rolePermissionEdit')->withErrors('出现了错误');
    }

    public function delete( Request $request )
    {
        $re = Role::roleDelete($request);
        return redirect('/roles')->withErrors('删除完成');
    }

}