<?php

/*******************************************************************************
 * Admin Main Program
 *
 *                                                              created by Kevin
 *                                                                    2004/12/10
 ******************************************************************************/


require_once("pri_function.php");


class admin
{


  /*****************************************************************************
   * var property
   *
   *  @access private
   ****************************************************************************/

  var $FN;                                       // private, readonly
  var $str_defaultclass = "adwebcfg";            // DEFAULT start first class
  var $str_mainhtmllangpath = "mainhtml/lang/";  // private, readonly

  

  /*****************************************************************************
   * CONSTRUCTOR admin
   ****************************************************************************/

  function admin()
  {
    $this->FN = new pri_function();
    $FN = $this->FN;
    $fm_data = $_REQUEST['fm_data'];


    // -- chk login, error show login page -------------------------------------
    $ary_authdata = $this->_AuthChk($_REQUEST['fm_data']);

    if ($ary_authdata['auth'] == true && $fm_data['loginact'] == "login") {
      $str_url = "admin.php";
      $FN->GoUrl($str_url, $FN->TLANG('login complete'), "3");
      exit;
    }

    if ($ary_authdata['auth'] != true) {
      $tplflag = "adminlogin";
      $tpl = $FN->tpl("mainhtml/".D_THEMEPATH, $tplflag, $tplflag.".html");
      $tpl->assign($this->FN->mergeLang($this->str_mainhtmllangpath));

      $tpl->assign(array('V_STROPTION'    => $FN->getComboHtml($FN->getWebLangAry(), D_LANGCODE),
                         'V_SESSIONKEY'   => D_SESSIONKEY_USRCHK,
                         'V_LOGINFAILMSG' => $ary_authdata['loginmsg'],
      ));

      $tpl->parse('F_'.$tplflag, $tplflag);
      $tpl->fastprint();
      exit;
    }
    // -------------------------------------------------------------------------
    
    
    if ($_REQUEST['po']=="logout") {
      $this->_AdminLogout();
      exit;
    }

    $this->_RunProgram();
    exit;
  }
  
  
  
  /*****************************************************************************
   * HTML Page Admin Header
   *
   *  @param str $str_htmlcode : HTML code string insert to Main HTML
   *
   *  @return HTML code
   *  @access public
   ****************************************************************************/

  function ADHeaderPage($str_htmlcode="")
  {
    $FN = $this->FN;
    $ary_lang = $FN->mergeLang($this->str_mainhtmllangpath);


    // -- get HTML code --------------------------------------------------------
    $tplflag = 'adheader';
    $tpl = $FN->tpl("mainhtml/".D_THEMEPATH, $tplflag, $tplflag.'.html');
    $tpl->assign($ary_lang);
    // -------------------------------------------------------------------------


    $tpl->assign(array('V_LEFTHTML'   => $this->_LeftMenu($ary_lang),
                       'V_CENTERHTML' => $str_htmlcode,
                       'V_RIGHTHTML'  => $this->_RightMenu($ary_lang),
                       'V_SERVERTIME' => $FN->ShowTime(14),
                       'V_THEMEPATH'  => D_THEMEPATH,
    ));
    
    $tpl->parse('F_'.$tplflag, $tplflag);
    $tpl->fastprint();
    $tpl->clear_all();
  }



  /*****************************************************************************
   * Left Menu
   *
   *  @return HTML code
   *  @access private
   ****************************************************************************/

  function  _LeftMenu($ary_lang="")
  {
    return null;
  }



  /*****************************************************************************
   * Right Menu
   *
   *  @return HTML code
   *  @access private
   ****************************************************************************/

  function  _RightMenu($ary_lang="")
  {
    return null;
  }

  
  
  /*****************************************************************************
   * Admin Login Check Check start
   *
   *  need import 'class/classlogin/adminlogin.php'
   *
   *  @param array or str $ad  : FORM HTML PARAM, is adminID and adminPSD or String 'login'
   *
   *  @return boolen
   *  @access private
   ****************************************************************************/

  function _AuthChk($ary_fmdata="")
  {
    $FN = $this->FN;
    $DB = $FN->DBMY();
    $ary_rs =array();
    $ary_rs['auth'] = false;

    //var_dump(D_SESSIONKEY_ADCHK);
    // -- chk _SESSION data ----------------------------------------------------
    if ($_SESSION[D_SESSIONKEY_ADCHK]['auth'] == true) {
      $ary_rs['auth'] = true;
      return $ary_rs;
    }
    // -------------------------------------------------------------------------


    // -- chk Login Data -------------------------------------------------------
    $sql = " SELECT adminid AS id, adminpsd AS psd FROM webcfg ".
           " WHERE adminid='".$ary_fmdata['acc']."' ".
           " AND adminpsd='".$ary_fmdata['psd']."' ";

    $ary_rs = $DB->get_row($sql, ARRAY_A);
    $ary_rs['auth'] = ($ary_rs['id']<>"") ? true : false;

    if ($ary_rs['auth']==true) {
      while ( list($str_key, $str_val) = each($ary_rs) )
        $_SESSION[D_SESSIONKEY_ADCHK][$str_key] = $str_val;

      $_SESSION[D_SESSIONKEY_ADCHK]['auth'] = true;
      $ary_rs['loginmsg'] = null;
    }
    else {
      $ary_rs['loginmsg'] = isset($_SESSION[D_SESSIONKEY_ADCHK]['auth'])
                          ? $FN->TLANG('login failure msg') : null;
                          
      $_SESSION[D_SESSIONKEY_ADCHK]['auth'] = false;
    }
    // -------------------------------------------------------------------------


    return $ary_rs;
  }



  /*****************************************************************************
   * Admin Login OUT
   *
   *  @return proc
   *  @access private
   ****************************************************************************/

  function _AdminLogout($logoutmsg="")
  {
    $FN = $this->FN;
    $str_url = "admin.php";
    $logoutmsg = $logoutmsg=="" ? $FN->TLANG('logout msg') : $logoutmsg ;

    session_unset();

    $FN->GoUrl($str_url, $logoutmsg, "3");
    exit;
  }
  
  
  
  /*****************************************************************************
   * Run Program (class method)
   *
   *  @param
   *
   *  @return void
   *  @access private
   ****************************************************************************/

  function _RunProgram()
  {
    $FN = $this->FN;
  
    $po = ( isset($_REQUEST['po']) and $_REQUEST['po']<>"" ) ? $_REQUEST['po'] : $this->str_defaultclass;
    $op = ( isset($_REQUEST['op']) ) ? $_REQUEST['op'] : "";

    if ( file_exists("admin/".$po."/".$po.".php") )
      require_once("admin/".$po."/".$po.".php");

    else {
      require_once("admin/".$this->str_defaultclass."/".$this->str_defaultclass.".php");
      $po = $this->str_defaultclass;
      $op = "";
    }

    $FN->ary_lang = $FN->mergeLang("admin/".$po."/lang/");
    
    new $po($op, $FN);
  }
  


}



/*******************************************************************************
 * Program Start
 ******************************************************************************/

new admin();



?>
