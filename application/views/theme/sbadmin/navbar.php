<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url() ?>">Admin Tutorialesvirtuales</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url() ?>seguridad/login/salir"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

<?php
$file = FCPATH . 'assets/gratiacms/menus/1/menu_' . $this->session->userdata('rol_id') . '.json';
$menus = json_decode(file_get_contents($file), true);
?>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <?php foreach ($menus['original'] as $menu): ?>
            <?php if ($menu['menu_id'] === NULL): ?>
                <?php if (isset($menus['predecesor'][$menu['id']])): ?>
                    <li>
                        <a href="javascript:;"><i class="<?php echo $menu['icono'] ?>"></i> <?php echo $menu['etiqueta'] ?><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php foreach ($menus['predecesor'][$menu['id']] as $menuP): ?>
                                <?php if (isset($menus['predecesor'][$menuP['id']])): ?>
                                    <li>
                                        <a href="javascript:;"><i class="<?php echo $menuP['icono'] ?>"></i> <?php echo $menuP['etiqueta'] ?><span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <?php foreach ($menus['predecesor'][$menuP['id']] as $menuS): ?>
                                                <?php if (isset($menus['predecesor'][$menuS['id']])): ?>
                                                    <li>
                                                        <a href="javascript:;"><i class="<?php echo $menuS['icono'] ?>"></i> <?php echo $menuS['etiqueta'] ?><span class="fa arrow"></span></a>
                                                        <ul class="nav nav-third-level">
                                                            <?php foreach ($menus['predecesor'][$menuS['id']] as $menuSS): ?>
                                                                <li>
                                                                    <a href="<?php echo base_url() . $menuSS['url'] ?>"><i class="<?php echo $menuSS['icono'] ?>"></i> <?php echo $menuSS['etiqueta'] ?></a>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </li>
                                                <?php else: ?>
                                                    <li>
                                                        <a href="<?php echo base_url() . $menuS['url'] ?>"><i class="<?php echo $menuS['icono'] ?>"></i> <?php echo $menuS['etiqueta'] ?></a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="<?php echo base_url() . $menuP['url'] ?>"><i class="<?php echo $menuP['icono'] ?>"></i> <?php echo $menuP['etiqueta'] ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?php echo base_url() . $menu['url'] ?>"><i class="<?php echo $menu['icono'] ?>"></i> <?php echo $menu['etiqueta'] ?></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>