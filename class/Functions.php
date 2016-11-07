<?php

function getGallery()
{
	global $settings;

	foreach (new DirectoryIterator($settings['mediaDir'] . 'src') as $file)
	{
		if ($file->isDot())
			continue;

		$files[] = $file->getFilename();
	}

	arsort($files);
	$total = count($files);

	$files = new ArrayIterator($files);
	$start = ($_GET['page'] > 0 ? $_GET['page']-1 : 0);
	$paginated = new LimitIterator($files, $start * $settings['imagesPerPage'], $settings['imagesPerPage']);

    foreach ($paginated as $file) 
    {
    	$images[] = array(
            'name' => $file,
			'big' => getMedium($file, 'big'),
			'small' => getMedium($file, 'small'),
			'src' => $settings['mediaDir'].'src/'.$file,
			'type' => substr($file, -3)
		);

    }


	return array(
		'list' => $images,
		'total' => $total
	);
}

function getMedium($medium, $format = 'small')
{
	global $settings;

	$targetMedium = $settings['mediaDir'].$format.'/'.$medium;

	if (substr($medium, -3) != 'mp4')
	{
		if (!file_exists($targetMedium))
		{
			try {
			    $img = new abeautifulsite\SimpleImage($settings['mediaDir'].'src/'.$medium);
			    
			    switch ($format) {
			    	case 'big':
			    		$img->auto_orient()->fit_to_width(1080)->save($targetMedium, 90);
			    		break;
			    	
			    	default:
			    		$img->auto_orient()->fit_to_height(460)->save($targetMedium, 90);
			    		break;
			    }
			    
			} catch(Exception $e) {
			    echo 'Error: ' . $e->getMessage();
			}
		}
	}

	return $targetMedium;
}

function importMedia()
{
	global $settings;

	$media_path = $settings['mediaDir'];
	$i = 1;
	$message = '';

	$dir = openDir($settings['importDir']);
	while ($file = readDir($dir)) 
	{
		if ($file != "." && $file != ".." && $file != ".ftpquota") 
		{
			$src_image = $settings['importDir'].$file;
			$dest_image = $media_path.'src/'.date('Ymd', filemtime($src_image)).'-IMG_'.time().'-'.$i++.'.jpg';

		    if (copy($src_image, $dest_image)) 
		    {
				unlink($src_image);
			}

		    $message .= $file.': imported ('.$dest_image.')<br />';			
		}
	}
	return $message;
}

function deleteMedium($medium, $onlyVersions = true)
{
	global $settings;
	
	$src_image = $settings['mediaDir'].'src/'.$medium;
	$big_image = $settings['mediaDir'].'big/'.$medium;
	$small_image = $settings['mediaDir'].'small/'.$medium;

	if (file_exists($big_image)) unlink($big_image);
	if (file_exists($small_image)) unlink($small_image);
	if (file_exists($src_image) && $onlyVersions == false) unlink($src_image);
}

function rotateMedium($medium, $degree = 90)
{
	global $settings;

	$src_image = $settings['mediaDir'].'src/'.$medium;

	try {
	    $img = new abeautifulsite\SimpleImage($src_image);
	    $img->rotate($degree)->save($src_image);
	    deleteMedium($medium);
	} catch(Exception $e) {
	    echo 'Error: ' . $e->getMessage();
	}
}