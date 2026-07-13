<?php

/*******************************************************************************
 * function collections class (for this project use)
 *
 *                                                              created by Kevin
 *                                                                    2004/12/18
 ******************************************************************************/


require_once("class/pub_function.php");
require_once("class/fmdate/class.fmdate.php");
require_once("class/calendarmon/calendarmon.php");


class pri_function extends pub_function
{


  /*****************************************************************************
   * Property (edit)
   *
   *  @access all private, readonly
   ****************************************************************************/

  var $ary_lang = array();  // protected, writeable

      
      
  /*****************************************************************************
   * CONSTRUCTOR function_main
   ****************************************************************************/

  function pri_function()
  {
    $this->getMQuote();      // from pub_config method    
    $this->_webDefine();
    $this->obj_calendarmon = new calendarmon;


    // -- get Timezone data ----------------------------------------------------
    define('D_TIMEZONE', ($this->ary_webcfg['timezone']<>"") ? $this->ary_webcfg['timezone'] : D_DEFAULTTIMEZONE);
    $this->obj_fmdate = new FormatDate(D_DATETIMETYPE, D_TIMEZONE);
    // -------------------------------------------------------------------------


    // -- chk Theme path -------------------------------------------------------
    define('D_THEMEPATH', is_dir("mainhtml/".D_WEBTHEME) ? D_WEBTHEME : D_DEFAULTTHEME );
    // -------------------------------------------------------------------------


    // -- get and DEFINE Language code name ------------------------------------
    /*
    $this->SaveSESSION(D_SESSIONKEY_USRCHK."_lang", D_DEFAULTLANGCODE);

    $_SESSION[D_SESSIONKEY_USRCHK]['lang'] = (!isset($_SESSION[D_SESSIONKEY_USRCHK."_lang"]))
                                           ? D_DEFAULTLANGCODE
                                           : $_SESSION[D_SESSIONKEY_USRCHK."_lang"];

    define('D_LANGCODE', $_SESSION[D_SESSIONKEY_USRCHK]['lang']);
    */

    $str_file = ( file_exists("lang/".D_LANGCODE) )
              ? "lang/".D_LANGCODE : "lang/english";

    $this->ary_lang = array_merge($this->_getLangTxt2Ary($str_file),
                                  array('V_THEMEPATH' => D_THEMEPATH)

    );
    // -------------------------------------------------------------------------
    
    
    // -- get Max calendar end date --------------------------------------------
    $str_currtime = $this->ShowTime("6d");
    $Xtime = mktime(1, 1, 1, substr($str_currtime, 4, 2), 31, substr($str_currtime, 0, 4)+5);
    define('D_DEFAULTMAXEDATE', date("Ym", $Xtime));
    // -------------------------------------------------------------------------
    
    
  }
  
  
  
  /*****************************************************************************
   * USER DEFINE
   ****************************************************************************/
   
  function _webDefine()
  {
    $DB = $this->DBMY();
    $ary_rs = $DB->get_row(" SELECT * FROM webcfg ", ARRAY_A);

    define('D_WEBNAME'     , $this->CodeWd($ary_rs['webname'], "", "nohtml"));
    define('D_WEBURL'      , $ary_rs['weburl']);
    define('D_WEBEMAIL'    , $this->CodeWd($ary_rs['adminemail'], "", "nohtml"));
    define('D_COUNTRYCODE' , $ary_rs['countrycode']);
    define('D_TOPMSG'      , $this->CodeWd($ary_rs['topmsg'], "", "html"));
    define('D_FOOTMSG'     , $this->CodeWd($ary_rs['footmsg'], "", "html"));
    define('D_WEBDEFSDATE' , $ary_rs['calstartdate']);
    define('D_DATETIMETYPE', $ary_rs['datetype']);
    define('D_TIMEZONE'    , ($ary_rs['timezone']<>"") ? $ary_rs['timezone'] : D_DEFAULTTIMEZONE);
    define('D_LANGCODE'    , $ary_rs['langcode']);
    define('D_STARTMONDAY' , ($ary_rs['firstweek']=="mon") ? true : false);
    define('D_WEBTHEME'    , $ary_rs['theme']);
  }
  
  
  
  /*****************************************************************************
   * Merge Common and Target Language
   *
   *  @param str $str_path : Target Language path
   *
   *  @return array or NULL
   *  @access public
   ****************************************************************************/

