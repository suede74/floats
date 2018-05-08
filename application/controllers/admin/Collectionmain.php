<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Collectionmain extends MY_Controller
{

    private $uploadPath;
    private $uploadFolder;
    
    public function __construct()
    {
        parent::__construct();        

        $this->load->model('collection_main_model');

        $this->load->library('uploadfile');

        $this->uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/public/upload/';
        $this->uploadFolder = 'cm/';
    }

    public function index()
    {
        $this->data["title"] = '主集合管理';

        $this->load->library('pagination');

        $get         = $this->input->get(null, true);
        $get['page'] = ($this->input->get('page') != '') ? $this->input->get('page') : 1;

        $per_page             = PER_PAGE;
        $config['base_url']   = base_url($this->folder . '/' . $this->ctl . '/' . $this->method);
        $config['total_rows'] = $this->collection_main_model->countListByQuery($get);
        $config['per_page']   = $per_page;

        $limit = array(($get['page'] - 1) * $per_page, $per_page);

        // 分頁
        $this->pagination->initialize($config);
        $this->data['pages'] = $this->pagination->create_links();
        $this->data['lists'] = $this->collection_main_model->getListByQuery($get, $limit);

        // status
        $this->data['status'] = $this->config->item('common_status', 'website_config');

        $js = array(
//                 'assets/apps/scripts/admin/news_list',
        );
        $this->setJS($js);

        $this->render('admin/collection_main_list_view', $this->data);
    }

    public function add()
    {
        $this->data["title"] = '新增主集合';

        $js = array(
            'assets/global/plugins/jquery-validation/js/jquery.validate.min',
            'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
            'assets/global/plugins/icheck/icheck.min',
            'assets/apps/scripts/admin/collection_main',
        );
        $this->setJS($js);

        $css = array(
            'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
            'assets/global/plugins/icheck/skins/all',
        );
        $this->setCSS($css);

        $this->render('admin/collection_main_detail_view', $this->data);
    }

    public function add_collection()
    {
        $fields = array(
            'cm_title',
            'cm_status',
        );

        $this->data['post'] = $this->input->post($fields, true);
        $result             = $this->form_check();

        // file upload
        $config['upload_path']   = $this->uploadPath . $this->uploadFolder;
        $config['allowed_types'] = 'jpg|png|gif|jpeg';
        $this->uploadfile->_init($config);
        $fileData = $this->uploadfile->upload('cm_image');
        if ($result === true && $fileData['success'] == true) {
            //商品圖
            if (!empty($fileData['data'])) {
                $this->data['post']['cm_image'] = $fileData['data']['file_name'];
            }
            $this->data['post']['cm_created'] = date('Y-m-d H:i:s');
            if ($id = $this->collection_main_model->insert($this->data['post'])) {
                $this->response['Status']       = true;
                $this->response['MessageTitle'] = '成功';
                $this->response['Message']      = '新增成功';
            } else {
                $this->response['MessageTitle'] = '失敗';
                $this->response['Message']      = '新增失敗，資料庫錯誤';
            }
        } else {
            $this->response['MessageTitle'] = '新增失敗';
            if ($fileData['success'] == false) {
                $this->response['Message'] = '請選擇檔案上傳';
            } else {
                $this->response['Message'] = $result;
            }
        }

        $this->ajax_output();
    }

    public function detail($id)
    {
        $this->data["title"] = '修改主集合';
        if ($id) {
            $where = array(
                'cm_id' => $id,
            );
            $this->data['collection'] = $this->collection_main_model->getByParam(false, $where);

            if (empty($this->data['collection'])) {
                // no member, show error
                $message = array(
                    'form_title'      => '錯誤',
                    'portlet_caption' => '錯誤',
                    'form_message'    => '查無主集合資料',
                    'url'             => '/admin/'.strtolower(__CLASS__),
                    'link_name'       => '返回主集合管理',
                );

                $this->session->set_flashdata('flash_message', $message);
                redirect('admin/message');
            }
            $js = array(
                'assets/global/plugins/jquery-validation/js/jquery.validate.min',
                'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
                'assets/global/plugins/icheck/icheck.min',
                'assets/apps/scripts/admin/collection_main',
            );
            $this->setJS($js);

            $css = array(
                'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
                'assets/global/plugins/icheck/skins/all',
            );
            $this->setCSS($css);

            $this->render('admin/collection_main_detail_view', $this->data);
        } else {
            redirect('admin/collectionmain');
        }
    }

    public function update_collection()
    {
        $fields = array(
            'cm_title',
            'cm_status',
        );

        $cm_id = $this->input->post('cm_id', true);
        $this->data['post'] = $this->input->post($fields, true);
        $result             = $this->form_check();
        $where              = array('cm_id' => $cm_id);
        $item               = $this->collection_main_model->getByParam(false, $where);
        
        if ($result === true && !empty($item)) {            
            // file upload
            $config['upload_path']   = $this->uploadPath . $this->uploadFolder;
            $config['allowed_types'] = 'jpg|png|gif|jpeg';
            $this->uploadfile->_init($config);
            $fileData = $this->uploadfile->multiUpload();

            if (!empty($fileData['data']) && count($fileData['data']) > 0) {
                foreach ($fileData['data'] as $field => $file) {
                    $this->data['post'][$field] = $file['file_name'];
                }
            }

            if ($this->collection_main_model->update($this->data['post'], $where)) {
                $this->response['Status']       = true;
                $this->response['MessageTitle'] = '成功';
                $this->response['Message']      = '修改成功<br>' . $fileData['errorMsg'];
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

    private function removeFolder($basePath, $folder)
    {
        if (is_dir($basePath . '/' . $folder)) {
            $folderDatas = scandir($basePath . '/' . $folder);
            if (count($folderDatas) > 2) {
                foreach ($folderDatas as $fd) {
                    if ($fd != '.' && $fd != '..') {
                        if (is_dir($basePath . '/' . $folder . '/' . $fd)) {
                            $this->removeFolder($basePath . '/' . $folder, $fd);
                        } else if (is_file($basePath . '/' . $fd)) {
                            unlink($basePath . '/' . $fd);
                        }
                    }
                }
            }
            rmdir($basePath . '/' . $folder);
        }
    }

    /**
     * 表單檢查
     * @return [type] [description]
     */
    private function form_check()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('cm_title', '主集合名稱', 'required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('cm_status', '狀態', 'required|numeric');

        // set errorw message
        $this->form_validation->set_message('required', '請輸入 {field}');
        $this->form_validation->set_message('min_length', '{field} 最少需要輸入 {param} 字元');
        $this->form_validation->set_message('max_length', '{field} 最多只能輸入 {param} 字元');
        $this->form_validation->set_message('numeric', '{field}只能輸入數字');

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
