<?php

/*******************************************************************************
 *  Public Config DEFINE
 *
 *                                                              created by Kevin
 *                                                   email : service@2200net.com
 *                                                                    2004/05/26
 ******************************************************************************/

  session_start();

  $tmp_ary = explode("/", $_SERVER["SCRIPT_FILENAME"]);
  unset($tmp_ary[(count($tmp_ary)-1)]);
  
  define("D_WEBROOT", (implode("/", $tmp_ary))."/");     // SERVER WEB DOCUMENT ROOT
  define("D_REMOTE_ADDR"  , $_SERVER["REMOTE_ADDR"]);    // SERVER REMOTE IP
  define("D_QUERY_STRING" , $_SERVER["QUERY_STRING"]);   // SERVER QUERY_STRING
  define("D_PHP_SELF"     , $_SERVER["PHP_SELF"]);       // PHP_SELF


  if ( file_exists("pri_config.php") )
    require_once("pri_config.php");
    

?>