  function mergeLang($str_path="")
  {
    $ary_lang = $this->_getLangTxt2Ary($str_path.D_LANGCODE);

    if ($ary_lang=="")
      return $this->ary_lang;

    return array_merge($ary_lang, $this->ary_lang);
  }



  /*****************************************************************************
   * Explode lang.txt to an Array
   *
   *  @param str $str_file : Target Language path and File name
   *
   *  @return array or NULL
   *  @access private
   ****************************************************************************/

  function _getLangTxt2Ary($str_file="")
  {
    $ary_rs = "";

    if ( !file_exists($str_file) ) {
      return $ary_rs;
    }

    $ary_file = file($str_file);

    while ( list($nousekey, $str_txt) = each($ary_file) ) {
      if ($str_txt<>"") {
        $ary_ROW = explode("|||", $str_txt);

        if($ary_ROW[0]<>"" && $ary_ROW[1]<>"" )
          $ary_rs[trim($ary_ROW[0])] = eregi_replace("[\r\n]", "", trim($ary_ROW[1]));
      }
    }

    return $ary_rs;
  }

   

  /*****************************************************************************
   * DB static Start (MySQL)
   ****************************************************************************/

  function &DBMY()
  {
    static $obj_dbmysql;
    if ( !isset($obj_dbmysql) ) {
      require_once("class/db/class.".D_MYDBTYPE.".php");
      $obj_dbmysql = @new db_mysql(D_MYDBUSER, D_MYDBPASSWORD, D_MYDBNAME, D_MYDBHOST, D_MYDBCHARSET);
    }

    if ( !$obj_dbmysql->dbconn ) {
      echo "mysql db connect error !!";
      exit;
    }

    return $obj_dbmysql;
  }



  /*****************************************************************************
   * DB static Start (PGSQL)
   ****************************************************************************/

  function &DBPG()
  {
    static $obj_dbpgsql;
    if ( !isset($obj_dbpgsql) ) {
      require_once("class/db/class.".D_PGDBTYPE.".php");
      $obj_dbpgsql = @new db_pgsql(D_PGDBUSER, D_PGDBPASSWORD, D_PGDBNAME, D_PGDBHOST);
    }

    if ( !$obj_dbpgsql->dbh ) {
      echo "pgsql db connect error !!";
      exit;
    }

    return $obj_dbpgsql;
  }

  
  
  /*****************************************************************************
   * Language
   *  need include 'lang/lang_xx.php'
   *
   *  @param str $str_string : the original string
   *
   *  @return string : the result DEFINE of the language
   *  @access public
   ****************************************************************************/

  function TLANG($str_string="")
  {
    return $this->ary_lang[$str_string];
  }

  
  
  /*****************************************************************************
   * Week name
   *
   *  @param int $week : 0 or 7 = sun, 6 = sat
   *
   *  @return boolen : true = sent backupfile by email, NULL download by HTTP
   *  @access public
   ****************************************************************************/

  function getWeekName($int=0)
  {
    $ary_week = array($this->TLANG("sun"),
                      $this->TLANG("mon"),
                      $this->TLANG("tue"),
                      $this->TLANG("wed"),
                      $this->TLANG("thu"),
                      $this->TLANG("fri"),
                      $this->TLANG("sat"),
                      $this->TLANG("sun"),
    );
  
    return $ary_week[$int];
  }
  
  
  
  /*****************************************************************************
   * Month name
   *
   *  @param int $month : 1 ~ 12
   *
   *  @return boolen : true = sent backupfile by email, NULL download by HTTP
   *  @access public
   ****************************************************************************/

  function getMonthName($int)
  {
    $ary_month = array($this->TLANG("January"),
                       $this->TLANG("February"),
                       $this->TLANG("March"),
                       $this->TLANG("April"),
                       $this->TLANG("May"),
                       $this->TLANG("June"),
                       $this->TLANG("July"),
                       $this->TLANG("August"),
                       $this->TLANG("September"),
                       $this->TLANG("October"),
                       $this->TLANG("November"),
                       $this->TLANG("December"),
    );

    return $ary_month[$int-1];
  }

  
  
