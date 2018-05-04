<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
    }

    public function index()
    {        
        $this->data["title"] = '最新消息管理';
        
        $this->load->library('pagination');
        
        $get         = $this->input->get(null, true);
        $get['page'] = ($this->input->get('page') != '') ? $this->input->get('page') : 1;
        
        $per_page             = PER_PAGE;
        $config['base_url']   = base_url($this->folder . '/' . $this->ctl . '/' . $this->method);
        $config['total_rows'] = $this->news_model->countListByQuery($get);
        $config['per_page']   = $per_page;
        
        $limit = array(($get['page'] - 1) * $per_page, $per_page);
        
        // 分頁
        $this->pagination->initialize($config);
        $this->data['pages'] = $this->pagination->create_links();
        $this->data['lists'] = $this->news_model->getListByQuery($get, $limit);
        
        // 取得類型，狀態
        $this->data['status'] = $this->config->item('common_status', 'website_config');
        
        // $js = array(
        // 		'assets/apps/js/admin/news_list',
        // );
        // $this->setJS($js);
        
        $this->render('admin/news_list_view', $this->data);
    }

    public function add()
    {
        $this->data["title"] = '新增最新消息';

        $js = array(
        		'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min',
                'assets/global/plugins/jquery-validation/js/jquery.validate.min',
                'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
				'js/ckeditor/ckeditor',
        		'js/ckfinder/ckfinder',
                'assets/apps/scripts/admin/news',
            );
        $this->setJS($js);
        $css = array(
        	'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min',
            'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
        );
        $this->setCSS($css);
		
        $this->render('admin/news_detail_view', $this->data);
    }

    public function add_news()
    {        
        $fields = array(
        	'n_title',
            'n_content',
            'n_post',
            'n_status',
        );
        
        $this->data['post'] = $this->input->post($fields, true);
        $result             = $this->form_check();
        if ($result === true) {
            // insert
            $this->data['post']['n_created'] = date('Y-m-d H:i:s');
            if ($id = $this->news_model->insert($this->data['post'])) {
                $this->response['Status']       = true;
                $this->response['MessageTitle'] = '成功';
                $this->response['Message']      = '新增成功';
            } else {
                $this->response['MessageTitle'] = '失敗';
                $this->response['Message']      = '新增失敗，資料庫錯誤';
            }  
        } else {
        	$this->response['MessageTitle'] = '新增失敗';
        	$this->response['Message']      = $result;
        }
        
        $this->ajax_output();
    }
    
    public function detail($id)
    {
    	$this->data["title"] = '修改最新消息';
    	if ($id) {
    		$where = array(
				'n_id' => $id,
    		);
    		$this->data['news'] = $this->news_model->getByParam(false, $where);
    	
    		if (empty($this->data['news'])) {
    			// no member, show error
    			$message = array(
					'form_title'      => '錯誤',
					'portlet_caption' => '錯誤',
					'form_message'    => '查無最新消息資料',
					'url'             => '/admin/'.strtolower(__CLASS__),
					'link_name'       => '返回最新消息管理',
    			);
    	
    			$this->session->set_flashdata('flash_message', $message);
    			redirect('admin/message');
    		}
	    	$js = array(
	    			'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min',
	    			'assets/global/plugins/jquery-validation/js/jquery.validate.min',
                    'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
	    			'js/ckeditor/ckeditor',
	    			'js/ckfinder/ckfinder',
	    			'assets/apps/scripts/admin/news',
	    	);
	    	$this->setJS($js);
	    	$css = array(
	    			'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min',
                    'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
	    	);
	    	$this->setCSS($css);
	    	
	    	$this->render('admin/news_detail_view', $this->data);
    	} else {
    		redirect('admin/news');
    	}
    }
    
    public function update_news()
    {
    	$fields = array(
			'n_title',
			'n_content',
			'n_post',
            'n_status',
    	);
    
    	$this->data['post'] = $this->input->post($fields, true);
    	$result             = $this->form_check();
    	$where              = array('n_id' => $this->input->post('n_id'));
    	$news             	= $this->news_model->getByParam(false, $where);
    	if ($result === true && !empty($news)) {
            $this->data['post']['n_modified'] = date('Y-m-d H:i:s');
            
            if ($this->news_model->update($this->data['post'], $where)) {
                $this->response['Status']       = true;
                $this->response['MessageTitle'] = '成功';
                $this->response['Message']      = '修改成功';
            } else {
                $this->response['MessageTitle'] = '失敗';
                $this->response['Message']      = '修改失敗，資料庫錯誤';
            }
    	} else {
    		$this->response['MessageTitle'] = '修改失敗';
    		$this->response['Message']      = $result;
    	}
    
    	$this->ajax_output();
    }
    
    public function delete_news()
    {
    	// $where              = array('n_id' => $this->input->post('id'));
    	// $news             	= $this->news_model->getByParam(false, $where);
    	// if (!empty($news)) {
     //        $updateData = array('n_status' => 3);
     //   		if ($this->news_model->update($updateData, $where)) {
    	// 		$this->response['Status']       = true;
    	// 		$this->response['MessageTitle'] = '成功';
    	// 		$this->response['Message']      = '刪除成功';
    	// 	} else {
    	// 		$this->response['MessageTitle'] = '失敗';
    	// 		$this->response['Message']      = '刪除失敗，資料庫錯誤';
    	// 	}
    	// } else {
    	// 	$this->response['MessageTitle'] = '修改失敗';
    	// 	$this->response['Message']      = '查無資料';
    	// }
    	 
    	// $this->ajax_output();
    }

    /**
     * 表單檢查
     * @return [type] [description]
     */
    private function form_check()
    {
    	$this->load->library('form_validation');
    
    	$this->form_validation->set_rules('n_title', '標題', 'required|min_length[2]|max_length[255]');
    	$this->form_validation->set_rules('n_content', '內容', 'required');
    	$this->form_validation->set_rules('n_status', '狀態', 'is_natural');
    
    	// set errorw message
    	$this->form_validation->set_message('required', '請輸入 {field}');
    	$this->form_validation->set_message('min_length', '{field} 最少需要輸入 {param} 字元');
    	$this->form_validation->set_message('max_length', '{field} 最多只能輸入 {param} 字元');
    
    	// validate
    	if ($this->form_validation->run() == false) {
    		$errors = strip_tags(validation_errors());
    		$errors = str_replace("\n", '<br>', $errors);
    		return $errors;
    	} else {
    		return true;
    	}
    }

    
}
