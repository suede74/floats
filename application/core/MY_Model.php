<?php

class MY_Model extends CI_Model
{
    protected $table;

    public function __construct()
    {
        parent::__construct();
        $this->table = str_replace("_model", "", strtolower(get_class($this)));
    }

    public function insert(array $data)
    {
        if ($this->db->insert($this->table, $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function insertBatch(array $data)
    {
        if ($this->db->insert_batch($this->table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(array $where)
    {
    	if ($where) {
			return $this->db->delete($this->table, $where);
    	} else {
    		return false;
    	}
    }

    public function update(array $data, $where = array())
    {
        if ($where) {
        	if (is_array($where)){
        		$this->db->where($where);	
        	}
            
            return $this->db->update($this->table, $data);
        } else {
        	return false;
        }
    }

    /**
     *  簡單的 select 整列
     *  
     *  @param $multi boolean 單列還是多列
     *  @param $type string array || object
     *  @param $where array sql where 條件
     *  @return array || object
     */
    public function select($multi = false, $type = "array", array $where, $order = null, $limit = null, $offset = null)
    {
        $this->db->select("*");
        $this->db->from($this->table);
        if (!empty($where)) {
            $this->db->where($where);
        }

        if (!is_null($order) && is_array($order) && !empty($order)) {
            foreach ($order as $column => $o) {
                $this->db->order_by($column, $o);
            }
        }

        if ((!is_null($limit) && is_numeric($limit)) && (!is_null($offset) && is_numeric($offset))) {
            $this->db->limit(intval($limit), intval($offset));
        } else if (!is_null($limit) && is_numeric($limit)) {
            $this->db->limit(intval($limit));
        }

        $query = $this->db->get();

        if ($type === "array") {
            if ($multi) {
                return $query->result_array();
            } else {
                return $query->row_array();
            }
        } else {
            if ($multi) {
                return $query->result();
            } else {
                return $query->row();
            }
        }
    }
    
    protected function getPrimaryKey()
    {
    	$primary_key = '';
    	$fields = $this->db->field_data($this->table);
    	if ($fields){
    		foreach ($fields as $field){
    			if ($field->primary_key == 1){
    				$primary_key = $field->name;
    				break;
    			}
    		}
    	}
    	return $primary_key;
    }
    
	//重新排序
    public function reSeq ($params = array(), $type = 'add')
    {
    	$this->db->select("*");
		$this->db->from($this->table);
    	$seq_key = "";
    	//組合條件
    	if (count($params) > 0){
    		foreach ($params as $key=>$p){
    			if (stristr($key, "_seq")){
    				$seq_key = $key;
    				//是排序的
    				$this->db->where($key.' >= ', $p);
    			}else {
    				//一般參數
    				$this->db->where($key.' = ', $p);
    			}
    		}
    	}
    	$query = $this->db->get();
    	$datas = $query->result_array();
    	$symbol = 1;//預是+1
    	if ($type == "sub"){
    		$symbol = -1;
    	}
    	//執行修改
    	if ($seq_key){
    		$primary_key = $this->getPrimaryKey();
    		foreach ($datas as $data){
    			$this->update(array($seq_key=>$data[$seq_key]+$symbol), array($primary_key=>$data[$primary_key]));
    		}
    	}
    }
    
	//取得排序的最後一筆
    public function getLastSeq ($params = array())
    {
    	$seq_key = "";
		$fields = $this->db->list_fields($this->table);
		
		foreach ($fields as $field){
			if (stristr($field, "_seq")){
    			$seq_key = $field;
    			break;
    		}
		}
    	
    	if ($seq_key){
	    	$this->db->select("*");
	        $this->db->from($this->table);
	        if (!empty($params)) {
	            $this->db->where($params);
	        }
	    	$this->db->order_by($seq_key." desc");
	    	$query = $this->db->get();
	    	return $query->row_array();
    	}
    	
    	return 0;
    }

    /**
     *    取得最後 query string
     *    @return string
     */
    public function getLastQuery()
    {
        return $this->db->last_query();
    }
    
    
}
