<?php
header("Content-Type:application/json");

$chave_api = "9cf92b800603de7a266f4400062d865a67ee64eeb4b968b01d608ffa7806b092";

$cookie = '/tmp/cookie.txt';
$url = 'http://api.olhovivo.sptrans.com.br/v2.1';

if(!empty($_GET['api'])) {
  $api = $_GET['api'];
  if(!empty($_GET['termosBusca'])) {
    $termosBusca=$_GET['termosBusca'];

    // Login
    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_URL, $url . '/Login/Autenticar?token=' . $chave_api);
    curl_setopt ($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: 0'));
    curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie);
    print curl_exec ($ch);
    curl_close ($ch);

    // Busca
    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_URL, $url . '/Parada/Buscar?termosBusca=' . $termosBusca);
    curl_setopt ($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: 0'));
    curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie);
    $result = curl_exec ($ch);
    curl_close ($ch);

    echo $result;


    // return $result;
  }
  else {
    response(400, "Termos da Busca faltando.",NULL)
  }
} else {
  response(400,"Qual API faltando.",NULL)
}

function response($status,$status_message,$data)
{
  header("HTTP/1.1 ".$status);

  $response['status']=$status;
  $response['status_message']=$status_message;
  $response['data']=$data;

  $json_response = json_encode($response);
  echo $json_response;
}
?>
