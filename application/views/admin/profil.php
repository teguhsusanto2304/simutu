<?php 
    $namaParams         =   ['id' => 'nama', 'name' => 'nama', 'placeholder' => 'Nama Lengkap', 'value' => $detailAdmin['nama']];
    $emailParams        =   ['id' => 'email', 'name' => 'email', 'placeholder' => 'Email', 'type' => 'email', 'value' => $detailAdmin['email']];
    $usernameParams     =   ['id' => 'username', 'name' => 'username', 'placeholder' => 'Username', 'value' => $detailAdmin['username']];
    $teleponParams      =   ['id' => 'telepon', 'name' => 'telepon', 'placeholder' => 'Nomor Telepon', 'type' => 'number', 'value' => $detailAdmin['telepon']];

    $passwordLamaParams             =   [
        'id'            =>  'passwordLama',
        'name'          =>  'passwordLama',
        'placeholder'   =>  'Password Lama',
        'type'          =>  'password',
        'trailingIcon'  =>  [
            'trailingIconIcon'      =>  'fa fa-eye',
            'trailingIconOnClick'   =>  "togglePassword(this, 'showPasswordLama')"
        ]
    ];
    $passwordBaruParams             =   [
        'id'            =>  'passwordBaru',
        'name'          =>  'passwordBaru',
        'placeholder'   =>  'Password Baru',
        'type'          =>  'password',
        'trailingIcon'  =>  [
            'trailingIconIcon'      =>  'fa fa-eye',
            'trailingIconOnClick'   =>  "togglePassword(this, 'showPasswordBaru')"
        ]
    ];
    $konfirmasiPasswordBaruParams   =   [
        'id'            =>  'konfirmasiPasswordBaru',
        'name'          =>  'konfirmasiPasswordBaru',
        'placeholder'   =>  'Konfirmasi Password Baru',
        'type'          =>  'password',
        'trailingIcon'  =>  [
            'trailingIconIcon'      =>  'fa fa-eye',
            'trailingIconOnClick'   =>  "togglePassword(this, 'showKonfirmasiPasswordBaru')"
        ]
    ];

    $uploadGambarAdmin  =   $this->path->uploadGambarAdmin;
