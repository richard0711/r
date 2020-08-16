<?php

class Contents extends CI_Model {
    
    public $table = "contents";
    public $primary_key = "idcontent";
    

    public function __construct() {
        parent::__construct();
    }

    public function get($id){
        return $this->db->get_where($this->table, array($this->primary_key => $id))->row();
    }

    public function get_all() {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function insert($data) {
        if ($this->db->insert($this->table, $data))
            return $this->db->insert_id();
        else 
            return 0;
    }

    public function update($id, $data) {
        $this->db->where("contents.".$this->primary_key, $id);
        $res = $this->db->update("contents", $data);
        return $res;
    }

    public function delete($id){
        return $this->db->delete($this->table, array($this->primary_key => $id)); 
    }
    
    public function get_result_array($result) {
        $data = array();
        if ($result->num_rows() > 0) {
            foreach ($result->result_array() as $row) {
                $data[] = $row;
            }
        }
        $result->free_result();
        return $data;
    }
    
    public function get_contents($filter = array(), $idcontent = NULL){
        $result = array('count' => 0, 'data' => array());
        //a számlaszámokra is filterezünk ha van string
        if (isset($filter['string']) && $filter['string'] != '') {
            
        }
        $this->db->select('contents.*');
        if($idcontent > 1) {
            $this->db->where('idcontent', $idcontent);
        } else {
           //set filters
        }
        $this->db->order_by("contents.created DESC");
        set_query_limit_and_offset($filter, $this->db);
        $result['count'] = $this->db->count_all_results('', false);
        $res = $this->db->get();
        $result['data'] = $this->get_result_array($res);
        return $result;
    }
}