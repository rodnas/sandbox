<?php

/*******************************************************************************
 * config DEFINE for this Project
 *  marked with  'edit' means you should edit some DEFINE for this project
 *
 *  admin page URL like : http://yourdomain/admin
 *  deafult id : admin
 *  default password : admin
 *
 *                                                              created by Kevin
 *                                                                    2004/12/10
 *                                                             update 2006/03/20
 ******************************************************************************/


/*******************************************************************************
 * SESSION DEFINE (do not change !!)
 ******************************************************************************/

  define('D_SESSIONKEY', session_id());
  define('D_SESSIONKEY_ADCHK'   , md5(D_SESSIONKEY.'ADCHK'));     // (do not change !!)
  define('D_SESSIONKEY_USRCHK'  , md5(D_SESSIONKEY.'USRCHK'));    // (do not change !!)
  define('D_SESSIONKEY_USERID'  , md5(D_SESSIONKEY.'USERID'));    // (do not change !!)
  define('D_SESSIONKEY_LANGCODE', md5(D_SESSIONKEY.'LANGCODE'));  // (do not change !!)
  


/*******************************************************************************
 * DB config (edit)
 ******************************************************************************/

  define('D_MYDBTYPE'    ,'mysql' );        // DB type         (do not change !!)
  define('D_MYDBCHARSET' ,"utf-8");         // DB charset      (do not change !!)
  define('D_MYDBUSER'    ,"db_user");       // DB user         (edit)
  define('D_MYDBPASSWORD',"user_psd");      // DB password     (edit)
  define('D_MYDBHOST'    ,"localhost");     // DB server host  (edit)
  define('D_MYDBNAME'    ,"db_name");       // DB name         (edit)
  
  
  
/*******************************************************************************
 * Define PATH ,Files, URL
 ******************************************************************************/

  define('D_SYSROOT'      , "./");
  define('D_MAINLANGPATH' , 'lang/');                // default language path
  define('D_WEBROOT'      , D_CURRWEBROOT);
  define('D_MAINFILENAME' , D_WEBROOT."main.php");
  define('D_ADMINFILENAME', D_WEBROOT."admin.php");
  


/*******************************************************************************
 * Common DEFINE (edit if needed)
 ******************************************************************************/

  define('D_DEFAULTMINSDATE', 199001);           // calendar min start date
  define('D_DEFAULTMAXETEAR', 5);                // calendar max end of year

  define('D_DEFAULTTHEME'   , "default");        // default website theme
  define('D_PERPAGESIZE'    , 20);               // default per page size
  define('D_DEFAULTTIMEZONE', 0);                // DEFAULT GMT timezone
  define('D_PGJUMPFLAGSTR'  , 'fm_data[FLAG]');  // pagejump class use, use in HTML page
  define('D_DEFAULTLANGCODE', 'english');        // default language code
  define('D_CALENDARVERSION', '2.0');            // current version


?>
