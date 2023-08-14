<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
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
        </div>
        <div class="d-flex">
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="<?php echo base_url('assets/images/users/user.png'); ?>" alt="Header Avatar">
                </button>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="p-3 bg-primary border-bottom">
                        <h6 class="mb-0 text-white">Administrador</h6>
                    </div>
                    <a class="dropdown-item" href="#" id="btn-config"><i class="mdi mdi-cog text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Configuración</span></a>
                    <a class="dropdown-item" href="#" id="btn-changeKey"><i class="mdi mdi-key-outline text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Cambiar Contraseña</span></a>
                    <a class="dropdown-item" href="<?php echo base_url('Home'); ?>"><i class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Salir</span></a>
                </div>
            </div>
        </div>
    </div>
</header>

<script>

    $('#btn-config').click(function(e) {

        e.preventDefault();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('Administrator/showModalConfig'); ?>",
            dataType: "html",
            success: function(htmlResponse) {
                $('#main-modal').html(htmlResponse);
            },
            error: function(error) {
                showToast('error', 'Ha ocurrido un error');
            }
        });

    });

    $('#btn-changeKey').click(function(e) {

        e.preventDefault();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('Administrator/showModalChangeKey'); ?>",
            dataType: "html",
            success: function(htmlResponse) {
                $('#main-modal').html(htmlResponse);
            },
            error: function(error) {
                showToast('error', 'Ha ocurrido un error');
            }
        });

    });
</script>;