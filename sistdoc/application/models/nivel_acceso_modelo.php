<?php

class Nivel_Acceso_Modelo extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function select($id) {
        $query = $this->db->select('*');
        $query = $this->db->where("id_nivel_acceso", $id);
        $query = $this->db->get('v_nivel_acceso');
        return $query->row();
    }

    public function lista($from=0, $limit=false,$where=false) {
        $query = $this->db->select('*');
        if ($where)
            $query = $this->db->where($where);
        if ($limit)
            $query = $this->db->limit(10, $from);
        $query = $this->db->get('v_nivel_acceso');
        return $query->result();
    }


    public function insert($data) {
        $this->db->insert('tb_nivel_acceso', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where("id_nivel_acceso", $id);
        $this->db->update('tb_nivel_acceso', $data);
        return $this->db->affected_rows();
    }

    public function delete($id) {
        $this->db->where('id_nivel_acceso', $id);
        $this->db->delete('tb_nivel_acceso');
        return $this->db->affected_rows();
    }

}

?>
