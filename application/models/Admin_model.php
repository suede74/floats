<?php

class Admin_model extends MY_Model
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
        unset($query['page']);
        $this->db->select("*")
            ->from($this->table);
        
        if (isset($query['account']) && $query['account'] != ''){
        	$this->db->where('a_account', $query['account']);
        }
        if (isset($query['email']) && $query['email'] != ''){
        	$this->db->where('a_email', $query['email']);
        }

        $this->db->where('a_status < ', 3);

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
        unset($query['page']);
        $this->db->select("*")
            ->from($this->table);
        
        if (isset($query['account']) && $query['account'] != ''){
        	$this->db->where('a_account', $query['account']);
        }
        if (isset($query['email']) && $query['email'] != ''){
        	$this->db->where('a_email', $query['email']);
        }

        $this->db->where('a_status < ', 3)
            ->limit($limit[1], $limit[0]);
        
        $this->db->order_by('a_id desc');

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

    /**
     * 後台管理登入
     * @param  string $account  帳號
     * @param  string $password 密碼
     * @return array           管理者資料
     */
    public function loginAdmin($account, $password)
    {        
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('a_account', $account)
            ->where('a_password', $password)
            ->where('a_status =', 1);

        $query = $this->db->get();

        if ($admin = $query->row_array()) {
            unset($admin['password']);
            return $admin;
        } else {
            return false;
        }
    }

    /**
     * 檢查管理者帳號是否存在
     * @param  string $account [description]
     * @param  int $id [description]
     * @return [type]          [description]
     */
    public function existAdmin($account, $id = 0)
    {
        $this->db->select("a_id");
        $this->db->from($this->table);
        $this->db->where('a_account', $account);

        if ($id > 0){
            $this->db->where('a_id !=', $id);
        }

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }     

}
