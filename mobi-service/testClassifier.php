<?php

require_once "device_data.php";
require_once "Classifier.php";


$ua_list = Array(
  'Mozilla/5.0 (Linux; U; Android 1.5; en-us; T-Mobile G1 Build/CRB43) AppleWebKit/528.5+ (KHTML, like Gecko) Version/3.1.2 Mobile Safari/525.20.1', //android
  'BlackBerry8330/4.3.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/105', //blackberry
  'ELinks/0.11.3-5ubuntu2-lite (textmode; Debian; Linux 2.6.24-19-generic i686; 126x37-2)', //elinks
  'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', //googlebot
  'Mozilla/5.0 (iPhone; U; iPhone OS 2_0 like Mac OS X; ko-kr) AppleWebKit/525.17 (KHTML, like Gecko) Version/3.1 Mobile/5A240d Safari/5525.7', //iphone
  'Mozilla/5.0 (iPhone; U; CPU iPhone OS 2_1 like Mac OS X; zh-cn) AppleWebKit/525.18.1 (KHTML, like Gecko) Version/3.1.1 Mobile/5F136 Safari/525.20', //iphone
  'Mozilla/5.0 (iPod; U; CPU like Mac OS X; en) AppleWebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/3A101a Safari/419.3', //ipod
  'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)', //ie7 on windows vista
  'KDDI-SA3B UP.Browser/6.2_7.2.7.1.K.1.5.1.108 (GUI) MMP/2.0', //kddi
  'Opera/9.50 (J2ME/MIDP; Opera Mini/4.1.10781/298; U; en)', // nokia n95
  'Mozilla/4.0 (compatible; MSIE 5.0; Series80/2.0 Nokia9500/4.51 Profile/MIDP-2.0 Configuration/CLDC-1.1)', // nokia 9500
  'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.8.1.20) Gecko/20081217 Firefox/2.0.0.20 Novarra-Vision/8.0', // novarra
  'Mozilla/4.0 (compatible; MSIE 6.0; ; Linux armv5tejl; U) Opera 8.02 [en_US] Maemo browser 0.4.31 N770/SU-18', // nokia internet tablet
  'Mozilla/4.8 [en] (Windows NT 6.0; U)', // netscape on windows vista
  'Opera/9.51 Beta (Microsoft Windows; PPC; Opera Mobi/1718; U; en)', // windows pocket pc
  'Mozilla/4.0 (compatible; MSIE 4.01; Windows CE; PPC; 240x320)', // windows pocket pc
  'MOT-V3i/08.B4.34R MIB/2.2.1 Profile/MIDP-2.0', // razr
  'SCH-U900/1.0 NetFront/3.0.22 .2.9 (GUI) MMP/2.0', // samsung
  'YahooSeeker/1.2 (compatible; Mozilla 4.0; MSIE 5.5; yahooseeker at yahoo-inc dot com ; http://help.yahoo.com/help/us/shop/merchant/)', // yahooseeker
  'Mozilla/4.1 (U; BREW 3.1.5; en-US; Teleca/Q05A/INT)', // samsung instinct
  'Mozilla/4.0 (Microsoft Windows CE 5.0; PPC; U; en) Opera 9.0', // samsung sgh-i780
  'Opera/9.5 (Microsoft Windows; PPC; Opera Mobile/378; U; en)', // samsung sgh-i780
  'SAMSUNG-SGH-i780/1.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.7)', // samsung sgh-i780
  'SAMSUNG-SGH-i780/1.0 (compatible; MSIE 6.0; Windows CE; PPC) Opera 8.65', // samsung sgh-i780
  'SAMSUNG-SGH-i780/CSHB1_HC2 (compatible; MSIE 6.0; Windows CE; IEMobile 7.7)', // samsung sgh-i780
  'SAMSUNG-SGH-i780ORANGE/BVGJ2 (compatible; MSIE 6.0; Windows CE; IEMobile 7.7)', // samsung sgh-i780
  'SAMSUNG-SGH-I907/UCHE5 Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.11) UP.Link/6.3.1.20.0', // samsung sgh-i907/epix
  'SAMSUNG-SGH-I907/UCHI5 Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.11)', // samsung sgh-i907/epix
  'SAMSUNG-SGH-I907/UCHI5 Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.11) UP.Link/6.3.0.0.0', // samsung sgh-i907/epix
  'Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.11) VZW:SCH-i770 PPC 320x320', // samsung sch-i770/saga
  'Mozilla/4.1 (compatible; MSIE 6.0; ) 400x240 LGE VX10000', // lg voyager
  'vx10kv1', // lg voyager
  'LG-CU920/V1.0h Obigo/Q05A Profile/MIDP-2.0 Configuration/CLDC-1.1 UP.Link/6.3.0.0.0', // lg cu920
  'LG-CT810/V08e IEMobile/7.11 Profile/MIDP-2.0 Configuration/CLDC-1.1 Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.11)', // lg ct810
  'Mozilla/5.0 (compatible; Teleca Q7; Brew 3.1.5; U; en) 240X400 LGE VX9700', // lg dare
  'LG-GR500/V10f Teleca/Q7.0 Profile/MIDP-2.1 Configuration/CLDC-1.1', // lg xenon
  'LG-GW520/1.0 Profile/MIDP-2.1 Configuration/CLDC-1.1', // lg calisto
  'LG-GW520/V10a Teleca/WAP2.0 MIDP-2.1/CLDC-1.1', // lg calisto
  'Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.11) Sprint PPC6850SP', // htc touch pro
  'Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.11) Vodafone/1.0/HTC_Diamond', // htc touch diamond
  'Vodafone/1.0/HTC_Diamond/1.97.164.3 Opera/9.50 (Windows NT 5.1; U; es-ES)', // htc touch diamond
  'HTC_Touch_Pro_T7272 Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.11)', // htc touch pro
  'HTC_Touch_Pro_T7272 Opera/9.50 (Windows NT 5.1; U; en)', // htc touch pro
  'Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 6.12) Sprint:PPC6800', // htc mogul
  'Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.11) Sprint:PPC6800', // htc mogul
  'Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.6) Sprint:PPC6800', // htc mogul
  'Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.6) Vodafone/1.0/HTC_Kaiser/1.56.161.4', // htc kaiser (tilt)
  'HTC-8900/1.2 Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.6)', // htc tilt (kaiser)
  'UTSTARCOM-GTX75/UC1.88 POLARIS/6.00 Profile/MIDP-2.0 Configuration/CLDC-1.1', // UT Starcom Quickfire
  'Mozilla/4.0 (compatible; MSIE 6.0; Windows 98; PalmSource/Palm-D052; Blazer/4.5) 16;320x320', // palm treo 700p
  'Palm750/v0000 Mozilla/4.0 (compatible; MSIE 4.01; Windows CE; PPC; 240x320)', // palm treo 750w
  'Mozilla/4.0 (compatible; MSIE 4.01; Windows CE; PPC; 240x320)', // palm treo 750x
  'Mozilla/4.0 (compatible; MSIE 6.0; Windows 98; PalmSource/Palm-D060; Blazer/4.5) 16;320x320', // palm treo 755p
  'Treo800w/v0100 Mozilla/4.0 (compatible; MSIE 4.01; Windows CE, PPC; 320x320) (compatible; MSIE 6.0; Windows CE; IEMobile 7.11)', // palm treo 800w
  'Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.7) 320x240; VZW; Motorola-Q9c; Windows Mobile 6.0 Standard', // moto q9c
  'MOT-Q9/01.02.23R Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; Smartphone; 240x320) Opera 8.65', // moto q9
  'MOT-Q9/01.09.23R Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; Smartphone; 320x240) Opera 8.65 UP.Link/6.3.1.20.0', // moto q9
  'Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; Smartphone; 240x320; MOT-Q-UMTS/01.02.15I) Opera 8.65 [en]', // moto q9
  'Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 6.12) MOT-Q9/01.04.35R', // moto q9
  'Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.7) MOT-Q9/01.06.08R', // moto q9
  'MOT-Q11/01.00.49R-01 Software/WM6.1 Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.11)', // moto q11
  '8900a/1.2 Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.6)', // htc tilt
  'dopod C858g/5.1.422/WAP1.2 Profile/MIDP2.0 Configuration/CLDC1.0 Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.6)', // htc wing
  'Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.6) SP; 240x320; HTC_S710/1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1', // htc wing
  'Mozilla/4.0 (compatible; MSIE 6.0; Windows 98; PalmSource/Palm-D062; Blazer/4.5) 16;320x320', // palm centro
  'PalmCentro/v0001 Mozilla/4.0 (compatible; MSIE 6.0; Windows 98; PalmSource/Palm-D061; Blazer/4.5) 16;320x320', // palm centro
  'Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 6.12) T-Mobile Dash', // t-mobile dash
  'T-Mobile Dash Mozilla/4.0 (compatible; MSIE 4.01; Windows CE; Smartphone; 320x240)', // t-mobile dash
  'WinWAPDashMR/4.0 (Dash 2.0.000.0; 4.0.2.70; WM; SP; t-zones)', // t-mobile dash
  'Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.11) Sprint MP6950SP', // htc touch diamond
  'HTC_P3702 Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.11)', // htc touch diamond
  );

foreach ($ua_list as $ua) {
  echo $ua . "\n\n";
  print_r(Classifier::uaClassify($ua));
}

?>
