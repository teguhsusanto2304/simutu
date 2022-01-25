<?php 
	function adminViews($path = null){
		$adminViewsPath 	=	'admin';
		if(!is_null($path) && !empty($path)){
			$adminViewsPath 	=	$adminViewsPath.'/'.$path;
		}

		return $adminViewsPath;
	}
	function adminControllers($path = null){
		$adminControllersPath 	=	'admin';
		if(!is_null($path) && !empty($path)){
			$adminControllersPath 	=	$adminControllersPath.'/'.$path;
		}

		return $adminControllersPath;
	}
	function adminComponents($path = null){
		$adminComponentsPath 	=	'admin/components';
		if(!is_null($path) && !empty($path)){
			$adminComponentsPath 	=	$adminComponentsPath.'/'.$path;
		}

		return $adminComponentsPath;
	}
	function assetsImg($path = null){
		$assetsImgPath 	=	'assets/img';
		if(!is_null($path) && !empty($path)){
			$assetsImgPath 	=	$assetsImgPath.'/'.$path;
		}

		return $assetsImgPath;
	}
	function website($path = null){
		$websitePath 	=	'website';
		if(!is_null($path) && !empty($path)){
			$websitePath 	=	$websitePath.'/'.$path;
		}

		return $websitePath;
	}
	function landingPageAssets($path = null){
		$landingPageAssets 	=	'assets/landing-page/assets';
		if(!is_null($path) && !empty($path)){
			$landingPageAssets 	=	$landingPageAssets.'/'.$path;
		}

		return $landingPageAssets;
	}
?>