<?php

/*******************************************************************************
 * function collections class (public for all program use)
 *   must include config.php first
 *
 *  @access public
 *
 *                                                              created by Kevin
 *                                                                    2004/01/28
 ******************************************************************************/


require_once("class/pub_config.php");                       // Public Config class
require_once("class/fasttemplete/class.fasttemplate.php");  // HTML templete
require_once("class/pagejump/class.pagejump.php");          // Page Jump class


class pub_function
{


  /*****************************************************************************
   * CONSTRUCTOR function_main
   ****************************************************************************/



  /*****************************************************************************
   * Templete for HTML code
   *   need include 'class/class.fasttemplate.php'
   *
   *  @param str $str_path : the target htmlpage path  ex. program\htmlpage
   *  @param int $str_flag : the htmlpage flag name    ex. tpl_mypagename
   *  @param int $str_file : the htmlpage name         ex. mypagename.html
   *
   *  @return object     : Templete Object
   *  @access public
   ****************************************************************************/

  function tpl($str_path, $str_flag, $str_file, $str_os="")
  {
    // require_once ("class/class.fasttemplate.php");
    $RS = new FastTemplate($str_path, $str_os);
    $RS->no_strict();
    $RS->define(array($str_flag => $str_file));
    return $RS;
  }



  /*****************************************************************************
   * Redirect to som page
   *
   *  @param str $URL     : the redirect URL
   *  @param str $message : display message
   *  @param int $delay   : after xxx seconds and redirect to
   *
   *  @return string      : HTML code string
   *  @access public
   ****************************************************************************/

  function GoURL($URL, $message="", $delay=0)
  {
    echo "<meta http-equiv='Refresh' content='$delay; url=$URL'>";
    echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";

    if( !empty($message) )
      echo "&nbsp;<P><CENTER><FONT COLOR=#800000 SIZE=3>$message</FONT><P></CENTER>";
  }



  /*****************************************************************************
   * Goback HTML code
   *
   *  @param str $word : display message
   *
   *  @return string   : HTML code string
   *  @access public
   ****************************************************************************/

  function GoBack($word="")
  {
    return '<CENTER>&nbsp;<P><FONT COLOR=#800000 SIZE=3>'.$word.'</FONT><P>'.
           ' [ <a href="javascript:history.back(1)"><U>GO BACK</U></a> ] </CENTER>';
  }



  /*****************************************************************************
   * Get limit words
   *
   *  @param str $str  : the original words
   *  @param int $nums : limit number
   *
   *  @return string   : string
   *  @access public
   ****************************************************************************/

  function CutWord($str, $nums)
  {
    if ( strlen($str)>$nums ) {
      for ($i=0; $i<$nums; $i++) {
        $ch = substr($str, $i, 1);
        if ( ord($ch)>127 )
          $i++;
      }
     $str = substr($str, 0, $i)."...";
    }
    return $str;
  }



  /*****************************************************************************
   * Dump data
   ****************************************************************************/

  function XX_DUMP($STR)
  {
    echo "<PRE>";
    var_dump($STR);
    echo "</PRE><P>";
  }



  /*****************************************************************************
   * String DECODE & ENCODE
   *
   *  @param str $str    : the original string
   *
   *  @param str $type   : e    = ENCODE
   *                       d    = DECODE
   *                       null = do nothing (default))
   *
   *  @param str $act    : null   = do nothing (default))
   *                       nohtml = HTML code no effect
   *                       br     = HTML code no effect but <BR>
   *
   *  @param str $slashe : null = do nothing (default))
   *                       y    = add stripslashes
   *
   *  @return string     : string
   *  @access public
   *                                                                  2004/07/09
   ****************************************************************************/

  function CodeWd($str="", $type="", $act="", $slashe="")
  {
    // $php_ver = $this->GetPHPver();

    if ($str=="") {
      return $str;
      exit;
    }


    // -- ENCODE or DECODE -----------------------------------------------------
    if ($type=="e") {
      return base64_encode($str);
      exit;
    }

    if ($type=="d")
      $str = base64_decode($str);
    // -------------------------------------------------------------------------


    // -- Action ---------------------------------------------------------------
    if ($act=="nohtml")
      $str = htmlspecialchars($str);

    if ($act=="br")
      $str = eregi_replace("\n", "<BR>", htmlspecialchars($str));
    // -------------------------------------------------------------------------


    // -- stripslashes ---------------------------------------------------------
    if ($slashe<>"")
      stripslashes($str);
    // -------------------------------------------------------------------------


    return $str;
  }



  /*****************************************************************************
   * get GMT time
   *
   *   @return str 14 digt numbers
   ****************************************************************************/

  function getGMTtime()
  {
    return gmdate( "YmdHis", time() );
  }




  /*****************************************************************************
   * GMT Time to Local Time
   *
   *  @return 14 digi number, must define 'D_LOCATTIME' in config.php
   ****************************************************************************/

  function GMT2Localtime($thistime="")
  {
    if ($thistime=="")  $thistime = $this->getGMTtime();

    $Y = substr($thistime, 0, 4);
    $M = substr($thistime, 4, 2);
    $D = substr($thistime, 6, 2);
    $h = substr($thistime, 8, 2)<>""  ?  substr($thistime, 8, 2)  : 0 ;
    $m = substr($thistime, 10, 2)<>"" ?  substr($thistime, 10, 2) : 0 ;
    $s = substr($thistime, 12, 2)<>"" ?  substr($thistime, 12, 2) : 0 ;

    $Xtime = mktime($h + D_LOCATTIME , $m, $s, $M, $D, $Y);
    return date("YmdHis", $Xtime);
  }



