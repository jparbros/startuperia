#!/usr/bin/php5
<?php
/**
 * only a few lines of code will make the best web framework
 * function on the command line
 */

/* we don't need to be limited by...normal limitations */
set_time_limit(0);
ini_set('memory_limit', '256M');

/* make sure this isn't being called by a web browser */
if (isset($_SERVER['REMOTE_ADDR'])) die('Permission denied.');

/* set some constants */
define('CMD', 1);

/* manually set the URI path based on command line arguments... */
unset($argv[0]); /* ...but not the first one */
$_SERVER['HTTP_HOST']='localhost';
$_SERVER['QUERY_STRING'] =  $_SERVER['PATH_INFO'] = $_SERVER['REQUEST_URI'] = '/' . implode('/', $argv) . '/';

/* call up the framework */
include(dirname(__FILE__).'/index.php');
?>
