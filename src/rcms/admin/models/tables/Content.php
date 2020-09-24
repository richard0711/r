<?php

class Content extends CI_Model {
    
    protected $table = "contents";
    protected $primary_key = "idcontent";
    
    public function get_field_name($field = '') {
        if (isset($this->field_names[$field])) {
            return $this->field_names[$field];
        } else {
            return $field;
        }
    }
    
    public function get_field_value($field = '', $value = null) {
        if (isset($this->field_values[$field]) && isset($this->field_values[$field][$value])) {
            return $this->field_values[$field][$value];
        } else {
            return $value;
        }
    }

    public function __construct() {
        parent::__construct();
    }

    public function get($id, $assoc = false){
        $this->db->select($this->table.'.*');
        return (!$assoc) 
            ? $this->db->get_where($this->table, array($this->primary_key => $id))->row() 
            : $this->db->get_where($this->table, array($this->primary_key => $id))->row_array();
    }

    public function get_all() {
        $this->db->select($this->table.'.*');
        $query = $this->db->get_where($this->table, array('status' => 1));
        return $query->result();
    }

    public function insert($data = array()) {
        if (array_key_exists('published', $data) && $data["published"] == '') {
            $data["published"] = null;
        }
        if (array_key_exists('published_to', $data) && $data["published_to"] == '') {
            $data["published_to"] = null;
        }
        $data["creator"] = 1;
        $data["created"] = date("Y-m-d H:i:s");
        if ($this->db->insert($this->table, $data))
            return $this->db->insert_id();
        else 
            return 0;
    }

    public function update($id, $data) {
        if (array_key_exists('published', $data) && $data["published"] == '') {
            $data["published"] = null;
        }
        if (array_key_exists('published_to', $data) && $data["published_to"] == '') {
            $data["published_to"] = null;
        }
        $data["editor"] = 1;
        $data["edited"] = date("Y-m-d H:i:s");
        $this->db->where($this->table.".".$this->primary_key, $id);
        $res = $this->db->update($this->table, $data);
        return $res;
    }

    public function delete($id){
        return $this->db->delete($this->table, array($this->primary_key => $id)); 
    }
    
    public function get_contents_by_filters($filters = array()){
        $result = array('count' => 0, 'data' => array());
        $this->db->from($this->table);
        $this->db->select($this->table.'.*');
        if (isset($filters["idcontent"]) && $filters["idcontent"] > 1) {
            $this->db->where($this->table.".idcontent", $filters["idcontent"]);
        }
        if (isset($filters["string"]) && $filters["string"] != '') {
            $this->db->where($this->table.".title like '%".$filters["string"]."%'");
        }
        $this->db->where($this->table.".status", 1);
        $result['count'] = $this->db->count_all_results('', false);
        set_query_limit_and_offset($filters, $this->db);
        $this->db->order_by($this->table.".created desc");
        $res = $this->db->get();
        log_message('debug', 'get_contents_by_filters $this->db->last_query()'.print_r($this->db->last_query(), true));
        $result['data'] = $this->get_result_array($res);
        return $result;
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
     
}