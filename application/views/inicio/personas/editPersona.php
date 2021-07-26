<?php $this->load->view("headers/header") ?>
<div class="content">
    <h1>Editar Persona</h1>
    <form action="<?php echo base_url("actInfoPersonas") ?>" method="post">
        <input type="text" name="id" id="id" value="<?php echo $_SESSION["datosEditPersona"]["id"] ?>" hidden>
        <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $_SESSION["datosEditPersona"]["nombre"] ?>"><br>
        <input type="text" class="form-control" name="ap_paterno" id="ap_paterno" value="<?php echo $_SESSION["datosEditPersona"]["ap_paterno"] ?>"><br>
        <input type="text" class="form-control" name="ap_materno" id="ap_materno" value="<?php echo $_SESSION["datosEditPersona"]["ap_materno"] ?>"><br>
        <button type="submit" class="btn btn-success btn-block btn-lg">Actualizar datos</button>
    </form>
    
</div>
<?php $this->load->view("footers/footer") ?>
