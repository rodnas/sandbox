<?php

/*******************************************************************************
 * Calendar main page
 *
 *                                                              created by Kevin
 *                                                                    2004/12/03
 ******************************************************************************/


if ($_SERVER["SCRIPT_FILENAME"]<>D_MAINFILENAME)
  exit;


class calendar extends main
{


  /*****************************************************************************
   * var property
   *
   *  @access
   ****************************************************************************/

  var  $FN,
       $str_programpath = "program/calendar";  // private, readonly



  /*****************************************************************************
   * CONSTRUCTOR
   *
   *  @param str $str_act : this class use method when recive $_REQUEST
   *  @param obj $obj_FN  : the $FN object
   *
   *  @return HTML code or others
   *  @access protected
   ****************************************************************************/

  function calendar($str_act, $obj_FN)
  {
    $this->FN = $obj_FN;
    $str_method = ( !method_exists($this, $str_act) ) ? "calendar_main" : $str_act;
    $this->$str_method();
  }



  /*****************************************************************************
   * Calendar Main page
   *
   *  @returm str : HTML code
   *  @access protected
   ****************************************************************************/

  function calendar_main()
  {
    $FN = $this->FN;
    $DB = $FN->DBMY();
    $fm_data = $_REQUEST['fm_data'];
    

    // -- for week sort use, index key start and end ---------------------------
    $int_loopstart = 0;
    $int_loopend   = 6;
    
    if (D_STARTMONDAY == true) {
      $int_loopstart = 1;
      $int_loopend   = 7;
    }
    // -------------------------------------------------------------------------
    

    // -- chk calendar datetime ------------------------------------------------
    $str_currdate = ( !eregi("[0-9]{6}", $fm_data['datetime']) )
                  ? $FN->ShowTime("6d") : $fm_data['datetime'];
    // -------------------------------------------------------------------------
    

    // -- get data HTML code ---------------------------------------------------
    $tplflag = "calendar_main";
    $tpl = $FN->tpl($this->str_programpath, $tplflag, $tplflag.".html");
    $tpl->assign($FN->ary_lang);
    
    $tpl->assign(array('V_CURRDATE' => $FN->getMonthName(substr($str_currdate, -2))." ".
                                       substr($str_currdate, 0, 4)

    ));
    // -------------------------------------------------------------------------


    // --make YearMonth Select ComboList ---------------------------------------
    $sql = " SELECT MAX(datetime) AS maxdate, MIN(datetime) AS mindate FROM data ";
    $ary_maxmindate = $DB->get_row($sql, ARRAY_A);
    
    $str_maxYM = substr($ary_maxmindate['maxdate'], 0, 6);
    if ( $str_maxYM < $FN->ShowTime("6d") )
      $str_maxYM = $FN->ShowTime("6d");

    $str_minYM = substr($ary_maxmindate['mindate'], 0, 6);

    $tpl->define_dynamic('TABLE1', $tplflag);

    $str_loopYM = $str_maxYM;
    
    $sql = " SELECT COUNT(id) AS nums, year, mon FROM data GROUP BY year, mon ";
    $ary_rs = $DB->get_results($sql, ARRAY_A);
    $ary_yymm = array();

    foreach ($ary_rs as $ary_row) {
      $str_key = $ary_row['year'].sprintf("%02d", $ary_row['mon']);
      $ary_yymm[$str_key] = $ary_row['nums'];
    }
    
    while ($str_loopYM >= $str_minYM) {

      $tpl->assign(array('V_DATETIME'     => $str_loopYM,
                         'V_DATETIMELIST' => $FN->ShowTime("6", $str_loopYM),
                         'V_SELECT'       => ($str_loopYM == $str_currdate) ? "SELECTED" : "",
                         'V_TOTNUMS'      => (isset($ary_yymm[$str_loopYM])) ? $ary_yymm[$str_loopYM] : 0,
      ));
      $tpl->parse('ROW1', '.TABLE1');
      
      $str_year = substr($str_loopYM, 0, 4);
      $str_mon  = substr($str_loopYM, -2, 2);

      $Xtime = mktime(1, 1, 1, ($str_mon - 1 ), 1, $str_year);
      $str_loopYM = date("Ym", $Xtime);
    }
    // -------------------------------------------------------------------------


    // -- get the Calendar Array -----------------------------------------------
    $ary_calendar = $this->_getCalendarAry($str_currdate);
    // -------------------------------------------------------------------------
    
    
    // -- make Calendar head week html code ------------------------------------
    $tpl->define_dynamic('TABLE2', $tplflag);
    
    $ary_week = array("sun", "mon", "tue", "wed", "thu", "fri", "sat", "sun");

    for ($i=$int_loopstart; $i<=$int_loopend; $i++) {
      $tpl->assign(array('V_WEEK' => $FN->TLANG($ary_week[$i]),
      ));

      $tpl->parse('ROW2', '.TABLE2');
    }
    // -------------------------------------------------------------------------
    
    
    // -- make Calendar HTML code ----------------------------------------------
    $tpl->define_dynamic('TABLE3', $tplflag);
    
    foreach ($ary_calendar as $ROW) {
      $str_htmlcode = "";
      
      for ($i=$int_loopstart; $i<=$int_loopend; $i++) {
        $int_ROWdata = (isset($ROW[$i])) ? $ROW[$i] : null;
        $str_htmlcode .= $this->_getDataHtml($int_ROWdata, $str_currdate);
      }
      
      $tpl->assign(array('V_DATEHTMLDATA' => $str_htmlcode,
      ));
      
      $tpl->parse('ROW3', '.TABLE3');
    }
    // -------------------------------------------------------------------------


    $tpl->parse('F_'.$tplflag, $tplflag);
    $this->HeaderPage($tpl->fetch());
    $tpl->clear_all();
  }



