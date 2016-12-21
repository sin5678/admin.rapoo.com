<?php

namespace App\Services;

use App\Models\Role;
use App\Models\Permission;
use App\Services\BaseService;
use DB,Validator,Hash;

class AdminsService extends BaseService
{
    
    /**
     * 管理员表
     *
     * @param
     */
    public function getList()
    {
        $re = DB::table('admins')
        ->leftJoin('role_admin', 'role_admin.admin_id', '=', 'admins.id')
        ->leftJoin('roles', 'roles.id', '=', 'role_admin.role_id')
        ->select('admins.*', 'role_admin.*', 'roles.id as rid', 'roles.id as rname', 'roles.display_name as rdisplay_name')
        ->orderBy('admins.id', 'desc')
        ->paginate(12);
        return $re;
    }
    
    /**
     * 获取管理员
     *
     * @param (int) $admin_id
     */
    public function getUser($admin_id)
    {
    
        $re = DB::table('admins')
        ->where('admins.id', '=', $admin_id)
        ->leftJoin('role_admin', 'role_admin.admin_id', '=', 'admins.id')
        ->leftJoin('roles', 'roles.id', '=', 'role_admin.role_id')
        ->select('admins.*', 'role_admin.*', 'roles.id as rid', 'roles.id as rname', 'roles.display_name as rdisplay_name')
        ->first();
        return $re;
    }
    
    /**
     * 增加加管理员
     *
     * @param (object) $request
     */
    public function createUser($request)
    {
    
        $data=array();
        
        $data['account']    = $request->account;
        $data['real_name']  = $request->real_name;
        $data['email']      = $request->email;
        $data['password']   = Hash::make($request->password);
        $data['client_ip']  = $_SERVER['REMOTE_ADDR'];
        $data['created_at'] = date("Y-m-d H:i:s",time());
        
        $role_id = $request->role_id;
    
        $uid = $this->create_admin_user( $data );
    
        if($uid && $role_id){
            
            $role_admin_data['admin_id']= $uid;
            
            $role_admin_data['role_id'] = $role_id;
            
            $role_admin_id = $this->create_admin_role($role_admin_data);
            
        }
        return $uid;
        
    }
    
    /**
     * 执行增加加管理员
     *
     * @param (arr) $data
     */
    public function create_admin_user($data)
    {
    
        $user = DB::table('admins')->where('account', $data['account'] )->first();
        if($user)
        {
            return false;
        }
        
        $id =  DB::table('admins')->insertGetId($data);
        return $id;
    
    }
    
    /**
     * 给予新管理员角色
     *
     * @param (arr) $data
     */
    public function create_admin_role($data)
    {
        return  DB::table('role_admin')->insertGetId($data);
    }
    
    /**
     * 执行编辑管理员
     *
     * @param (arr) $data
     */
    public function store($request)
    {
    
        $admin_id = $request->admin_id;
         
        $data=array();
        $data['account']    = $request->account;
        $data['real_name']  = $request->real_name;
        $data['email']      = $request->email;
        $data['client_ip']  = $_SERVER['REMOTE_ADDR'];
        $data['updated_at'] = date("Y-m-d H:i:s",time());
        
        if( $request->password === $request->repassword && (strlen($request->password) >=6 ) )
        {
            $data['password']   = Hash::make($request->password);
        }
    
        //更新role
        $getRole = DB::table('role_admin')->where('admin_id', $admin_id)->get();
    
        if( $getRole )
        {
            //更新
            DB::table('role_admin')->where('admin_id', $admin_id)->update(['role_id'=>$request->role_id]);
        } else {
            //添加
            DB::table('role_admin')->insertGetId( [ 'role_id' => $request->role_id , 'admin_id' => $admin_id ]);
        }
    
        //更新admin
        return DB::table('admins')->where('id', $admin_id)->update($data);
    }
    
    /**
     * 执行删除管理员
     *
     * @param (arr) $data
     */
    public function delete($request)
    {
        return DB::table('admins')->where('id', '=', $request )->delete();
    }
    
    
}//