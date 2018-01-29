<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Uploadfile
{
    private $ci;
    protected $uploadData = array();
    protected $config     = array();

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->library('upload');
        $this->uploadData = array(
            'success'  => false,
            'errorMsg' => '',
            'data'     => array(),
        );

        $this->config['upload_path']   = '';
        $this->config['allowed_types'] = 'exe';
        $this->config['detect_mime']   = false;
        // $this->config['max_size']             = 1024;
        $this->_init($this->config);
    }

    public function _init($config = array())
    {
        if (!empty($config)) {
            $this->config = $config;
            $this->ci->upload->initialize($config);
        }
    }

    public function upload($file_name)
    {
        if (count($_FILES) > 0) {
            if (!$this->ci->upload->do_upload($file_name)) {
                $this->uploadData['errorMsg'] = $this->ci->upload->display_errors();
            } else {
                $this->uploadData['success'] = true;
                $this->uploadData['data']    = $this->ci->upload->data();
            }
        } else {            
            if (!$this->ci->upload->do_upload($file_name)) {
                $this->uploadData['errorMsg'] = $this->ci->upload->display_errors();                    
            }
            
        }

        return $this->uploadData;
    }

    public function multiUpload()
    {
        if (count($_FILES) > 0) {
            foreach ($_FILES as $field=>$file){                
                if (!$this->ci->upload->do_upload($field)) {
                    $this->uploadData['errorMsg'] .= $field . $this->ci->upload->display_errors();
                } else {
                    $this->uploadData['success'] = true;
                    $this->uploadData['data'][$field]    = $this->ci->upload->data();
                }
            }
        } else {
            
        }

        return $this->uploadData;
    }

}
