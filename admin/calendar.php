<?php

/* $Id: calendar.php,v 2.3 2004/05/07 17:58:37 rabus Exp $ */

require __DIR__ . '/libraries/grab_globals.lib.php';
$is_minimum_common = true;
require __DIR__ . '/libraries/common.lib.php';
require __DIR__ . '/libraries/header_http.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $GLOBALS['available_languages'][$GLOBALS['lang']][2]; ?>" lang="<?php echo $GLOBALS['available_languages'][$GLOBALS['lang']][2]; ?>" dir="<?php echo $GLOBALS['text_dir']; ?>">

<head>
<title><?php echo $strCalendar; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $GLOBALS['charset']; ?>">
<link rel="stylesheet" href="./css/phpmyadmin.css.php" type="text/css">
<script type="text/javascript" src="./libraries/tbl_change.js"></script>
<script type="text/javascript">
<!--
var month_names = new Array("<?php echo implode('","', $month); ?>");
var day_names = new Array("<?php echo implode('","', $day_of_week); ?>");
//-->
</script>
</head>
<body onload="initCalendar();">
<div id="calendar_data"></div>
<div id="clock_data"></div>
</body>
</html>
