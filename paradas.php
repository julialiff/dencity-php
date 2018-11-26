<?php
function paradas($termosBusca, $cookie, $url) {

  $ch = curl_init();
  curl_setopt ($ch, CURLOPT_URL, $url . '/Parada/Buscar?termosBusca=' . $termosBusca);
  curl_setopt ($ch, CURLOPT_POST, false);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: 0'));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie);
  curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie);
  $response = curl_exec ($ch); // POR QUE TÁ PRINTANDO ESSA LINHA SEM EU MANDAR?
  curl_close ($ch);
  return $response;
}
?>
