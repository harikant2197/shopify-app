<?php
require_once("inc/functions.php");
$requests = $_GET;
$hmac = $_GET['hmac'];
$serializeArray = serialize($requests);
$requests = array_diff_key($requests, array('hmac' => ''));
ksort($requests);

$token = "c77b4b6bb0dd22b0f12da16221b6f9b5";
$shop = "storesynapseindiadev.myshopify.com";            //no 'myshopify.com' or 'https'

$collectionList = shopify_call($token, $shop, "/admin/api/2019-07/custom_collections.json", array(), 'GET');
$collectionList = json_decode($collectionList['response'], JSON_PRETTY_PRINT);
$collection_id = $collectionList['custom_collections'][0]['id'];

$array = array("collection_id"=>$collection_id);
$collects = shopify_call($token, $shop, "/admin/api/2019-07/collects.json", $array, 'GET');
$collects = json_decode($collects['response'], JSON_PRETTY_PRINT);

foreach($collects as $collect){ 
    foreach($collect as $key => $value){ 
                $products = shopify_call($token, $shop, "/admin/api/2019-07/products/".$value['product_id'].".json", array(), 'GET');
		$products = json_decode($products['response'], JSON_PRETTY_PRINT);

    	$images = shopify_call($token, $shop, "/admin/api/2019-07/products/".$products['product']['id']."/images.json", array(), 'GET');
		$images = json_decode($images['response'], JSON_PRETTY_PRINT);
		$item_default_image = $images['images'][0]['src'];

		echo '<img src="'.$item_default_image.'" style="width: 200px; height: 230px;"/>';
    } 
}
