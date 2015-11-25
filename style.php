<?php
$directory = "scss";

require "class/scss.class.php";
scss_server::serveFrom($directory);