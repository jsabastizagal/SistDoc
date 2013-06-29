<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Observacion extends CI_Controller {

    var $page = "Observacion";

    public function index() {
        if ($this->session->userdata('user')) {
            $DC["containerData"] = $this->load->view($this->page . '/data', null, true);
            $DC["tabActive"] = 2;
            $data["estructura"] = $this->load->view('inicio/index', $DC, true);
            $data["opcion"] = 0;
            $this->load->view('inicio/contenedor', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function Tabla($idObs=false) {
        $this->load->model("observacion_modelo");
        $this->load->model('movimiento_modelo');
        $where = false;
        $id = (!$idObs) ? $this->input->post('id') : $idObs;
        $sql = "id_movimiento =" . $id;
        $where = $sql;
        $Data["id_movimiento"] = $id;
        $movimiento = $this->movimiento_modelo->select($id);
        $Data["NumExp"] = $movimiento->id_area_destino;
        $Data["destino"] = $movimiento->id_area_destino;
        $Data["listaDatos"] = $this->observacion_modelo->lista(false, false, $where);
        if (!$idObs) {
            $D["print"] = $this->load->view("movimiento/observacion", $Data, true);
            echo $this->load->view("inicio/popup", $D, true);
        } else {
            $Data["historial"] = $movimiento->historial;
            $Data["proveido"] = $movimiento->proveido;
            $this->load->view('mobile/observacion', $Data);
        }
    }

    public function guardar() {
        if ($this->session->userdata('user')) {
            $this->load->model('Observacion_modelo');
            $data['id_movimiento'] = $this->input->post('id_movimiento');
            $data['observacion'] = $this->input->post('observacion');
            $modificado = $this->Observacion_modelo->insert($data);
            echo $modificado;
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function eliminar($id) {
        if ($this->session->userdata('user')) {
            $this->load->model('Observacion_modelo');
            $affected = $this->Observacion_modelo->delete($id);
            echo ($affected) ? 1 : 0;
        } else {
            redirect(base_url(), 'refresh');
        }
    }

}