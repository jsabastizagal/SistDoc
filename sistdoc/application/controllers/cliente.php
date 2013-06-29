<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Cliente extends CI_Controller {

    public function listCliente() {
        $this->load->model('cliente_modelo');        
        $lista=$this->cliente_modelo->lista();
        $l="";
        foreach ($lista as $val) {
            $l.=$val->id_cliente."-".$val->numero_identificacion."-".$val->nombre.",";
        }
        echo $l;
    }

}
?>
