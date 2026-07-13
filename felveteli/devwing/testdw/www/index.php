<?php
error_reporting(0);
session_start();  
/**
 * Define document paths 
 */
require_once('config/config.php');
/**
 * Fetch the router
 */
require_once('controllers/' . 'router.php');
