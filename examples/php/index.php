<?php
$API_KEY = 'YOUR_API_KEY';
$API_SECRET = 'YOUR_SECRET_KEY';
$PATH = 'https://exchange.bitexblock.com/api/private/wallets';
$METHOD = 'GET';
$BODY = '';

$SIGN_MESSAGE = $METHOD.$PATH.$BODY;
$SIGNED_MESSAGE = hash_hmac('SHA256', $SIGN_MESSAGE, $API_SECRET);

try {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $PATH);
    $apiKeyHeader = "API-KEY: ".$API_KEY;
    $signedMessageHeader = "ACCESS-SIGN: ".$SIGNED_MESSAGE;
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded' , $apiKeyHeader, $signedMessageHeader )); // Inject the token into the header
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $result = curl_exec($curl);
    curl_close($curl);

    print_r($result);
} catch (\Throwable $th) {
    print_r($th);
}

?>
