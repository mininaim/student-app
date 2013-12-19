<?php

/** create password */
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); 
    $alphaLength = strlen($alphabet) - 1; 
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}

/** get avatar from Gravatar */
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    $url = 'http://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}

/** paginate */
function paginate($query, $page)
  {
    global $p, $limit, $total, $start;
    $p     = @$_GET['p'];
    $limit = @$_GET['limit'];
    $sql = @mysql_query($query) or die(mysql_error());
    $num = mysql_num_rows($sql);
    if ((!$p) || (is_numeric($p) == false) || ($p < 0) || ($p > $num))
      {
        $p = 1;
      }
    if ((!$limit) || (is_numeric($limit) == false))
      {
        $limit = $page;
      }
    if ((!isset($start)) || (is_numeric($start) == false))
      {
        $start = $p * $limit - ($limit);
      }
    $total = ceil($num / $limit);
    unset($sql);
  }

/** convert dates */
function humain_date($d)
  {
    $ts = time() - strtotime(str_replace("-", "/", $d));
    if ($ts > 31536000)
        $val = round($ts / 31536000, 0) . ' year';
    else if ($ts > 2419200)
        $val = round($ts / 2419200, 0) . ' month';
    else if ($ts > 604800)
        $val = round($ts / 604800, 0) . ' week';
    else if ($ts > 86400)
        $val = round($ts / 86400, 0) . ' day';
    else if ($ts > 3600)
        $val = round($ts / 3600, 0) . ' hour';
    else if ($ts > 60)
        $val = round($ts / 60, 0) . ' minute';
    else
        $val = $ts . ' second';
    if ($val > 1)
        $val .= 's';
    return $val;
  }

/** get records from db */
function get_stats($table)
 {
    $query = mysql_query("SELECT * FROM $table");
    $num   = mysql_num_rows($query);
    return $num;
 }