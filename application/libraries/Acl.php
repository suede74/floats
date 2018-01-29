<?php

class Acl 
{
    protected $ci;
	private $service_name;
    private $exception_controller; // 登入後不用設權限也可以使用

    public function __construct()
    {
        // parent::__construct();
        $this->ci = &get_instance();
        // $this->service_name = "admin.tms";
        $this->exception_controller = array(
            'admin' => array(
                'profile'
            )
        );
        $this->ci->load->model("admin_permission_model");
    }

    public function isAllowed($adminIdx, $folder, $controller, $func)
    {
        if ($this->ci->session->admin){
            return true;
        } else {
            return false;
        }
        /*
        if (isset($this->exception_controller[$folder]) && in_array($controller, $this->exception_controller[$folder])) {
            return true;
        } else if ($this->ci->session->admin['role'] != 'admin'){
            // 權限對照表
            $adminTmsPermissionMapping = $this->ci->config->item('admin_tms_permission_mapping', 'global_permission');
            // 功能對照表
            $mappingTransform = $this->ci->config->item('mapping_transform', 'global_permission');            
            $mappingMethod = $func;
            if (isset($mappingTransform[$folder][$controller][$func])){
                $mappingMethod = $mappingTransform[$folder][$controller][$func];
            }

            $permission = $this->ci->admin_permission_model->getAccessControllerMethod($adminIdx, $this->service_name, $folder, $controller, $mappingMethod);                    
            // 要有找到權限跟比對該function需要的權限等級&後要等於權限等級
            if (isset($permission['allowed']) && $permission['allowed'] > 0 && ($permission['allowed'] & $adminTmsPermissionMapping[$folder][$controller][$func]) === $adminTmsPermissionMapping[$folder][$controller][$func]){
                return true;
            } else {
                return false;
            }

        } else {
            return true;
        }
    	*/
    }
}
