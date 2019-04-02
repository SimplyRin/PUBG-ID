<?php
require_once(__DIR__ . '/NameTools.php');
$instance = new NameTools();

print($instance->getIdFromName($_GET['name']));
?>
