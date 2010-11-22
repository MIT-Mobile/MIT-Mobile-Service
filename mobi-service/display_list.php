<?php 
?>
<html>
<head>
<style type="text/css">
td {
  border: 1px solid #999;
}
</style>
</head>
<body>

<p>
Each user agent string is matched against the following list of regular 
expressions or keywords, roughly (not exactly) in the following order.
As soon as a pattern/keyword is matched, the user agent is assigned a
page type (Webkit, Touch, Basic), platform, and certificate support.
</p>
<p>
Within each page type, a list of attributes is also assigned, which will 
affect the rendering of subsequent web pages.
</p>
<p>
Unmatched devices are assigned the Basic page type, generic rendering
attributes, and no certificate support.
</p>

<?
$docRoot = getenv("DOCUMENT_ROOT");

require_once($docRoot . "/mobi-config/mobi_service_config.php");
require_once(SERVICEROOT . "/device_data.php");

$pagetype_index = array_search('pagetype', $mobi_service_whitelist_fields);
$numfields = count($mobi_service_whitelist_fields);

foreach (Array('Webkit', 'Touch', 'Basic') as $branch) {
?>
<h3>Patterns assigned to <?=$branch?></h3>
<?
  $result = array();
  foreach ($mobi_service_whitelist as $row) {
    if ($row[ $pagetype_index ] == $branch) {
      $assoc_row = array();
      for ($i=0; $i<$numfields; $i++) {
        $assoc_row[ $mobi_service_whitelist_fields[$i] ] = $row[$i];
      }
      $result[] = $assoc_row;
    }
  }

  if ($result) {
?>
<table>
<tr>
<th>Description</th>
<th>Regex or keyword</th>
<th>Platform</th>
<th>Certificates?</th>
<th>Subbranch attributes</th>
</tr>
<?
    foreach ($result as $row) {
?>
<tr>
<td><?=$row['description']?>&nbsp;</td>
<td>"<?=$row['pattern']?>"</td>
<td><?=$row['platform']?></td>
<td><?=$row['certs']?></td>
<td>
<?
      foreach ($row as $key => $value) {
	if (!in_array($key, Array('pattern', 'certs', 'platform', 'description'))) {
?>
<strong><?=$key?></strong>: <?=$value?><br />
<?
	}
      }
?>
</td>
</tr>
<?
    }
?>
</table>
<?
  }
}

?>
</body>
</html>