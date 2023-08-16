<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>TPV SHOP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="TPV SHOP" name="description" />
    <meta content="Axley Herrera" name="author" />

    <link rel="shortcut icon" href="<?php echo base_url('assets/images/app-icon.ico'); ?>">

    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/app.min.css'); ?>" id="app-style" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/libs/sweetalert/sweetalert2.css'); ?>" id="app-style" rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url('assets/libs/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/metismenujs/metismenujs.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/simplebar/simplebar.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/feather-icons/feather.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/sweetalert/sweetalert2.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/customApp.js'); ?>"></script>
    <script src="<?php echo base_url('assets/custom/formValidation.js'); ?>"></script>
</head>

<body>
    <div class="authentication-bg min-vh-100">
        <div class="container">
            <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="text-center py-5">
                            <div class="user-thumb mb-4 mb-md-5">
                                <img src="<?php echo base_url('assets/images/users/user.png'); ?>" class="rounded-circle img-thumbnail avatar-lg" alt="thumbnail">
                                <h5 class="font-size-16 mt-3">Bienvenido</h5>
                            </div>
                            <div class="form-floating form-floating-custom mb-3">
                                <input type="password" id="txt-password" class="form-control required focus" placeholder="Clave de Acceso">
                                <label for="txt-password">Clave de Acceso</label>
                                <div class="form-floating-icon">
                                    <i class="uil uil-padlock"></i>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button id="btn-login" type="button" class="btn btn-info w-100" type="button">Entrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COPY RIGHT -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="text-center p-4">
                            <h5 class="mb-0">© <script>
                                    document.write(new Date().getFullYear())
                                </script> Creado por Axley Herrera Vázquez</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            let session = '<?php echo $session; ?>';
            if (session == 'expired')
                showToast('error', 'Su sessión ha expirado!');

            $('#btn-login').on('click', function() {
                let result = checkRequiredValues('required');
                if (result == 0) {
                    $('#btn-login').attr('disabled', true);
                    let password = $('#txt-password').val();
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('Authentication/login'); ?>",
                        data: {
                            'password': password
                        },
                        dataType: "json",
                        success: function(response) {

                            if (response.error == 0)
                                window.location.href = '<?php echo base_url('TPV/dashboard'); ?>';
                            else if (response.error == 1) {
                                showToast('error', 'Clave de Acceso Incorrecta!');
                                $('#txt-password').addClass('is-invalid');
                                $('#btn-login').removeAttr('disabled');
                            }
                        },

                    });
                } else
                    showToast('error', 'Debe escribir su contraseña!');
            });
        });
    </script>