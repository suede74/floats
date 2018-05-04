<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
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

        $this->load->model('index_slide_model');
    }

	public function index()
	{
		$this->data['title'] = '關於我們';

		$query = ['is_status' => 1];
		$order_by = ['is_seq' => 'asc', 'is_id' => 'desc'];
		$this->data['slides'] = $this->index_slide_model->getListByQuery($query, [0, 10], $order_by);
    	   
		$this->render('index', $this->data, '', 'layout_view');
	}
}
