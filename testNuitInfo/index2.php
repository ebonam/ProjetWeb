<?php
include ('./httpful.phar');

$uri = "https://api.cdiscount.com/OpenApi/json/Search";
$api = "1187f984-ca43-4263-b389-ee75689542e7";

$toPost = array(
		"ApiKey" => $api,
		"SearchRequest" => array(
				"Keyword" => "tablette",
				"SortBy" => "relevance",
				"Pagination" => array(
						"ItemsPerPage" => 2,
						"PageNumber" => 0
				)
		),
		"Filters" => array(
				"Price" => array(
						"Min" => null,
						"Max" => null
				)
		),
		"Navigation" => "",
		"IncludeMarketPlace" => false,
		"Condition" => null
);


//echo json_encode($toPost) . "<br><br>";

$response = \Httpful\Request::put($uri)->sendsJson()->body(json_encode($toPost))->send();
//echo json_decode($response,true);
$arr = json_decode($response, true);
$ListArr=$arr["Products"];
//$ListArr["ProductURL"];
$produit=$ListArr[1];
echo $produit["name"]
//$numberPage = $produit ['PageCount'];

?>