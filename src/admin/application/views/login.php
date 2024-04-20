<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>rCMS bejelentkezés</title>
        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="<?php echo VIEWS_URL; ?>css/sb-admin-2.min.css" rel="stylesheet">
    </head>
    <body class="bg-gradient-primary">
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">rCMS</h1>
                                        </div>
                                        <form class="user">
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user" id="username" aria-describedby="emailHelp" placeholder="E-mail cím">
                                                <small id="userNameHelp" class="form-text text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" id="password" placeholder="Jelszó">
                                                <small id="passwordHelp" class="form-text text-danger"></small>
                                            </div>
                                            <a onclick="login()" href="javascript:void(0);" class="btn btn-primary btn-user btn-block">
                                                Bejelentkezés
                                            </a>
                                            <div class="form-group row">
                                                <div class="col-sm-12 text-center">
                                                    <small id="errorMessage" class="form-text text-danger"></small>
                                                </div> 
                                            </div>
                                        </form>
<!--                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="<?php // echo FULL_BASE_URL . 'forgot-password'; ?>">Elfelejtetted a jelszavad?</a>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="<?php echo VIEWS_URL; ?>vendor/jquery/jquery.min.js"></script>
        <script src="<?php echo VIEWS_URL; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="<?php echo VIEWS_URL; ?>vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="<?php echo VIEWS_URL; ?>js/sb-admin-2.min.js"></script>

        <script>
            jQuery(document).ready(function () {

            });

            function login() {
                var data = {
                    username: jQuery("#username").val(),
                    password: jQuery("#password").val(),
                    system: 'oroszlangy'
                };
                //validation:
                if (data.username == null | data.username == '') {
                    jQuery("#userNameHelp").html('E-mail cím kitöltése kötelező!');
                    return;
                }
                //validation:
                if (data.password == null | data.password == '') {
                    jQuery("#passwordHelp").html('E-mail cím kitöltése kötelező!');
                    return;
                }
                jQuery.ajax({
                    url: "<?php echo AUTH_API_URL; ?>login",
                    type: "POST",
                    async: false,
                    dataType: 'json',
                    data: JSON.stringify(data),
                    contentType: 'application/json'
                }).done(function (response) {
                    if (response.errorCode == 0) {
                        window.location = '<?php echo FULL_BASE_URL; ?>';
                    } else {
                        jQuery("#errorMessage").html(response.msg);
                    }
                }).fail(function (response) {
                    console.log('error log : ', response);
                    if (response.responseJSON && response.responseJSON.message) {
                        jQuery("#errorMessage").html(response.responseJSON.message);
                    }
                });
            }
        </script>
        
    </body>

</html>
