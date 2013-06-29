<?php

class Rol_Usuario_Modelo extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function selectRolUser($us) {
        $query = $this->db->where("id_cuenta_usuario",$us);
        $query = $this->db->get('v_rol_usuario');
        return $query->row();
    }

    public function select($id) {
        $query = $this->db->select('*');
        $query = $this->db->where("id_rol_usuario", $id);
        $query = $this->db->get('v_rol_usuario');
        return $query->row();
    }

        public function lista($from=0, $limit=false,$where=false) {
        $query = $this->db->select('*');
        if ($where)
            $query = $this->db->where($where);
        if ($limit)
            $query = $this->db->limit(10, $from);
        $query = $this->db->get('v_rol_usuario');
        return $query->result();
    }

    public function insert($data) {
        $this->db->insert('tb_rol_usuario', $data);
        return $this->db->insert_id();
    }

    public function update($data, $id) {
        $this->db->where("id_rol_usuario", $id);
        $this->db->update('tb_rol_usuario', $data);
        return $this->db->affected_rows();
//        return $this->db->last_query();
    }

    public function delete($id) {
        $this->db->where('id_rol_usuario', $id);
        $this->db->delete('tb_rol_usuario');
        return $this->db->affected_rows();
    }

}