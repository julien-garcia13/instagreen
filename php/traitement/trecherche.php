<?php
require_once('config.php');
$name = $_POST['name'];
$db = new bdd();
$data = $db->rechercheParID($name);
echo json_encode($data, JSON_INVALID_UTF8_IGNORE);
$data = json_decode(file_get_contents('../127_0_0_1.json'), true);
?>