<?php
    $baseURL    =   'http://localhost/tempequ/';
    // $baseURL    =   'https://tempequ.com/';
/*
 * CKFinder Configuration File
 *
 * For the official documentation visit https://ckeditor.com/docs/ckfinder/ckfinder3-php/
 */

/*============================ PHP Error Reporting ====================================*/
// https://ckeditor.com/docs/ckfinder/ckfinder3-php/debugging.html

// Production
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
ini_set('display_errors', 0);

// Development
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

/*============================ General Settings =======================================*/
// https://ckeditor.com/docs/ckfinder/ckfinder3-php/configuration.html

$ckFinderConfig = array();

/*============================ Enable PHP Connector HERE ==============================*/
// https://ckeditor.com/docs/ckfinder/ckfinder3-php/configuration.html#configuration_options_authentication

$ckFinderConfig['authentication'] = function () {
    return true;
};

/*============================ License Key ============================================*/
// https://ckeditor.com/docs/ckfinder/ckfinder3-php/configuration.html#configuration_options_licenseKey

$ckFinderConfig['licenseName'] = '';
$ckFinderConfig['licenseKey']  = '';

/*============================ CKFinder Internal Directory ============================*/
// https://ckeditor.com/docs/ckfinder/ckfinder3-php/configuration.html#configuration_options_privateDir

$ckFinderConfig['privateDir'] = array(
    'backend' => 'default',
    'tags'   => '.ckfinder/tags',
    'logs'   => '.ckfinder/logs',
    'cache'  => '.ckfinder/cache',
    'thumbs' => '.ckfinder/cache/thumbs',
);

/*============================ Images and Thumbnails ==================================*/
// https://ckeditor.com/docs/ckfinder/ckfinder3-php/configuration.html#configuration_options_images

$ckFinderConfig['images'] = array(
    'maxWidth'  => 1600,
    'maxHeight' => 1200,
    'quality'   => 80,
    'sizes' => array(
        'small'  => array('width' => 480, 'height' => 320, 'quality' => 80),
        'medium' => array('width' => 600, 'height' => 480, 'quality' => 80),
        'large'  => array('width' => 800, 'height' => 600, 'quality' => 80)
    )
);

/*=================================== Backends ========================================*/
// https://ckeditor.com/docs/ckfinder/ckfinder3-php/configuration.html#configuration_options_backends

$ckFinderConfig['backends'][] = array(
    'name'                  =>  'default',
    'adapter'               =>  'local',
    'baseUrl'               =>  $baseURL.'upload/gambar/blog/temporary-content/',
    // 'root'                  =>  '',
    'chmodFiles'            =>  0777,
    'chmodFolders'          =>  0755,
    'filesystemEncoding'    =>  'UTF-8',
);

/*================================ Resource Types =====================================*/
// https://ckeditor.com/docs/ckfinder/ckfinder3-php/configuration.html#configuration_options_resourceTypes

$ckFinderConfig['defaultResourceTypes'] = '';

$ckFinderConfig['resourceTypes'][] = array(
    'name'              =>  'Files',
    'directory'         =>  'files',
    'maxSize'           =>  0,
    'allowedExtensions' =>  '7z,aiff,asf,avi,bmp,csv,doc,docx,fla,flv,gif,gz,gzip,jpeg,jpg,mid,mov,mp3,mp4,mpc,mpeg,mpg,ods,odt,pdf,png,ppt,pptx,qt,ram,rar,rm,rmi,rmvb,rtf,sdc,swf,sxc,sxw,tar,tgz,tif,tiff,txt,vsd,wav,wma,wmv,xls,xlsx,zip',
    'deniedExtensions'  =>  '',
    'backend'           =>  'default'
);

$ckFinderConfig['resourceTypes'][] = array(
    'name'              =>  'Images',
    'directory'         =>  '',
    'maxSize'           =>  0,
    'allowedExtensions' =>  'bmp,gif,jpeg,jpg,png',
    'deniedExtensions'  =>  '',
    'backend'           =>  'default'
);

/*================================ Access Control =====================================*/
// https://ckeditor.com/docs/ckfinder/ckfinder3-php/configuration.html#configuration_options_roleSessionVar

$ckFinderConfig['roleSessionVar'] = 'CKFinder_UserRole';

// https://ckeditor.com/docs/ckfinder/ckfinder3-php/configuration.html#configuration_options_accessControl
$ckFinderConfig['accessControl'][] = array(
    'role'                =>    '*',
    'resourceType'        =>    '*',
    'folder'              =>    '/',

    'FOLDER_VIEW'         =>    true,
    'FOLDER_CREATE'       =>    true,
    'FOLDER_RENAME'       =>    true,
    'FOLDER_DELETE'       =>    true,

    'FILE_VIEW'           =>    true,
    'FILE_CREATE'         =>    true,
    'FILE_RENAME'         =>    true,
    'FILE_DELETE'         =>    true,

    'IMAGE_RESIZE'        =>    true,
    'IMAGE_RESIZE_CUSTOM' =>    true
);


/*================================ Other Settings =====================================*/
// https://ckeditor.com/docs/ckfinder/ckfinder3-php/configuration.html

$ckFinderConfig['overwriteOnUpload'] = false;
$ckFinderConfig['checkDoubleExtension'] = true;
$ckFinderConfig['disallowUnsafeCharacters'] = false;
$ckFinderConfig['secureImageUploads'] = true;
$ckFinderConfig['checkSizeAfterScaling'] = true;
$ckFinderConfig['htmlExtensions'] = array('html', 'htm', 'xml', 'js');
$ckFinderConfig['hideFolders'] = array('.*', 'CVS', '__thumbs');
$ckFinderConfig['hideFiles'] = array('.*');
$ckFinderConfig['forceAscii'] = false;
$ckFinderConfig['xSendfile'] = false;

// https://ckeditor.com/docs/ckfinder/ckfinder3-php/configuration.html#configuration_options_debug
$ckFinderConfig['debug'] = false;

/*==================================== Plugins ========================================*/
// https://ckeditor.com/docs/ckfinder/ckfinder3-php/configuration.html#configuration_options_plugins

$ckFinderConfig['pluginsDirectory'] = __DIR__ . '/plugins';
$ckFinderConfig['plugins'] = array();

/*================================ Cache settings =====================================*/
// https://ckeditor.com/docs/ckfinder/ckfinder3-php/configuration.html#configuration_options_cache

$ckFinderConfig['cache'] = array(
    'imagePreview' => 24 * 3600,
    'thumbnails'   => 24 * 3600 * 365,
    'proxyCommand' => 0
);

/*============================ Temp Directory settings ================================*/
// https://ckeditor.com/docs/ckfinder/ckfinder3-php/configuration.html#configuration_options_tempDirectory

$ckFinderConfig['tempDirectory'] = sys_get_temp_dir();

/*============================ Session Cause Performance Issues =======================*/
// https://ckeditor.com/docs/ckfinder/ckfinder3-php/configuration.html#configuration_options_sessionWriteClose

$ckFinderConfig['sessionWriteClose'] = true;

/*================================= CSRF protection ===================================*/
// https://ckeditor.com/docs/ckfinder/ckfinder3-php/configuration.html#configuration_options_csrfProtection

$ckFinderConfig['csrfProtection'] = true;

/*===================================== Headers =======================================*/
// https://ckeditor.com/docs/ckfinder/ckfinder3-php/configuration.html#configuration_options_headers

$ckFinderConfig['headers'] = array();

/*============================== End of Configuration =================================*/

// Config must be returned - do not change it.
return $ckFinderConfig;
