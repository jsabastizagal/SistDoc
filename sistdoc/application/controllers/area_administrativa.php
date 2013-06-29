<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Area_Administrativa extends CI_Controller {

    var $page = "area_administrativa";

    public function index() {
        if ($this->session->userdata('user')) {
            $DC["containerData"] = $this->load->view($this->page.'/data', null, true);
            $DC["tabActive"] = 5;
            $data["estructura"] = $this->load->view('inicio/index', $DC, true);
            $data["opcion"] = 0;
            $this->load->view('inicio/contenedor', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function Tabla($isPost=-1, $currPage=1) {
        if ($this->session->userdata('user')) {
            $this->load->model("organo_administrativo_modelo");
            $where = false;
            $nombre = $this->input->post('nombre');
            if ($nombre != "") {
                $sql = "nombre_area like '%" . $nombre . "%'";
                $where = $sql;
            }
            $list = $this->organo_administrativo_modelo->lista(false, false, $where);
            $Dp['NumPage'] = ceil(count($list) / 10);
            $Dp['CurPage'] = $currPage;
            $Data["listaDatos"] = $this->organo_administrativo_modelo->lista(($currPage - 1) * 10, true, $where);
            echo $this->load->view($this->page."/tabla", $Data, true);
            echo $this->load->view("inicio/paginacion", $Dp, true);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function NuevoEditar($id_Area = false) {
        if ($this->session->userdata('user')) {
            $this->load->model('organo_administrativo_modelo');
            $Data['id_organo_administrativo'] = '';
            $Data['nombre_area'] = '';
            if ($id_Area) {
                $dataModel = $this->organo_administrativo_modelo->select($id_Area);
                $Data['id_organo_administrativo'] = $dataModel->id_organo_administrativo;
                $Data['nombre_area'] = $dataModel->nombre_area;
            }
            $D["print"] = $this->load->view($this->page."/formulario", $Data, true);
            echo $this->load->view("inicio/popup", $D, true);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function guardar() {
        if ($this->session->userdata('user')) {
            $this->load->model('organo_administrativo_modelo');
            $id_Area_Administrativa = $this->input->post('id_organo_administrativo');
            $data['nombre_area'] = $this->input->post('nombre_area');
            if ($id_Area_Administrativa == "") {
                $modificado = $this->organo_administrativo_modelo->insert($data);
            } else {
                $modificado = $this->organo_administrativo_modelo->update($data, $id_Area_Administrativa);
            }
            echo $modificado;
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function eliminar($id) {
        if ($this->session->userdata('user')) {
            $this->load->model('organo_administrativo_modelo');
            $affected = $this->organo_administrativo_modelo->delete($id);
            echo ($affected) ? 1 : 0;
        } else {
            redirect(base_url(), 'refresh');
        }
    }

}