  /*****************************************************************************
   * get the PHP version
   ****************************************************************************/

  function GetPHPver()
  {
    // prints e.g. '4.1.1'
    // echo phpversion();
    return substr(phpversion(), 0, 3);
  }



  /*****************************************************************************
   * SESSION method
   *
   *  @param str $str   : SESSION args
   *  @param int $value : default value
   *
   *  @access public
   ****************************************************************************/

  function SaveSESSION($str="", $value="")
  {
    if  ($str<>"") {
      if ( isset($_REQUEST[$str]) )
        $_SESSION[$str] = $_REQUEST[$str];

      if ( !isset($_SESSION[$str]) )
        $_SESSION[$str] = $value;

      return $_SESSION[$str];
    }
  }



  /*****************************************************************************
   * get PHPSESSIONID
   *   because cookie disable reason ...
   *
   * DEFINE D_SESSIONID, just get it !!
   ****************************************************************************/

  function getPHPSESSID()
  {
    if ($_REQUEST['PHPSESSID']=="") {
      define('D_SESSIONID' , strip_tags(SID));
      $tmp_ary = explode("=", strip_tags(SID));
      define('D_SESSIONIDS', $tmp_ary[1]);
      // header("Location:main.php?".D_SESSIONID);
      // header("Location:".$_SERVER["PHP_SELF"]."?".D_SESSIONID);
    }
     else {
      define('D_SESSIONID' , "PHPSESSID=".$_REQUEST['PHPSESSID']);
      define('D_SESSIONIDS', $_REQUEST['PHPSESSID']);
    }
  }


  function getPHPSESSIDHTML()
  {
    return '<INPUT TYPE="HIDDEN" NAME="PHPSESSID" VALUE="'.D_SESSIONIDS.'">';
  }



  /*****************************************************************************
   * Get Combobox <OPTION> HTML code
   *
   *  @param array $ary_data : ex. array{'NAME1' => VALUE1,
   *                                     'NAME2' => VALUE2, ..... }
   *
   *  @param str   $str_matchkey : if $str_key == <OPTION> value, mark "SELECTED"
   *
   *  @return HTML code
   *  @access public
   ****************************************************************************/

  function getComboHtml($ary_data, $str_matchkey="")
  {
    if ( $ary_data=="" or !is_array($ary_data) ) {
      return null;
      exit;
    }

    while ( list($name, $value) = each($ary_data) ) {
      // list($name, $value) = each($ROW);
      $str_CHECK = ( $str_matchkey == $name ) ? "SELECTED" : "";
      $str_HTML .= '<OPTION VALUE="'.$name.'" '.$str_CHECK.' >'.$value;
    }

    return $str_HTML;
  }



  /*****************************************************************************
   * PAGEJUMP function
   *
   *  @param int $int_totnum    : total data nums
   *  @param int $int_pagesize  : how many data list in each pach
   *  @param int $int_startflag : data start FLAG num
   *  @param str $str_reqname   : HTML trans PAARAM NAME
   *
   *  @return object
   *  @access public
   ****************************************************************************/

  function PGJump($int_totnum, $int_pagesize=5, $int_startflag=0, $str_reqname)
  {
    $obj_PGJump = new PageJump($int_totnum, $int_pagesize, $int_startflag, $str_reqname);
    return $obj_PGJump;
  }



  /*****************************************************************************
   * Magic quotes
   *  see php.ini, magic quotes config
   *
   *  @param
   *
   *  @return void
   *  @access public
   ****************************************************************************/

  function getMQuote()
  {
    if ( !get_magic_quotes_gpc() ) {
      function _deepslash ($v) {
        return (is_array($v)) ? array_map("_deepslash", $v) : addslashes($v);
      }
    
      $_POST    = array_map("_deepslash", $_POST);
      $_GET     = array_map("_deepslash", $_GET);
      $_COOKIE  = array_map("_deepslash", $_COOKIE);
      $_REQUEST = array_map("_deepslash", $_REQUEST);
      $_GLOBALS = array_map("_deepslash", $_GLOBALS);
      $_SERVER  = array_map("_deepslash", $_SERVER);
    }
  }



  /*****************************************************************************
   * Multi Lannuage array, this file config UNICODE(UTF-8)
   *
   *  @param
   *
   *  @return array
   *  @access public
   ****************************************************************************/

  function getMultiLangAry()
  {
    $ary_rs = array('afrikaans'     => 'Afrikaans',
                    'chinese-tr'    => '&#32321;&#39636;&#20013;&#25991;',
                    'chinese-sim'   => '&#31616;&#20307;&#20013;&#25991;',
                    'czech'         => '&#268;esky',
                    'dutch'         => 'Nederlands',
                    'english'       => 'English',
                    'french'        => 'Fran&ccedil;ais',
                    'german'        => 'Deutsch',
                    'italian'       => 'Italiano',
                    'japanese'      => '&#26085;&#26412;&#35486;',
                    'hungarian'     => 'Magyar',
                    'polish'        => 'Polski',
                    'portuguese-br' => 'Portugu&ecirc;s-Brasileiro',
                    'russian'       => '&#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081;',
                    'slovak'        => 'Slovensky',
                    'swedish'       => 'Svenska',
                    'spanish'       => 'Espa&ntilde;ol',
                    'turkish'       => 'T&uuml;rk&ccedil;e',
    );

    return $ary_rs;
  }



}



?>
