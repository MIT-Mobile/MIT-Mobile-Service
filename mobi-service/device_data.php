<?php

$mobi_service_platforms = array(
  array(
    'platform' => 'iphone',
    'description' => 'iPhone',
    ),
  array(
    'platform' => 'android',
    'description' => 'Android',
    ),
  array(
    'platform' => 'webos',
    'description' => 'webOS',
    ),
  array(
    'platform' => 'winmo',
    'description' => 'Windows Mobile',
    ),
  array(
    'platform' => 'symbian',
    'description' => 'Symbian',
    ),
  array(
    'platform' => 'maemo',
    'description' => 'Maemo',
    ),
  array(
    'platform' => 'palmos',
    'description' => 'PalmOS',
    ),
  array(
    'platform' => 'featurephone',
    'description' => 'Feature Phone',
    ),
  array(
    'platform' => 'computer',
    'description' => 'Computer',
    ),
  array(
    'platform' => 'spider',
    'description' => 'Spider',
    ),
  );

// this is a list of all platforms that can appear as Webkit devices
// and customizations we use for each
$mobi_service_Webkit = array(
  'iphone' => array(
    'home_css' => '#homegrid div {width:79px;height:90px} h1 {margin-top: 14px; margin-bottom:9px}',
    'extra_css' => NULL,
    ),
  'android' => array(
    'home_css' => NULL,
    'extra_css' => '#container { min-height: 252px }',
    ),
  'webos' => array(
    'home_css' => NULL,
    'extra_css' => '#container { min-height: 330px } * { -webkit-border-radius: 0!important } .breadcrumbs a { padding-top: 7px } .pagetitle { padding-top: 8px } a.homelink { padding-top: 0 } a.module { padding-top: 4px } .homepage .pagetitle { line-height: 16px }; .tabbody { min-height: 300px } #footerlinks { display: none }',
    ),
  );

// this is a list of all platforms that can appear as Touch devices
// and customizations we use for each
$mobi_service_Touch = array(
  'winmo' => array('viewport_device_width' => 1),
  'blackberry' => array('viewport_device_width' => 0),
  'symbian' => array('viewport_device_width' => 1),
  'palmos' => array('viewport_device_width' => 1),
  'featurephone' => array('viewport_device_width' => 1),
  );

// this is a list of all platforms that can appear as Basic devices
$mobi_service_Basic = array(
  'winmo', 'blackberry', 'symbian', 'palmos', 'featurephone', 'computer', 'spider');

// regexes and keywords that tell us what to do with each UA string
$mobi_service_whitelist_fields = 
  array('pattern', 'pagetype', 'platform',   'certs', 'description');

