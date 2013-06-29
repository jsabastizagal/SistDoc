<div style="border-top: 1px solid #dcdede ;padding: 5px;text-align: center;color: #ffffff ">
    <span style="background-color: #006699 ;padding: 3px;border-radius:5px;font-size: 16px">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->session->userdata("nombre_usuario"); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </span>
</div>
<table class="table table-hover">
    <col width="20%">
    <col width="80%">
    <tbody>
        <tr>
            <td><strong>Usuario:</strong></td>
            <td><?php echo $rol->usuario; ?></td>
        </tr>
        <tr>
            <td><strong>Rol:</strong></td>
            <td><?php echo $rol->nombre_rol; ?></td>
        </tr>
        <tr>
            <td><strong>Nivel de Acceso:</strong></td>
            <td><?php echo $rol->nivel_acceso; ?></td>
        </tr>
        <tr>
            <td><strong>DNI:</strong></td>
            <td><?php echo $rol->dni; ?></td>
        </tr>
        <tr>
            <td><strong>Nombre de Area:</strong></td>
            <td><?php echo $this->session->userdata("nombre_area"); ?></td>
        </tr>
    </tbody>
</table>