<?php

/*******************************************************************************
 * Format Date and Time Class
 *
 *                                                              created by Kevin
 *                                                                    2004/06/20
 *                                                                    2006/03/20
 ******************************************************************************/


class FormatDate
{


  /*****************************************************************************
   * var field
   *
   *  @access private
   ****************************************************************************/

  // .. string fields ALL ReadOnly ..
  var $str_fmttype,   // str : ex. yymmdd
      $timezone = 0,  // int : ex. 8 or -10
      $str_phpver;    // php version
      


  /*****************************************************************************
   * CONSTRUCTOR FormatDate
   *
   *  @param str $type : like ... 1. 'yymmdd'
   *                              2. 'ddmmyy'
   *                              3. 'mmddyy'
   *
   *  @param int $timezone : -12 ~ 12
   ****************************************************************************/

  function FormatDate($fmttype, $timezone="")
  {
    $this->fmttype  = $fmttype;
    $this->timezone = $timezone=="" ? $this->timezone : $timezone;
    $this->str_phpver = substr(phpversion(), 0, 3);
  }
  
  
  
  /*****************************************************************************
   * get DateTime type
   *
   *  @param str $type : like ... 1. 'yymmdd'
   *                              2. 'ddmmyy'
   *                              3. 'mmddyy'
   *
   *  @return ary
   *  @access public
   ****************************************************************************/

  function getDateTypeAry()
  {
    return array('yymmdd' => "YY/MM/DD",
                 'ddmmyy' => "DD/MM/YY",
                 'mmddyy' => "MM/DD/YY",
    );
  }
  


  /*****************************************************************************
   * GetDateTime result
   *
   *  @param str $type         : display format type
   *  @param str $thistime     : MAX 14, MIN 6 digits numbers
   *  @param int $int_timezone : Timezone if config here
   *
   *  @return string
   *  @access public
   ****************************************************************************/

  function GetDateTime($type="", $thistime="", $int_timezone="")
  {
    $str_time = ($thistime=="") ? gmdate("YmdHis", time()) : $thistime;
    $int_timezone = ($int_timezone<>"") ? $int_timezone : $this->timezone;
    $Xtime = $this->_getTimeStream($str_time, $int_timezone);

    if ($type=="") {
      return "$Y$M$D$h$m$s";
    }

    if ($type=="N") {
      return (substr($this->str_phpver, 0, 1) < 5 && date("w", $Xtime) == 0) ? 7 : date("w", $Xtime);
    }

    if ($type=="w") {
      return date("w", $Xtime);
    }

    if ( substr($type, -1, 1)=="d" ) {
      if     ($type=="14d") $rs = date("YmdHis", $Xtime);
      elseif ($type=="12d") $rs = date("YmdHi" , $Xtime);
      elseif ($type=="8d")  $rs = date("Ymd"   , $Xtime);
      elseif ($type=="6d")  $rs = date("Ym"    , $Xtime);
      else                  $rs = date("YmdHis", $Xtime);

      return $rs;
    }

    return $this->_LocalDate($type, $Xtime);
  }



  /*****************************************************************************
   * get Time Stream
   *
   *  @param str $thistime     : MAX 14, MIN 6 digits numbers
   *  @param int $int_timezone : Timezone if config here
   *
   *  @return stream
   *  @access private
   ****************************************************************************/

  function _getTimeStream($str_time="", $int_timezone="")
  {
    $Y = substr($str_time, 0, 4);
    $M = substr($str_time, 4, 2);
    $D = substr($str_time, 6, 2)<>""  ?  substr($str_time, 6, 2)  : "01" ;
    $h = substr($str_time, 8, 2)<>""  ?  substr($str_time, 8, 2)  : "01" ;
    $m = substr($str_time, 10, 2)<>"" ?  substr($str_time, 10, 2) : "01" ;
    $s = substr($str_time, 12, 2)<>"" ?  substr($str_time, 12, 2) : "01" ;

    return mktime( ($h + $int_timezone), $m, $s, $M, $D, $Y );
  }



  /*****************************************************************************
   * Get Local Date Time Format
   *
   *  @param str $type : display format type
   *  @param timeformat $Xtime : the formated time
   *
   *  @return string
   *  @access private
   ****************************************************************************/

  function _LocalDate($type, $Xtime)
  {
    switch($this->fmttype)
    {
      case "yymmdd":
        if     ($type=="8")   $rs = date("Y/m/d", $Xtime);
        elseif ($type=="6")   $rs = date("Y / m", $Xtime);
        elseif ($type=="12")  $rs = date("Y/m/d H:i", $Xtime);
        elseif ($type=="14")  $rs = date("Y/m/d H:i:s", $Xtime);
        elseif ($type=="YM")  $rs = date("y/m", $Xtime);
        else                  $rs = date("r", $Xtime);
        break;

      case "ddmmyy":
        if     ($type=="8")   $rs = date("d/m/Y", $Xtime);
        elseif ($type=="6")   $rs = date("m / Y", $Xtime);
        elseif ($type=="12")  $rs = date("d/m/Y H:i", $Xtime);
        elseif ($type=="14")  $rs = date("d/m/Y H:i:s", $Xtime);
        elseif ($type=="MY")  $rs = date("m/y", $Xtime);
        else                  $rs = date("r", $Xtime);
        break;

      case "mmddyy":
        if     ($type=="8")   $rs = date("m/d/Y", $Xtime);
        elseif ($type=="6")   $rs = date("m / Y", $Xtime);
        elseif ($type=="12")  $rs = date("m/d/Y H:i", $Xtime);
        elseif ($type=="14")  $rs = date("m/d/Y H:i:s", $Xtime);
        elseif ($type=="MY")  $rs = date("m/y", $Xtime);
        else                  $rs = date("r", $Xtime);
        break;

      default:
        if     ($type=="8")   $rs = date("Y/m/d", $Xtime);
        elseif ($type=="6")   $rs = date("Y / m", $Xtime);
        elseif ($type=="12")  $rs = date("Y/m/d H:i", $Xtime);
        elseif ($type=="14")  $rs = date("Y/m/d H:i:s", $Xtime);
        elseif ($type=="YM")  $rs = date("y/m", $Xtime);
        else                  $rs = date("r", $Xtime);
        break;
    }

    return $rs;
  }



}



?>
