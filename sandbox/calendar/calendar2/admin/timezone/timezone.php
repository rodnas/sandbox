<?php

/*******************************************************************************
 * Timezone manage
 *
 *                                                              created by Kevin
 *                                                                    2004/05/26
 ******************************************************************************/


if ($_SERVER["SCRIPT_FILENAME"]<>D_ADMINFILENAME)
  exit;


class timezone extends admin
{


  /*****************************************************************************
   * var property
   *
   *  @access
   ****************************************************************************/

  var  $FN,
       $str_programpath = "admin/timezone";  // private, readonly



  /*****************************************************************************
   * CONSTRUCTOR
   *
   *  @param str $str_act : this class use method when recive $_REQUEST
   *  @param obj $obj_FN  : the $FN object
   *
   *  @return HTML code or others
   *  @access protected
   ****************************************************************************/

  function timezone($str_act, $obj_FN)
  {
    $this->FN = $obj_FN;

    $str_method = ( !method_exists($this, $str_act) ) ? "timezone_main" : $str_act;
    $this->$str_method();
  }



  /*****************************************************************************
   * Main page
   *
   *  @return str : HTML code
   *  @access : protected
   ****************************************************************************/

  function timezone_main()
  {
    $FN = $this->FN;
    $DB = $FN->DBMY();


    // -- get data HTML code ---------------------------------------------------
    $tplflag = "timezone_main";
    $tpl = $FN->tpl($this->str_programpath, $tplflag, $tplflag.".html");
    $tpl->assign($FN->ary_lang);
    // -------------------------------------------------------------------------
    

    $int_timezone = $DB->get_var(" SELECT timezone FROM webcfg WHERE id='0' ");
    $tpl->assign(array('V_CURRTIME' => $FN->ShowTime(14),
    ));
    

    // -- make Time Combox HTNL Code -------------------------------------------
    $tpl->define_dynamic('TABLE1', $tplflag);

    for ($i=-12; $i<=12; $i++) {
      $tpl->assign(array('V_TIMEVALUE' => $i,
                         'V_TIME'      => $FN->obj_fmdate->GetDateTime(14, "", $i),
                         'V_CHK'       => ($i==$int_timezone) ? "SELECTED" : "",
      ));
      $tpl->parse('ROW1', '.TABLE1');
    }
    // -------------------------------------------------------------------------
    

    $tpl->parse('F_'.$tplflag, $tplflag);
    $ary_rs = array('title'   => $FN->TLANG('timezone manage'),
                    'content' => $tpl->fetch(),
    );

    $FN->JavaHeaderPage($ary_rs);
  }



  /*****************************************************************************
   * Edit save to DB
   *
   *  @return : proc
   *  @access private
   ****************************************************************************/

  function timezone_editsave()
  {
    $FN = $this->FN;
    $DB = $FN->DBMY();
    $timezone = $_REQUEST['timezone'];

    $DB->query(" UPDATE webcfg SET timezone=".$timezone." WHERE id='0' ");
    
    $FN->GoURL("admin.php?po=timezone", $FN->TLANG('update data completed'), "3");
  }



}



?>
