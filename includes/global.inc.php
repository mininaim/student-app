<?php

/** classes */
require_once 'classes/mysql.class.php';

/** functions */
require_once 'functions/misc.php';

/** DB Connect */
$DB = new dbManager();
$DB->connect();