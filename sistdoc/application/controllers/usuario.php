<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Usuario extends CI_Controller {

    var $page = "usuario";

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

    public function Tabla($isPost = -1, $currPage = 1) {
        if ($this->session->userdata('user')) {
            $this->load->model("usuario_modelo");
            $where = false;
            $nombre = $this->input->post('nombre');
            $dni = $this->input->post('dni');
            $sql = "nombre like '%" . $nombre . "%'";
            if ($dni != "") {
                $sql.= "AND dni like '%" . $nombre . "%'";
            }
            $where = $sql;
            $list = $this->usuario_modelo->lista(false, false, $where);
            $Dp['NumPage'] = ceil(count($list) / 10);
            $Dp['CurPage'] = $currPage;
            $Data["listaDatos"] = $this->usuario_modelo->lista(($currPage - 1) * 10, true, $where);
            echo $this->load->view($this->page . "/tabla", $Data, true);
            echo $this->load->view("inicio/paginacion", $Dp, true);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function NuevoEditar($id_user = false) {
        if ($this->session->userdata('user')) {
            $this->load->model('usuario_modelo');
            $Data['id_usuario'] = '';
            $Data['dni'] = '';
            $Data['nombre'] = '';
            $Data['apellidos'] = '';
            if ($id_user) {
                $dataModel = $this->usuario_modelo->select($id_user);
                $Data['id_usuario'] = $dataModel->id_usuario;
                $Data['dni'] = $dataModel->dni;
                $Data['nombre'] = $dataModel->nombre;
                $Data['apellidos'] = $dataModel->apellido_paterno;
            }
            $D["print"] = $this->load->view($this->page . "/formulario", $Data, true);
            echo $this->load->view("inicio/popup", $D, true);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function guardar() {
        if ($this->session->userdata('user')) {
            $this->load->model('usuario_modelo');
            $id_Usuario = $this->input->post('id_usuario');
            $data['nombre'] = $this->input->post('nombre');
            $data['dni'] = $this->input->post('dni');
            $data['apellido_paterno'] = $this->input->post('apellidos');
            if ($id_Usuario == "") {
                $modificado = $this->usuario_modelo->insert($data);
            } else {
                $modificado = $this->usuario_modelo->update($data, $id_Usuario);
            }
            echo $modificado;
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function eliminar($id) {
        if ($this->session->userdata('user')) {
            $this->load->model('usuario_modelo');
            $affected = $this->usuario_modelo->delete($id);
            echo ($affected) ? 1 : 0;
        } else {
            redirect(base_url(), 'refresh');
        }
    }
}
/* AUTOR: Lester Narvasta Ramirez */