<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Systemvariable extends MY_Controller
{
    private $uploadPath;
    private $uploadFolder;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('system_variable_model');

        $this->uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/public/upload/';
        $this->uploadFolder = 'sv/';
    }

    public function index()
    {
        $this->data["title"] = '系統變數管理';

        $this->load->library('pagination');

        $get         = $this->input->get(null, true);
        $get['page'] = ($this->input->get('page') != '') ? $this->input->get('page') : 1;

        $per_page             = PER_PAGE;
        $config['base_url']   = base_url($this->folder . '/' . $this->ctl . '/' . $this->method);
        $config['total_rows'] = $this->system_variable_model->countListByQuery($get);
        $config['per_page']   = $per_page;

        $limit = array(($get['page'] - 1) * $per_page, $per_page);

        // 分頁
        $this->pagination->initialize($config);
        $this->data['pages'] = $this->pagination->create_links();
        $this->data['lists'] = $this->system_variable_model->getListByQuery($get, $limit);

        $this->render('admin/system_variable_list_view', $this->data);
    }

    public function detail($id)
    {
        $this->data["title"] = '修改系統變數';
        if ($id) {
            $where = array(
                'sv_id' => $id,
            );
            $this->data['variable'] = $this->system_variable_model->getByParam(false, $where);

            if (empty($this->data['variable'])) {
                // no member, show error
                $message = array(
                    'form_title'      => '錯誤',
                    'portlet_caption' => '錯誤',
                    'form_message'    => '查無系統變數資料',
                    'url'             => base_url($this->folder . '/' . $this->ctl),
                    'link_name'       => '返回系統變數管理',
                );

                $this->session->set_flashdata('flash_message', $message);
                redirect('admin/message');
            }
            $js = array(
                'assets/global/plugins/jquery-validation/js/jquery.validate.min',
                'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
                'assets/apps/scripts/admin/system_variable',
            );
            $this->setJS($js);

            $css = array(
                'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
            );
            $this->setCSS($css);

            $this->render('admin/system_variable_detail_view', $this->data);
        } else {
            redirect($this->folder . '/' . $this->ctl);
        }
    }

    public function update_variable()
    {
        $fields = array(
            'sv_value',
        );

        $where              = array('sv_id' => $this->input->post('sv_id'));
        $variable           = $this->system_variable_model->getByParam(false, $where);
        $this->data['post'] = $this->input->post($fields, true);
        $result             = $this->form_check($variable);
        if ($result === true && !empty($variable)) {
            if ($this->system_variable_model->update($this->data['post'], $where)) {
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

    /**
     * 表單檢查
     * @return [type] [description]
     */
    private function form_check($variable)
    {
        if ($variable) {
            if ($variable['sv_type'] == 'image') {
                $this->load->library('uploadfile');

                $config['upload_path']   = $this->uploadPath . $this->uploadFolder;
                $config['allowed_types'] = 'jpg|png|gif|jpeg';
                $this->uploadfile->_init($config);
                $fileData = $this->uploadfile->upload('sv_value');
                if ($fileData['success'] == true) {
                    $this->data['post']['sv_value'] = $fileData['data']['file_name'];
                }
                
                return ($fileData['success'])? true : $fileData['errorMsg'];
            } else {
                $this->load->library('form_validation');

                $this->form_validation->set_rules('sv_value', '值', 'required');

                // set errorw message
                $this->form_validation->set_message('required', '請輸入 {field}');
                $this->form_validation->set_message('min_length', '{field} 最少需要輸入 {param} 字元');
                $this->form_validation->set_message('max_length', '{field} 最多只能輸入 {param} 字元');

                // validate
                if ($this->form_validation->run() == false) {
                    $errors = strip_tags(validation_errors());
                    $errors = str_replace("\n", '<br>', $errors);
                    return $errors;
                }
            }
        }

        return true;
    }

}
