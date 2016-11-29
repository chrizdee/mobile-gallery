<?php 

// Load classes
include('config.php');
include('class/SimpleImage.class.php');
include('class/Template.class.php'); 
include('class/Functions.php');
include('class/Pagination.class.php');

// Detect language
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
if (file_exists('lang/lang.' . $lang . '.php'))
	include('lang/lang.' . $lang . '.php');
else
	include('lang/lang.en.php');

// Load template engine
$template = new Template(); 
$template->defaultPath = 'tpl/';

// Build gallery
$gallery = getGallery();
$template->assign('gallery', $gallery['list']);
$template->assign('total', $gallery['total']);
$template->assign('_L', $_L);
$template->assign('lang', $lang);

// Build pager
$nav = new Pagination($settings['imagesPerPage'], $gallery['total'], 6, 'page');
if ($_GET['admin']) $link = '/?admin=true&page=';
else $link = '/?page=';

$template->assign('numbers', $nav->numbers(' <li><a href="'.$link.'{nr}">{nr}</a></li> ', ' <li class="active"><span>{nr}</span></li> '));
$template->assign('previous', $nav->previous($link.'{nr}'));
$template->assign('next', $nav->next($link.'{nr}'));

$template->display('index.tpl.php'); 