<?php

namespace App\Services;

use App\Models\Role;
use App\Models\Permission;
use DB,Validator,Hash;

class RolesService 
{
    
    /**
     * 处理权限为可阅读文字
     *
     * @param ob $request
     */
    public function handlePermissiont($request){
        
        $permissions = Permission::getRolePermission($request);
        
        $pids = array();
        foreach($permissions as $k=>$v){
            $pids[] = $v->permission_id;
        }
        
        return Permission::getPermissionInIds($pids);
    }
    
}//