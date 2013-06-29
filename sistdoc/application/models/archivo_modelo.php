<?php
class Archivo_Modelo extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function select($id) {
        $query = $this->db->select('*');
        $query = $this->db->where("id_archivo ", $id);
        $query = $this->db->get("v_archivo");
        return $query->row();
    }

    public function lista($cant=false, $from=false, $where=false) {
        $query = $this->db->select('*');
        if ($where)
            $query = $this->db->where($where);
        if ($cant && $from)
            $query = $this->db->limit($cant, $from);
        $query = $this->db->get("v_archivo");
        return $query->result();
    }

    public function insert($data) {
        $this->db->insert("tb_archivo", $data);
        return $this->db->insert_id();
    }

    public function update($data, $id) {
        $this->db->where("id_archivo ", $id);
        $this->db->update("tb_archivo", $data);
        return $this->db->affected_rows();
    }

    public function delete($id) {
        $this->db->where("id_archivo", $id);
        $this->db->delete("tb_archivo");
        return $this->db->affected_rows();
    }

}
?>