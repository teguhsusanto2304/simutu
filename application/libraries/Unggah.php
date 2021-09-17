<?php 
	class Unggah{
		public function configUnggah($uploadPath, $maxWidth, $maxHeight, $maxSize, $allowedTypes, $fileName){
			if(!file_exists($uploadPath)){
				mkdir($uploadPath);
			}

			$configUnggah['upload_path'] 	=	$uploadPath;	
			$configUnggah['max_width'] 		=	$maxWidth;
			$configUnggah['max_height'] 	=	$maxHeight;
			$configUnggah['max_size'] 		=	$maxSize;	
			$configUnggah['allowed_types'] 	=	$allowedTypes;		
			$configUnggah['file_name'] 		=	$fileName;	

			return $configUnggah;	
		}
		public function resizeImage($sourceImage, $destination, $desiredWidth, $desiredHeight){
			#dari mana mau ke mana dengan panjang berapa dan tinggi berapa dengan nama apa
			$destinationFolderArray 	=	explode('/', $destination);

			$destinationFolder 	=	'';

			$lastItemIndex	=	(count($destinationFolderArray) - 1);
			foreach($destinationFolderArray as $index => $item){
				if($index != $lastItemIndex){
					$slash 	=	($index < ($lastItemIndex - 1))? '/' : '';
					$destinationFolder 	.=	$item.$slash;
				}
			}

			if(!file_exists($destinationFolder)){
				mkdir($destinationFolder);
			}

			$sourceImageName	=	explode('/', $sourceImage);
			$sourceImageName	=	$sourceImageName[count($sourceImageName) - 1]; //mengambil nama file di indeks array terakhir

			$imageExtension 	=	explode('.', $sourceImageName);
			$imageExtension		=	strtolower($imageExtension[count($imageExtension) - 1]);

			list($originalWidth, $originalHeight)	=	getimagesize($sourceImage);

			$blankImage 	=	imagecreatetruecolor($desiredWidth, $desiredHeight);

			if($imageExtension === 'png'){
				$resource		=	imagecreatefrompng($sourceImage);
			}else{
				$resource 		=	imagecreatefromjpeg($sourceImage);
			}

			imagecopyresampled($blankImage, $resource, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $originalWidth, $originalHeight);

			if($imageExtension === 'png'){
				imagepng($blankImage, $destination);
			}else{
				imagejpeg($blankImage, $destination);
			}

			imagedestroy($blankImage);
			imagedestroy($resource);
		}
		public function getExtensionOfThisMimeType($mimeType){
			$arrayMimeType 	=	explode('/', $mimeType);

			return $arrayMimeType[count($arrayMimeType) - 1];
		}
	}
?>