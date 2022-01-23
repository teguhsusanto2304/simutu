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
	function websiteComp($path = null){
		$websiteComponentsPath 	=	'website-components';
		if(!is_null($path) && !empty($path)){
			$websiteComponentsPath 	=	$websiteComponentsPath.'/'.$path;
		}

		return $websiteComponentsPath;
	}
	function userViews($path = null){
		$userViewsPath 	=	'user';
		if(!is_null($path) && !empty($path)){
			$userViewsPath 	=	$userViewsPath.'/'.$path;
		}

		return $userViewsPath;
	}
	function assetsImg($path = null){
		$assetsImgPath 	=	'assets/img';
		if(!is_null($path) && !empty($path)){
			$assetsImgPath 	=	$assetsImgPath.'/'.$path;
		}

		return $assetsImgPath;
	}
?>