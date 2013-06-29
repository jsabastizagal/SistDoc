<script type="text/javascript" src="<?php echo base_url() ?>recursos/js/formulario.js"></script>
<form id="frmAdd" class='form-stacked' action="" method="post">
    <input  id="id_usuario" name="id_usuario" type="hidden" value="<?php echo $id_usuario; ?>">
    <div style="padding: 1px;background-color: #515352">
        <div style="text-align: center">
            <label style="font-weight: bold;text-align: center;color: #f1f0f0 ">                
                Agregar &Aacute;rea Administrativa</label>
        </div>
    </div>
    <div style="padding-bottom: 15px"></div>
    <table style="width: 100%">
        <col width="5%">
        <col width="25%">
        <col width="65%">
        <col width="5%">
        <tbody>
            <tr><td></td>
                <td><label for="name">DNI: </label></td>
                <td>
                    <input class="xlarge" id="dni" name="dni" size="30" type="text" value="<?php echo $dni; ?>">
                </td>
                <td></td>
            </tr>
            <tr><td></td>
                <td><label for="name">Nombres: </label></td>
                <td>
                    <input class="xlarge" id="nombre" name="nombre" size="30" type="text" value="<?php echo $nombre; ?>">
                </td>
                <td></td>
            </tr>
            <tr><td></td>
                <td><label for="name">Apellidos: </label></td>
                <td>
                    <input class="xlarge" id="apellidos" name="apellidos" size="30" type="text" value="<?php echo $apellidos; ?>">
                </td>
                <td></td>
            </tr>
            <tr><td colspan="4"><div style="padding-bottom: 15px"></div></td>
            </tr>
            <tr><td></td>
                <td style="text-align: right">
                    <button type="button" class="btn primary" id="btnSend">
                        Guardar</button>
                    &nbsp;&nbsp;&nbsp;
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn primary" id="btnCancel">
                        Cancelar</button>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>    
</form>
<div style="padding-bottom: 10px;text-align: left">
    <span style="display: none" class="badge badge-warning"> Error al Guardar Los Datos </span>
    <span style="display: none" class="badge badge-info info1"> Enviando... </span>
    <span style="display: none" class="badge badge-info info2"> Guardado Correctamente </span>
</div>