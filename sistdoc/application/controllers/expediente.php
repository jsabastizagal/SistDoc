<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set("America/Lima");
session_start();

class Expediente extends CI_Controller {

    public function guardar() {
        if ($this->session->userdata('user')) {
            $this->load->model('expediente_modelo');
            $this->load->model('movimiento_modelo');
            $this->load->model('cliente_modelo');
            $Y = date('Y');
            $d = date('Y-m-d');
            $h = date('H:i:s');
            $data['id_procedimiento'] = $this->input->post('cbo_Pr');
            $data['id_tipo_documento'] = $this->input->post('cbo_TD');
            $data['numero_documento'] = $this->input->post('txtNDoc');
            $data['asunto'] = $this->input->post('txtAsunto');
            $data['fecha'] = "2012-11-16 14:18:21";
            $data['folio'] = $this->input->post('txtFolio');
            $data['estado_expediente'] = "1";
            $data['id_cliente'] = $this->input->post('txtHNI');
            if ($data['id_cliente'] == "") {
                $dataCl['numero_identificacion'] = $this->input->post('txtNI');
                $dataCl['nombre'] = $this->input->post('txtCliente');
                $data['id_cliente'] = $this->cliente_modelo->insert($dataCl); //AGREGAR CLIENTE
            } else {
                $dataCl['numero_identificacion'] = $this->input->post('txtNI');
                $dataCl['nombre'] = $this->input->post('txtCliente');
                $this->cliente_modelo->update($dataCl, $data['id_cliente']); //MODIFICAR CLIENTE
            }
//            GUARDAR EXPEDIENTE
            $NExp=1;
            $r = $this->expediente_modelo->selectLast();
                if(count($r)>0){
                    $lastExp = explode("-", $r->numero_expediente);
                    if($lastExp[1]==$Y){
                        $NExp=($lastExp[0])+1;
                    }
                }
            $result = $this->expediente_modelo->insert($data);
            if ($result) {                             
                $e = substr("00000", 0, 5 - (strlen($NExp) / 10));
                $NumExp = $e . $NExp . "-" . $Y;
                $da["numero_expediente"] = $NumExp;
                $this->expediente_modelo->update($result, $da);
                //Iniciar Movimiento
                $dataMov["id_expediente"] = $result;
                $dataMov["org_destino"] = $this->input->post('cbo_UOO');
                $dataMov["fecha_recepcion"] = $d . " " . $h;
                $dataMov["rol_recepcion"] = $this->session->userdata("id_rol_usuario");
                $dataMov["fecha_derivacion"] = $d . " " . $h;
                $dataMov["rol_derivacion"] = $this->session->userdata("id_rol_usuario");
                $dataMov["id_estado"] = "3";
                $dataMov["id_organo_administrativo"] = "0";
                $dataMov["rol_atencion"] = "0";
                $this->movimiento_modelo->insert($dataMov);
                //Segundo Movimiento
                $dataMov2["id_expediente"] = $result;
                $dataMov2["id_organo_administrativo"] = $this->input->post('cbo_UOO');
                $dataMov2["org_destino"] = $this->input->post('cbo_UOD');
                $dataMov2["id_estado"] = "2";
                $dataMov2["rol_recepcion"] = "0";
                $dataMov2["rol_derivacion"] = "0";
                $dataMov2["rol_atencion"] = "0";
                $this->movimiento_modelo->insert($dataMov2);
                //Mostrar N Expediente
                echo $NumExp;
            } else {
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function mostrarExpediente($NumExp) {
        $datos["NumExp"] = $NumExp;
        $D["print"] = $this->load->view('expediente/mensaje', $datos, true);
        echo $this->load->view("inicio/popup", $D, true);
    }

    public function observacion($idExp) {
        $this->load->model('expediente_modelo');
        $Data["listaDatos"] = $this->expediente_modelo->select($idExp);
        $D["print"] = $this->load->view("expediente/observacion", $Data, true);
        echo $this->load->view("inicio/popup", $D, true);
    }

    public function actualizar() {
        if ($this->session->userdata('user')) {
            $this->load->model('expediente_modelo');
            $id = $this->input->post('id');
            $dat['observacion'] = $this->input->post('observacion');
            $modificado = $this->expediente_modelo->update($id,$dat);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function descargarExpediente() {
        if ($this->session->userdata('user')) {
            $this->load->model('expediente_modelo');
            $Data["listaDatos"] = $this->expediente_modelo->lista(false, false, false);
            $this->load->view("expediente/downloadTable", $Data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function expedientePDF() {
        if ($this->session->userdata('user')) {

        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function savePdf($name, $data, $dest = 'I') {
        if ($this->session->userdata('user')) {
            $logo = base_url() . "recursos/imagenes/logo.jpg";
            $dataName["row"] = $data["column"];
            $dataConfig["widths"] = $data['widthPage'];
            $dataConfig["align"] = $data["align"];
            $attr = array(
                "orientation" => $data["orientation"],
                "unit" => "mm",
                "size" => "A4",
                "title" => utf8_encode($data["tittle"]),
                "SubTitle" => utf8_encode($data["bo_name"]),
                "be_logo" => $logo,
                "user" => $data["User"],
                "wrapLines" => $data["wrapLines"]
            );
            define("FPDF_FONTHPATH", BASEPATH . "libraries/fpdf/font/");
            $this->load->library("fpdf/fpdf");
            $this->load->library("pdf", $attr);
            if (count($dataConfig["widths"]) == count($dataConfig["align"]) && count($dataName["row"]) == count($dataConfig["align"])) {
                $this->pdf->AddNameHead($dataName);
                $this->pdf->AddValueConfig($dataConfig);
                $this->pdf->setBorderEnabled($data["BorderE"]);
                $this->pdf->AddPage();
                $this->pdf->AliasNbPages();
                $this->pdf->addReportData($data["persons"], $data["fields"], $data["options"]);
                $this->pdf->output($name . ".pdf", $dest);
            } else {
                $this->pdf->Error("La Cantidad de Columnas no Coinciden");
            }
        }
    }

    public function index() {
        if ($this->session->userdata('user')) {
            $this->load->model("expediente_modelo");
            $data["persons"] = $this->expediente_modelo->listaArr();
            $data["options"] = Array(
                "1" => "numero_expediente",
                "2" => "nombre",
                "3" => "asunto",
                "4" => "fecha",
            );
            $field = "1_2_3_4";
            $ArrField = explode("_", $field);
            $data["fields"] = $ArrField;
            $data["column"] = array(
                '1' => 'CODIGO',
                '2' => 'NOMBRE',
                '3' => 'ASUNTO',
                '4' => 'FECHA',
            );
            $tittle = "Reporte de Expedientes";
            $name = "Reporte-Expediente";
            $colArray = array();
            $colNameArray = array();
            $nc = 0;
            foreach ($data["fields"] as $f) {
                $colArray[$nc] = $data["options"][$f];
                $colNameArray[$nc] = $data["column"][$f];
                $nc++;
            }
            $data["options"] = $colArray;
            $data["column"] = $colNameArray;
            $data["BorderE"] = true;

            $data["wrapLines"] = false;
            $data["orientation"] = "P";
            $data["bo_name"] = "Expedientes Registrados";
            $data["User"] = "LSTR";
            $data["align"] = array("L", "L", "L", "L");
            $data["widthPage"] = array(25, 30, 95, 80); //288
            $data["tittle"] = $tittle;
            $this->savePdf($name, $data, "D");
        } else {
            redirect(base_url(), 'refresh');
        }
    }

}
?>