?>
<!DOCTYPE html>
<html lang="en">
    <?php
        $cF =   $this->cF;

        $headOptions    =   [
            'pageTitle'     =>  'Profil',
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

            <div class="content-wrapper">
                <?php 
                    $contentHeaderOptions   =   ['pageName' => 'Profil'];
                    $this->load->view(adminComponents('content-header'), $contentHeaderOptions); 
                ?>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle" src="<?=base_url($uploadGambarAdmin.'/'.$detailAdmin['foto'])?>" 
                                                alt="<?=$detailAdmin['nama']?>" style='width:125px; height: 125px;' />
                                        </div>
                                        <h3 class="profile-username text-center"><?=$detailAdmin['nama']?></h3>
                                        <p class="text-muted text-center"><?=$detailAdmin['username']?></p>

                                        <hr />
                                        
                                        <h6>Email</h6>
                                        <p class="text-sm text-muted"><?=$detailAdmin['email']?></p>
                                        <h6>Telepon</h6>
                                        <p class="text-sm text-muted"><?=$detailAdmin['telepon']?></p>
                                        <h6>Alamat</h6>
                                        <p class="text-sm text-muted"><?=$detailAdmin['alamat']?></p>

                                        <hr />
                                        <h6>Bergabung pada</h6>
                                        <p class="text-sm text-muted"><?=date('D, d M Y H:i:s', strtotime($detailAdmin['createdAt']))?></p>
                                        <h6>Terakhir kali diupdate pada</h6>
                                        <p class="text-sm text-muted">
                                            <?php if(!is_null($detailAdmin['updatedAt'])){ ?>
                                                <?=date('D, d M Y H:i:s', strtotime($detailAdmin['updatedAt']))?>
                                            <?php }else{ ?>
                                                <i class='text-sm text-muted'>Belum pernah diupdate</i>
                                            <?php } ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item"><a class="nav-link active"
                                                href="#profil" data-toggle="tab">Profil</a></li>
                                            <li class="nav-item"><a class="nav-link"
                                                href="#gantiPassword" data-toggle="tab">Ganti Password</a></li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class='tab-pane active' id="profil">
                                                <form id="formProfil">
                                                    <div class="row">
                                                        <div class="col-lg-4 d-flex align-items-center">
                                                            <div class="d-block m-auto text-center">
                                                                <label for='adminImg'>
                                                                    <img src="<?=base_url($uploadGambarAdmin.'/'.$detailAdmin['foto'])?>" 
                                                                        alt="Foto User" id='adminImgPreview'
                                                                        class='w-100 cp' data-toggle='tooltip'
                                                                        data-placement='left' title='Klik Gambar untuk Memilih Gambar' />
                                                                    <input type="file" id='adminImg' onChange='adminImgChanged(this, event)'
                                                                        style='display:none;' name='adminImg' />
                                                                </label>
                                                                <h6>Foto</h6>
                                                                <span class="badge badge-warning">Foto <?=$detailAdmin['nama']?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="form-group">
                                                                <?=$cF->textField($namaParams, 'Nama Lengkap')?>
                                                            </div>
                                                            <div class="form-group">
                                                                <?=$cF->textField($usernameParams, 'Username')?>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-lg-6">
                                                                    <?=$cF->textField($emailParams, 'Email')?>
                                                                </div>
                                                                <div class="form-group col-lg-6">
                                                                    <?=$cF->textField($teleponParams, 'Telepon')?>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="alamat">Alamat Lengkap</label>
                                                                <textarea name="alamat" id="alamat" class='form-control'
                                                                    placeholder='Alamat Lengkap Kamu'><?=$detailAdmin['alamat']?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class='mb-4' />
                                                    <button class="btn btn-success mr-1" type='submit'
                                                        id='btnSubmitFormProfil'>Simpan Perubahan Data Saya</button>
                                                    <a href="<?=base_url(adminControllers())?>">
                                                        <button class="btn btn-default ml-1" type='button'>Halaman Utama</button>
                                                    </a>
                                                </form>
                                            </div>
                                            <div class='tab-pane' id="gantiPassword">
                                                <form id="formGantiPassword">
                                                    <div class="form-group">
                                                        <?=$cF->textField($passwordLamaParams, 'Password Lama')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?=$cF->textField($passwordBaruParams, 'Password Baru')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?=$cF->textField($konfirmasiPasswordBaruParams, 'Konfirmasi Password Baru')?>
                                                    </div>
                                                    <hr class='mb-4' />
                                                    <button class="btn btn-success mr-1" type='submit'
                                                        id='btnSubmitFormPassword'>Simpan Password Baru</button>
                                                    <a href="<?=base_url(adminControllers())?>">
                                                        <button class="btn btn-default ml-1" type='button'>Halaman Utama</button>
                                                    </a>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <?php $this->load->view(adminComponents('footer')); ?>
        </div>

        <?php 
            $jsOptions  =   [
                'morePackages'  =>  [
                    'js'    =>  [
                        base_url('assets/plugins/sweetalert2/sweetalert2.min.js')
                    ]
                ]
            ];
            $this->load->view(adminComponents('javascript'), $jsOptions); 
        ?>
    </body>
</html>
<script language='Javascript'>
    let adminImgPreview =   false;
    let adminImgData    =   false;

    window.showPasswordLamaState            =   false;
    window.showPasswordBaruState            =   false;
    window.showKonfirmasiPasswordBaruState  =   false;
    function togglePassword(thisContext, identifierString){
        let _el             =   $(thisContext);
        let _form           =   _el.parents('.input-parent').find('input');

        let _identifier     =   window[identifierString];
        if(_identifier){
            _class          =   `fa fa-eye trailing-icon`;
            _form.attr('type', 'password');   
        }else{
            _class  =   `fa fa-eye-slash trailing-icon`;
            _form.attr('type', 'text');   
        }

        _el.find('.trailing-icon').attr('class', _class);
        window[identifierString]  =   !_identifier;
    }
    
    function adminImgChanged(thisContext){
        let el          =   $(thisContext);
        let imgData     =   el.prop('files')[0];

        let fileReader  =   new FileReader();
        fileReader.readAsDataURL(imgData);
        fileReader.onload   =   (e) =>  {
            let imgResult   =   e.target.result;
            adminImgPreview    =   imgResult;
            adminImgData       =   imgData;

            $('#adminImgPreview').attr('src', adminImgPreview).addClass('img-thumbnail');
        }
    }

    $('#formProfil').on('submit', function(e){
        e.preventDefault();

        let _btnSubmit      =   $('#btnSubmitFormProfil');
        let _btnSubmitText  =   _btnSubmit.text();
        _btnSubmit.prop('disabled', true).text('Processing ...');   

        let _el     =   $(this);
        let _serializeArray     =   _el.serializeArray();  
        
        let _formData   =    new FormData();
        _formData.append('img', adminImgData);
        _serializeArray.forEach((item) => {
            _formData.append(item.name, item.value);
        });

        $.ajax({
            url     :   `<?=site_url(adminControllers('admin/process_saveProfil'))?>`,
            data    :   _formData,
            type    :   'POST',
            processData     :   false,
            contentType     :   false,
            cache   :   false,
            success :   (decodedRFS) => {
                _btnSubmit.prop('disabled', false).text(_btnSubmitText);  

                let _statusSave     =   decodedRFS.statusSave;
                let _action     =   'Memperbaharui';
                let _title      =   `${_action} Profil`;

                let _htmlMessage, _type, _onClick;
                if(_statusSave){
                    _htmlMessage    =   `<span class='text-success'>Berhasil <b>${_action} data profil!</b></span>`;
                    _type           =   'success';
                    _onClick        =   () => {location.reload()};
                }else{
                    let _messageSave    =   decodedRFS.messageSave;
                    _htmlMessage        =   `<span class='text-danger'><b>Gagal ${_action} profil! ${_messageSave}</b></span>`;
                    _type               =   'error';
                    _onClick            =   null;
                }

                notificationSwal(_title, _htmlMessage, _type, _onClick);
            }
        });
    });
    
    $('#formGantiPassword').on('submit', function(e){
        e.preventDefault();

        let _btnSubmit      =   $('#btnSubmitFormPassword');
        let _btnSubmitText  =   _btnSubmit.text();
        _btnSubmit.prop('disabled', true).text('Processing ...');   

        let _el     =   $(this);
        let _serializeArray     =   _el.serializeArray();  
        
        let _formData   =    new FormData();
        _serializeArray.forEach((item) => {
            _formData.append(item.name, item.value);
        });

        $.ajax({
            url     :   `<?=site_url(adminControllers('admin/process_gantiPassword'))?>`,
            data    :   _formData,
            type    :   'POST',
            processData     :   false,
            contentType     :   false,
            cache   :   false,
            success :   (decodedRFS) => {
                _btnSubmit.prop('disabled', false).text(_btnSubmitText);  

                let _statusGantiPassword     =   decodedRFS.statusGantiPassword;
                let _action     =   'Memperbaharui';
                let _title      =   `${_action} Password`;

                let _htmlMessage, _type, _onClick;
                if(_statusGantiPassword){
                    _htmlMessage    =   `<span class='text-success'>Berhasil <b>${_action} password!</b></span>`;
                    _type           =   'success';
                    _onClick        =   () => {location.reload()};
                }else{
                    let _messageGantiPassword    =   decodedRFS.messageGantiPassword;
                    _htmlMessage        =   `<span class='text-danger'><b>Gagal ${_action} password! ${_messageGantiPassword}</b></span>`;
                    _type               =   'error';
                    _onClick            =   null;
                }

                notificationSwal(_title, _htmlMessage, _type, _onClick);
            }
        });
    });
</script>
