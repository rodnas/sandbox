<?php

/*******************************************************************************
 * Admin Password manage
 *
 *                                                              created by Kevin
 *                                                                    2004/06/24
 ******************************************************************************/


if ($_SERVER["SCRIPT_FILENAME"]<>D_ADMINFILENAME)
  exit;
  

class adpasswd extends admin
{


  /*****************************************************************************
   * var property
   *
   *  @access
   ****************************************************************************/

  var  $FN,
       $str_programpath = "admin/adpasswd";  // private, readonly



  /*****************************************************************************
   * CONSTRUCTOR
   *
   *  @param str $str_act : this class use method when recive $_REQUEST
   *  @param obj $obj_FN  : the $FN object
   *
   *  @return HTML code or others
   *  @access protected
   ****************************************************************************/

  function adpasswd($str_act, $obj_FN)
  {
    $this->FN = $obj_FN;

    $str_method = ( !method_exists($this, $str_act) ) ? "adpasswd_main" : $str_act;
    $this->$str_method();
  }
  


  /*****************************************************************************
   * Main page
   *
   *  @return str : HTML code
   *  @access : protected
   ****************************************************************************/

  function adpasswd_main()
  {
    $FN = $this->FN;
    $DB = $FN->DBMY();


    // -- get data HTML code ---------------------------------------------------
    $tplflag = "adpasswd_main";
    $tpl = $FN->tpl($this->str_programpath, $tplflag, $tplflag.".html");
    $tpl->assign($FN->ary_lang);
    // -------------------------------------------------------------------------


    $tpl->parse('F_'.$tplflag, $tplflag);
    $ary_rs = array('title'   => $FN->TLANG('admin psd manage'),
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

  function adpasswd_editsave()
  {
    $FN = $this->FN;
    $DB = $FN->DBMY();
    $fm_data = $_REQUEST['fm_data'];
    $str_msg = $FN->TLANG('no data update');
    
    $RS_num = $DB->get_var(" SELECT COUNT(*) FROM webcfg WHERE adminpsd ='".$fm_data['opsd']."'  ");

    if ($RS_num<1 or $fm_data['psd']=="") {
      $FN->GoBack( $FN->TLANG('orgpsd or newpsd error') );
      exit;
    }

    if ($fm_data['psd']<>"") {
      $DB->query(" UPDATE webcfg SET adminpsd ='".$fm_data['psd']."' WHERE id='0' ");
      $str_msg = $FN->TLANG('update data completed');
    }

    $FN->GoUrl("admin.php?po=adpasswd&op=adpasswd_main", $str_msg, "3");
    exit;
  }
  


}



?>
