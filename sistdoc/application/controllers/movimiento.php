<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();
date_default_timezone_set("America/Lima");

class Movimiento extends CI_Controller {

    public function index() {
        if ($this->session->userdata('user')) {
            $this->load->model('tipo_documento_modelo');
            $Data["tipo_documento"] = $this->tipo_documento_modelo->lista(false,false,false);
            $data["estructura"] = $this->load->view("expediente/index", $Data, true);
            $data["opcion"] = 2;
            $this->load->view('inicio/contenedor', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function Tabla($isPost=-1,$currPage=1) {
        if ($this->session->userdata('user')) {
            $this->load->model('expediente_modelo');
            $this->load->model('movimiento_modelo');
            $where = false;
            if ($isPost != -1) {
                $cliente = $this->input->post("cli");
                $tipo_doc = $this->input->post("cbo_td");
                $num_doc = $this->input->post("ND");
                $est = $this->input->post("cbo_est");
                $FechaFrom = $this->input->post("From");
                $FechaTo = $this->input->post("To");
                $codigo = "nombre like '%".$cliente."%' AND numero_documento like '%".$num_doc."%'";
                if($tipo_doc!="")
                   $codigo.=" AND id_tipo_documento = ".$tipo_doc;
                if($est!="")
                    $codigo.=" AND estado_expediente = ".$est;                
                $where = $codigo;
                if($FechaFrom!="" && $FechaTo!=""){
                    $fecha = "fecha between '" . $FechaFrom . " 00:00:00' AND '" . $FechaTo." 23:59:59'";
                    $where .= " AND ".$fecha;
                }
            }
            $list = $this->expediente_modelo->lista(false,false,$where);
            $Dp['NumPage'] = ceil(count($list) / 10);
            $Dp['CurPage'] = $currPage;
            $Data["listaDatos"] = $this->expediente_modelo->lista(($currPage-1)*10,true,$where);
            $wh['id_area_destino'] = $this->session->userdata('id_organo_administrativo');
            $wh['id_estado'] = 2;
            $listaRecibir = $this->movimiento_modelo->lista(false,false,$wh);
            $dataExp=null;
            foreach ($listaRecibir as $val) {
                $dataExp[]=$val->id_expediente;
            }
            $Data["dataExp"]=$dataExp;
            echo $this->load->view("expediente/dataTable", $Data, true);
            echo $this->load->view("inicio/paginacion", $Dp, true);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function verMovimientoDocumento($idExp = "") {
        if ($this->session->userdata('user')) {
            $this->load->model('movimiento_modelo');
            $this->load->model('expediente_modelo');            
            if ($idExp != "") {                
                $Data["datosExp"] = $this->expediente_modelo->select($idExp);
                $Data["listaDatos"] = $this->movimiento_modelo->selectbyExp($idExp);
                $data["estructura"] = $this->load->view("movimiento/dataTable", $Data, true);
                $data["opcion"] = 2;
                $this->load->view('inicio/contenedor', $data);
            } else {
                echo "No hay Numero de Expediente";
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function recibirDocumento() {
        if ($this->session->userdata('user')) {
            $this->load->model('movimiento_modelo');
            $idMov = "";
            $idMov = $this->input->post('id');
            if ($idMov != "") {
                $Dt["fecha_recepcion"] = date('Y-m-d H:i:s');
                $Dt["rol_recepcion"] = $this->session->userdata("id_rol_usuario");
                $Dt["id_estado"] = 1;
                $Dt["rol_derivacion"] = "0";
                $Dt["rol_atencion"] = "0";
                $affected = $this->movimiento_modelo->update($idMov, $Dt);
                if ($affected) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                echo "No hay Numero de Expediente";
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }
    public function concluirDocumento() {
        if ($this->session->userdata('user')) {
            $this->load->model('movimiento_modelo');
            $this->load->model('expediente_modelo');
            $idMov = $this->input->post('id');
            $nexp = $this->input->post('nexp');
            if ($idMov != "") {
                $Dt["fecha_recepcion"] = date('Y-m-d H:i:s');
                $Dt["rol_recepcion"] = $this->session->userdata("id_rol_usuario");
                $Dt["fecha_atencion"] = date('Y-m-d H:i:s');
                $Dt["rol_atencion"] = $this->session->userdata("id_rol_usuario");
                $Dt["id_estado"] = 5;
                $affected = $this->movimiento_modelo->update($idMov, $Dt);
                if ($affected) {
                    $dtExp["estado_expediente"]="2";
                    $affected = $this->expediente_modelo->update($nexp,$dtExp);
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                echo "No hay Numero de Expediente";
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }
    public function derivarDocumento() {
        if ($this->session->userdata('user')) {
            $this->load->model('movimiento_modelo');
            $idMov = "";
            $idMov = $this->input->post('id');
            $nexp = $this->input->post('nexp');
            $idOA = $this->input->post('oa');
            $idOAD = $this->input->post('oad');
            if ($idMov != "") {
                $Dt["fecha_derivacion"] = date('Y-m-d H:i:s');
                $Dt["rol_derivacion"] = 2;
                $Dt["id_estado"] = 3;
                $affected = $this->movimiento_modelo->update($idMov, $Dt);
                if ($affected) {
                    //Segundo Movimiento
                    $dataMov2["id_expediente"] = $nexp;
                    $dataMov2["id_organo_administrativo"] = $idOA;
                    $dataMov2["org_destino"] = $idOAD;
                    $dataMov2["id_estado"] = 2;
                    $dataMov2["rol_recepcion"] = "0";
                    $dataMov2["rol_derivacion"] = "0";
                    $dataMov2["rol_atencion"] = "0";
                    $affected = $this->movimiento_modelo->insert($dataMov2);
                    if ($affected) {                        
                        echo 1;
                    }
                } else {
                    echo 0;
                }
            } else {
                echo "No hay Numero de Expediente";
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }
    public function cargaOA() {
        if ($this->session->userdata('user')) {
            $this->load->model('organo_administrativo_modelo');
            $where="id_organo_administrativo <> 0 and id_organo_administrativo <> 1 and id_organo_administrativo <> ".$this->session->userdata("id_organo_administrativo");
            $Data["datosOA"] = $this->organo_administrativo_modelo->lista(false,false,$where);  
            $D["print"] = $this->load->view("movimiento/listaOrganoAdministrativo", $Data, true);
            echo $this->load->view("inicio/popup", $D, true);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function historial() {
        $idMov = $this->input->post('id');
        $this->load->model('movimiento_modelo');
        $Data["listaDatos"] = $this->movimiento_modelo->select($idMov);
        $D["print"] = $this->load->view("movimiento/historial", $Data, true);
        echo $this->load->view("inicio/popup", $D, true);
    }

    public function proveido() {
        $idMov = $this->input->post('id');
        $this->load->model('movimiento_modelo');
        $Data["listaDatos"] = $this->movimiento_modelo->select($idMov);
        $D["print"] = $this->load->view("movimiento/proveido", $Data, true);
        echo $this->load->view("inicio/popup", $D, true);
    }

    public function actualizar() {
        if ($this->session->userdata('user')) {
            $this->load->model('movimiento_modelo');
            $id = $this->input->post('id');
            if($this->input->post('historial')!="")
            $dat['historial'] = $this->input->post('historial');
            if($this->input->post('proveido')!="")
            $dat['proveido'] = $this->input->post('proveido');
            $modificado = $this->movimiento_modelo->update($id,$dat);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

}

?>