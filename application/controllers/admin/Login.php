<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
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
    
    private $error_times = 5; // 帳號密碼錯誤次數
    private $expiration = 300; // 300秒後才可以再輸入

    public function __construct()
    {
        parent::__construct();
        $m = $this->router->fetch_method();
        if ($this->session->admin && $this->method == 'index'){
            redirect('/admin/index');
        }

        $this->load->model('admin_model');        
    }

    public function index()
    {        
        if ($this->session->error_times < $this->error_times) {
            if ($post = $this->input->post(null, true)) {                
                $admin = $this->admin_model->loginAdmin($post['account'], md5($post['password']));
                if (!empty($admin) && $admin['a_status'] == 1 && !empty($post['check_code']) && strtolower($post['check_code']) === strtolower($this->session->captcha_word)) {

                    $this->session->set_userdata('admin', $admin);
					
//                     $this->session->set_userdata('UserId', $admin['a_id']);
//                     $this->session->set_userdata('CKFinder_UserRole', 9);
                    $_SESSION['UserId'] = $admin['a_id'];
                    $_SESSION['CKFinder_UserRole'] = 9;
                    
                    $this->admin_model->update(
                        array('a_last_login' => date("Y-m-d H:i:s")), 
                        array('a_id' => $admin['a_id'])
                    );                
                    redirect('/admin/index');
                } else {
                    $num = ($this->session->error_times + 1);
                    $this->session->set_tempdata('error_times', $num, $this->expiration);
                    // 輸入錯誤次數達到門檻                    
                    if ($num >= $this->error_times) {
                        $this->session->set_tempdata('lock_login', true, $this->expiration);
                        $this->data['error_msg'] = '登入錯誤請等待'.$this->expiration.'秒再重新登入';
                    } else if ($this->session->captcha_word === null) {
                        $this->data['error_msg'] = '驗證碼過期';
                    } else if (strtolower($post['check_code']) !== strtolower($this->session->captcha_word)) {
                        $this->data['error_msg'] = '驗證碼錯誤';
                    } else if (isset($admin['a_id']) && $admin['a_status'] == 0) {
                        $this->data['error_msg'] = '帳號停用';
                    } else if (empty($admin)) {
                        $this->data['error_msg'] = '帳號密碼錯誤';
                    } else {
                        $this->data['error_msg'] = '錯誤';
                    }
                }
            }
        } else {
            $this->data['error_msg'] = str_replace('{seconds}', $this->expiration, $this->language['lock_login']);
        }

        $this->load->view('admin/login_view', $this->data);
    }

    public function logout()
    {
        $this->session->sess_destroy();

//         redirect('admin/login');
        redirect('/');
    }

    public function captcha()
    {
        $this->load->library('captcha');
        $this->captcha->generate();
    }

}
