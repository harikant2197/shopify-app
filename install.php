<?php
$shop = $_GET['shop'];
$domain = $_SERVER['SERVER_NAME'];

$api_key = "c77b4b6bb0dd22b0f12da16221b6f9b5";
$scopes = "read_orders,write_products";

$redirect_uri = "http://".$domain."/token_generator.php";

$install_url = "https://" . $shop . "/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($redirect_uri);

header("Location: " . $install_url);
die();