<?php

class Product_main_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

	/**
     * 計算查詢資料筆數
     * @param  array $query [description]
     * @return int        [description]
     */
    public function countListByQuery($query = array())
    {
        $this->db->select("*")
            ->from($this->table);
		
        if (isset($query['pm_category']) && $query['pm_category'] != ''){
        	$this->db->like('pm_category', $query['pm_category'], 'both');
        }
        if (isset($query['pm_name_tw']) && $query['pm_name_tw'] != ''){
            $this->db->where('pm_name_tw', $query['pm_name_tw']);
        }
        if (isset($query['pm_model_no']) && $query['pm_model_no'] != ''){
            $this->db->where('pm_model_no', $query['pm_model_no']);
        }
        if (isset($query['pm_status']) && !empty($query['pm_status'])) {
            if (is_array($query['pm_status'])) {
                $this->db->where_in('pm_status', $query['pm_status']);
            } else {
                $this->db->where('pm_status', $query['pm_status']);       
            }
        }

        // front
        if (isset($query['color']) && $query['color'] != ''){
            $this->db->group_start();
            $this->db->where('pm_color_01', $query['color']);
            $this->db->or_where('pm_color_02', $query['color']);
            $this->db->or_where('pm_color_03', $query['color']);
            $this->db->group_end();
        }
        if (isset($query['material']) && $query['material'] != ''){
            $this->db->group_start();
            $this->db->where('pm_material_01', $query['material']);
            $this->db->or_where('pm_material_01', $query['material']);
            $this->db->group_end();
        }
        if (isset($query['scenario']) && $query['scenario'] != ''){
            $this->db->group_start();
            $this->db->where('pm_use_scenario_01', $query['scenario']);
            $this->db->or_where('pm_use_scenario_02', $query['scenario']);
            $this->db->or_where('pm_use_scenario_03', $query['scenario']);
            $this->db->group_end();
        }
        if (isset($query['size']) && $query['size'] != ''){
            $this->db->where('pm_size', $query['size']);
        }
        if (isset($query['price']) && $query['price'] != ''){
            switch($query['price']){
                case '1':
                    $this->db->where('pm_price <', 1000);
                    break;
                case '2':
                    $this->db->where('pm_price <', 2000);
                    $this->db->where('pm_price >=', 1000);
                    break;
                case '3':
                    $this->db->where('pm_price <', 3000);
                    $this->db->where('pm_price >=', 2001);
                    break;
                case '4':
                    $this->db->where('pm_price <', 4000);
                    $this->db->where('pm_price >=', 3001);
                    break;
                case '5':
                    $this->db->where('pm_price <', 5000);
                    $this->db->where('pm_price >=', 4001);
                    break;
                case '6':
                    $this->db->where('pm_price >', 5001);
                    break;
            }            
        }
	
        $num = $this->db->count_all_results();

        return $num;
    }

    /**
     * 取得查詢資料
     * @param  array $query [description]
     * @param  array $limit [description]
     * @return array        [description]
     */
    public function getListByQuery($query = array(), $limit = array(0, 10), $order = array())
    {
        $this->db->select("*")
            ->from($this->table);		

        if (isset($query['pm_category']) && $query['pm_category'] != ''){
            // $this->db->like('pm_category', $query['pm_category'], 'both');
            $this->db->where('pm_category', $query['pm_category']);
        }
        if (isset($query['pm_name_tw']) && $query['pm_name_tw'] != ''){
            $this->db->where('pm_name_tw', $query['pm_name_tw']);
        }
        if (isset($query['pm_model_no']) && $query['pm_model_no'] != ''){
            $this->db->where('pm_model_no', $query['pm_model_no']);
        }
        if (isset($query['pm_status']) && !empty($query['pm_status'])) {
            if (is_array($query['pm_status'])) {
                $this->db->where_in('pm_status', $query['pm_status']);
            } else {
                $this->db->where('pm_status', $query['pm_status']);       
            }
        }

        // front
        if (isset($query['color']) && $query['color'] != ''){
            $this->db->group_start();
            $this->db->where('pm_color_01', $query['color']);
            $this->db->or_where('pm_color_02', $query['color']);
            $this->db->or_where('pm_color_03', $query['color']);
            $this->db->group_end();
        }
        if (isset($query['material']) && $query['material'] != ''){
            $this->db->group_start();
            $this->db->where('pm_material_01', $query['material']);
            $this->db->or_where('pm_material_01', $query['material']);
            $this->db->group_end();
        }
        if (isset($query['scenario']) && $query['scenario'] != ''){
            $this->db->group_start();
            $this->db->where('pm_use_scenario_01', $query['scenario']);
            $this->db->or_where('pm_use_scenario_02', $query['scenario']);
            $this->db->or_where('pm_use_scenario_03', $query['scenario']);
            $this->db->group_end();
        }
        if (isset($query['size']) && $query['size'] != ''){
            $this->db->where('pm_size', $query['size']);
        }
        if (isset($query['price']) && $query['price'] != ''){
            switch($query['price']){
                case '1':
                    $this->db->where('pm_price <', 1000);
                    break;
                case '2':
                    $this->db->where('pm_price <', 2000);
                    $this->db->where('pm_price >=', 1000);
                    break;
                case '3':
                    $this->db->where('pm_price <', 3000);
                    $this->db->where('pm_price >=', 2001);
                    break;
                case '4':
                    $this->db->where('pm_price <', 4000);
                    $this->db->where('pm_price >=', 3001);
                    break;
                case '5':
                    $this->db->where('pm_price <', 5000);
                    $this->db->where('pm_price >=', 4001);
                    break;
                case '6':
                    $this->db->where('pm_price >', 5001);
                    break;
            }            
        }


        if (!is_null($order) && is_array($order) && !empty($order)) {
            foreach ($order as $column => $o) {
                $this->db->order_by($column, $o);
            }
        }
        
        if ($limit){
            $this->db->limit($limit[1], $limit[0]);    
        }
        
        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * 用條件查詢log資料
     * @param  boolean $multi 資料是多筆還是單筆
     * @param  array   $where 要查詢的條件
     * @return array         回傳log資料
     */
    public function getByParam($multi = false, array $where, $order = null)
    {
        return $this->select($multi, "array", $where, $order);
    }
 
    public function getAllItems($column = array(), $where = array())
    {
    	if ($column) {
    		$this->db->select(join(',', $column));
    	} else {
    		$this->db->select("*");
    	}    	
		$this->db->from($this->table);
    	
    	if ($where){
    		$this->db->where($where);
    	}
    	
    	$query = $this->db->get();
    	
    	return $query->result_array();
    }
    
    public function existModelNo($where)
    {
        $this->db->select('Product_main.pm_id');
        $this->db->from($this->table);
        $this->db->where($where);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getGroup($type, $where = array(), $column = array())
    {
        if ($column) {
            $this->db->select(join(',', $column));
        } else {
            $this->db->select("*");
        }       
        $this->db->from($this->table);
        
        if ($where){
            $this->db->where($where);
        }

        switch ($type){
            case 'color':                
                $this->db->group_by('pm_color_01, pm_color_02, pm_color_03');
                break;
            case 'material':
                $this->db->group_by('pm_material_01, pm_material_02');
                break;
            case 'size':
                $this->db->group_by('pm_size');                
                break;
            case 'scenario':
                $this->db->group_by('pm_use_scenario_01, pm_use_scenario_02, pm_use_scenario_03');                
                break;
            case 'style':
                $this->db->group_by('pm_style');                
                break;
        }
        
        $query = $this->db->get();
        
        return $query->result_array();
    }

    public function getCategoryPrice($query = array())
    {
        $this->db->select(
            'COUNT( CASE WHEN `pm_price` < 1000 THEN 1 ELSE NULL END ) AS `1`,' .
            'COUNT( CASE WHEN `pm_price` < 2000 AND `pm_price` >= 1000 THEN 1 ELSE NULL END ) AS `2`,' .
            'COUNT( CASE WHEN `pm_price` < 3000 AND `pm_price` >= 2000 THEN 1 ELSE NULL END ) AS `3`,' .
            'COUNT( CASE WHEN `pm_price` < 4000 AND `pm_price` >= 3000 THEN 1 ELSE NULL END ) AS `4`,' .
            'COUNT( CASE WHEN `pm_price` < 5000 AND `pm_price` >= 4000 THEN 1 ELSE NULL END ) AS `5`,' .
            'COUNT( CASE WHEN `pm_price` > 5000 THEN 1 ELSE NULL END ) AS `6`' 
        )
            ->from($this->table);

        if (isset($query['pm_category']) && $query['pm_category'] != ''){
            $this->db->where('pm_category', $query['pm_category']);
        }
        if (isset($query['pm_status']) && !empty($query['pm_status'])) {
            if (is_array($query['pm_status'])) {
                $this->db->where_in('pm_status', $query['pm_status']);
            } else {
                $this->db->where('pm_status', $query['pm_status']);       
            }
        }

        // $this->db->group_by('pm_price');
        
        $query = $this->db->get();
        return $query->row_array();
    }

    public function search($query)
    {
        $this->db->select('pm_id, pm_name_tw, pm_name_en, pm_model_no');
        $this->db->from($this->table);
        
        if (isset($query['q']) && $query['q']) {
            $this->db->like('pm_name_tw', $query['q'], 'both');
            $this->db->or_like('pm_model_no', $query['q'], 'both');
        }
        
        $this->db->where('pm_status !=', 2);
        
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
}
