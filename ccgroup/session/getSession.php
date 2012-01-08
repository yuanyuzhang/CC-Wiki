<?php

session_start();

$page_name = $_SESSION['page_name'];
$gbTitle = $_SESSION['gbTitle'];
$gbImg = $_SESSION['gbImg'];
$gbUrl = $_SESSION['gbUrl'];
$address = $_SESSION['address'];

echo '<session><page_name>'.$page_name.'</page_name><gbTitle>'.$gbTitle.'</gbTitle><gbImg>'.$gbImg.'</gbImg><gbUrl>'.$gbUrl.'</gbUrl><address>'.$address.'</address></session>';
?>
