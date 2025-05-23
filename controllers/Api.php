<?php
//https://docs.apiperu.dev/enpoints/consulta-dni  

if (isset($_GET['op'])){
    if($_GET['op'] == 'consultaDNI'){
      // Datos
      $token = 'apis-token-2947.deXbJQdXSqW84R7Yzu115SChksjWeeoI';
      $documento = $_GET["documento"];

      // Iniciar llamada a API
      $curl = curl_init();

      // Buscar dni
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero=' . $documento,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 2,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'Referer: https://apis.net.pe/consulta-dni-api',
          'Authorization: Bearer ' . $token
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      // Datos listos para usar
      echo $response;

    }

    if($_GET['op'] == 'consultaRUC'){
      $token = 'apis-token-2947.deXbJQdXSqW84R7Yzu115SChksjWeeoI';
      $documento = $_GET['documento'];

      // Iniciar llamada a API
      $curl = curl_init();

      // Buscar ruc sunat
      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.apis.net.pe/v1/ruc?numero=' . $documento,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
          'Referer: http://apis.net.pe/api-ruc',
          'Authorization: Bearer ' . $token
      ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      echo $response;
  }
}


?>