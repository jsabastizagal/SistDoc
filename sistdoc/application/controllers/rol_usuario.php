<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Rol_Usuario extends CI_Controller {

    var $page = "rol_usuario";

    public function index() {
        if ($this->session->userdata('user')) {
            $DC["containerData"] = $this->load->view($this->page . '/data', null, true);
            $DC["tabActive"] = 3;
            $data["estructura"] = $this->load->view('inicio/index', $DC, true);
            $data["opcion"] = 0;
            $this->load->view('inicio/contenedor', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function Tabla($isPost = -1, $currPage = 1) {
        if ($this->session->userdata('user')) {
            $this->load->model("Rol_Usuario_modelo");
            $where = false;
            $nombre = $this->input->post('nombre');
            if ($nombre != "") {
                $sql = "nombre_Rol like '%" . $nombre . "%'";
                $where = $sql;
            }
            $list = $this->Rol_Usuario_modelo->lista(false, false, $where);
            $Dp['NumPage'] = ceil(count($list) / 10);
            $Dp['CurPage'] = $currPage;
            $Data["listaDatos"] = $this->Rol_Usuario_modelo->lista(($currPage - 1) * 10, true, $where);
            echo $this->load->view($this->page . "/tabla", $Data, true);
            echo $this->load->view("inicio/paginacion", $Dp, true);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function NuevoEditar($id_Rol_Usuario = false) {
        if ($this->session->userdata('user')) {
            $this->load->model('Rol_Usuario_modelo');
            $this->load->model('organo_administrativo_modelo');
            $this->load->model('usuario_modelo');
            $this->load->model('nivel_acceso_modelo');
            $Data['id_rol_usuario'] = '';
            $Data['nombre'] = '';
            $Data['id_organo_administrativo'] = '';
            $Data['id_cuenta_usuario'] = '';
            $Data['id_usuario'] = '';
            $Data['id_nivel_acceso'] = '';
            $Data['estado'] = '';
            $Data['usuario'] = '';
            $Data['clave'] = '';
            $Data['id_cuenta_usuario'] = '';

            $list = $this->Rol_Usuario_modelo->lista(false, false, false);
            $arrUser = null;
            $arrArea = null;
            foreach ($list as $val) {
                $arrUser[]=$val->id_usuario;
                $arrArea[]=$val->id_organo_administrativo;
            }
            $Data['arrUser'] = $arrUser;
            $Data['arrArea'] = $arrArea;
            $Data['VOA'] = $this->organo_administrativo_modelo->lista(false, false, false);
            $Data['VU'] = $this->usuario_modelo->lista(false, false, false);
            $Data['VNA'] = $this->nivel_acceso_modelo->lista(false, false, false);
            if ($id_Rol_Usuario) {
                $dataModel = $this->Rol_Usuario_modelo->select($id_Rol_Usuario);
                $Data['id_rol_usuario'] = $dataModel->id_rol_usuario;
                $Data['nombre'] = $dataModel->nombre_rol;
                $Data['id_organo_administrativo'] = $dataModel->id_organo_administrativo;
                $Data['id_usuario'] = $dataModel->id_usuario;
                $Data['id_nivel_acceso'] = $dataModel->id_nivel_acceso;
                $Data['estado'] = $dataModel->estado;
                $Data['id_cuenta_usuario'] = $dataModel->id_cuenta_usuario;
                $dataModel = $this->usuario_modelo->selectCU($dataModel->id_cuenta_usuario);
                $Data['usuario'] = $dataModel->usuario;
                $Data['clave'] = $dataModel->clave;
            }
            $D["print"] = $this->load->view($this->page . "/formulario", $Data, true);
            echo $this->load->view("inicio/popup", $D, true);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function guardar() {
        if ($this->session->userdata('user')) {
            $this->load->model('Rol_Usuario_modelo');
            $this->load->model('usuario_modelo');
            $id_cuenta_usuario = $this->input->post('id_cuenta_usuario');
            $usuario = $this->input->post('usuario');
            $claveH = $this->input->post('claveH');
            $clave = $this->input->post('clave');
            if ($id_cuenta_usuario == "" && ($usuario == "" || $clave == "")) {
                echo -1;
                return;
            }
            if ($id_cuenta_usuario == "" && $clave == "") {
                echo -3;
                return;
            }
            if ($clave == "") {
                $clave = $claveH;
            }
            $dat['usuario'] = $usuario;
            $dat['clave'] = md5($clave);
            if ($id_cuenta_usuario == "") {
                $modificado = $this->usuario_modelo->insertCU($dat);
                $id_cuenta_usuario = $modificado;
            } else {
                $modificado = $this->usuario_modelo->updateCU($dat, $id_cuenta_usuario);
                $modificado=true;
            }
            if ($modificado) {
                $id_Rol_Usuario = $this->input->post('id_rol_usuario');
                $data['nombre_rol'] = $this->input->post('nombre');
                $data['estado'] = ($this->input->post('estado') == "on") ? 1 : 0;
                $data['id_organo_administrativo'] = $this->input->post('cbo_oa');
                $data['id_usuario'] = $this->input->post('cbo_u');
                $data['id_nivel_acceso'] = $this->input->post('cbo_na');
                $data['id_cuenta_usuario'] = $id_cuenta_usuario;
                if ($id_Rol_Usuario == "") {
                    $mod = $this->Rol_Usuario_modelo->insert($data);
                    echo $mod;
                } else {
                    $mod = $this->Rol_Usuario_modelo->update($data, $id_Rol_Usuario);
                    echo 1;
                }
            } else {
                echo -2;
                return;
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function eliminar($id) {
        if ($this->session->userdata('user')) {
            $this->load->model('Rol_Usuario_modelo');
            $affected = $this->Rol_Usuario_modelo->delete($id);
            echo ($affected) ? 1 : 0;
        } else {
            redirect(base_url(), 'refresh');
        }
    }

}