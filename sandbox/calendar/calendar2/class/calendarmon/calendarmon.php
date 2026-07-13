<?php

/*******************************************************************************
 * Calendar
 *  Return the number of days in a month for a given year and calendar
 *
 *                                                              created by Kevin
 *                                                                    2004/12/18
 ******************************************************************************/



class calendarmon
{

  /*****************************************************************************
   * CONSTRUCTOR calendarmon
   ****************************************************************************/


  /*
  function calendarmon()
  {

  }
  */
  
  

  /*****************************************************************************
   * cal_days_in_month
   *
   *  @param int $mon  : the month digit, exp: MAR = 3
   *  @param int $year : the year digit, exp: 2004
   *
   *  @return int
   *  @access public
   ****************************************************************************/
   
  function NumDays_Month($mon, $year)
  {
    if ( ($mon >= 1 and $mon <= 12) and $mon <> 2  ) {
      return $this->_nums_Month_($mon);
      exit;
    }
  
    if ( $mon == 2 ) {
      return checkdate($mon, 29, $year) ? 29 : 28 ;
      exit;
    }

    return 0;
  }
  
  
  
  /*****************************************************************************
   * default number of days in a month (execpt FEB)
   *
   *  @param int $mon : the month digit, exp: MAR = 3
   *
   *  @return int
   *  @access private
   ****************************************************************************/

  function _nums_Month_($mon)
  {
    $ary_mon = array( 1 => 31,
                      3 => 31,
                      4 => 30,
                      5 => 31,
                      6 => 30,
                      7 => 31,
                      8 => 31,
                      9 => 30,
                      10 => 31,
                      11 => 30,
                      12 => 31
    );

    return $ary_mon[$mon];
  }
  
    

}



?>
