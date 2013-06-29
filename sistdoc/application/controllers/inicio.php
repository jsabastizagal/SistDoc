<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!isset($_SESSION))
session_start();

class Inicio extends CI_Controller {

    public function index() {
        if ($this->inSesion()) {
            if ($this->session->userdata("id_rol_usuario") == 1) {
                $this->load->model('tipo_documento_modelo');
                $this->load->model('organo_administrativo_modelo');
                $this->load->model('procedimiento_modelo');
                $Data["tipo_documento"] = $this->tipo_documento_modelo->lista(false, false, false);
                $Data["organo_administrativo"] = $this->organo_administrativo_modelo->lista(false,false,false);
                $Data["procedimiento"] = $this->procedimiento_modelo->lista(false,false,false);
                $data["estructura"] = $this->load->view('expediente/formulario', $Data, true);
                $data["opcion"] = 1;
                $this->load->view('inicio/contenedor', $data);
            } else {
                $this->load->model('tipo_documento_modelo');
                $Data["tipo_documento"] = $this->tipo_documento_modelo->lista(false, false, false);
                $data["estructura"] = $this->load->view("expediente/index", $Data, true);
                $data["opcion"] = 2;
                $this->load->view('inicio/contenedor', $data);
            }
        } else {
            $this->session->set_userdata('NExp',0);
            $this->session->set_userdata('txtNI',0);
            $this->session->set_userdata('isMobile',0);
            $this->load->library("user_agent");
            $Info = $this->agent->platform() . "<br>";
			if ($this->agent->is_mobile()) {
				$Info .= $this->agent->mobile();
                $this->load->view('mobile/index');
                
            }else if ($this->agent->is_browser()) {
                if ($this->agent->browser() == "Internet Explorer") {
                    $this->load->view('inicio/chrome');
                } else {
                    $Info .= $this->agent->browser() . " - " . $this->agent->version();
                    $data["mess"] = 1;
                   $this->load->view('inicio/login', $data);
//                   $this->load->view('mobile/index');
                }
            } else if ($this->agent->is_robot()) {
                $Info .= $this->agent->robot();
            } else {
                $Info .= "Agente No Identificado";
            }
        }
    }

    public function mobile() {
        $this->load->view('mobile/index');
    }
    public function iniciarSesion() {
        $this->load->model('usuario_modelo');
        $user = $this->input->post("txtUsu");
        $pass = $this->input->post("txtPass");
        if ($user != "" && $pass != "") {
            $data["usuario"] = $user;
            $data["clave"] = md5($pass);
            $res = $this->usuario_modelo->verifiUser($data);
            if ($res) {
                $this->crearSesion($res->id_cuenta_usuario);
            } else {
                $data["mess"] = 2;
                $this->load->view('inicio/login', $data);
            }
        } else {
            $data["mess"] = 3;
            $this->load->view('inicio/login', $data);
        }
    }

    public function cerrarSesion() {
        $this->session->sess_destroy();
        redirect(base_url(), "refresh");
    }

    private function crearSesion($idcuenta_user) {
        $this->load->model('rol_usuario_modelo');
        $user = $this->rol_usuario_modelo->selectRolUser($idcuenta_user);
        if (count($user) > 0) {
            $this->session->set_userdata("user", true);
            $this->session->set_userdata("id_usuario", $user->id_usuario);
            $this->session->set_userdata("id_rol_usuario", $user->id_rol_usuario);
            $this->session->set_userdata("id_cuenta_usuario", $user->id_cuenta_usuario);
            $this->session->set_userdata("id_organo_administrativo", $user->id_organo_administrativo);
            $this->session->set_userdata("nivel_acceso", $user->nivel_acceso);
            $this->session->set_userdata("nombre_usuario", $user->nombre . " " . $user->apellido_paterno);
            $this->session->set_userdata("nombre_rol", $user->nombre_rol);
            $this->session->set_userdata("nombre_area", $user->nombre_area);
            $this->session->set_userdata("estado_rol", $user->estado);
            redirect(base_url(), "refresh");
        } else {
            echo "Usuario no Existe o sus datos no estan completos";
        }
    }

    private function inSesion() {
        return $this->session->userdata("user");
    }

    public function perfil() {
        if ($this->inSesion()) {
            $this->load->model("Rol_Usuario_modelo");
            $dataModel["rol"] = $this->Rol_Usuario_modelo->select($this->session->userdata("id_rol_usuario"));
            $DC["containerData"] = $this->load->view('inicio/perfil', $dataModel, true);
            $DC["tabActive"] = 1;
            $data["estructura"] = $this->load->view('inicio/index', $DC, true);
            $data["opcion"] =0;
            $this->load->view('inicio/contenedor', $data);
        } else {
            $this->load->view('inicio/login');
        }
    }

    public function error() {
        $this->load->view('inicio/error404');
    }

    public function ayuda() {
        $this->load->view('inicio/ayuda');
    }
}
/* AUTOR: Lester Narvasta Ramirez */