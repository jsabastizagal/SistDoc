<?php

class Observacion_Modelo extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function select($id) {
        $query = $this->db->select('*');
        $query = $this->db->where("id_observacion", $id);
        $query = $this->db->get('v_observacion');
        return $query->row();
    }

     public function lista($from=0, $limit=false,$where=false) {
        $query = $this->db->select('*');
        if ($where)
            $query = $this->db->where($where);
        if ($limit)
            $query = $this->db->limit(10, $from);
        $query = $this->db->get('v_observacion');
        return $query->result();
    }

    public function insert($data) {
        $this->db->insert('tb_observacion', $data);
        return $this->db->insert_id();
    }

    public function update($data, $id) {
        $this->db->where("id_observacion", $id);
        $this->db->update('tb_observacion', $data);
        return $this->db->affected_rows();
    }

    public function delete($id) {
        $this->db->where('id_observacion', $id);
        $this->db->delete('tb_observacion');
        return $this->db->affected_rows();
    }

}

?>
