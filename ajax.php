<?php

// Load classes
include('config.php');
include('class/SimpleImage.class.php');
include('class/Functions.php');

if ($_GET['action'])
{
	switch ($_GET['action']) {
		case 'rotateMedium':
			rotateMedium($_GET['medium'], $_GET['degree']);
			break;
		
		case 'deleteMedium':
			deleteMedium($_GET['medium'], false);
			break;

		case 'importMedia':
			$ret = importMedia();
			echo ($ret ? $ret : 'No medium found.');
			break;

		default:
			# code...
			break;
	}
}