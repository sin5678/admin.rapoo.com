<?php 

namespace App\Models;

use Zizaco\Entrust\EntrustPermission;
use DB;

class Permission extends EntrustPermission
{

    /**
     * 获得权限
     *
     * @param
     */
    public static function getPermission()
    {
        
       return DB::table('permissions')
       ->select('permissions.*','pc.cat as pcat','pc.showname as showname' )
       ->leftJoin('permission_cat as pc','permissions.cat','=','pc.id')->orderBy('permissions.cat', 'desc')->get();
    }
    
    /**
     * 获得权限
     *
     * @param int $request->id
     */
    public static function getPermissionById($request)
    {
    
        return DB::table('permissions')->where('id','=',$request->id)->first();
    }
    
    /**
     * 获得权限
     *
     * @param array $ids
     */
    public static function getPermissionInIds($ids)
    {
        return DB::table('permissions')->whereIn('id', $ids)->get();
    }
    
    /**
     * 增加权限
     *
     * @param ob $request
     */
    public static function doPermissionAdd($request)
    {
        
        $data=array();
        $data['name']           = $request->name;
        $data['display_name']   = $request->display_name;
        $data['description']    = $request->description;
        $data['cat']            = $request->cat;
        $data['created_at']     = date("Y-m-d H:i:s",time());
        
        return DB::table('permissions')->insertGetId($data );
    }
    
    /**
     * 获得角色权限
     *
     * @param int $request->id;
     */
    public static function getRolePermission($request)
    {
        return DB::table('permission_role')->select('permission_id')->where('role_id','=',$request->id)->get();
    }
    
    /**
     * 角色加权限
     *
     * @param int $request->id; int $request->role_id
     */
    public static function rolesAddPermission($request)
    {
        self::clearPermission($request->role_id);
        $rids = $request->permission_id;
        for($i=0;$i<count($rids);$i++){
            $data = array();
            $data['permission_id'] = $rids[$i];
            $data['role_id']    = $request->role_id;
            DB::table('permission_role')->insertGetId($data);
        }
        return true;
    }
    
    /**
     * 权限属性编辑
     *
     * @param ob $request
     */
    public static function doPermissionEdit($request)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['display_name'] = $request->display_name;
        $data['description']  = $request->description;
        $data['cat']            = $request->cat;
        $data['updated_at']  = date("Y-m-d H:i:s",time());
        return DB::table('permissions')->where('id', $request->pid)->update($data);
    }
    
    /**
     * 清空角色权限
     *
     * @param int $role_id
     */
    public static function clearPermission($role_id)
    {
       return DB::table('permission_role')->where('role_id', '=', $role_id)->delete();
    }
    
    /**
     * 删除权限
     *
     * @param ob $request->id (pid)
     */
    public static function permissionDelete($request)
    {
        return DB::table('permissions')->where('id', '=', $request->id )->delete();
    }
    
    /**
     * 获得权限分类
     *
     * @param
     */
    public static function getPermissionCat()
    {
    
        return DB::table('permission_cat')->get();
    }
    
}//