<?php $this->load->view("headers/header") ?>
<div class="content">
    <h1>Agregar persona</h1>
    <form action="<?php echo base_url("insert/personas") ?>" method="post">
        <div class="row">
            <div class="col-md-12">
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Escribe el nombre"><br>
                <input type="text" name="ap_paterno" id="ap_paterno" class="form-control" placeholder="Escribe el apellido paterno"><br>
                <input type="text" name="ap_materno" id="ap_materno" class="form-control" placeholder="Escribe el apellido materno"><br>
                <button type="submit" class="btn btn-success btn-block btn-lg form-control">Agregar persona</button>
            </div>
        </div>
    </form>
</div>
<?php $this->load->view("footers/footer") ?>