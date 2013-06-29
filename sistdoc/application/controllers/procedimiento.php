<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Procedimiento extends CI_Controller {

    var $page = "procedimiento";

    public function index() {
        if ($this->session->userdata('user')) {
            $DC["containerData"] = $this->load->view($this->page.'/data', null, true);
            $DC["tabActive"] = 6;
            $data["estructura"] = $this->load->view('inicio/index', $DC, true);
            $data["opcion"] = 0;
            $this->load->view('inicio/contenedor', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function Tabla($isPost=-1, $currPage=1) {
        if ($this->session->userdata('user')) {
            $this->load->model("Procedimiento_modelo");
            $where = false;
            $nombre = $this->input->post('nombre');
            if ($nombre != "") {
                $sql = "nombre_Procedimiento like '%" . $nombre . "%'";
                $where = $sql;
            }
            $list = $this->Procedimiento_modelo->lista(false, false, $where);
            $Dp['NumPage'] = ceil(count($list) / 10);
            $Dp['CurPage'] = $currPage;
            $Data["listaDatos"] = $this->Procedimiento_modelo->lista(($currPage - 1) * 10, true, $where);
            echo $this->load->view($this->page."/tabla", $Data, true);
            echo $this->load->view("inicio/paginacion", $Dp, true);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function NuevoEditar($id_Procedimiento = false) {
        if ($this->session->userdata('user')) {
            $this->load->model('Procedimiento_modelo');
            $Data['id_procedimiento'] = '';
            $Data['nombre'] = '';
            if ($id_Procedimiento) {
                $dataModel = $this->Procedimiento_modelo->select($id_Procedimiento);
                $Data['id_procedimiento'] = $dataModel->id_procedimiento;
                $Data['nombre'] = $dataModel->nombre_procedimiento;
            }
            $D["print"] = $this->load->view($this->page."/formulario", $Data, true);
            echo $this->load->view("inicio/popup", $D, true);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function guardar() {
        if ($this->session->userdata('user')) {
            $this->load->model('Procedimiento_modelo');
            $id_Procedimiento = $this->input->post('id_Procedimiento');
            $data['nombre_procedimiento'] = $this->input->post('nombre');
            if ($id_Procedimiento == "") {
                $modificado = $this->Procedimiento_modelo->insert($data);
            } else {
                $modificado = $this->Procedimiento_modelo->update($data, $id_Procedimiento);
            }
            echo $modificado;
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function eliminar($id) {
        if ($this->session->userdata('user')) {
            $this->load->model('Procedimiento_modelo');
            $affected = $this->Procedimiento_modelo->delete($id);
            echo ($affected) ? 1 : 0;
        } else {
            redirect(base_url(), 'refresh');
        }
    }

}