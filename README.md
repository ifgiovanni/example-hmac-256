### Uso de API 

Ejemplo de consumo de API para conexión mediante autenticación de _API KEY_ y _HMAC 256_

Ejemplo en *PHP*

```php
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
```

Se obtiene como respuesta:

```json
{
   "success": true,
   "wallets": [
      {
         "balance": 0,
         "reserved": 0,
         "volume_buy": 0,
         "volume_sell": 0,
         "volume_withdraw": 0,
         "volume_deposit": 0,
         "id_coin": {
            "ticker": "XSR",
            "name": "Sucrecoin"
         },
         "updated_at": "2020-06-17T04:43:57.538Z",
         "address": "XJULJ5vgqLPiKXUakHCJWjevazX6HqbiTX"
      },
      {
         "balance": 0,
         "reserved": 0,
         "volume_buy": 0,
         "volume_sell": 0,
         "volume_withdraw": 0,
         "volume_deposit": 0,
         "id_coin": {
            "ticker": "BTC",
            "name": "Bitcoin"
         },
         "updated_at": "2020-06-17T04:43:57.537Z",
         "address": "3MSYFhHuDXewdr9WLu14gKZofCwe1BPhtt"
      }
   ]
}
```
> El contenido de la respuesta puede variar debido a que el API de Bitexblock está aún en desarrollo 
