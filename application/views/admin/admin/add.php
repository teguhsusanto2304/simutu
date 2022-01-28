<?php
    $cF     =   $this->cF;

    $dAS    =   ($detailAdminUser !== false);

    $firstNameParams    =   [
        'id'    =>  'firstName',
        'name'  =>  'firstName',
        'placeholder'   =>  'Nama depan'
    ];
    $lastNameParams    =   [
        'id'    =>  'lastNama',
        'name'  =>  'lastName',
        'placeholder'   =>  'Nama belakang'
    ];
    $frontTitleParams    =   [
        'id'    =>  'frontTitle',
        'name'  =>  'frontTitle',
        'placeholder'   =>  'gelar depan'
    ];
    $endTitleParams    =   [
        'id'    =>  'endTitle',
        'name'  =>  'endTitle',
        'placeholder'   =>  'gelar belakang'
    ];

    $genderParams    =   [
        'id'    =>  'gender',
        'name'  =>  'gender',
        'placeholder'   =>  'gender'
    ];
    $tanggalLahirParams    =   [
        'id'    =>  'tanggalLahir',
        'name'  =>  'tanggalLahir',
        'placeholder'   =>  'tanggal Lahir'
    ];

    $teleponParams    =   [
        'type'  =>  'number',
        'id'    =>  'telepon',
        'name'  =>  'telepon',
        'placeholder'   =>  'Example : 0812xxxxxxxx',
        'data'  =>  [
            ['name' => 'entity', 'value' => 'telepon'],
            ['name' => 'tabel', 'value' => $this->tabel->admin]
        ]
    ];

    $emailParams    =   [
        'type'  =>  'email',
        'id'    =>  'email',
        'name'  =>  'email',
        'placeholder'   =>  'Example : falentinodjoka2801@gmail.com',
        'data'  =>  [
            ['name' => 'entity', 'value' => 'email'],
            ['name' => 'tabel', 'value' => $this->tabel->admin]
        ]
    ];

    $usernameParams    =   [
        'type'  =>  'text',
        'id'    =>  'username',
        'name'  =>  'username',
        'placeholder'   =>  'Example : falentino_djoka28',
        'data'  =>  [
            ['name' => 'entity', 'value' => 'username'],
            ['name' => 'tabel', 'value' => $this->tabel->admin]
        ]
    ];


    if($detailAdminUser !== false){
        $firstNameParams['value']   =   $detailAdminUser['firstName'];
        $lastNameParams['value']   =   $detailAdminUser['lastName'];
        $teleponParams['value'] =   $detailAdminUser['telepon'];
        $emailParams['value']   =   $detailAdminUser['email'];
        $usernameParams['value']      =   $detailAdminUser['username'];
    }else{
        $passwordParams    =   [
            'type'  =>  'password',
            'id'    =>  'password',
            'name'  =>  'password',
            'trailingIcon'  =>  [
                'trailingIconIcon'      =>  'fa fa-eye visibility-password',
                'trailingIconOnClick'   =>  'togglePassword(this)'
            ]
        ];

        $passwordConfirmParams    =   [
            'type'  =>  'password',
            'id'    =>  'passwordConfirm',
            'name'  =>  'passwordConfirm',
            'trailingIcon'  =>  [
                'trailingIconIcon'      =>  'fa fa-eye visibility-password',
                'trailingIconOnClick'   =>  'togglePassword(this)'
            ]
        ];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  $pageTitle,
            'morePackages'  =>  [
                'css'   =>  [
                    base_url('assets/plugins/sweetalert2/sweetalert2.min.css')
                ]
            ]
        ];
        $this->load->view(adminComponents('head'), $headOptions); 
    ?>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <?php $this->load->view(adminComponents('preloader')); ?>            

            <?php $this->load->view(adminComponents('navbar')); ?>
            <?php $this->load->view(adminComponents('sidebar')); ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?php 
                    $contentHeaderOptions   =   ['pageName' => 'Administator'];
                    $this->load->view(adminComponents('content-header'), $contentHeaderOptions); 
                ?>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5><?=($detailAdminUser !== false)? 'Edit Administator' : 'Administator Baru'?></h5>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('admin'))?>">
                                                    <button class="btn btn-link btn-sm">List Administrator</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="formAdmin">
                                            <div class="row">
                                                <div class="col-lg-4 text-center">
                                                    <label for='adminImage'>
                                                        <img src="<?=base_url(($detailAdminUser !== false)? $path->uploadGambarAdmin.'/'.$detailAdminUser['imageProfile'] : 'assets/img/upload-icon.png')?>" alt="Gambar Admin" 
                                                            class='w-100 cp <?=($detailAdminUser !== false)? 'img-thumbnail' : ''?> ' data-toggle='tooltip'
                                                            data-placement='left' title='Klik Gambar untuk Memilih Gambar' id='imgPreview' />
                                                        <input type="file" id='adminImage' onChange='imgChanged(this)'
                                                            style='display:none;' name='adminImg' />
                                                    </label>
                                                    <span class="badge badge-warning">Ukuran yang disarankan 1920px x 1080px</span>
                                                </div>
                                                <div class="col-lg-8">
                                                    
                                                    <div class="row">
                                                        <div class='col-lg-6 form-group'>
                                                        <?=$cF->textField($firstNameParams, 'Nama Depan')?>
                                                        </div>
                                                        <div class='col-lg-6 form-group'>
                                                        <?=$cF->textField($lastNameParams, 'Nama Belakang')?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class='col-lg-6 form-group'>
                                                        <?=$cF->textField($frontTitleParams, 'gelar Depan')?>
                                                        </div>
                                                        <div class='col-lg-6 form-group'>
                                                        <?=$cF->textField($endTitleParams, 'gelar Belakang')?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class='col-lg-6 form-group'>
                                                        <?=$cF->textField($genderParams, 'Gender')?>
                                                        </div>
                                                        <div class='col-lg-6 form-group'>
                                                        <?=$cF->textField($tanggalLahirParams, 'Tanggal Lahir')?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class='col-lg-6 form-group'>
                                                        <?=$cF->textField($frontTitleParams, 'gelar Depan')?>
                                                        </div>
                                                        <div class='col-lg-6 form-group'>
                                                        <?=$cF->textField($endTitleParams, 'gelar Belakang')?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class='col-lg-6 form-group'>
                                                            <?=$cF->textField($teleponParams, 'Telepon')?>
                                                        </div>
                                                        <div class='col-lg-6 form-group'>
                                                            <?=$cF->textField($emailParams, 'Email')?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class='col-lg-<?=($detailAdminUser !== false)? '12' : '4'?> form-group'>
                                                            <?=$cF->textField($usernameParams, 'Username')?>
                                                        </div>
                                                        <?php if($detailAdminUser === false){ ?>
                                                                <div class='col-lg-4 form-group'>
                                                                    <?=$cF->textField($passwordParams, 'Password')?>
                                                                </div>
                                                                <div class='col-lg-4 form-group'>
                                                                    <?=$cF->textField($passwordConfirmParams, 'Password Confirm')?>
                                                                </div>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for='alamat'>Alamat Lengkap</label>
                                                        <textarea class="form-control" id='alamat'
                                                            name='alamat' placeholder='Alamat Lengkap'><?=($detailAdminUser !== false)? $detailAdminUser['alamat'] : ''?></textarea>
                                                    </div>
                                                    <hr class='mb-4' />
                                                    <button class="btn btn-success mr-1" type='submit'
                                                        id='btnSubmit'>Simpan <?=($detailAdminUser !== false)? 'Perubahan' : ''?> Data Admin</button>
                                                    <a href="<?=site_url(adminControllers('admin'))?>">
                                                        <button class="btn btn-default ml-1" type='button'>Back to List Administator</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- /.content-wrapper -->

            <?php $this->load->view(adminComponents('footer')); ?>
        </div>

        <?php 
            $jsOptions  =   [
                'morePackages'  =>  [
                    'js'    =>  [
                        base_url('assets/plugins/sweetalert2/sweetalert2.min.js'),
                        base_url('assets/plugins/myJS/delayKeyup.js')
                    ]
                ]
            ];
            $this->load->view(adminComponents('javascript'), $jsOptions); 
        ?>
    </body>
</html>
<script language='Javascript'>
    let baseURL             =   '<?=base_url()?>';

    let imgPreview  =   false;
    let imgData     =   false;

    let _dAS        =   `<?=$dAS?>`;
    _dAS            =   _dAS === 'true';    
    
    let idAdmin     =   '<?=($detailAdminUser !== false)? '/'.$detailAdminUser['id'] : ''?>';

    function imgChanged(thisContext){
        try{
            let el          =   $(thisContext);
            let _imgData     =   el.prop('files')[0];

            let fileReader  =   new FileReader();
            fileReader.readAsDataURL(_imgData);
            fileReader.onload   =   (e) =>  {
                let imgResult   =   e.target.result;
                imgPreview    =   imgResult;
                imgData       =   _imgData;

                $('#imgPreview').attr('src', imgPreview).addClass('img-thumbnail');
            }
        }catch(e){
            console.log(e);
        }
    }

    $('#formAdmin').on('submit', function(e){
        e.preventDefault();

        let _btnSubmit      =   $('#btnSubmit');
        let _btnSubmitText  =   _btnSubmit.text();
        
        _btnSubmit.prop('disabled', true).text('Processing ...');


        let _formData   =   new FormData();
        if(imgData !== false){
            _formData.append('img', imgData);
        }
        _formData.append('nama', $('#nama').val());
        _formData.append('telepon', $('#telepon').val());
        _formData.append('email', $('#email').val());
        _formData.append('username', $('#username').val());

        if(!_dAS){
            _formData.append('password', $('#password').val());
            _formData.append('passwordConfirm', $('#passwordConfirm').val());
        }
        
        _formData.append('alamat', $('#alamat').val());

        $.ajax({
            url     :   `<?=site_url(adminControllers('admin/process_save'))?>${idAdmin}`,
            type    :   'POST',
            data    :   _formData,
            processData :   false,
            contentType :   false,
            cache   :   false,
            success     :   function(_decodedRFS){
                _btnSubmit.prop('disabled', false).text(_btnSubmitText);

                let _statusSave     =   _decodedRFS.statusSave;

                let _swalType, _swalMessage;

                if(_statusSave){
                    _swalMessage    =   'Berhasil menyimpan data administrator!';
                    _swalType       =   'success';
                }else{
                    let _messageSave    =   _decodedRFS.messageSave;

                    _swalMessage    =   `Gagal menyimpan data administrator! ${_messageSave}`;
                    _swalType       =   'error';
                }

                Swal.fire({
                    title   :   'Administator',
                    html    :   _swalMessage,
                    icon    :   _swalType
                }).then(() => {
                    if(_statusSave){
                        location.href   =   `<?=site_url(adminControllers('admin'))?>`;
                    }
                });
            }
        });
    });

    $('#telepon, #email, #username').on('keyup', function(e){
        isValueExist(e.target);
    });

    let _showPasswordState  =   false;
    function togglePassword(thisContext){
        let _el             =   $(thisContext);
        let _passwordEl     =   $('#password, #passwordConfirm');

        let _class;
        if(_showPasswordState){
            _class          =   `fa fa-eye visibility-password`;
            _passwordEl.attr('type', 'password');   
        }else{
            _class  =   `fa fa-eye-slash visibility-password`;
            _passwordEl.attr('type', 'text');   
        }

        $('.visibility-password').attr('class', _class);
        _showPasswordState  =   !_showPasswordState;
    }

</script>