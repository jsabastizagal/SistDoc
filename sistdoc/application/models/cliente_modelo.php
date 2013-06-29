<?php

class Cliente_Modelo extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function select($id) {
        $query = $this->db->select('*');
        $query = $this->db->where("id_cliente", $id);
        $query = $this->db->get('v_cliente');
        return $query->row();
    }

    public function lista($from=0, $limit=false,$where=false) {
        $query = $this->db->select('*');
        if ($where)
            $query = $this->db->where($where);
        if ($limit)
            $query = $this->db->limit(10, $from);
        $query = $this->db->get('v_cliente');
        return $query->result();
    }

    public function insert($data) {
        $this->db->insert('tb_cliente', $data);
        return $this->db->insert_id();
    }

    public function update($data, $id) {
        $this->db->where("id_cliente", $id);
        $this->db->update('tb_cliente', $data);
        return $this->db->affected_rows();
    }

    public function delete($id) {
        $this->db->where('id_cliente', $id);
        $this->db->delete('tb_cliente');
        return $this->db->affected_rows();
    }
}