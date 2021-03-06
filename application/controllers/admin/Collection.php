<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Collection extends MY_Controller
{

    private $uploadPath;
    private $uploadFolder;

    public function __construct()
    {
        parent::__construct();

        $this->load->model('collection_model');
        $this->load->model('collection_main_model');
        $this->load->model('collection_product_relaction_model');

        $this->load->library('uploadfile');

        $this->uploadPath   = $_SERVER['DOCUMENT_ROOT'] . '/public/upload/';
        $this->uploadFolder = 'collection/';
    }

    public function index($cm_id = 0)
    {
        $this->data["title"] = '集合管理';

        $this->checkCollectionMain($cm_id);

        $this->load->library('pagination');

        $get               = $this->input->get(null, true);
        $get['cm_id']      = $cm_id;
        $get['page']       = ($this->input->get('page') != '') ? $this->input->get('page') : 1;
        $this->data['get'] = $get;

        $per_page             = PER_PAGE;
        $config['base_url']   = base_url($this->folder . '/' . $this->ctl . '/' . $this->method);
        $config['total_rows'] = $this->collection_model->countListByQuery($get);
        $config['per_page']   = $per_page;

        $limit = array(($get['page'] - 1) * $per_page, $per_page);

        // 分頁
        $this->pagination->initialize($config);
        $this->data['pages'] = $this->pagination->create_links();
        $this->data['lists'] = $this->collection_model->getListByQuery($get, $limit);

        // status
        $this->data['status'] = $this->config->item('common_status', 'website_config');
        unset($this->data['status']['3']);

        $js = array(
//                 'assets/apps/scripts/admin/news_list',
        );
        $this->setJS($js);

        $this->render('admin/collection_list_view', $this->data);
    }

    public function add($cm_id = 0)
    {
        $this->data["title"] = '新增集合';

        $this->checkCollectionMain($cm_id);

        $this->data['cm_id'] = $cm_id;

        // 取得所有商品
        // $this->load->model('product_main_model');
        // $this->data['products'] = $this->product_main_model->getByParam(true, array('pm_status !=' => 2));

        $js = array(
            'assets/global/plugins/jquery-validation/js/jquery.validate.min',
            'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
            'assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min',
            'assets/global/plugins/select2/js/select2.full.min',
            'assets/global/plugins/icheck/icheck.min',
            'assets/apps/scripts/admin/collection',
        );
        $this->setJS($js);

        $css = array(
            'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
            'assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput',
            'assets/global/plugins/select2/css/select2.min',
            'assets/global/plugins/select2/css/select2-bootstrap.min',
            'assets/global/plugins/icheck/skins/all',
        );
        $this->setCSS($css);

        $this->render('admin/collection_detail_view', $this->data);
    }

    public function add_collection()
    {
        $fields = array(
            'cm_id',
            'c_title',
            'c_status',
        );

        $this->data['post'] = $this->input->post($fields, true);
        $result             = $this->form_check();

        // file upload
        $config['upload_path']   = $this->uploadPath . $this->uploadFolder;
        $config['allowed_types'] = 'jpg|png|gif|jpeg';
        $this->uploadfile->_init($config);
        $fileData = $this->uploadfile->upload('c_image');
        if ($result === true && $fileData['success'] == true) {
            //商品圖
            if (!empty($fileData['data'])) {
                $this->data['post']['c_image'] = $fileData['data']['file_name'];
            }
            $this->data['post']['c_created'] = date('Y-m-d H:i:s');
            if ($id = $this->collection_model->insert($this->data['post'])) {
                $this->insert_relaction($id);

                $this->response['Status']       = true;
                $this->response['MessageTitle'] = '成功';
                $this->response['Message']      = '新增成功';
                $this->response['Url']          = '/admin/collection/index/' . $this->data['post']['cm_id'];
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

    public function detail($cm_id, $id)
    {
        $this->data["title"] = '修改集合';
        if ($id) {
            $this->checkCollectionMain($cm_id);

            $this->data['cm_id'] = $cm_id;

            $where = array(
                'c_id' => $id,
            );
            $this->data['collection'] = $this->collection_model->getByParam(false, $where);

            if (empty($this->data['collection'])) {
                // no member, show error
                $message = array(
                    'form_title'      => '錯誤',
                    'portlet_caption' => '錯誤',
                    'form_message'    => '查無集合資料',
                    'url'             => '/admin/' . strtolower(__CLASS__),
                    'link_name'       => '返回集合管理',
                );

                $this->session->set_flashdata('flash_message', $message);
                redirect('admin/message');
            }

            // 取得所有商品
            // $this->load->model('product_main_model');
            // $this->data['products'] = $this->product_main_model->getByParam(true, array('pm_status !=' => 2));
            // 取得relaction的資料
            // $query         = array('c_id' => $id);
            // $order         = array();
            // $column        = array('collection_product_relaction.pm_id');
            // $relaction     = $this->collection_product_relaction_model->getListByQuery($query, null, $order, $column);
            // $new_relaction = array();
            // foreach ($relaction as $key => $value) {
            //     if (!in_array($value['pm_id'], $new_relaction)) {
            //         array_push($new_relaction, $value['pm_id']);
            //     }
            // }
            // unset($relaction);
            // $this->data['relaction'] = $new_relaction;

            $this->data['relaction_data'] = $this->collection_product_relaction_model->getTagsinputByCollection($id);

            $js = array(
                'assets/global/plugins/jquery-validation/js/jquery.validate.min',
                'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
                'assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min',
                'assets/global/plugins/select2/js/select2.full.min',
                'assets/global/plugins/icheck/icheck.min',
                'assets/apps/scripts/admin/collection',
            );
            $this->setJS($js);

            $css = array(
                'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
                'assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput',
                'assets/global/plugins/select2/css/select2.min',
                'assets/global/plugins/select2/css/select2-bootstrap.min',
                'assets/global/plugins/icheck/skins/all',
            );
            $this->setCSS($css);

            $this->render('admin/collection_detail_view', $this->data);
        } else {
            redirect('admin/collection');
        }
    }

    public function update_collection()
    {
        $fields = array(
            'cm_id',
            'c_title',
            'c_status',
        );

        $c_id               = $this->input->post('c_id', true);
        $this->data['post'] = $this->input->post($fields, true);
        $result             = $this->form_check();
        $where              = array('c_id' => $c_id);
        $item               = $this->collection_model->getByParam(false, $where);

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

            if ($this->collection_model->update($this->data['post'], $where)) {
                $this->insert_relaction($c_id);

                $this->response['Status']       = true;
                $this->response['MessageTitle'] = '成功';
                $this->response['Message']      = '修改成功<br>' . $fileData['errorMsg'];
                $this->response['Url']          = '/admin/collection/index/' . $this->data['post']['cm_id'];
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

    private function insert_relaction($c_id)
    {
        $now    = date('Y-m-d H:i:s');
        $where  = array('c_id' => $c_id);
        // $pm_ids = $this->input->post('pm_id', true);
        $pm_ids = explode(',', $this->input->post('pm_ids', true));
        if (is_array($pm_ids) && count($pm_ids) > 0) {
            $this->collection_product_relaction_model->delete($where);
            $batch_arr = array();
            foreach ($pm_ids as $pm_id) {
                array_push($batch_arr, array('c_id' => $c_id, 'pm_id' => $pm_id, 'cpr_created' => $now));
            }
            $this->collection_product_relaction_model->insertBatch($batch_arr);
        }
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

    protected function checkCollectionMain($cm_id)
    {
        $collection_main = $this->collection_main_model->getByParam(false, ['cm_id' => $cm_id]);
        if (!$collection_main) {
            redirect('admin/collectionmain');
            exit;
        }
    }

    /**
     * 表單檢查
     * @return [type] [description]
     */
    private function form_check()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('c_title', '主集合', 'required');
        $this->form_validation->set_rules('c_title', '集合名稱', 'required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('c_status', '狀態', 'required|numeric');

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
