<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function index()
    {
    	$this->data['title'] = '管理者管理';
    	$this->load->library('pagination');
    
    	$get         = $this->input->get(null, true);
    	$get['page'] = ($this->input->get('page') != '') ? $this->input->get('page') : 1;
    
    	$per_page             = PER_PAGE;
    	$config['base_url']   = base_url($this->ctl . '/' . $this->method);
    	$config['total_rows'] = $this->admin_model->countListByQuery($get);
    	$config['per_page']   = $per_page;
    
    	$limit = array(($get['page'] - 1) * $per_page, $per_page);
    
    	// 分頁
    	$this->pagination->initialize($config);
    	$this->data['pages'] = $this->pagination->create_links();
    	$this->data['lists'] = $this->admin_model->getListByQuery($get, $limit);
    
    	// admin status
    	$this->data['admin_status'] = $this->config->item('admin_status', 'website_config');
    
    	// set js
    	$js = array(
    		'assets/global/plugins/jquery-validation/js/jquery.validate.min',
    		'assets/apps/scripts/admin/admin_list',
    	);
    	$this->setJs($js);
    
    	$this->render('admin/admin_list_view', $this->data);
    }
    
    public function detail($id = null)
    {
    	$this->data['title'] = '管理者資料';
    
    	if ($id) {
    		$where = array(
    			'a_id' => $id,
    		);
    		$admin                       = $this->admin_model->getByParam(false, $where);
    		$this->data['administrator'] = $admin;
    
    		if (!empty($this->data['administrator'])) {    		
    			// 取得管理者權限
//     			$this->data['permissions']    = $this->admin_permission_model->getPermissionByAdmin($id);
//     			$this->data['permissionView'] = $this->load->view($this->languageFolder . 'setting/admin_permission_view', $this->data, true);
    
    			// set js
		    	$js = array(
		    		'assets/global/plugins/jquery-validation/js/jquery.validate.min',
		    		'assets/apps/scripts/admin/admin',
		    	);
		    	$this->setJs($js);
		    	
		    	// admin status
		    	$this->data['admin_status'] = $this->config->item('admin_status', 'website_config');
    
    			$this->render('admin/admin_detail_view', $this->data);
    		} else {
    			// no member, show error
    			$message = array(
    					'form_title'      => $this->lang->line('error'),
    					'portlet_caption' => $this->lang->line('error'),
    					'form_message'    => $this->lang->line('not_find') . $this->lang->line('admin_data'),
    					'url'             => $this->ctl,
    					'link_name'       => $this->lang->line('back') . $this->lang->line('admin_data'),
    			);
    
    			$this->session->set_flashdata('flash_message', $message);
    			redirect('message');
    		}
    	}
    }
    
    public function add()
    {
    	$this->data['title'] = '新增管理者';
        	
    	// 取得權限array
//     	$this->data['permission_list'] = $this->config->item('admin_tms', 'global_permission');    
//     	$this->data['permissionView'] = $this->load->view($this->languageFolder . 'setting/admin_permission_view', $this->data, true);
    
    	// 取得角色
//     	$this->data['roles'] = $this->config->item('admin_role', 'global_permission');
    
    	// set js
    	$js = array(
    		'assets/global/plugins/jquery-validation/js/jquery.validate.min',
    		'assets/apps/scripts/admin/admin',
    	);
    	$this->setJs($js);
    
    	// admin status
    	$this->data['admin_status'] = $this->config->item('admin_status', 'website_config');
    	
    	$this->render('admin/admin_detail_view', $this->data);
    }
    
    public function add_admin()
    {
    	$fields = array(
    		'a_account',
    		'a_email',
    		'a_password',
    		'a_displayname',
    		'a_status',
    	);
    
    	$this->data['post'] = $this->input->post($fields, true);
    	$result             = $this->form_check(__FUNCTION__);
    	if ($result === true) {
    		$this->data['post']['a_password']    = md5($this->data['post']['a_password'] );
    		$this->data['post']['a_created'] = date('Y-m-d H:i:s');
    		if ($idx = $this->admin_model->insert($this->data['post'])) {    			
    			$this->response['Status']       = true;
    			$this->response['MessageTitle'] = '成功';
    			$this->response['Message']      = '新增成功';
    		} else {
    			$this->response['MessageTitle'] = '新增失敗';
    			$this->response['Message']      = '資料庫錯誤';
    		}
    
    	} else {
    		$this->response['data'] = $this->data['post'];
    		$this->response['datas'] = $this->input->post();
    		$this->response['Message'] = $result;
    	}
    
    	$this->ajax_output();
    }
    
    public function update_admin()
    {
    	$fields = array(
    		'a_account',
    		'a_email',
    		'a_password',
    		'a_displayname',
    		'a_status',
    	);
    
    	$this->data['post'] = $this->input->post($fields, true);
    	$result             = $this->form_check(__FUNCTION__);
    	if ($result === true) {
    		if (isset($this->data['post']['a_password']) && $this->data['post']['a_password'] != ''){
    			$this->data['post']['a_password'] = md5($this->data['post']['a_password']);
    		} else {
    			unset($this->data['post']['a_password']);
    		}
    		$id = $this->input->post('a_id', true);
    		if ($this->admin_model->update($this->data['post'], array('a_id' => $id))) {
    			$this->response['Status']       = true;
    			$this->response['MessageTitle'] = '成功';
    			$this->response['Message']      = '修改成功';
    		} else {
    			$this->response['MessageTitle'] = '修改失敗';
    			$this->response['Message']      = '資料庫錯誤';
    		}
    
    	} else {
    		$this->response['Message'] = $result;
    	}
   
    	$this->ajax_output();
    }
    
    /**
     * 商店表單檢查
     * @return [type] [description]
     */
    private function form_check($method)
    {
    	$this->load->library('form_validation');
    
    	// set rule
    	$this->form_validation->set_rules('a_account', '帳號', array(
    			'required',
    			'trim',
    			'alpha_dash',
    			'min_length[3]',
    			'max_length[30]',
    			array(
    					'account_check',
    					function ($value) {
    						// 檢查帳號
    						$isExist = $this->admin_model->existAdmin($value, $this->input->post('a_id'));
    						return ($isExist === true) ? false : true;
    					},
    			),
    	)
    	);
    	$this->form_validation->set_rules('a_email', 'Email', 'required|trim|valid_email|max_length[90]');
    	$this->form_validation->set_rules('a_displayname', '暱稱', 'required|trim|min_length[2]|max_length[20]');
    	if ($method == 'add_admin'){
    		$this->form_validation->set_rules('a_password', '密碼', 'required|trim|min_length[3]|max_length[12]');
//     		$this->form_validation->set_rules('re_password', '確認密碼', 'required|trim|matches[a_password]');
    	} else {
//     		$this->form_validation->set_rules('re_password', '確認密碼', 'trim|matches[a_password]');    		
    	}
    
    	// set errorw message
    	$this->form_validation->set_message('required', '請輸入 {field}');
    	$this->form_validation->set_message('min_length', '{field} 最少需要輸入 {param} 字元');
    	$this->form_validation->set_message('max_length', '{field} 最多只能輸入 {param} 字元');
    	$this->form_validation->set_message('account_check', '{field} 已存在');
    	$this->form_validation->set_message('valid_email', '請確認{field}格式是否正確');
//     	$this->form_validation->set_message('matches', '{field}要跟密碼相同');
    	$this->form_validation->set_message('alpha_dash', '{field}只能中輸入英文跟_');
    	// validate
    	if ($this->form_validation->run() == false) {
    		$errors = strip_tags(validation_errors());
    		$errors = str_replace("\n", "<br>", $errors);
    		return $errors;
    	} else {
    		return true;
    	}
    }
    
}
