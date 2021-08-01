<?php $this->load->view("headers/header") ?>
<div class="content">
    <div class="col-md-12">
        <form action="<?php echo base_url("updatePass")?>" method="post">
            <div class="row">
                <label for="">Nueva contraseña</label>
                <input type="text" name="contra" id="contra" class="form-control"><br>
            </div><br>
            <div class="row">
                <label for="">Confirmar contraseña</label>
                <input type="text" name="conf" id="conf" class="form-control"><br>
            </div><br>
            <div class="row">
                <button type="submit" class="btn btn-block btn-lg btn-success">Cambiar contraseña</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">var base_url="<?php echo base_url(); ?>"</script>
<?php $this->load->view("footers/footer") ?>