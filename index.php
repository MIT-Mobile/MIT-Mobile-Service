<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$ua = $_GET['ua'];
$action = $_GET['action'];

if ((($ua != null) && ($action != null)) && ((strlen($ua) != 0) && (strlen($action) != 0)))
{
    $request = Array(
        'ua' => $ua,
        'action' => $action,
    );
    $args = http_build_query($request);
    header("Location: ./mobi-service/?" . $args);
}
?>
