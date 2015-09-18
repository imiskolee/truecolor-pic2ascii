<?php

$default_config = array(

		'level_show'	=> array(
			'※',
			'=',
			'≡',
			'+',
			'*',
			'-',
			" ",
		),

		'level_rank'	=> array(
			0,
			30,
			70,
			120,
			160,
			190,
			240,
			256

		)
);

$config = $default_config;

$file = $argv[1];

if(!is_string($file) || strlen($file) < 1){

	exit("no resource path.");
}

define('MAX_WIDTH',100);



list($width, $height, $type, $attr) = getimagesize($file);

switch($type){

	case 3 : {

		$resource = imagecreatefrompng($file);
	
	}break;

	default : {

		$resource = imagecreatefromjpeg($file);

	}

}

if($width > MAX_WIDTH){

	$scale = $width / MAX_WIDTH;

	$real_height = $height / $scale;

	$real_height = intval($real_height);

	$src = imagecreatetruecolor(MAX_WIDTH,$real_height);

	imagecopyresampled($src,$resource,0,0,0,0,MAX_WIDTH,$real_height,$width,$height);

	$resource = null;

	$resource = $src;

	$width = MAX_WIDTH;

	$height = $real_height;

}

$step_width = 1;

$scale = $width / $height;

$scale = $scale * 2;

$step_height = $step_width *2;


$w=$h=$iter_w=$iter_h = 0;

for($h=0;$h<$height;$h+= $step_height){

	for($w=0;$w<$width;$w+= $step_width){

		$rank = 0;

		for($m=0;$m<$step_height;$m++){

			for($n=0;$n<$step_width;$n++){
				
				$color = imagecolorat($resource,$w+$n,$h+$m);

				$color = imagecolorsforindex($resource,$color);

				$r = ($color['red'] * 0.299 + $color['green'] * 0.587  + $color['blue'] * 0.114);

				$rank += intval($r); 
							
			}
		}

		$r = $rank / ($step_width*$step_height);

		$level = 1;

		for($i=0;$i<count($config['level_rank'])-1;$i++){


			if($r >= $config['level_rank'][$i] && $r < $config['level_rank'][$i+1]){

				$level = $i;
			}

		}

		echo $config['level_show'][$level];
	}

	echo "\n";
}







