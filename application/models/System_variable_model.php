<?php

class System_variable_model extends MY_Model
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
		
        if (isset($query['lang']) && $query['lang'] != ''){
        	$this->db->where('au_lang', $query['lang']);
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
    public function getListByQuery($query = array(), $limit = array(0, 10))
    {
        $this->db->select("*")
            ->from($this->table);		

    	if (isset($query['lang']) && $query['lang'] != ''){
        	$this->db->where('au_lang', $query['lang']);
        }
        
        $this->db->limit($limit[1], $limit[0]);

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
 

}
