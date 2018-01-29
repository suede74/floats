<?php

class Admin_permission_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAccessControllerMethod($idx, $serviceName, $folderName, $controller, $method)
    {
        $where = array(
            "admin_idx"             => intval($idx),
            "service_name"    => $serviceName,
            "folder_name"     => $folderName,
            "controller_name" => $controller,
            "function_name"   => $method,
        );

        return $this->select(false, "array", $where);
    }

    public function insertPermission($idx, $serviceName, $folderName, $controller, $method, $allowed)
    {
        $insertData = array(
            "admin_idx"             => intval($idx),
            "service_name"    => $serviceName,
            "folder_name"     => $folderName,
            "controller_name" => $controller,
            "function_name"   => $method,
            "allowed"         => intval($allowed),
        );

        return $this->insert($insertData);
    }

    public function updatePermission($idx, $serviceName, $folderName, $controller, $method, $allowed)
    {
        $updateData = array(
            "allowed" => intval($allowed),
        );

        $where = array(
            "admin_idx"             => intval($idx),
            "service_name"    => $serviceName,
            "folder_name"     => $folderName,
            "controller_name" => $controller,
            "function_name"   => $method,
        );

        return $this->update($updateData, $where);
    }

    public function getPermissionByAdmin($adminIdx)
    {
        $where = array(
            "admin_idx" => $adminIdx,
        );

        $permissinoData = $this->select(true, "array", $where);
        $permissions = array();
        if ($permissinoData){
            foreach ($permissinoData as $row=>$data){
                $key = $data['folder_name'].'_'.$data['controller_name'].'_'.$data['function_name'];
                $permissions[$key] = $data['allowed'];
            }    
        }
        
        return $permissions;
    }
}
