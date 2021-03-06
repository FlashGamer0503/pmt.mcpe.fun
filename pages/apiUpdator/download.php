<?php

global $ROOT_DIR;
$ROOT_DIR = implode(DIRECTORY_SEPARATOR, array_slice(explode(DIRECTORY_SEPARATOR, __DIR__), 0, count(explode(DIRECTORY_SEPARATOR, __DIR__)) - 2));

if(!isset($_GET["n"]) || !file_exists($ROOT_DIR . "/data/phars/" . $_GET["n"] . ".phar")) {
    header("Location: index.html");
    exit();
}

$plData = yaml_parse(file_get_contents("phar://" . $ROOT_DIR . "/data/phars/" . $_GET["n"] . ".phar/plugin.yml"));
$name = $plData["name"] . "_v" . $plData["version"];
header("Content-Type: application/phar");
header("Content-Disposition: filename=\"$name.phar\"");
echo file_get_contents($ROOT_DIR . "/data/phars/" . $_GET["n"] . ".phar");