  /*****************************************************************************
   * Get the Calendar Array ( only for calendar_main() use )
   *
   *  @param str $str_currdate : like '200410'
   *
   *  @returm array
   *  @access private
   ****************************************************************************/

  function _getCalendarAry($str_currdate)
  {
    $FN = $this->FN;
    $int_row      = 0;
    $int_currdate = 1;
    $int_lastWeek = (D_STARTMONDAY == true) ? 7 : 6;
    $str_weektype = (D_STARTMONDAY == true) ? "N" : "w";
    
    $ary_claendar = array();
    $str_year     = substr($str_currdate, 0, 4);
    $str_mon      = substr($str_currdate, -2, 2);
    $int_DateNums = $FN->getMonthDays(($str_mon)*1, ($str_year)*1);

    while ($int_currdate <= $int_DateNums) {
      $flag = 0;
      
      while ($flag == 0) {
        $int_week = $FN->ShowTime($str_weektype, $str_currdate.sprintf("%02d", $int_currdate));
        $ary_claendar[$int_row][$int_week] = $int_currdate;
        $int_currdate += 1;
        
        if ($int_currdate > $int_DateNums)
          break;

        if ($int_week == $int_lastWeek)
         $flag = 1;
      }
      
      $int_row++;
    }

    return $ary_claendar;
  }
  
  
  
  /*****************************************************************************
   * Get the Date HTML Code ( only for calendar_main() use )
   *
   *  @param str $str_date     : the date number
   *  @param str $str_currdate : like 200410
   *
   *  @returm HTML code
   *  @access private
   ****************************************************************************/

  function _getDataHtml($str_date="", $str_currdate)
  {
    $FN = $this->FN;
    $DB = $FN->DBMY();
    
    $tplflag = 'tpl_calendar_main_HTML';
    

    // -- if date is NULL ------------------------------------------------------
    if ($str_date=="") {
      $tpl = $FN->tpl('program/calendar', $tplflag, 'calendar_main_empty.html');
      $tpl->assign(array('V_EMPTY' => "",
      ));
      
      $tpl->parse('F_'.$tplflag, $tplflag);
      return $tpl->fetch();
      exit;
    }
    else
      $tpl = $FN->tpl('program/calendar', $tplflag, 'calendar_main_active.html');
    // -------------------------------------------------------------------------


    // -- make color -----------------------------------------------------------
    $int_week = strtolower(date("w", mktime(1, 1, 1, substr($str_currdate, -2, 2), $str_date, substr($str_currdate, 0, 4) ) ));

    // .. boxcolor, checkout style.css config ..................................
    if     ($int_week == 0)  $str_color = "boxcolor_sunday";
    elseif ($int_week == 6)  $str_color = "boxcolor_saturday";
    else                     $str_color = "boxcolor_active";
    // .........................................................................
    
    $tpl->assign(array('V_DATE'  => $str_date,
                       'V_COLOR' => $str_color,
    ));
    // -------------------------------------------------------------------------


    // -- get the date Title ---------------------------------------------------
    $sql = " SELECT id, title FROM data WHERE datetime='".$str_currdate.sprintf("%02d", $str_date)."' ";

    $RS = $DB->get_results($sql, ARRAY_A);
    
    if ( count($RS) > 0 ) {
      $tpl->define_dynamic('TABLE1', $tplflag);

      $str_year = substr($str_currdate, 0, 4);
      $str_mon  = substr($str_currdate, -2, 2);

      foreach ($RS as $ROW) {
        $tpl->assign(array('V_TITLE' => $FN->CodeWd($ROW['title'], "", "br", ""),
                           'V_ID'    => $ROW['id'],
                           'V_LI'    => "*",
        ));
        $tpl->parse('ROW1', '.TABLE1');
      }
    }
    // -------------------------------------------------------------------------
    

    $tpl->parse('F_'.$tplflag, $tplflag);
    return $tpl->fetch();
  }
  
  
  
  /*****************************************************************************
   * Calendar data only HTML
   *
   *  @return str : HTML code
   *  @access private
   ****************************************************************************/

  function calendar_only()
  {
    $FN = $this->FN;
    $DB = $FN->DBMY();
    $fm_data = $_REQUEST['fm_data'];
    
    
    // -- chk if have any data -------------------------------------------------
    $ROW = $DB->get_row(" SELECT * FROM data WHERE id='".$fm_data['id']."' ", ARRAY_A);
    if ( $ROW == "" ) {
      exit;
    }
    // -------------------------------------------------------------------------


    $T_data = array('title' => $FN->TLANG('calendar'));
    $this->FN->JavaHeaderPage($T_data);

    $tplflag = 'calendar_only';
    $tpl = $FN->tpl("program/calendar", $tplflag, $tplflag.'.html');


    // -- DB data ROW ----------------------------------------------------------
    $tpl->assign(array('V_TITLE'   => $FN->CodeWd($ROW['title'], "", "br", ""),
                       'V_CONTENT' => $FN->CodeWd($ROW['content'], "", "br", ""),
                       'V_SENDER'  => $FN->CodeWd($ROW['sender'], "", "nohtml", ""),
                       'V_DATE'    => $FN->ShowTime("8", $ROW['datetime']),
    ));
    // -------------------------------------------------------------------------


    $tpl->parse('F_'.$tplflag, $tplflag);
    $this->FN->JavaHeaderPage( $tpl->fastprint() );
  }

  

}



?>
