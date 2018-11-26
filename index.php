<?php
header("Content-Type:application/json");

$token = "9cf92b800603de7a266f4400062d865a67ee64eeb4b968b01d608ffa7806b092";

$cookie = '/tmp/cookie.txt';
$url = 'http://api.olhovivo.sptrans.com.br/v2.1';

if(!empty($_GET['api'])) {
  $api = $_GET['api'];
  if(!empty($_GET['termosBusca'])) {
    $termosBusca=$_GET['termosBusca'];

    // Autenticação na SPTrans
    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_URL, $url . '/Login/Autenticar?token=' . $token);
    curl_setopt ($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: 0'));
    curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_exec ($ch);
    curl_close ($ch);

    switch ($api) {
      case 'PARADAS':
        // Busca por paradas naquele endereço
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url . '/Parada/Buscar?termosBusca=' . $termosBusca);
        curl_setopt ($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: 0'));
        curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie);
        curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie);
        $r = curl_exec ($ch); // POR QUE TÁ PRINTANDO ESSA LINHA SEM EU MANDAR?
        curl_close ($ch);
        // $json_response = json_encode($r);
        // $s =  str_split($json_response, 10);
        // echo $s[0];
        // $a = explode ("}", $json_response);
        // echo $a[1];
        // echo gettype($json_response[0]);
        // echo $response;
        break;

        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url . '/Linha/Buscar?termosBusca=' . $termosBusca);
        curl_setopt ($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: 0'));
        curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie);
        curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie);
        $result = curl_exec ($ch);
        curl_close ($ch);
        echo $result;

      default:
        response(400, "API a ser buscada é inválida", $api);
        break;
    }

    // return $result;
  }
  else {
    response(400, "Termos da Busca não definidos.",NULL);
  }
} else {
  response(400,"API a ser buscada não definida.",NULL);
}

function response($status,$status_message,$data) {
  header("HTTP/1.1 ".$status);

  $response['status']=$status;
  $response['status_message']=$status_message;
  $response['data']=$data;

  $json_response = json_encode($response);
  echo $json_response;
}
?>
