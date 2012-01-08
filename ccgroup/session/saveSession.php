<?php
$page_name = $_GET['page_name'];
$gbTitle = $_GET['gbTitle'];
$gbImg = $_GET['gbImg'];
$gbUrl = $_GET['gbUrl'];
$address = $_GET['address'];


echo $page_name;
echo '<br />';
echo $keyword;

session_start();

$_SESSION['page_name'] = $page_name;
$_SESSION['gbTitle'] = $gbTitle;
$_SESSION['gbImg'] = $gbImg;
$_SESSION['gbUrl'] = $gbUrl;
$_SESSION['address'] = $address;
?>
