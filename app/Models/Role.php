<?php 

namespace App\Models;

use Zizaco\Entrust\EntrustRole;
use DB;

class Role extends EntrustRole
{
    //获得角色list
    public static function get_roles_list(){
        $re = DB::table('roles')
        ->orderBy('roles.id', 'desc')
        ->paginate(10);
        return $re;
    }
    
    //获得角色by id
    public static function getRoleInfo($request){
        $re = DB::table('roles')->where('id', '=', $request->id )->first();
        return $re;
    }
    
    
    //增加角色
    public static function do_roles_add($request){
        $data = array();
        $data['name']         = $request->name;
        $data['display_name'] = $request->display_name;
        $data['description']  = $request->description;
        $data['created_at']   = date("Y-m-d H:i:s",time());
        return DB::table('roles')->insertGetId( $data );
    }
    
    //执行编辑角色信息
    public static function doRoleEdit($request){

        $data = array();
        $data['name'] = $request->name;
        $data['display_name'] = $request->display_name;
        $data['description']  = $request->description;
        $data['updated_at']  = date("Y-m-d H:i:s",time());
        
        return DB::table('roles')->where('id', $request->id)->update($data);
    }
    
    //执行删除角色
    public static function roleDelete($request){
        return DB::table('roles')->where('id', '=', $request->id )->delete();
    }
    
    
}//