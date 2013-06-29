<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!isset($_SESSION))
    session_start();
date_default_timezone_set("America/Lima");

class Expedientes extends CI_Controller {

    public function index() {
        if ($this->session->userdata('user')) {
            $this->load->model('tipo_documento_modelo');
            $Data["tipo_documento"] = $this->tipo_documento_modelo->lista(false, false, false);
            $data["estructura"] = $this->load->view("expediente/index", $Data, true);
            $data["opcion"] = 2;
            $this->load->view('inicio/contenedor', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function consulta() {
        $this->load->library("user_agent");
        if ($this->session->userdata('NExp')) {
            $NExp = $this->session->userdata('NExp');
            $NI = $this->session->userdata('txtNI');
        } else {
            $NExp = $this->input->post("txtNExp");
            $NI = $this->input->post("txtNI");
            $this->session->set_userdata("NExp", $NExp);
            $this->session->set_userdata("txtNI", $NI);
        }
        $this->load->model('movimiento_modelo');
        $this->load->model('expediente_modelo');
        if ($NExp != "") {
            $Exp = $this->expediente_modelo->selectByNE($NExp, $NI);
            if (count($Exp) > 0) {
                $this->session->set_userdata("consultWrong", 0);
                $Data["datosExp"] = $Exp;
                $Data["datosOA"] = null;
                $Data["listaDatos"] = $this->movimiento_modelo->selectbyExp($Exp->id_expediente);
                if (!$this->session->userdata("isMobile")) {
                    $data["estructura"] = $this->load->view("movimiento/dataTableCliente", $Data, true);
                    $data["opcion"] = 2;
                    $this->load->view('inicio/cliente', $data);
                } else {
                    $this->load->view('mobile/movimiento', $Data);
                }
            } else {
                $this->session->set_userdata("consultWrong", 1);
                redirect(base_url(), 'refresh');
            }
        } else {
            $this->session->set_userdata("consultWrong", 1);
            redirect(base_url(), 'refresh');
        }
    }

    public function descargarPDF($idExp) {
        $this->load->model("movimiento_modelo");
        $this->load->model("expediente_modelo");
        $Exp = $this->expediente_modelo->select($idExp);
        $where["id_expediente"] = $idExp;
        $data["result"] = $this->movimiento_modelo->listaArray(false, false, $where);
        $data["options"] = Array(
            "1" => "area_origen",
            "2" => "area_destino",
            "3" => "fecha_recepcion",
            "4" => "rol_recepcion",
            "5" => "fecha_derivacion",
            "6" => "rol_derivacion",
            "7" => "fecha_atencion",
            "8" => "rol_atencion",
            "9" => "proveido",
            "10" => "nombre",
        );
        $field = "1_2_3_4_5_6_7_8_9_10";
        $ArrField = explode("_", $field);
        $data["fields"] = $ArrField;
        $data["column"] = array(
            '1' => 'ORIGEN',
            '2' => 'DESTINO',
            '3' => 'FECHA RECEPCION',
            '4' => 'USUARIO',
            '5' => 'FECHA DERIVACION',
            '6' => 'USUARIO',
            '7' => 'FECHA ATENCION',
            '8' => 'USUARIO',
            '9' => 'PROVEIDO',
            '10' => 'ESTADO',
        );
        $tittle = "MOVIMIENTO DE EXPEDIENTE N: " . $Exp->numero_expediente;
        $name = "Reporte- Expediente N: " . $Exp->numero_expediente;
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
        $data["BorderE"] = false;

        $data["wrapLines"] = false;
        $data["orientation"] = "L";
        $data["subtitle"] = "ENVIADO: " . $Exp->fecha;
        $data["TitleHeader"] = strtoupper($Exp->nombre_tipo_documento);
        $data["Info"] = "USUARIO: " . $Exp->nombre . "      NUMERO DE IDENTIFICACION: " . $Exp->numero_identificacion;
        $data["User"] = $Exp->nombre;
        $data["align"] = array("L", "L", "L", "L", "L", "L", "L", "L", "L" ,"L");
        $data["widthPage"] = array(25, 25, 30, 30, 30, 30, 30, 25, 40,20); //288
        $data["tittle"] = $tittle;
        $this->savePdf($name, $data, "D");
    }

    public function savePdf($name, $data, $dest = 'I') {
        $logo = base_url() . "recursos/imagenes/logo.jpg";
        $dataName["row"] = $data["column"];
        $dataConfig["widths"] = $data['widthPage'];
        $dataConfig["align"] = $data["align"];
        $attr = array(
            "orientation" => $data["orientation"],
            "unit" => "mm",
            "size" => "A4",
            "title" => utf8_encode($data["tittle"]),
            "Info" => utf8_encode($data["Info"]),
            "SubTitle" => utf8_encode($data["subtitle"]),
            "TitleHeader" => utf8_encode($data["TitleHeader"]),
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
            $this->pdf->addReportData($data["result"], $data["fields"], $data["options"]);
            $this->pdf->output($name . ".pdf", $dest);
        } else {
            $this->pdf->Error("La Cantidad de Columnas no Coinciden");
        }
    }

}
?>