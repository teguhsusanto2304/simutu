<?php 
    $usernameOptions    =   [
        'id'    =>  'usernameOrEmail',
        'name'  =>  'usernameOrEmail',
        'placeholder'   =>  'Your Username or Email'
    ];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Administrator</title>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?=base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="<?=base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?=base_url('assets/dist/css/adminlte.min.css')?>">
        <link rel="shortcut icon" href="<?=base_url('assets/img/icon.png')?>" />

        <link rel="stylesheet" href="<?=base_url('assets/plugins/sweetalert2/sweetalert2.min.css')?>" />

        <style type="text/css">
            body{
                position: relative;
                background-image: url(<?=base_url('assets/img/login-admin-background.jpg')?>);
                background-size: cover;
                background-position: center bottom;
                background-attachment: fixed;
            }
            .login-overlay{
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                background-color: rgba(0, 0, 0, 0.3);
            }
            .cp{
                cursor: pointer;
            }
        </style>
    </head>
    <body class="hold-transition login-page">
        <div class="login-overlay"></div>
        <div class="login-box">
             <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="<?=base_url('assets/')?>index2.html" class="h1">
                        Lupa Password
                    </a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">
                        <img src="<?=base_url('assets/img/icon.png')?>" alt="SIMUTU"
                            style='width:100px;' />
                    </p>
                    <form id='formLupaPassword'>
                        <div class="input-group mb-3">
                            <?=$this->cF->textField($usernameOptions, 'Username atau Email')?>
                        </div>
                        <div class="social-auth-links text-center mt-2 mb-3">
                            <button class="btn btn-block btn-primary" type='submit' id='btnSubmit'>
                                Recovery Password
                            </button>
                        </div>
                    </form>

                    <p class="mb-1 text-center">
                        <a href="<?=site_url(adminControllers('auth/login'))?>">Login</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="<?=base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
        <!-- Bootstrap 4 -->
        <script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
        <!-- AdminLTE App -->
        <script src="<?=base_url('assets/dist/js/adminlte.min.js')?>"></script>
        
        <script src="<?=base_url('assets/plugins/sweetalert2/sweetalert2.min.js')?>"></script>
    </body>
</html>
<script language='Javascript'>
    $('#formLupaPassword').on('submit', function(e){
        e.preventDefault();
        let _dataForm   =   $(this).serialize();

        let _btnSubmit      =   $('#btnSubmit');
        let _btnSubmitText  =   _btnSubmit.text();

        _btnSubmit.prop('disabled', true).text('Processing ...');
        
        $.ajax({
            url     :   '<?=site_url(adminControllers('auth/process_recoveryPassword'))?>',
            type    :   'POST',
            data    :   _dataForm,
            success     :   function(rFS){
                _btnSubmit.prop('disabled', false).text(_btnSubmitText);

                let _status    =   rFS.status;

                let _htmlMessage, _type;
                if(_status){
                    _htmlMessage    =   `<span class='text-success'>Berhasil Recovery Password! Silahkan cek email anda untuk dapatkan password baru untuk login!</span>`;
                    _type           =   `success`;
                }else{
                    let _message    =   rFS.message;
                    _htmlMessage    =   `<span class='text-danger'>Gagal merecovery password! ${_message}</span>`;
                    _type           =   'error';
                }

                Swal.fire({
                    title   :   'Lupa Password',
                    html    :   _htmlMessage,
                    icon    :   _type
                }).then(function(){
                    if(_status){
                        let _uSP        =   new URLSearchParams(location.search);
                        let _nextRoute  =   `<?=site_url(adminControllers())?>`;
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