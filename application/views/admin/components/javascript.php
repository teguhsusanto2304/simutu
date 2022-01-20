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
    
    let ckEditorToolbars  =   [
        'selectAll', 'undo', 'redo', 'bold', 'italic', 'blockQuote', 'link', 'ckfinder', 'uploadImage', 'imageUpload',
        'heading', 'imageTextAlternative', 'toggleImageCaption', 'imageStyle:inline', 'imageStyle:alignLeft',
        'imageStyle:alignRight', 'imageStyle:alignCenter', 'imageStyle:alignBlockLeft', 'imageStyle:alignBlockRight',
        'imageStyle:block', 'imageStyle:side', 'imageStyle:wrapText', 'imageStyle:breakText', 'indent', 'outdent', 'numberedList',
        'bulletedList', 'mediaEmbed', 'insertTable', 'tableColumn', 'tableRow', 'mergeTableCells'
    ];

    let ckEditorToolbarsCustomBuild     =   [
        'heading', 'alignment', 'undo', 'redo',
        'blockQuote', 'bold', 'italic', 'code', 'codeBlock', 'selectAll', 'findAndReplace', 'fontBackgroundColor', 'fontColor',
        'fontFamily', 'fontSize', '-', 'highlight', 'removeHighlight', 'horizontalLine',
        'htmlEmbed', 'imageTextAlternative', 'toggleImageCaption', 'imageInsert',
        'resizeImage',
        'imageStyle:inline', 'imageStyle:alignLeft', 'imageStyle:alignRight', 'imageStyle:alignCenter', 'imageStyle:alignBlockLeft',
        'imageStyle:alignBlockRight', 'imageStyle:block', 'imageStyle:side', 'imageStyle:wrapText', 'imageStyle:breakText', 'indent',
        'outdent','link', 'linkImage', 'numberedList', 'bulletedList', 'mediaEmbed', 'pageBreak', 'removeFormat',
        'strikethrough', 'subscript', 'superscript', 'insertTable', 'tableColumn', 'tableRow', 'mergeTableCells', 'toggleTableCaption',
        'tableCellProperties', 'tableProperties', 'textPartLanguage', 'todoList', 'underline'
    ];

    function isValueExist(thisContext){
        let _el     =   $(thisContext);

        let _tabel      =   _el.data('tabel');
        let _entity     =   _el.data('entity');
        let _value      =   _el.val();

        _el.removeClass('border-danger');

        delay(() => {
            $.ajax({
                url     :   `<?=site_url(adminControllers('other/isValueExist'))?>`,
                data    :   {entity : _entity, value : _value, tabel : _tabel},
                success :   function(decodedRFS){
                    let _isExist     =   decodedRFS.isExist;
                    if(_isExist){
                        _el.val('');
                        _el.addClass('border-danger');

                        alert('Data sudah ada! gunakan data lain!');
                    }
                }
            })
        }, 650);
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
