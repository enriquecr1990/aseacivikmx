        <div id="conteiner_modal_confirmacion"></div>
        <div id="conteiner_registro_es"></div>
    </div>
    <br>
    <div class="nav navbar-default navbar-fixed-bottom">
        <div class="container">
            <div class="col-sm-12 centrado">
                <img src="<?=base_url().'extras/imagenes/logo-ASEA.png'?>" style="width: 45px;">
                <span class="label label-default">Todos los derechos reservados <?=date('Y')?></span>
                <img src="<?=base_url().'extras/imagenes/logo_semarnat.png'?>" style="width: 45px;">
            </div>
        </div>
    </div>

</div>
<!--<div class="col-sm-12 centrado">
    Píe de pagina de mi proyecto de inicio con codeigniter<br>
    Todos los derecho reservados &copy <?= date('Y') ?>
</div>-->
<!-- js de bootstrap-->
<script src="<?= base_url() . 'extras/bootstrap/js/jquery.js' ?>"></script>
<!--<script src="http://code.jquery.com/jquery.js"></script>-->
<script src="<?= base_url() . 'extras/bootstrap/js/bootstrap.js' ?>"></script>

<!-- script para jquery validate e idioma-->
<script src="<?= base_url() . 'extras/jquery/jquery.validate.js'?>" ></script>
<script src="<?= base_url() . 'extras/jquery/localization/messages_es.js'?>" ></script>

<!-- js extras y principales al sistema completo -->
<script src="<?= base_url() . 'extras/asea/comun.js' ?>"></script>
<script type="text/javascript">
    var base_url = '<?php echo base_url()?>';
    var extenciones_files = '<?php echo EXTENSIONES_FILES_IMG ?>';
    var max_filesize = '<?php echo MAX_FILESIZE ?>';
    var base_url_script = '<?php echo base_url()."extras/" ?>';
    var loader_gif = '<div style="text-align: center;"><img src="<?php echo base_url("extras/imagenes/loaders/loader08.gif")?>" width="100px" href="100px"></div>';
</script>

<!-- js extras y secundarios se cargan conforme al modulo-->
<?php if (isset($extra_js)): ?>
    <?php foreach ($extra_js as $js): ?>
        <script src="<?= $js ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>
