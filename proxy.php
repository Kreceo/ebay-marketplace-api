<?php
$url = 'https://api.sandbox.ebay.com/buy/marketplace_insights/v1_beta/item_sales/search?q=iphone&category_ids=9355&limit=3&' . $_SERVER['REQUEST_URI'];
$api_key = '';

$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

// Add any necessary headers
curl_setopt( $ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $api_key",
    'X-EBAY-C-MARKETPLACE-ID: EBAY_US',
] );

$response = curl_exec( $ch );
$httpCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

// Set the appropriate headers and return the response
header( 'Content-Type: application/json' );
http_response_code( $httpCode );
echo $response;