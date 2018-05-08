<?php

class Collection_product_relaction_model extends MY_Model
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
		        
        if (isset($query['c_id']) && $query['c_id'] != ''){
            $this->db->where('c_id', $query['c_id']);
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
    public function getListByQuery($query = array(), $limit = array(0, 10), $order = array(), $column = array())
    {
        if (empty($column) || !is_array($column)){
            $this->db->select("*");
        } else {
            $this->db->select(join(',', $column));
        }
            
        $this->db->from($this->table);		

        if (isset($query['c_id']) && $query['c_id'] != ''){
            $this->db->where('collection_product_relaction.c_id', $query['c_id']);
        }
        if (isset($query['pm_status']) && $query['pm_status'] != ''){
            $this->db->where('product_main.pm_status', $query['pm_status']);
        }
        
        if ($limit){
            $this->db->limit($limit[1], $limit[0]);    
        }

        $this->db->join('product_main', 'product_main.pm_id = collection_product_relaction.pm_id');

        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * 用條件查詢log資料
     * @param  boolean $multi 資料是多筆還是單筆
     * @param  array   $where 要查詢的條件
     * @return array         回傳log資料
     */
    public function getByParam($multi = false, array $where)
    {
        return $this->select($multi, "array", $where);
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

    public function getTagsinputByCollection($c_id)
    {
        $this->db->select('product_main.pm_id as id, concat(product_main.pm_name_tw, " - ", product_main.pm_model_no) as text, "" as continent');
            
        $this->db->from($this->table);      

        $this->db->where('collection_product_relaction.c_id', $c_id);
        // $this->db->where('product_main.pm_status !=', 2);

        $this->db->join('product_main', 'product_main.pm_id = collection_product_relaction.pm_id');

        $query = $this->db->get();

        return $query->result_array();
    }
    
}
