<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collection extends MY_Controller {

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

        $this->load->model('collection_model');
        $this->load->model('collection_product_relaction_model');
    }
    
	public function index($id = 0)
	{
		$this->data['title'] = 'Collection';

		$query = array('c_status' => 1);
		if ($id > 0){
			$query['c_id'] = $id;
		}		
		$this->data['collection'] = $this->collection_model->getByParam(false, $query, array('c_id' => 'desc'));

		if (!empty($this->data['collection'])){
			$query['c_id'] = $this->data['collection']['c_id'];
			// 取的relaction的商品
			$this->data['products'] = $this->collection_product_relaction_model->getListByQuery($query, null);
		}
		    	   
		$this->render('collection', $this->data, '', 'layout_view');
	}
}
