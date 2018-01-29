<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MY_Controller extends CI_Controller
{
    // 資料物件
    public $data;
    // 輸出格式
    protected $response;
    protected $folder;
    // 繼承 MY_Controller 的 Controller Class 名稱
    protected $ctl;
    // 目前作用的Controller Method 名稱
    protected $method;
    // 登入資訊
    protected $admin;
    // user 語言設定
    protected $language;
    protected $language_folder;
    // 不檢查是否要登入
    protected $ignore_admin_ctl;
    protected $ignore_ctl;
    // minify js/css
    private $js;
    private $css;

    public function __construct()
    {
        parent::__construct();

        $this->config->load('website_config', true);

        $this->data     = array();
        $this->response = array(
            "Status"  => false,
            "Message" => "",
        );
        $this->ignore_admin_ctl = array(
            "login",
            "test",
        );
        $this->ignore_ctl = array(
            "Index",
            "Login",
            "Test",
        );

        $this->folder = str_replace('/', '', $this->router->fetch_directory());
        $this->ctl    = $this->router->fetch_class();
        $this->method = $this->router->fetch_method();

        $this->js  = array('minify' => array(), 'source' => array());
        $this->css = array('minify' => array(), 'source' => array());

        $this->setCSS(array(
            'source' => array(
                'assets/global/plugins/fancybox/source/jquery.fancybox',
            ),
        ));

        $this->setJS(array(
            'assets/global/plugins/jquery.min',
            'assets/global/plugins/bootstrap/js/bootstrap.min',
            'assets/global/plugins/js.cookie.min',
            'assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min',
            'assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min',
            'assets/global/plugins/jquery.blockui.min',
            'assets/global/plugins/uniform/jquery.uniform.min',
            'assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min',
            'assets/global/scripts/app.min',
            'assets/layouts/layout/scripts/layout.min',
            'assets/layouts/layout/scripts/demo.min',
            'assets/layouts/global/scripts/quick-sidebar.min',
        	'assets/global/plugins/fancybox/source/jquery.fancybox.pack',
            'assets/apps/scripts/jquery.form.min',
        	'assets/apps/scripts/admin/common',
        ));

        // load acl library
        $this->load->library("acl");
        // 確認使用者是不是需要登入
        $this->check_login();
        // 取得目前的使用者語系
        $this->language        = $this->get_language();
        $this->language_folder = $this->language . '/';
    }

    /**
     * -------------------------------------------
     *     建立版型
     * -------------------------------------------
     * @param string $view container view file
     * @param string $tpl template view file
     */
    protected function render($view = '', $view_data = array(), $navigation = 'admin_navigation_view', $tpl = 'admin_layout_view')
    {

        // 版型
        $data = array_merge(array(
            'title'      => $this->data["title"],
            'page_title' => $this->_setAppTitle($this->data["title"]),
            'global'     => $this->config->item('global_common'),
            'website'    => $this->config->item('website_config'),
            'js'         => $this->_resourceEncode($this->js, "js"),
            'css'        => $this->_resourceEncode($this->css, "css"),
        	'folder'     => $this->folder, 
            'ctl'        => $this->ctl,
            'method'     => $this->method,
        ), $view_data);
        $data['menu'] = $this->config->item('menu', 'website_config');

        if ($this->folder == 'admin') {
            $data['admin'] = $this->data["admin"];

            $template = 'layout/' . $tpl;
            // top (notification and login profile)
            // $data['top_view'] = $this->load->view('top_view', $data, true);
            // navigation menu
            $data['navigation_view'] = $this->load->view('layout/' . $navigation, $data, true);
            // container view
            $data['container_view'] = $this->load->view($view, $data, true);
        } else {
            $this->load->model('collection_model');
            //取得系統變數
            $data['collections'] = $this->collection_model->getByParam(true, array('c_status' => '1'), array('c_created' => 'desc'));

            $template = 'layout/' . $tpl;
            // top (notification and login profile)
            // $data['top_view'] = $this->load->view($this->language_folder . 'top_view', $data, true);
            // navigation menu
            // $data['navigation_view'] = $this->load->view($this->language_folder . $navigation, $data, true);
            // container view
            $data['container_view'] = $this->load->view($view, $data, true);

        }

        $this->load->view($template, $data);
    }

    /**
     *
     * @param {string | array} $js  js檔案名稱或array
     */
    protected function setJS($js)
    {
        $this->_addResource($js, 'js');
    }

    /**
     *
     * @param {string | array} $css  css檔案名稱或array
     */
    protected function setCSS($css)
    {
        $this->_addResource($css, 'css');
    }

    /**
     * @param string $title
     */
    private function _setAppTitle($title = '')
    {
        $meta            = $this->config->item('meta', 'website_config');
        $title_separator = $this->config->item('title_separator', 'website_config');

        return $title . $title_separator . $meta['title'];
    }

    /**
     *
     * @param array $res
     * @param string $type {css|js}
     */
    private function _addResource($res, $type)
    {
        if (is_array($res)) {
            foreach ($res as $file) {
                if (is_array($file)) {
                    $this->{$type}['source'][] = "{$file[0]}.{$type}";
                } else {
                    $this->{$type}['minify'][] = "{$file}.{$type}";
                }
            }
        } else {
            $this->{$type}['minify'][] = "{$file}.{$type}";
        }
    }

    /**
     * base64 encode file list
     * @param array $arr
     * @return array
     */
    private function _resourceEncode($arr, $type)
    {
        $encode = array(
            'minify' => '',
            'source' => '',
        );

        // if (count($arr['minify'])) {
        //     $encode['minify'] = base64_encode(implode(",", $arr['minify']));
        // }

        foreach ($arr['source'] as $file) {
            if ($type === "css") {
                $encode['source'] .= ('<link href="/public/' . $file . '" rel="stylesheet" type="text/css" />' . "\n\t");
            } else {
                $encode['source'] .= ('<script src="/public/' . $file . '"></script>' . "\n\t");
            }
        }

        foreach ($arr['minify'] as $file) {
            if ($type === "css") {
                $encode['minify'] .= ('<link href="/public/' . $file . '" rel="stylesheet" type="text/css" />' . "\n\t");
            } else {
                $encode['minify'] .= ('<script src="/public/' . $file . '?v=1"></script>' . "\n\t");
            }
        }

        $encode['source'] = trim($encode['source']);
        $encode['minify'] = trim($encode['minify']);

        return $encode;
    }

    protected function error_redirect()
    {
        redirect($this->ctl);
    }

    public function _remap($method, $arguments = array())
    {
        if (method_exists($this, $method)) {
            if ($this->folder === 'admin'){
                if (!in_array($this->ctl, $this->ignore_admin_ctl)) {
                    if ($this->acl->isAllowed($this->data["admin"]["a_id"], $this->folder, strtolower($this->ctl), $this->method, $arguments)) {
                        return call_user_func_array(array($this, $method), $arguments);
                    } else {
                        redirect('admin/login');
                        /*
                        if ($this->isAjax()) {
                            $this->response['MessageTitle'] = $this->lang->line('error');
                            $this->response['Message'] = $this->lang->line('permission_deined');

                            $this->tms_output->output($this->response);
                            return false;
                        } else {
                            show_error($this->method . "：" . $this->lang->line('permission_deined'), 200, $this->ctl);die;
                        }
                        */
                    }
                } else {
                    return call_user_func_array(array($this, $method), $arguments);
                }
            } else {
                return call_user_func_array(array($this, $method), $arguments);
            }

        }

        show_404();
    }

    /**
     * 判斷是否為 ajax 送來請求
     * @return boolean
     */
    public function isAjax()
    {
        return $this->input->is_ajax_request();
    }

    public function ajax($ac)
    {
        if ($this->isAjax()) {
            $this->$ac();
        } else {
            $this->response["msg"] = "No Request";
        }
    }
    
    public function ajax_output()
    {
    	$this->output
	    	->set_content_type('application/json')
	    	->set_output(json_encode($this->response));
    }

    protected function check_login($action = null)
    {
        if ($this->folder == 'admin') {
            if ($this->session->has_userdata("admin")) {
                $this->data["admin"] = $this->session->admin;
            } else {
                if (in_array(get_class($this), $this->ignore_ctl)) {
                    $this->data["admin"] = false;
                } else {
                    redirect('admin/login');
                }
            }
        } else {

        }

    }

    /**
     *  取得目前語言設定
     */
    private function get_language()
    {
        if ($this->input->cookie("language")) {
            $language = $this->input->cookie("language");
        } else {
            /**
             *  判斷目前瀏覽器語系
             */
            $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            switch ($lang) {
                // case "en":
                //     $language = "en";
                //     break;
                default:
                    $language = "zh";
                    break;
            }

            $this->input->set_cookie("language", $language, 60 * 60 * 24 * 365, $_SERVER['SERVER_NAME']);
        }

        // 讀取語系檔
        if ($this->folder !== 'admin') {
            $this->lang->load('language', $language);
        }

        return $language;
    }

    public static function dumpData()
    {
        $data = func_get_args();
        echo "<pre>";
        foreach ($data as $d) {
            var_dump($d);
            echo "<br/>";
        }
        die;
    }

    public static function printData()
    {
        $data = func_get_args();
        echo "<pre>";
        foreach ($data as $d) {
            print_r($d);
            echo "<br/>";
        }
        die;
    }
}
