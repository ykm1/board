<?php
require_once 'controller.php';
$bController = new BoardController($_GET['action']);
$bController->run();
exit;
?>