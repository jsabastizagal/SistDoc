<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();
date_default_timezone_set("America/Lima");

class Reporte extends CI_Controller {

    var $page = "reporte";

    public function index() {
        if ($this->session->userdata('user')) {
            $this->load->model('organo_administrativo_modelo');
            $this->load->model('tipo_documento_modelo');
            $Dat['OA'] = $this->organo_administrativo_modelo->lista(false, false, false);
            $Dat['TD'] = $this->tipo_documento_modelo->lista(false, false, false);
            $DC["containerData"] = $this->load->view($this->page . '/data', $Dat, true);
            $DC["tabActive"] = 4;
            $data["estructura"] = $this->load->view('inicio/index', $DC, true);
            $data["opcion"] = 0;
            $this->load->view('inicio/contenedor', $data);
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

    public function descargaFecha($FechaFrom=null, $FechaTo=null) {
        if ($this->session->userdata('user')) {
            if ($FechaFrom != "" && $FechaTo != "") {
                $fecha = "fecha between '" . $FechaFrom . " 00:00:00' AND '" . $FechaTo . " 23:59:59'";
            }
            $name="Expedientes Registrados Desde ".$FechaFrom." - ".$FechaTo;
            $this->descarga($fecha, false, $name);
        } else {
            $this->pdf->Error("La Cantidad de Columnas no Coinciden");
        }
    }

    public function descargaTipoDoc($idTipo) {
        if ($this->session->userdata('user')) {
            $this->load->model('tipo_documento_modelo');
            $dataModel = $this->tipo_documento_modelo->select($idTipo);
            $where["id_tipo_documento"] = $idTipo;
            $name="Expedientes Registrados Con Tipo de Documento: ".$dataModel->nombre_tipo_documento;
            $this->descarga($where, false, $name);
        } else {
            $this->pdf->Error("La Cantidad de Columnas no Coinciden");
        }
    }

    public function descargaArea($opc=1, $uo=0) {
        if ($this->session->userdata('user')) {
            $where = false;
            $whIn = false;
            $area = "Todas las Areas";
            if ($uo > 0) {
                $this->load->model('movimiento_modelo');
                $W["id_area_destino"] = $uo;
                $D = $this->movimiento_modelo->lista(false, false, $W);
                foreach ($D as $vl) {
                    $area = $vl->area_origen;
                    $whIn[] = $vl->id_expediente;
                }
            }
            if ($opc == 2) {
                $where["estado_expediente"] = "1";
                $name = "Expedientes Registrados-Concluido/Area " . $area;
            } else if ($opc == 3) {
                $where["estado_expediente"] = "2";
                $name = "Expedientes Registrados-En Proceso/Area " . $area;
            } else {
                $name = "Expedientes Registrados/Area " . $area;
            }
            $this->descarga($where, $whIn, $name);
        } else {
            $this->pdf->Error("La Cantidad de Columnas no Coinciden");
        }
    }

    public function descarga($where=false, $whIn=false, $name="") {
        if ($this->session->userdata('user')) {
            $this->load->model("expediente_modelo");
            $data["bo_name"] = $name;
            $data["persons"] = $this->expediente_modelo->listaArr(false, false, $where, $whIn);
            $data["options"] = Array(
                "1" => "numero_expediente",
                "2" => "nombre",
                "3" => "nombre_tipo_documento",
                "4" => "asunto",
                "5" => "fecha",
                "6" => "observacion",
            );
            $field = "1_2_3_4_5_6";
            $ArrField = explode("_", $field);
            $data["fields"] = $ArrField;
            $data["column"] = array(
                '1' => 'Numero Exp.',
                '2' => 'Nombre',
                '3' => 'Tipo Doc.',
                '4' => 'Asunto',
                '5' => 'Fecha',
                '6' => 'Observacion',
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
            $data["orientation"] = "L";

            $data["User"] = $this->session->userdata("nombre_usuario");
            $data["align"] = array("L", "L", "L", "L", "L", "L");
            $data["widthPage"] = array(30, 50, 30, 100, 30, 40); //288
            $data["tittle"] = $tittle;
            $this->savePdf($name, $data, "D");
        } else {
            redirect(base_url(), 'refresh');
        }
    }

}