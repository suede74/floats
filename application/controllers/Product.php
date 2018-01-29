<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

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
        $this->load->model('product_main_model');
    }

	public function index($category=null)
	{
		$this->data['title'] = '商品列表';

		$category = urldecode($category);
		if (empty($category)){
			
		}
		$this->data['category'] = $category;
		$query = $this->input->get(null, true);
		$this->data['get'] = $query;

		$query['pm_category'] = $category;
		$order = array('pm_created' => 'desc');
		$query['pm_status'] = array(1, 3);
		$this->data['products'] = $this->product_main_model->getListByQuery($query, null, $order);

		// 取得分類價格group
		$prices = $this->product_main_model->getCategoryPrice($query);
		$this->data['prices'] = $this->filter_data($prices, 'price');
		$this->data['price_rang'] = $this->config->item('price_rang', 'website_config');

		// 取得filter的資料
		// 顏色
		$type = 'color';
		$this->data['colors'] = $this->filter_data($this->product_main_model->getGroup($type, array('pm_category' => $category), array('pm_color_01', 'pm_color_02', 'pm_color_03')), $type);
		// 情境
		$type = 'scenario';
		$this->data['scenarios'] = $this->filter_data($this->product_main_model->getGroup($type, array('pm_category' => $category), array('pm_use_scenario_01', 'pm_use_scenario_02', 'pm_use_scenario_03')), $type);
		// 材質
		$type = 'material';
		$this->data['materials'] = $this->filter_data($this->product_main_model->getGroup($type, array('pm_category' => $category), array('pm_material_01', 'pm_material_02')), $type);
		// 大小
		$type = 'size';
		$this->data['sizes'] = $this->filter_data($this->product_main_model->getGroup($type, array('pm_category' => $category), array('pm_size')), $type);
    	   
		$this->render('product_list', $this->data, '', 'layout_view');
	}

	public function detail($id = 0)
	{
		$this->data['title'] = '商品明細';		

		$query = array('pm_id' => $id);
		$this->data['product'] = $this->product_main_model->getByParam(false, $query);

		if (empty($this->data['product'])){
			redirect('/');
			exit;
		}
		
		// $js = array(            
  //           'assets/apps/scripts/admin/collection',
  //       );
  //       $this->setJS($js);
    	   
		$this->render('product_detail', $this->data, '', 'layout_view');
	}

	private function filter_data($datas, $type)
	{
		$typeData = array();
		if ($datas){
			foreach ($datas as $key => $data){
				switch ($type){
					case 'color':
						if ($data['pm_color_01'] && !in_array($data['pm_color_01'], $typeData)){
							array_push($typeData, $data['pm_color_01']);
						}
						if ($data['pm_color_02'] && !in_array($data['pm_color_02'], $typeData)){
							array_push($typeData, $data['pm_color_02']);
						}
						if ($data['pm_color_03'] && !in_array($data['pm_color_03'], $typeData)){
							array_push($typeData, $data['pm_color_03']);
						}
						break;
					case 'material':
						if ($data['pm_material_01'] && !in_array($data['pm_material_01'], $typeData)){
							array_push($typeData, $data['pm_material_01']);
						}
						if ($data['pm_material_02'] && !in_array($data['pm_material_02'], $typeData)){
							array_push($typeData, $data['pm_material_02']);
						}
						break;
					case 'size':
						if ($data['pm_size'] && !in_array($data['pm_size'], $typeData)){
							array_push($typeData, $data['pm_size']);
						}
						break;
					case 'scenario':
						if ($data['pm_use_scenario_01'] && !in_array($data['pm_use_scenario_01'], $typeData)){
							array_push($typeData, $data['pm_use_scenario_01']);
						}
						if ($data['pm_use_scenario_02'] && !in_array($data['pm_use_scenario_02'], $typeData)){
							array_push($typeData, $data['pm_use_scenario_02']);
						}
						if ($data['pm_use_scenario_03'] && !in_array($data['pm_use_scenario_03'], $typeData)){
							array_push($typeData, $data['pm_use_scenario_03']);
						}
						break;
					case 'style':
						if ($data['pm_style'] && !in_array($data['pm_style'], $typeData)){
							array_push($typeData, $data['pm_style']);
						}
						break;
					case 'price':
						if ($data > 0) {
							array_push($typeData, $key);
						}
						break;
				}
			}
		}

		return $typeData;
	}
}
