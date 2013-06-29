<?php

class Movimiento_Modelo extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function select($id) {
        $query = $this->db->where("id_movimiento",$id);
        $query = $this->db->get('v_movimiento');
        return $query->row();
    }
    public function selectbyExp($id) {
        $query = $this->db->where("id_expediente",$id);
        $query = $this->db->get('v_movimiento');
        return $query->result();
    }
    public function lista($from=0, $limit=false,$where=false) {
        $query = $this->db->select('*');
        if ($where)
            $query = $this->db->where($where);
        if ($limit)
            $query = $this->db->limit(10, $from);
        $query = $this->db->get('v_movimiento');
        return $query->result();
    }
    public function listaArray($from=0, $limit=false,$where=false) {
        $query = $this->db->select('*');
        if ($where)
            $query = $this->db->where($where);
        if ($limit)
            $query = $this->db->limit(10, $from);
        $query = $this->db->get('v_movimiento');
        return $query->result_array();
    }
    
    public function insert($data) {
        $this->db->insert('tb_movimiento', $data);
        return $this->db->insert_id();
    }
      public function update($id, $data) {
        $this->db->where("id_movimiento", $id);
        $this->db->update('tb_movimiento', $data);
        return $this->db->affected_rows();
    }
}