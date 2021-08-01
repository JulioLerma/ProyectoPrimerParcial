<?php $this->load->view("headers/header") ?>
	<div class="container">
        <h1>Editar Personas</h1>
        <form action="<?php echo base_url("actInfoPersonas") ?>" method="post">
            <input type="hidden" name="id" id="id" value="<?php print_r($_SESSION["datosEditPersonas"]["id"]); ?>">
            <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $_SESSION["datosEditPersonas"]["nombre"] ?>"> <br>
            <input type="text" class="form-control" name="ap_paterno" id="ap_paterno" value="<?php echo $_SESSION["datosEditPersonas"]["ap_paterno"] ?>"> <br>
            <input type="text" class="form-control" name="ap_materno" id="ap_materno" value="<?php echo $_SESSION["datosEditPersonas"]["ap_materno"] ?>"> <br>
            <button type="submit" class="btn btn-success btn-block btn-lg">Actualizar datos</button>
        </form>
    
	</div>
	<?php $this->load->view("footers/footer") ?>