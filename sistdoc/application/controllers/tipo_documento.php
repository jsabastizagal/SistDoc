<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Tipo_Documento extends CI_Controller {

    var $page = "tipo_documento";

    public function index() {
        if ($this->session->userdata('user')) {
            $DC["containerData"] = $this->load->view($this->page.'/data', null, true);
            $DC["tabActive"] = 7;
            $data["estructura"] = $this->load->view('inicio/index', $DC, true);
            $data["opcion"] = 0;
            $this->load->view('inicio/contenedor', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function Tabla($isPost=-1, $currPage=1) {
        if ($this->session->userdata('user')) {
            $this->load->model("tipo_documento_modelo");
            $where = false;
            $nombre = $this->input->post('nombre');
            if ($nombre != "") {
                $sql = "nombre_tipo_documento like '%" . $nombre . "%'";
                $where = $sql;
            }
            $list = $this->tipo_documento_modelo->lista(false, false, $where);
            $Dp['NumPage'] = ceil(count($list) / 10);
            $Dp['CurPage'] = $currPage;
            $Data["listaDatos"] = $this->tipo_documento_modelo->lista(($currPage - 1) * 10, true, $where);
            echo $this->load->view($this->page."/tabla", $Data, true);
            echo $this->load->view("inicio/paginacion", $Dp, true);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function NuevoEditar($id_Area = false) {
        if ($this->session->userdata('user')) {
            $this->load->model('tipo_documento_modelo');
            $Data['id_tipo_documento'] = '';
            $Data['nombre'] = '';
            if ($id_Area) {
                $dataModel = $this->tipo_documento_modelo->select($id_Area);
                $Data['id_tipo_documento'] = $dataModel->id_tipo_documento;
                $Data['nombre'] = $dataModel->nombre_tipo_documento;
            }
            $D["print"] = $this->load->view($this->page."/formulario", $Data, true);
            echo $this->load->view("inicio/popup", $D, true);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function guardar() {
        if ($this->session->userdata('user')) {
            $this->load->model('tipo_documento_modelo');
            $id_Tipo_Documento = $this->input->post('id_tipo_documento');
            $data['nombre_tipo_documento'] = $this->input->post('nombre');            
            if ($id_Tipo_Documento == "") {
                $modificado = $this->tipo_documento_modelo->insert($data);
            } else {
                $modificado = $this->tipo_documento_modelo->update($data, $id_Tipo_Documento);
            }
            echo $modificado;
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function eliminar($id) {
        if ($this->session->userdata('user')) {
            $this->load->model('tipo_documento_modelo');
            $affected = $this->tipo_documento_modelo->delete($id);
            echo ($affected) ? 1 : 0;
        } else {
            redirect(base_url(), 'refresh');
        }
    }

}
/* AUTOR: Lester Narvasta Ramirez */