<script type="text/javascript" src="<?php echo base_url() ?>recursos/js/formulario.js"></script>
<form id="frmAdd" class='form-stacked' action="" method="post">
    <input id="id_rol_usuario" name="id_rol_usuario" type="hidden" value="<?php echo $id_rol_usuario; ?>">
    <div style="padding: 1px;background-color: #515352">
        <div style="text-align: center">
            <label style="font-weight: bold;text-align: center;color: #f1f0f0 ">                
                Agregar Rol de Usuario</label>
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
                <td><label for="name">Nombre de Rol</label></td>
                <td>                    
                    <input class="xlarge" id="nombre" name="nombre" size="30" type="text" value="<?php echo $nombre; ?>">
                </td>
                <td></td>
            </tr>
            <tr><td></td>
                <td><label for="name">Organo Administrativo</label></td>
                <td>
                    <select name="cbo_oa" style="height: 26px;width: 100%;">
                        <?php
                        foreach ($VOA as $v) {
                            if($v->id_organo_administrativo==$id_organo_administrativo||!in_array($v->id_organo_administrativo, $arrArea)){
                        ?>
                        <option <?php echo ($v->id_organo_administrativo==$id_organo_administrativo)?"selected":""; ?>
                                    value="<?php echo $v->id_organo_administrativo; ?>">&nbsp;<?php echo $v->nombre_area; ?></option>
                        <?php
                        }} ?>
                    </select>
                </td>
                <td></td>
            </tr>
            <tr><td></td>
                <td><label for="name">Nivel De Acceso</label></td>
                <td>
                    <select name="cbo_na" style="height: 26px;width: 100%;">
                        <?php
                        foreach ($VNA as $v) {
                            if ($v->id_nivel_acceso != 0) {
                        ?>
                        <option <?php echo ($v->id_nivel_acceso==$id_nivel_acceso)?"selected":""; ?>
                                    value="<?php echo $v->id_nivel_acceso; ?>">&nbsp;<?php echo $v->nivel; ?></option>
                        <?php }
                        } ?>
                    </select>
                </td>
                <td></td>
            </tr>
            <tr><td></td>
                <td><label for="name">Personal</label></td>
                <td>
                    <select name="cbo_u" style="height: 26px;width: 100%;">
                        <?php
                        foreach ($VU as $v) {
                            if ($v->id_usuario != 0&&($v->id_usuario==$id_usuario||!in_array($v->id_usuario, $arrUser))) {
                        ?>
                        <option <?php echo ($v->id_usuario==$id_usuario)?"selected":""; ?>
                                    value="<?php echo $v->id_usuario; ?>">&nbsp;<?php echo $v->nombre." ".$v->apellido_paterno; ?></option>
                        <?php }
                        } ?>
                    </select>
                </td>
                <td></td>
            </tr>
            <tr><td></td>
                <td><label for="name">Usuario</label></td>
                <td>
                    <input class="xlarge" id="usuario" name="usuario" size="30" type="text" value="<?php echo $usuario; ?>">
                </td>
                <td></td>
            </tr>
            <tr><td></td>
                <td><label for="name">Contrase&ntilde;a</label></td>
                <td>
                    <input id="id_cuenta_usuario" name="id_cuenta_usuario" size="30" type="hidden" value="<?php echo $id_cuenta_usuario; ?>">
                    <input id="claveH" name="claveH" size="30" type="hidden" value="<?php echo $clave; ?>">
                    <input class="xlarge" id="clave" name="clave" size="30" style="height: 25px" type="password" value="">
                </td>
                <td></td>
            </tr>
            <tr><td colspan="4">
                    <div style="padding-bottom: 15px;text-align: center">
                        <label><input type="checkbox" name="estado" id="estado" <?php echo ($estado!=0)?"checked":""; ?>/>
                            <span style="position: absolute;font-weight: bold;padding-top: 2px">&nbsp;Activo</span></label>
                    </div></td>
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