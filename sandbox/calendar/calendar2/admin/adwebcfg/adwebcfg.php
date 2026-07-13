<?php

/*******************************************************************************
 * Admin Webconfig
 *
 *                                                              created by Kevin
 *                                                                    2004/12/30
 ******************************************************************************/


if ($_SERVER["SCRIPT_FILENAME"]<>D_ADMINFILENAME)
  exit;
  
  
class adwebcfg extends admin
{


  /*****************************************************************************
   * var property
   *
   *  @access
   ****************************************************************************/

  var  $FN,
       $str_programpath = "admin/adwebcfg";  // private, readonly



  /*****************************************************************************
   * CONSTRUCTOR
   *
   *  @param str $str_act : this class use method when recive $_REQUEST
   *  @param obj $obj_FN  : the $FN object
   *
   *  @return HTML code or others
   *  @access protected
   ****************************************************************************/

  function adwebcfg($str_act, $obj_FN)
  {
    $this->FN = $obj_FN;

    $str_method = ( !method_exists($this, $str_act) ) ? "adwebcfg_main" : $str_act;
    $this->$str_method();
  }



  /*****************************************************************************
   * Main page
   *
   *  @return str : HTML code
   *  @access : protected
   ****************************************************************************/

  function adwebcfg_main()
  {
    $FN = $this->FN;
    $DB = $FN->DBMY();


    // -- get data HTML code ---------------------------------------------------
    $tplflag = "adwebcfg_main";
    $tpl = $FN->tpl($this->str_programpath, $tplflag, $tplflag.".html");
    $tpl->assign($FN->ary_lang);
    // -------------------------------------------------------------------------


    // -- get Target DB data ---------------------------------------------------
    $sql = " SELECT * FROM webcfg WHERE id='0' ";
    $ROW = $DB->get_row($sql, ARRAY_A);
    // -------------------------------------------------------------------------
    
    
    // -- read the LANG directory and make HTML code ---------------------------
    $ary_langdesp = $FN->getMultiLangAry();
    $obj_dir = opendir(D_MAINLANGPATH);
    $ary_lang = array();

    while ( false !== ($str_file = readdir($obj_dir)) ) {
      if ($str_file != "." && $str_file != "..") {
        $str_key = eregi_replace('.txt', "", $str_file);
        $ary_lang[$str_key] = $ary_langdesp[$str_key];
      }
    }
    
    closedir($obj_dir);
    // -------------------------------------------------------------------------
    

    // -- THEME, read the mainhtml directory and make HTML code ----------------
    $obj_dir = opendir('mainhtml');
    $ary_theme = array();
    
    while ( false !== ($str_file = readdir($obj_dir)) ) {
      if ($str_file != "." && $str_file != ".." && $str_file<>"lang")
        $ary_theme[$str_file] = strtoupper($str_file);
    }
    
    closedir($obj_dir);
    // -------------------------------------------------------------------------


    // -- ROW data -------------------------------------------------------------
    $ary_datetype = $FN->obj_fmdate->getDateTypeAry();
    $str_chk1 = $str_chk2 = "";
    
    if ($ROW['firstweek']=="sun")  $str_chk1 = "checked";
    else                           $str_chk2 = "checked";

    $tpl->assign(array('V_NAME'      => $FN->CodeWd($ROW['webname'], "", "nohtml", ""),
                       'V_URL'       => $FN->CodeWd($ROW['weburl'], "", "nohtml", ""),
                       'V_EMAIL'     => $FN->CodeWd($ROW['adminemail'], "", "nohtml", ""),
                       'V_ADMINID'   => $FN->CodeWd($ROW['adminid'], "", "nohtml", ""),
                       'V_LANGSEL'   => $FN->getComboHtml($ary_lang, $ROW['langcode']),
                       'V_DATESEL'   => $FN->getComboHtml($ary_datetype, $ROW['datetype']),
                       'V_THEMESEL'  => $FN->getComboHtml($ary_theme, $ROW['theme']),
                       'V_INFO'      => $ROW['topmsg'],
                       'V_FOOTMSG'   => $ROW['footmsg'],
                       'V_SDATE'     => $ROW['calstartdate'],
                       'V_CHK1'      => $str_chk1,
                       'V_CHK2'      => $str_chk2,
    ));
    // -------------------------------------------------------------------------


    $tpl->parse('F_'.$tplflag, $tplflag);
    $this->ADHeaderPage($tpl->fetch());
  }



  /*****************************************************************************
   * Data Update to Save DB
   *
   *  @return : proc
   *  @access : protected
   ****************************************************************************/

  function adwebcfg_editsave()
  {
    $FN = $this->FN;
    $DB = $FN->DBMY();
    $fm_data = $_REQUEST['fm_data'];


    // -- check input data -----------------------------------------------------
    if ($fm_data=="") {
      $FN->GoUrl("admin.php", "", "0");
      exit;
    }
    // -------------------------------------------------------------------------


    // -- chk cal start date ---------------------------------------------------
    if ( $fm_data['s_date']=="" || $fm_data['s_date'] < D_DEFAULTMINSDATE or $fm_data['s_date'] > $FN->ShowTime("6d") )
      $fm_data['s_date'] = $FN->ShowTime("6d");
    // -------------------------------------------------------------------------
    

    // -- update data ----------------------------------------------------------
    $str_weburl = ( !eregi('http', $fm_data['site_url']) )
                ? "http://".$fm_data['site_url'] : $fm_data['site_url'];

    $sql = " UPDATE webcfg SET                                    ".
           " webname      = '".trim($fm_data['site_name'])."'    ,".
           " weburl       = '".$str_weburl."'                    ,".
           " adminemail   = '".trim($fm_data['site_email'])."'   ,".
           " langcode     = '".$fm_data['site_lang']."'          ,".
           " footmsg      = '".trim($fm_data['site_footmsg'])."' ,".
           " datetype     = '".$fm_data['datetype']."'           ,".
           " theme        = '".$fm_data['theme']."'              ,".
           " adminid      = '".trim($fm_data['adminid'])."'      ,".
           " firstweek    = '".$fm_data['firstweek']."'          ,".
           " topmsg       = '".trim($fm_data['site_info'])."'     ";
    $DB->query($sql);
    // -------------------------------------------------------------------------
    
    
    $FN->GoUrl("admin.php?po=adwebcfg&op=adwebcfg_main", $FN->TLANG('update data completed'), "3");
    exit;
  }



}



?>
