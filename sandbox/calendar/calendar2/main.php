<?php

/*******************************************************************************
 * Main Program
 *   all program start here
 *
 *                                                         created by Kevin Tang
 *                                                                    2005/10/13
 ******************************************************************************/


require_once("pri_function.php");


class main
{


  /*****************************************************************************
   * var property
   *
   *  @access private
   ****************************************************************************/

  var $FN;                                       // private, readonly
  var $str_defaultclass = "calendar";            // DEFAULT start class
  var $str_mainhtmllangpath = "mainhtml/lang/";  // private, readonly
  
  

  /*****************************************************************************
   * CONSTRUCTOR
   *
   ****************************************************************************/
 
  function main()
  {
    $this->FN = new pri_function();

    $this->_RunProgram();
    exit;
  }
  
  
  
  /*****************************************************************************
   * HTML Page Header
   *
   *  @param str $str_htmlcode : HTML code string insert to Main HTML
   *
   *  @return HTML code
   *  @access public
   ****************************************************************************/

  function HeaderPage($str_htmlcode="")
  {
    $FN = $this->FN;
    $ary_lang = $FN->mergeLang($this->str_mainhtmllangpath);


    // -- get HTML code --------------------------------------------------------
    $tplflag = 'header';
    $tpl = $FN->tpl("mainhtml/".D_THEMEPATH, $tplflag, $tplflag.'.html');
    $tpl->assign($ary_lang);
    // -------------------------------------------------------------------------


    $tpl->assign(array('V_LEFTHTML'   => $this->_LeftMenu($ary_lang),
                       'V_CENTERHTML' => $str_htmlcode,
                       'V_RIGHTHTML'  => $this->_RightMenu($ary_lang),
                       'V_WEBNAME'    => D_WEBNAME,
                       'V_TOPMSG'     => D_TOPMSG,
                       'V_FOOTMSG'    => D_FOOTMSG,
                       'V_WEBURL'     => D_WEBURL,
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

    if ( file_exists("program/".$po."/".$po.".php") )
      require_once("program/".$po."/".$po.".php");

    else {
      require_once("program/".$this->str_defaultclass."/".$this->str_defaultclass.".php");
      $po = $this->str_defaultclass;
      $op = "";
    }

    $FN->ary_lang = $FN->mergeLang("program/".$po."/lang/");
    
    new $po($op, $FN);
  }
  
  
  
}



/*******************************************************************************
 * Program Start
 ******************************************************************************/

new main();



?>
