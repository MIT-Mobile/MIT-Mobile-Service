<?php

/*
 * a client makes a request to this page
 * by asking for the parameters it wants returned
 * parameters: 
 * - type of page to be shown (webkit, large touch screen, basic)
 * - platform (iphone, android, webos, windows, blackberry, smartphone, feature phone, computer, spider)
 * - whether device's browser supports ssl certificates
 * - name (and modification date) of stylesheet to apply to html pages
 * 
 * request should include user agent (UA) string
 * if UA is not given, the UA of the requesting client is used
 * if the requesting client does not have a UA, default values are returned
 */
$docRoot = getenv("DOCUMENT_ROOT");

require_once $docRoot . "/mobi-config/mobi_service_config.php";
require_once SERVICEROOT . "/device_data.php";
require_once SERVICEROOT . "/Classifier.php";

if (!$ua = $_GET['ua']) {
  $ua = $_SERVER['HTTP_USER_AGENT'];
}

if ($action = $_GET['action']) {
  $result = Array();
  $pt = 'Basic';
  $plat = 'featurephone';
  switch ($action) {
  case 'classify':
    $classification = Classifier::uaClassify($ua);
    $result = Array(
       'pagetype' => $classification['pagetype'],
       'platform' => $classification['platform'],
       'certs' => $classification['certs']
       );
    break;
  case 'attributes':
    if((isset($_GET['pagetype']))  &&  strlen($_GET['pagetype']) > 1) {
      $pt =  $_GET['pagetype'];
    }
    if((isset($_GET['platform']))  &&  strlen($_GET['platform']) > 1) {
      $plat =  $_GET['platform'];
    }
    $table = ${'mobi_service_' . $pt};
    $platform = $plat;
    $result = $table[$plat];
    $result['platform'] = $plat;
    $last_modified = filemtime(SERVICEROOT . '/device_data.php');
    $result['last_modified'] = date('Y-m-d H:i:s', $last_modified);
    break;
  case 'platforms':
    $result = $mobi_service_platforms;
    break;
  case 'debug':
    $result = Classifier::uaClassify($ua);
    $result['ua'] = $ua;
  }

  echo json_encode($result);
}

?>
