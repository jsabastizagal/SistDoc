<?php

class Expediente_Modelo extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function select($id) {
        $query = $this->db->select('*');
        $query = $this->db->where("id_expediente", $id);
        $query = $this->db->get('v_expediente');
        return $query->row();
    }
    public function selectLast() {
        $query = $this->db->select('*');
        $query = $this->db->order_by("id_expediente", "asc");
        $query = $this->db->get('v_expediente');
        return $query->last_row();
    }
    public function selectByNE($NE,$NI) {
        $query = $this->db->select('*');
        $query = $this->db->where("numero_expediente", $NE);
        $query = $this->db->where("numero_identificacion", $NI);
        $query = $this->db->get('v_expediente');
        return $query->row();
    }

    public function lista($from=0, $limit=false,$where=false) {
        $query = $this->db->select('*');
        if ($where)
            $query = $this->db->where($where);
        if ($limit)
            $query = $this->db->limit(10, $from);
        $query = $this->db->order_by("id_expediente", "desc");
        $query = $this->db->get('v_expediente');
        return $query->result();
    }
    public function listaArr($from=0, $limit=false,$where=false,$wherein=false) {
        $query = $this->db->select('*');
        if ($where)
            $query = $this->db->where($where);
        if ($wherein)
            $query = $this->db->where_in("id_expediente",$wherein);
        if ($limit)
            $query = $this->db->limit(10, $from);
        $query = $this->db->get('v_expediente');
        return $query->result_array();
//        return $this->db->last_query();
    }

    public function insert($data) {
        $this->db->insert('tb_expediente', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where("id_expediente", $id);
        $this->db->update('tb_expediente', $data);
        return $this->db->affected_rows();
    }

    public function delete($id) {
        $this->db->where('id_expediente', $id);
        $this->db->delete('tb_expediente');
        return $this->db->affected_rows();
    }
}