<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends MY_Controller
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
    }

    public function index()
    {
        echo "<pre>";
        var_dump(session_id());
        var_dump($this->session);
        var_dump($_SESSION['CKFinder_UserRole']);
    }

    public function test()
    {
//     	echo "<pre>";
        // $this->load->library('cart/cart');
        // $this->cart->addItem('abcd', 2);

    }

    public function table_fields()
    {
        $table = 'product_main';
        $fields = $this->db->list_fields($table);
        foreach($fields as $field_name){
            echo "'".$field_name."',<br>";
        }

    }
}
