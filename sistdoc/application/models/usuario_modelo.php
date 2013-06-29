<?php

class Usuario_Modelo extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function select($id) {
        $query = $this->db->select('*');
        $query = $this->db->where("id_usuario", $id);
        $query = $this->db->get('v_usuario');
        return $query->row();
    }

    public function lista($from=0, $limit=false, $where=false) {
        $query = $this->db->select('*');
        if ($where)
            $query = $this->db->where($where);
        if ($limit)
            $query = $this->db->limit(10, $from);
        $query = $this->db->get('v_usuario');
        return $query->result();
    }

    /**
     *
     * @From Cuenta_Usuario
     */
    public function verifiUser($w) {
        $query = $this->db->where($w);
        $query = $this->db->get('v_cuenta_usuario');
        return $query->row();
    }

    /**
     *
     * @From Cuenta_Usuario
     */
    public function selectCU($id) {
        $query = $this->db->select('*');
        $query = $this->db->where("id_cuenta_usuario", $id);
        $query = $this->db->get('v_cuenta_usuario');
        return $query->row();
    }

    public function insertCU($data) {
        $this->db->insert('tb_cuenta_usuario', $data);
        return $this->db->insert_id();
    }

    public function updateCU($data, $id) {
        $this->db->where("id_cuenta_usuario", $id);
        $this->db->update('tb_cuenta_usuario', $data);
        return $this->db->affected_rows();
    }
    public function insert($data) {
        $this->db->insert('tb_usuario', $data);
        return $this->db->insert_id();
    }

    public function update($data, $id) {
        $this->db->where("id_usuario", $id);
        $this->db->update('tb_usuario', $data);
        return $this->db->affected_rows();
    }

    public function delete($id) {
        $this->db->where('id_usuario', $id);
        $this->db->delete('tb_usuario');
        return $this->db->affected_rows();
    }

}