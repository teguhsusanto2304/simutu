<script src="<?=base_url('assets/consult/js/vendor/jquery-1.12.4.min.js')?>"></script>
<script src="<?=base_url('assets/consult/js/vendor/modernizr-3.7.1.min.js')?>"></script>
<script src="<?=base_url('assets/consult/js/popper.min.js')?>"></script>
<script src="<?=base_url('assets/consult/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('assets/consult/js/slick.min.js')?>"></script>
<script src="<?=base_url('assets/consult/js/imagesloaded.pkgd.min.js')?>"></script>
<script src="<?=base_url('assets/consult/js/isotope.pkgd.min.js')?>"></script>
<script src="<?=base_url('assets/consult/js/waypoints.min.js')?>"></script>
<script src="<?=base_url('assets/consult/js/jquery.counterup.min.js')?>"></script>
<script src="<?=base_url('assets/consult/js/circles.min.js')?>"></script>
<script src="<?=base_url('assets/consult/js/jquery.appear.min.js')?>"></script>
<script src="<?=base_url('assets/consult/js/wow.min.js')?>"></script>
<script src="<?=base_url('assets/consult/js/headroom.min.js')?>"></script>
<script src="<?=base_url('assets/consult/js/jquery.nav.js')?>"></script>
<script src="<?=base_url('assets/consult/js/scrollIt.min.js')?>"></script>
<script src="<?=base_url('assets/consult/js/jquery.magnific-popup.min.js')?>"></script>
<script src="<?=base_url('assets/consult/js/main.js')?>"></script>

<?php 
    if(isset($morePackages)){
        if(is_array($morePackages)){
            if(array_key_exists('js', $morePackages)){
                $moreJS     =   $morePackages['js'];

                if(is_array($moreJS)){
                    foreach($moreJS as $js){
                        ?>
                            <script src='<?=$js?>'></script>
                        <?php
                    }
                }
            }
        }
    }
?>

<script language='Javascript'>
    $('[data-toggle=tooltip]').tooltip();
    
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