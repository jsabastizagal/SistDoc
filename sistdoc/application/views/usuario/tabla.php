<script type="text/javascript" src="<?php echo base_url() ?>recursos/js/tabla.js"></script>
<link type="text/css" href="<?php echo base_url() ?>recursos/css/tabla.css" />
<style type="text/css">
    .table td{
        padding: 2px;
        font-size: 13px;
    }
    .table th{
        padding: 4px;
        font-size: 15px;
        background-color: #e6e7e7
    }
    .table tbody tr:nth-child(odd){
        background-color: #f4f5f4
    }
    .table tbody tr:nth-child(even){
        background-color: #f1f2f1
    }
</style>
<table class="table table-hover" style="margin-bottom: 0px">
    <thead>
        <tr>
            <th>Numero</th>
            <th>DNI</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th style="text-align:center">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $num = 1;
        foreach ($listaDatos as $val) {
        ?>
            <tr>
                <td><?php echo $num++; ?></td>
                <td><?php echo $val->dni; ?></td>
                <td><?php echo $val->nombre; ?></td>
                <td><?php echo $val->apellido_paterno; ?></td>
                <td style="text-align:center">
                    <button class="btn btn-mini btnMod" type="button" attr-aux="<?php echo $val->id_usuario; ?>">
                        <i class="icon-trash"></i>&nbsp Modificar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-mini btnEli" type="button" attr-aux="<?php echo $val->id_usuario; ?>">
                        <i class="icon-trash"></i>&nbsp Eliminar</button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>