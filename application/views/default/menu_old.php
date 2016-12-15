<!-- construccion del menu -->
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#">Inicio</a> </li>
    <li><a data-toggle="tab" href="#">Quienes somos</a> </li>
    <li class="dropdown">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">CodeIgniter menus</a>
        <ul class="dropdown-menu">
            <li><a href="<?=base_url().'Principal/menus'?>">Menu NAVS</a></li>
            <li><a href="<?=base_url().'Principal/wizard'?>">Wizard</a></li>
            <li><a href="<?=base_url().'Ahorcado'?>">Ahorcado</a></li>
        </ul>
    </li>
</ul>