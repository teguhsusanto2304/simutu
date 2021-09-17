<script src="<?=base_url('assets/')?>plugins/jquery/jquery.min.js"></script>
<script src="<?=base_url('assets/')?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script language='Javascript'>
    $.widget.bridge('uibutton', $.ui.button);
    
    async function confirmSwal(title, htmlMessage){
        let _swal   =   await Swal.fire({
            title   :   title,
            html    :   htmlMessage,
            icon    :   'question',
            showCancelButton    :   true,
            cancelButtonText    :   'Batal',
            showConfirmButton   :   true,
            confirmButtonText   :   'Ya, Lanjutkan!',
            focusCancel         :   true
        });

        return _swal.isConfirmed;
    }

    function notificationSwal(title, html, icon, onClick){
        Swal.fire({
            title   :   title,
            html    :   html,
            icon    :   icon
        }).then(() => {
            if(onClick !== null){
                onClick();
            }
        });
    }
</script>
<script src="<?=base_url('assets/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url('assets/')?>dist/js/adminlte.js"></script>
<?php 
    if(isset($morePackages)){
        if(is_array($morePackages)){
            if(array_key_exists('js', $morePackages)){
                $moreJSPackages    =   $morePackages['js'];

                if(count($moreJSPackages) >= 1){
                    foreach($moreJSPackages as $moreJS){
                        ?>    
                            <script src="<?=$moreJS?>"></script>
                        <?php
                    }
                }
            }
        }
    }
?>
