<?php

/*******************************************************************************
 * Admin Calendar main page
 *
 *                                                              created by Kevin
 *                                                                    2005/10/17
 ******************************************************************************/


if ($_SERVER["SCRIPT_FILENAME"]<>D_ADMINFILENAME)
  exit;


class adcalendar extends admin
{


  /*****************************************************************************
   * var property
   *
   *  @access
   ****************************************************************************/

  var  $FN,
       $str_programpath = "admin/adcalendar";  // private, readonly
       
       

  /*****************************************************************************
   * CONSTRUCTOR
   *
   *  @param str $str_act : this class use method when recive $_REQUEST
   *  @param obj $obj_FN  : the $FN object
   *
   *  @return HTML code or others
   *  @access protected
   ****************************************************************************/

  function adcalendar($str_act, $obj_FN)
  {
    $this->FN = $obj_FN;

    $str_method = ( !method_exists($this, $str_act) ) ? "adcalendar_main" : $str_act;
    $this->$str_method();
  }



  /*****************************************************************************
   * Main page
   *
   *  @return str : HTML code
   *  @access protected
   ****************************************************************************/

  function adcalendar_main()
  {
    $FN = $this->FN;
    $DB = $FN->DBMY();
    $fm_data = $_REQUEST['fm_data'];

    
    // -- chk have any data & calendar date ------------------------------------
    $sql = " SELECT COUNT(id) AS nums, year, mon, datetime FROM data ".
           " GROUP BY year, mon ORDER BY datetime DESC ";
           
    $ary_monthdata = $DB->get_results($sql, ARRAY_A);
    
    if ( count($ary_monthdata) < 1 ) {
      $str_url = "admin.php?po=adcalendar&op=adcalendar_add";
      $FN->GoUrl($str_url, $FN->TLANG('no data'), "3");
      exit;
    }
    
    $int_nums = ( eregi("[0-9]{6}", $fm_data['datetime']) )
              ? $DB->get_var(" SELECT COUNT(*) FROM data ".
                             " WHERE datetime LIKE '".$fm_data['datetime']."%' ")
              : 0;

    $str_localtime = ($int_nums<1)
                   ? substr($DB->get_var(" SELECT datetime FROM data ORDER BY datetime DESC LIMIT 1 "), 0, 6)
                   : $fm_data['datetime'];
    // -------------------------------------------------------------------------


    // -- get data HTML code ---------------------------------------------------
    $tplflag = "adcalendar_main";
    $tpl = $FN->tpl($this->str_programpath, $tplflag, $tplflag.".html");
    $tpl->assign($FN->ary_lang);
    
    $tpl->assign(array('V_CURRDATE' => $FN->ShowTime("6", $str_localtime, 0),
    ));
    // -------------------------------------------------------------------------


    // -- make YearMon Select ComboList ----------------------------------------
    $tpl->define_dynamic('TABLE1', $tplflag);

    foreach ($ary_monthdata as $ROW) {
      $tpl->assign(array('V_VALUEDATE'    => substr($ROW['datetime'], 0, 6),
                         'V_DATETIMELIST' => $FN->ShowTime("6", $ROW['datetime'], 0),
                         'V_SELECT'       => (substr($str_localtime, 0, 6) == substr($ROW['datetime'], 0 , 6))
                                             ? "SELECTED" : "",
                         'V_TOTNUMS'      => $ROW['nums'],
      ));
      $tpl->parse('ROW1', '.TABLE1');
    }
    // -------------------------------------------------------------------------


    // -- make Target DATE Calendar LIST HTML code -----------------------------
    $str_yer = substr($str_localtime, 0, 4);
    $str_mon = substr($str_localtime, 4, 2);

    $int_DateNums = $FN->getMonthDays(($str_mon)*1, ($str_yer)*1);
    
    $tpl->define_dynamic('TABLE2', $tplflag);

    for ($i=1; $i<=$int_DateNums; $i++) {
      $int_week = date("w", mktime(1, 1, 1, $str_mon, $i, $str_yer));

      $str_datetime = $str_yer.$str_mon.$curr_date.sprintf("%02d", $i);

      if     ($int_week == 0)  $str_color = "#F5BABB";
      elseif ($int_week == 6)  $str_color = "#D6E4A0";
      else                     $str_color = "WHITE";

      $tpl->assign(array('V_DATE'     => $i,
                         'V_WEEK'     => $FN->getWeekName($int_week),
                         'V_CONTENT'  => $this->_getDateTitle($str_datetime),
                         'V_COLOR'    => $str_color,
                         'V_DATETIME' => $str_datetime,
      ));
      $tpl->parse('ROW2', '.TABLE2');
    }
    // -------------------------------------------------------------------------


    $tpl->parse('F_'.$tplflag, $tplflag);
    $this->ADHeaderPage($tpl->fetch());
  }
  
  
  
