<div class="vertical-menu">
    <div class="navbar-brand-box">
        <a href="" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo base_url("assets/images/logo-sm.png"); ?>" alt="tpv" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo base_url("assets/images/logo.png"); ?>" alt="tpv" height="22">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>


    <div data-simplebar class="sidebar-menu-scroll">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <!-- DASHBOARD -->
                <li class="<?php if ($menu_ative == "dashboard") {
                                echo "mm-active";
                            } ?>">
                    <a href="<?php echo base_url('TPV/dashboard'); ?>">
                        <i class="icon nav-icon <?php if ($menu_ative == "dashboard") {
                                                    echo "active";
                                                } ?>" data-feather="home"></i>
                        <span class="menu-item">
                            Tablero
                        </span>
                    </a>
                </li>
                
                <!-- TPV -->
                <li class="<?php if ($menu_ative == "tpv") {
                                echo "mm-active";
                            } ?>">
                    <a href="<?php echo base_url('TPV/tpv'); ?>">
                        <i class="icon nav-icon <?php if ($menu_ative == "tpv") {
                                                    echo "active";
                                                } ?>" data-feather="monitor"></i>
                        <span class="menu-item">
                            TPV
                        </span>
                    </a>
                </li>
                
                <!-- PRODUCT -->
                <li class="<?php if ($menu_ative == "product") {
                                echo "mm-active";
                            } ?>">
                    <a href="<?php echo base_url('TPV/products'); ?>">
                        <i class="icon nav-icon <?php if ($menu_ative == "product") {
                                                    echo "active";
                                                } ?>" data-feather="archive"></i>
                        <span class="menu-item">
                            Artículos
                        </span>
                    </a>
                </li>

                <!-- REPORT -->
                <li class="<?php if ($menu_ative == "report") {
                                echo "mm-active";
                            } ?>">
                    <a href="<?php echo base_url('TPV/report'); ?>">
                        <i class="icon nav-icon <?php if ($menu_ative == "report") {
                                                    echo "active";
                                                } ?>" data-feather="bar-chart-2"></i>
                        <span class="menu-item">
                            Reportes
                        </span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-dashboards">Configuración</li>

                <!-- REPORT -->
                <li class="<?php if ($menu_ative == "settings") {
                                echo "mm-active";
                            } ?>">
                    <a href="<?php echo base_url('TPV/settings'); ?>">
                        <i class="icon nav-icon <?php if ($menu_ative == "settings") {
                                                    echo "active";
                                                } ?>" data-feather="settings"></i>
                        <span class="menu-item">
                            Ajustes del Sistema
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>