  /*****************************************************************************
   * GetDateTime
   *   need include class/fmdate/class.fmdate.php
   *
   *  @param str $type     : like 14, 12, 8, 6, 14d, 12d, 8d, 6d
   *  @param str $thistime : 14 digits num
   *  @param str $orgtime  : if not NULL, timezone no effect
   *
   *  @return string : the FORMATED TIME digits
   *  @access public
   ****************************************************************************/

  function ShowTime($type="", $thistime="", $int_timezone="")
  {
    return $this->obj_fmdate->GetDateTime($type, $thistime, $int_timezone="");
  }
  
  
  
  /*****************************************************************************
   * Get the number of days in a month
   *   need include class/calendarmon/calendarmon.php
   *
   *  @param int $mon  : the month digit, exp: MAR = 3
   *  @param int $year : the year digit, exp: 2004
   *
   *  @return int
   *  @access public
   ****************************************************************************/

  function getMonthDays($mon, $year)
  {
    return $this->obj_calendarmon->NumDays_Month($mon, $year);
  }
  
  
  
  /*****************************************************************************
   * HTML Page Header for Javacode use
   *
   *  @param array $T_data : some HTML code,
   *                         ex : $ary_rs = array('title'   => "Page Title",
   *                                              'content' => "Content" ... )
   *
   *  @return HTML code
   *  @access public
   ****************************************************************************/

  function JavaHeaderPage($ary_data="")
  {
    $tplflag = 'javaheader';
    $tpl = $this->tpl("mainhtml/".D_THEMEPATH, $tplflag, $tplflag.'.html');

    $tpl->assign(array('V_THEMEPATH' => D_THEMEPATH,
                       'V_PAGETITLE' => $ary_data['title'],
                       'V_CONTENT'   => $ary_data['content'],
    ));

    $tpl->parse('F_'.$tplflag, $tplflag);
    $tpl->fastprint();
  }



  /*****************************************************************************
   * get Page Jump class HTML string code array, for TPL class use
   *  remember DEFINE 'D_PGJUMPFLAGSTR', it will show in FORM html code
   *
   *  @param int $int_nums : tot data nums
   *  @param int $int_size : per page size
   *  @param int $int_flag : current DATA flag
   *
   *  @return array
   *  @access public
   *
   *                                                                  2005/09/22
   ****************************************************************************/

  function getPgJmpAry($int_nums=0, $int_size=10, $int_flag=0)
  {
    if ($int_nums<1)
      return null;

    if ( !defined('D_PGJUMPFLAGSTR') )
      define('D_PGJUMPFLAGSTR', 'fm_data[FLAG]');

    $obj_page = $this->PGJump($int_nums, $int_size, $int_flag, D_PGJUMPFLAGSTR);

    return array('V_SELECTPAGE' => $obj_page->selectpage($this->TLANG('jump to page')),
                 'V_UPDOWNPAGE' => $obj_page->prepage($this->TLANG('pre page')).
                                   $obj_page->nextpage($this->TLANG('next page')),
                 'V_TOTNUM'     => $int_nums,
    );
  }
  
  
  
  /*****************************************************************************
   * get Website avilaible Language array
   *  index target path : mainhtml
   *
   *  @param
   *
   *  @return array
   *  @access public
   ****************************************************************************/

  function getWebLangAry()
  {
    $str_path = D_MAINLANGPATH;

    if ( !file_exists($str_path) ) {
      return null;
    }

    $ary_rs = array();
    $ary_lancodeary = $this->getMultiLangAry();
    $obj_dir = dir($str_path);

    while ( false !== ($filename = $obj_dir->read()) ) {
      if ( substr($filename, 0, 1)<>"." ) {
        $ary_rs[$filename] = $ary_lancodeary[$filename];
      }
    }

    $obj_dir->close();
    return $ary_rs;
  }
  
  
  
  /*****************************************************************************
   * Dat array data, GMT to LOCAL datetime
   *
   *  @param ary $ary_row : data array include datetime ROW
   *  @param str $str_key : the datetime keyname
   *
   *  @return array : array will add a field 'local_datetime'
   *  @access public
   ****************************************************************************/

  function aryGMTtoLOCAL($ary_row, $str_key)
  {
    $ary_rs = $ary_row;
  
    foreach ($ary_row as $ROW) {
      $ary_rs[]['local_datetime'] = $this->ShowTime("14d", $ROW[$str_key]);
    }
    
    return $ary_rs;
  }
  
  
  
}



?>