  /*****************************************************************************
   * get the Target date title data ( only for adcalendar_main() use )
   *
   *  @param str $str_date : like 20041203
   *
   *  @returm str : HTML code or NULL
   *  @access protected
   ****************************************************************************/

  function _getDateTitle($str_date="")
  {
    if ($str_date=="") {
      return null;
    }
    
    $FN = $this->FN;
    $DB = $FN->DBMY();
    
    $RS = $DB->get_results(" SELECT id, title FROM data ".
                           " WHERE datetime='".$str_date."' ", ARRAY_A);
                           
    if ( count($RS) < 1 ) {
      return null;
    }


    // -- get data HTML code ---------------------------------------------------
    $tplflag = "adcalendar_main_1";
    $tpl = $FN->tpl($this->str_programpath, $tplflag, $tplflag.".html");
    $tpl->assign($FN->ary_lang);
    // -------------------------------------------------------------------------


    // -- ROW data -------------------------------------------------------------
    $tpl->define_dynamic('TABLE1', $tplflag);

    foreach ($RS as $ROW) {
      $tpl->assign(array('V_ID'    => $ROW['id'],
                         'V_TITLE' => $FN->CodeWD($ROW['title'], "", "nohtml"),
      ));
      $tpl->parse('ROW1', '.TABLE1');
    }
    // -------------------------------------------------------------------------

    
    $tpl->parse('F_'.$tplflag, $tplflag);
    return $tpl->fetch();
  }
  
  
  
  /*****************************************************************************
   * Add data
   *
   *  @return str : HTML code
   *  @access protected
   ****************************************************************************/

  function adcalendar_add()
  {
    $FN = $this->FN;
    $fm_data = $_REQUEST['fm_data'];


    // -- get data HTML code ---------------------------------------------------
    $tplflag = "adcalendar_add";
    $tpl = $FN->tpl($this->str_programpath, $tplflag, $tplflag.".html");
    $tpl->assign($FN->ary_lang);
    // -------------------------------------------------------------------------


    // -- ROW data -------------------------------------------------------------
    $str_date = $FN->ShowTime("8", $fm_data['datetime'].sprintf("%02d", $fm_data['date']));

    $tpl->assign(array('V_DATETIME'   => $fm_data['datetime'],
                       'V_DATE'       => $fm_data['date'],
                       'V_MINDATE'    => D_DEFAULTMINSDATE,
                       'V_MAXDATE'    => D_DEFAULTMAXEDATE,
                       'V_MINDATESTR' => $FN->ShowTime("6", D_DEFAULTMINSDATE),
                       'V_MAXDATESTR' => $FN->ShowTime("6", D_DEFAULTMAXEDATE),
                       'V_DATELIST'   => $str_date,
                       'V_SPANKEYIN'  => $fm_data['datetime']<>"" ? "" : "none",
    ));
    // -------------------------------------------------------------------------


    $tpl->parse('F_'.$tplflag, $tplflag);
    $this->ADHeaderPage($tpl->fetch());
  }



  /*****************************************************************************
   * New data save to DB
   *
   *  @return str : HTML code
   *  @access private
   ****************************************************************************/

