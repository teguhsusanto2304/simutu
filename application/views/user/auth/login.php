<?php
    $cF =   $this->cF;

    $usernameOptions    =   [
        'id'    =>  'username',
        'name'  =>  'username',
        'placeholder'   =>  'Your Username or Email'
    ];
    $passwordOptions    =   [
        'id'    =>  'password',
        'name'  =>  'password',
        'type'  =>  'password',
        'placeholder'   =>  'Your Password',
        'trailingIcon'  =>  [
            'trailingIconIcon'      =>  'fa fa-eye visibility-password',
            'trailingIconOnClick'   =>  'togglePassword(this)'
        ]
    ];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | User (Mahasiswa dan Dosen)</title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?=base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="<?=base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?=base_url('assets/dist/css/adminlte.min.css')?>">
        
        <link rel="shortcut icon" href="<?=base_url('assets/img/magang-icon.png')?>" />
        <link rel="stylesheet" href="<?=base_url('assets/plugins/sweetalert2/sweetalert2.min.css')?>" />

        <style type="text/css">
            body{
                background-image: url(<?=base_url('assets/img/login-user-background.jpg')?>);
                background-size: cover;
                background-position: center bottom !important;
                background-attachment: fixed;
            }
            .login-overlay{
                position: absolute;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                background-color: rgba(0, 0, 0, 0.5);
            }
            .cp{
                cursor: pointer;
            }
        </style>
    </head>
    <body class="hold-transition login-page">
        <div class="login-overlay"></div>
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="<?=base_url('assets/')?>index2.html" class="h1"><b>Portal</b> Login</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">
                        Portal Login Mahasiswa dan Dosen
                    </p>
                    
                    <form id='formLogin'>
                        <div class="input-group mb-3">
                            <?=$this->cF->textField($usernameOptions, 'Username atau Email')?>
                        </div>
                        <div class="input-group mb-3">
                            <?=$this->cF->textField($passwordOptions, 'Password')?>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="social-auth-links text-center mt-2 mb-3">
                            <button class="btn btn-block btn-primary" type='submit'>
                                Sign In
                            </button>
                        </div>
                    </form>
                    <!-- /.social-auth-links -->

                    <p class="mb-1 text-center">
                        <a href="forgot-password.html">Lupa Password</a>
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="<?=base_url('assets/')?>plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="<?=base_url('assets/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?=base_url('assets/')?>dist/js/adminlte.min.js"></script>
        <script src="<?=base_url('assets/plugins/sweetalert2/sweetalert2.min.js')?>"></script>
    </body>
</html>
<script language='Javascript'>
    let _showPasswordState  =   false;
    function togglePassword(thisContext){
        let _el             =   $(thisContext);
        let _passwordEl     =   $('#password');

        let _class;
        if(_showPasswordState){
            _class          =   `fa fa-eye visibility-password`;
            _passwordEl.attr('type', 'password');   
        }else{
            _class  =   `fa fa-eye-slash visibility-password`;
            _passwordEl.attr('type', 'text');   
        }

        _el.find('.visibility-password').attr('class', _class);
        _showPasswordState  =   !_showPasswordState;
    }

    $('#formLogin').on('submit', function(e){
        e.preventDefault();
        let _dataLogin  =   $(this).serialize();
        
        $.ajax({
            url     :   '<?=site_url('auth/doLogin')?>',
            type    :   'POST',
            data    :   _dataLogin,
            success     :   function(rFS){
                let _statusLogin    =   rFS.statusLogin;

                let _htmlMessage, _type;
                if(_statusLogin){
                    _htmlMessage    =   `<span class='text-success'>Berhasil Login! Anda akan menuju halaman Dashboard!</span>`;
                    _type           =   `success`;
                }else{
                    let _message    =   rFS.message;
                    _htmlMessage    =   `<span class='text-danger'>${_message}</span>`;
                    _type           =   'error';
                }

                Swal.fire({
                    title   :   'Autentikasi User',
                    html    :   _htmlMessage,
                    icon    :   _type
                }).then(function(){
                    if(_statusLogin){
                        let _uSP        =   new URLSearchParams(location.search);
                        let _nextRoute  =   `<?=site_url()?>`;
                        if(_uSP.get('nextRoute') !== null){
                            _nextRoute  =   _uSP.get('nextRoute');
                        }

                        location.href   =   _nextRoute;
                    }
                });
            }
        });
    });
</script>