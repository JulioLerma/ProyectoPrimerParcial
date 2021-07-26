<?php $this->load->view("headers/header") ?>
<div class="container">
	<table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Paterno</th>
                <th>Materno</th>
                <th>Estado</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($_SESSION["personas"] as $persona){
                    ?>
                    <tr>
                        <td><?php echo $persona["id"] ?></td>
                        <td><?php echo $persona["nombre"] ?></td>
                        <td><?php echo $persona["ap_paterno"] ?></td>
                        <td><?php echo $persona["ap_materno"] ?></td>
                        <?php echo $persona["estado"] == 1 ? "<td><a href=".base_url("activo/".$persona["estado"]."/".$persona["id"]."/personas")."><button class='btn btn-success'><i class='fas fa-check-circle'></i></button></a></td>"
                        :"<td><a href=".base_url("activo/".$persona["estado"]."/".$persona["id"]."/personas")."><button class='btn btn-danger'><i class='fas fa-times-circle'></i></button></a></td>" ?>
                        <td><a href="<?php echo base_url("editPersona/".$persona["id"]) ?>"><button class="btn btn-warning">Editar</button></a></td>
                        <td><a href="<?php echo base_url("deletePersona/".$persona["id"]) ?>"><button class="btn btn-danger">Eliminar</button></a></td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
    <div class="row">
        <a href="<?php echo base_url("addPersona") ?>" class="btn btn-block btn-success btn-lg">Agregar persona</a>
    </div>
</div>
<script type="text/javascript"> 
var base_url = "<?php echo base_url(); ?>";
</script>
<script type="text/javascript">
var id_delete = "<?php echo $this->session->flashdata('id_delete'); ?>";
</script>
<?php $this->load->view("footers/footer") ?>
<script src="<?php echo base_url("resources/js/delete.js")?>"></script>