  function adcalendar_addsave()
  {
    $FN = $this->FN;
    $DB = $FN->DBMY();
    $fm_data = $_POST['fm_data'];

    
    // -- get datetime ---------------------------------------------------------
    if ( $fm_data['inputdatetime']<>"" ) {
      $ary_date = explode("-", $fm_data['inputdatetime']);  // dd-mm-yyyy
      $fm_data['datetime'] = $ary_date[2].sprintf("%02d", $ary_date[1]).sprintf("%02d", $ary_date[0]);
      $fm_data['date'] = sprintf("%02d", $ary_date[0]);
    }
    // -------------------------------------------------------------------------


    // -- insert data ----------------------------------------------------------
    $int_rnak = ($fm_data['rank']=="") ? 0 : $fm_data['rank'] ;
    $int_year = substr($fm_data['datetime'], 0 , 4);
    $int_mon  = substr($fm_data['datetime'], 4 , 2);
    $str_datetime = $fm_data['datetime'].sprintf("%02d", $fm_data['date']);

    $sql = " INSERT INTO data SET                  ".
           " title    = '".$fm_data['title']."'   ,".
           " content  = '".$fm_data['content']."' ,".
           " year     = '".$int_year."'           ,".
           " mon      = '".$int_mon."'            ,".
           " date     = '".$fm_data['date']."'    ,".
           " datetime = '".$str_datetime."'       ,".
           " sender   = '".$fm_data['sender']."'  ,".
           " rank     = '".$int_rnak."'            ";

    $DB->query($sql);
    // -------------------------------------------------------------------------
    

    $str_url = "admin.php?po=adcalendar&op=adcalendar_main&fm_data[datetime]=".$fm_data['datetime'];
    $FN->GoUrl($str_url, $FN->TLANG('data add completed'), "3");
    exit;
  }
  
  
  
  /*****************************************************************************
   * Dea & Edit HTML page
   *
   *  @return str : HTML code
   *  @access private
   ****************************************************************************/

  function adcalendar_deledit()
  {
    $FN = $this->FN;
    $DB = $FN->DBMY();
    $fm_data = $_REQUEST['fm_data'];


    // -- get data HTML code ---------------------------------------------------
    $tplflag = "adcalendar_deledit";
    $tpl = $FN->tpl($this->str_programpath, $tplflag, $tplflag.".html");
    $tpl->assign($FN->ary_lang);
    // -------------------------------------------------------------------------


    // -- ROW data -------------------------------------------------------------
    $ROW = $DB->get_row(" SELECT * FROM data WHERE id='".$fm_data['id']."' ", ARRAY_A);

    $str_date = $FN->ShowTime("8", $ROW['datetime']);
    
    $tpl->assign(array('V_TITLE'    => $ROW['title'],
                       'V_CONTENT'  => $ROW['content'],
                       'V_RANK'     => $ROW['rank'],
                       'V_SENDER'   => $ROW['sender'],
                       'V_DATETIME' => substr($ROW['datetime'], 0, 6),
                       'V_DATELIST' => $str_date,
                       'V_ID'       => $fm_data['id'],
    ));
    // -------------------------------------------------------------------------


    $tpl->parse('F_'.$tplflag, $tplflag);
    $this->ADHeaderPage($tpl->fetch());
  }
  
  
  
  /*****************************************************************************
   * Del & Edit data save to DB
   *
   *  @return str : HTML code
   *  @access private
   ****************************************************************************/

  function adcalendar_deleditsave()
  {
    $FN = $this->FN;
    $DB = $FN->DBMY();
    $fm_data = $_POST['fm_data'];

    
    // -- del data -------------------------------------------------------------
    if ($fm_data['del']=="Y") {
      $DB->query(" DELETE FROM data WHERE id='".$fm_data['id']."' ");
      $DB->query(" OPTIMIZE TABLE data ");
      
      $str_url = "admin.php?po=adcalendar&op=adcalendar_main&fm_data[datetime]=".$fm_data['datetime'];
      $FN->GoUrl($str_url, $FN->TLANG('del data completed'), "3");
      exit;
    }
    // -------------------------------------------------------------------------
    

    // -- update data ----------------------------------------------------------
    $sql = " UPDATE data SET                       ".
           " title    = '".$fm_data['title']."'   ,".
           " content  = '".$fm_data['content']."' ,".
           " sender   = '".$fm_data['sender']."'  ,".
           " rank     = '".$fm_data['rank']."'     ".
           " WHERE id = '".$fm_data['id']."'       ";

    $DB->query($sql);
    // -------------------------------------------------------------------------

    
    $str_url = "admin.php?po=adcalendar&op=adcalendar_deledit&fm_data[id]=".$fm_data['id'];
    $FN->GoUrl($str_url, $FN->TLANG('update data completed'), "3");
    exit;
  }



}



?>
