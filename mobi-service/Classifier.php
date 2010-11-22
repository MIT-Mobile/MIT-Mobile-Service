<?php

class Classifier {

  private static $default_classification = 'featurephone,Basic,default';
  private static $default_pagetype = "Basic";
  private static $default_platform = "featurephone";
  private static $default_certs = "0";

  public static $platforms = Array();

  /* 
   * takes user agent string as param 
   * returns page type, platform, cert support, delta id
   * if no patterns are matched, returns {Basic, featurephone, 0}
   */
  public static function uaClassify($ua) {
    global $mobi_service_whitelist_fields;
    global $mobi_service_whitelist;

    $pattern_index = array_search('pattern', $mobi_service_whitelist_fields);
    $pagetype_index = array_search('pagetype', $mobi_service_whitelist_fields);
    $platform_index = array_search('platform', $mobi_service_whitelist_fields);
    $certs_index = array_search('certs', $mobi_service_whitelist_fields);
    $desc_index = array_search('description', $mobi_service_whitelist_fields);

    foreach ($mobi_service_whitelist as $row) {
      
      $pattern = $row[ $pattern_index ];
      if (strpos($pattern, '/') === 0) {
	if (preg_match($pattern, $ua)) {
          $platform = $row[ $platform_index ];
          $certs = $row[ $certs_index ];
          if (($platform == null) || (strlen($platform) == 0))
          {
              $platform = self::$default_platform;
              $certs = self::$default_certs;
          }
          else if (($certs == null) || (strlen($certs) == 0))
          {
              $certs = self::$default_certs;
          }
	  return Array(
            'pagetype' => self::$default_pagetype,
	    'platform' => $platform,
	    'certs' => $certs,
	    );
	}
      } else {
	if (strpos($ua, $pattern) !== FALSE) {
          $platform = $row[ $platform_index ];
          $certs = $row[ $certs_index ];
          $pagetype = $row[ $pagetype_index ];
          if ((($pagetype == null) || (strlen($pagetype) == 0)) ||
              (($platform == null) || (strlen($platform) == 0)))
          {
              $pagetype = self::$default_pagetype;
              $platform = self::$default_platform;
              $certs = self::$default_certs;
          }
          else if (($certs == null) || (strlen($certs) == 0))
          {
              $certs = self::$default_certs;
          }
	  return Array(
            'pagetype' => $pagetype,
	    'platform' => $platform,
	    'certs' => $certs,
	    );
	}
      }
    }

    return Array(
      'pagetype' => self::$default_pagetype,
      'platform' => self::$default_platform,
      'certs' => self::$default_certs,
      );
  }

  function __construct() {}
}

?>