$mobi_service_whitelist = array(
  array('iPad',    'Webkit',   'iphone',       1,       'iPad' ),
  array('/(Boopsie|Kratylos|MiniRedir|Jumpbot)/',
                   'Basic',    'spider',       0,       'annoying bots that are neither search engines nor user-invoked command line tools' ),
  array('iPhone',  'Webkit',   'iphone',       1,       'iPhone' ),
  array('iPod',    'Webkit',   'iphone',       1,       'iPhone' ),
  array('Aspen Simulator',
                   'Webkit',   'iphone',       0,       'iPhone simulator' ),
  array('Android', 'Webkit',   'android',      0,       'Android' ),
  array('webOS',   'Webkit',   'webos',        0,       'Palm Pre' ),
  array('BlackBerry95',
                   'Touch',    'blackberry',   1,       'BlackBerry Storm, Thunder' ),
  array('/BlackBerry(90|89|96)/',
                   'Basic',    'blackberry',   1,       'BlackBerry Bold, Onyx, Tour, Curve 89xx'  ),
  array('BlackBerry8100',
                   'Basic',    'blackberry',   0,       'BlackBerry Pearl' ),
  array('BlackBerry',
                   'Basic',    'blackberry',   0,       'All other BlackBerries' ),
  array('Dash',    'Basic',    'winmo',        1,       'T-Mobile Dash' ),
// htc devices.  unfortunately some HTC Touch* devices say IEMobile even when running Opera
  array('T-Mobile_Rhodium',
                   'Touch',    'winmo',        0, 'HTC Touch Pro 2 (T-Mobile)' ),
  array('/PPC68[05]0/',
                   'Touch',    'winmo',        0, 'HTC Mogul, Touch Pro (Sprint)' ),
  array('MP6950',  'Touch',    'winmo',        0, 'HTC Touch Diamond (Sprint)' ),
  array('/HTC[_ ](Touch|Diamond|Elf).+IEMobile|IEMobile.+HTC[_ ](Touch|Diamond|Elf)/',
                   'Touch',    'winmo',        0, 'HTC Touch, Diamond, Elf (IE)' ),
  array('/HTC[_ ](Touch|Diamond|Elf)/',
                   'Touch',    'winmo',        0, 'HTC Touch, Diamond, Elf' ), // htc touch*
  array('/HTC[\\-_ ]P\\d{4}/',
                   'Touch',    'winmo',        1, 'HTC P series (incl. Touch Diamond, Pro, Cruise, Color)' ),
  array('/dopod [A-Z]?8/',
                   'Touch',    'winmo',        1, 'HTC P series' ),
  array('/HTC[\\-_ ]T/',
                   'Touch',    'winmo',        1, 'HTC T series (incl. Touch Viva, 3G, Cruise, Pro, HD)' ),
  array('/8900.+IEMobile/',
                   'Touch',    'winmo',        1, 'HTC Tilt' ),
  array('/HTC[\\-_ ]S\\d{3}/',
                   'Basic',    'winmo',        1, 'HTC S series' ),
  array('T-Mobile_Atlas',
                   'Touch',    'winmo',        1, 'T-Mobile Wing' ),
  array('XV6950',  'Touch',    'winmo',        1, 'HTC Touch Diamond (vzw)'),
  array('/HTC[\\-_ ]ST/',
                   'Touch',    'winmo',        1, 'HTC Pure'),
// samsung devices
  array('/Opera.+S[CG]H\\-i9/',
                   'Touch',    'winmo',        0, 'Samsung Omnia (Opera)' ),
  array('SCH-U940','Touch',    'featurephone', 0, 'Samsung Glyde' ),
  array('SPH-M800','Touch',    'featurephone', 0, 'Samsung Instinct' ),
  array('Teleca/Q05A/INT',
                   'Touch',    'featurephone', 0, 'Samsung Instinct' ),
  array('/S[CG]H\\-i[79]/',
                   'Touch',    'winmo',        1, 'Samsung Omnia, Epix, Saga' ),
  array('/S[CG]H\\-i6/i',
                   'Basic',    'winmo',        1, 'Samsung BlackJack, Jack' ),
  array('/(SAMSUNG|GT|S[CGP]H)\-(M7600|M8800|A8[67]7|T9[12]9|R8[012]0|S5230|S8300)/',
                   'Touch',    'featurephone', 0, 'Samsung 240x400 devices' ),
  array('/(SAMSUNG|GT|S[CGP]H)\-(\w?\d+)/',
                   'Basic',    'featurephone', 0, 'Other Samsung devices' ),
// lg devices
  array('/LGE?[\\- ][A-Z]+\\d+.+Teleca|Teleca.+LGE?[\\- ][A-Z]+\\d+/',
                   'Touch',    'featurephone', 0, 'LG Dare, Versa, Xenon, Calisto' ),
  array('/VX10(000|k)/i',
                   'Touch',    'featurephone', 0, 'LG Voyager' ),
  array('LG-CU9',  'Touch',    'featurephone', 0, 'LG Vu' ),
  array('/\\bLGE?[\\- ][A-Z]*\\d+/',
                   'Basic',    'featurephone', 0, 'Other LG devices' ),
// utstar devices
  array('UTStar-XV6800',
                   'Touch',    'winmo',        1, 'UTStar-XV6800 (vzw)'),
// palm and motorola devices
  array('/MOTO?(|rola)\\-?Q/i',
                   'Basic',    'winmo',        0, 'Motorola Q series' ),
  array('Palm-D0', 'Basic',    'palmos',       0, 'Palm Centro, Treo 700p, Treo 750p' ), // palm centro, treo *p
  array('/240x320.+Opera/',
                   'Basic',    'winmo',        0, 'Motorola Q series alternative' ), // moto q
  array('/320x240.+Opera/',
                   'Basic',    'winmo',        0, 'Motorola Q series alternative' ), // moto q
  array('/(Smartphone|SP|PPC); 176x/',
                   'Basic',    'winmo',        0, '' ),
  array('/(Smartphone|SP|PPC); 240x/',
                   'Basic',    'winmo',        0, 'Palm Treo 750x, 750w, HTC Wing' ),
  array('/(Smartphone|SP|PPC); 320x/',
                   'Basic',    'winmo',        0, 'Palm Treo 800' ),
// etc.
  array('Symbian', 'Basic',    'symbian',      0, 'Symbian' ),
  array('Palm',    'Basic',    'palmos',       0, 'Other Palm' ),
  array('IEMobile','Basic',    'winmo',        1, 'Other IEMobile (Windows Mobile) devices' ),
  array('Opera Mobi',
                   'Basic',    'winmo',        0, 'Opera Mobi (Windows Mobile) devices' ),
  array('/Windows CE.+Opera/',
                   'Basic',    'winmo',        0, 'Other Windows Mobile devices' ),
  array('/Nokia|SonyEricsson|Motorola|\\bMOT|DoCoMo/',
                   'Basic',    'featurephone', 0, 'Vendors of many feature phones' ),
  array('/Opera Mini|NetFront|Novarra|UP.Browser|Blazer|Fennec/',
                   'Basic',    'featurephone', 0, 'Feature phone browsers' ),
  array('/BREW|hiptop|Maemo|J2ME/i',
                   'Basic',    'featurephone', 0, 'Feature phone platforms' ),
  array('/[Cc]rawle?r?|[Ss]pider|\\b\\w*[Bb]ot/',
                   'Basic',    'spider',       0, 'Robots' ),
  array('/Google Wireless Transcoder|Yahoo!|urllib|libwww|Wget|curl/',
                   'Basic',    'spider',       0, 'Google, Yahoo, Python, Perl, command line tools' ),
  array('/MSIE|Firefox|Safari/',
                   'Basic',    'computer',     1, 'Browsers' ),
  array('Opera',   'Basic',    'computer',     0, 'Browsers' ),
  );
