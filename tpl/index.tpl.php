<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>mobileGallery</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="js/vendor/jquery.fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen">
        <link rel="stylesheet" href="js/vendor/jquery.mediaelement/mediaelementplayer.css" type="text/css" media="screen">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.php/style.scss">

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div id="sys_message_overlay">
            <div class="message"><?= $sysMessage ?></div>
        </div>

        <header>
            <h1>mobileGallery</h1>
            <div class="stats"><?= $total ?> images found</div>
            <?php if ($_GET['admin'] == 'true'): ?>
            <nav>
                <ul>
                    <li><a href="javascript:importMedia();"><i class="fa fa-upload"></i> Import</a></li>
                </ul>
            </nav>
            <?php endif ?>
        </header>

        <div class="main-container">
            <div class="main wrapper clearfix">
                <div class="gallery">
                    <?php foreach($gallery as $medium): $i++; ?>

                    <?php 
                    $date = substr($medium['name'], 0, 8);
                    $year = substr($medium['name'], 0, 4);
                    $month = substr($medium['name'], 4, 2);
                    $day = substr($medium['name'], 6, 2);

                    if ($date != $lastDate): $lastDate = $date; ?>
                    <div class="box date">
                        <div class="inner">
                            <h3><?= $day.'.'.$month.'.'.$year ?></h3>
                        </div>
                    </div>
                    <?php endif ?>
                    
                    <?php if ($medium['type'] == 'mp4'): ?>

                    <video class="box" id="player_<?= $i ?>" src="<?= $medium['src'] ?>" type="video/mp4" controls="controls"></video>

                    <?php else: ?>

                    <div class="box image" id="img<?= $i ?>">
                        <a href="<?= $medium['big'] ?>" rel="group" class="fancybox"><img src="<?= $medium['small'] ?>"></a>
                        <?php if ($_GET['admin'] == 'true'): ?>
                        <nav class="functions">
                            <ul>
                                <li><a href="javascript:rotateMedium('<?= $medium['name'] ?>', -90);"><i class="fa fa-rotate-left"></i></a></li>
                                <li><a href="javascript:rotateMedium('<?= $medium['name'] ?>', 90);"><i class="fa fa-rotate-right"></i></a></li>
                                <li><a href="#modalDeleteMedium" rel="leanModal" onclick="actMedium='<?= $medium['name'] ?>'; actMediumId='img<?= $i ?>'"><i class="fa fa-remove"></i></a></li>
                            </ul>
                        </nav>
                        <?php endif ?>
                    </div>

                    <?php endif ?>

                    <?php endforeach ?>
                </div>
            </div>
        </div>

        <footer>
            <nav>
                <ul>
                    <li><a href="<?= $previous ?>" class="previous"><i class="fa fa-chevron-left"></i> Previous</a></li>
                    <li><a href="<?= $next ?>" class="next">Next <i class="fa fa-chevron-right"></i></a></li>
                </ul>
            </nav>
        </footer>

        <?php if ($_GET['admin'] == 'true'): ?>
        <div id="modalDeleteMedium" class="modal">
            <h3>Sure, you want to delete this medium?</h3>
            <p><a href="javascript:deleteMedium(actMedium, actMediumId);" class="btn modal_close"><i class="fa fa-trash"></i> Yes, delete</a></p>
        </div>
        <?php endif ?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
        <script type="text/javascript" src="js/vendor/jquery.fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
        <script type="text/javascript" src="js/vendor/jquery.leanModal.min.js"></script>
        <script type="text/javascript" src="js/vendor/jquery.mediaelement/mediaelement-and-player.min.js"></script>
        <script src="js/main.js"></script>

        
        <?php if ($sysMessage): ?>
        <script>
        $(document).ready(function() {
            $('#sys_message_overlay').fadeIn('fast');
        });
        </script>
        <?php endif ?>
        

    </body>
</html>
