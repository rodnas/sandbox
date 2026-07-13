<?php

/*******************************************************************************
 * Page Jump class
 *
 *  this class will return HTML code,
 *  like prep, next ICON link, combo list
 *
 *  ?? how to use ??
 *  1. require_once this program
 *  2. make object : $obj_page = new PageJump(120, 10, 0, 'FormFieldName');
 *  3. so we can use this object ...
 *     ex: the next page number = $obj_page->int_nextpage
 *         the last page number or total page nums = $obj_page->int_lastpage
 *         current page number = $obj_page->pageno
 *
 *                                                                    2003/09/01
 *                                                             update 2005/05/26
 ******************************************************************************/



class pagejump
{


  /*****************************************************************************
   * var field
   *
   *  @access private, readonly
   ****************************************************************************/

  var $int_totnums,
      $int_pagesize,
      $int_lastpage,
      $int_firstpage,
      $int_flag,
      $int_nextflag,
      $int_preflag,
      $int_prepage,
      $int_nextpage,
      $int_currpage,
      $str_formfieldname,
      
      $str_preicon  = "class/pagejump/preicon.gif",
      $str_nexticon = "class/pagejump/nexticon.gif";
      
      

  /*****************************************************************************
   *  CONSTRUCTOR PageJump
   *
   *  @param int $int_nums         : total numbes of data
   *  @param int $int_pgsize       : pagesize
   *  @param int $int_flag         : the flag use in SQL strin
   *  @param string $str_fieldname : in request display name
   *
   *  @return
   *  @access public
   ****************************************************************************/

  function PageJump($int_nums, $int_pgsize=5, $int_flag=0, $str_fieldname="flagnum")
  {
  
  
    // -- chk data nums, failure EXIT ------------------------------------------
    if ($int_nums<1) {
      echo "Class PageJump error : data nums < 1";
      exit;
    }
    
    if ($int_pgsize < 1)
      $int_pgsize = 5;
    // -------------------------------------------------------------------------
    
  
    // -- set totnums last, first ----------------------------------------------
    $this->int_totnums   = $int_nums;
    $this->int_pagesize  = $int_pgsize;
    $this->int_lastpage  = ceil($int_nums/$int_pgsize);
    $this->int_firstpage = 1;
    // -------------------------------------------------------------------------
    

    // -- set Flag -------------------------------------------------------------
    if ($int_flag < 1)
      $int_flag = 0;
      
    if     ( ($int_flag % $int_pgsize)<>0 or $int_flag < 0 )  $this->int_flag = 0;
    elseif ( $int_flag > ($int_nums -1) )                     $this->int_flag = $int_pgsize*($this->int_lastpage - 1);
    else                                                      $this->int_flag = $int_flag;
    // -------------------------------------------------------------------------
    
    
    // -- set next, pre Flag ---------------------------------------------------
    $this->int_preflag  = ($this->int_flag - $int_pgsize) < 0
                        ? 0 : $this->int_flag - $int_pgsize;
                        
    $this->int_nextflag = ($this->int_flag + $int_pgsize) > ($int_nums - 1)
                        ? $int_pgsize * ($this->int_lastpage - 1)
                        : $this->int_flag + $int_pgsize;
    // -------------------------------------------------------------------------

      
    // -- set next, pre, no. Page ----------------------------------------------
    $this->int_prepage  = (ceil($this->int_preflag/$int_pgsize) + 1) < 1
                        ? 1 : ceil($this->int_preflag/$int_pgsize) + 1;
    
    $this->int_nextpage = (ceil($this->int_nextflag/$int_pgsize) + 1) > $this->int_lastpage
                        ? $this->int_lastpage : ceil($this->int_nextflag/$int_pgsize) + 1;

    $this->int_currpage = ceil($this->int_flag/$int_pgsize) + 1;
    // -------------------------------------------------------------------------
    

    $this->str_formfieldname = $str_fieldname;
  }



  /*****************************************************************************
   * get pre page ICON HTML link code
   *
   *  @param str $str_pictalt  : pict icon alt text
   *  @param int $int_hspace
   *             $int_vspace   : pict hspace and vspace
   *  @param str $str_pictname : ex. 'pict/preicon.gif'
   *
   *  @return str              : the HTML code
   *  @access public
   ****************************************************************************/

  function prepage($str_pictalt="pre page", $int_hspace=3, $int_vspace=3, $str_pictname="")
  {
    $str_pictname = ($str_pictname=="") ? $this->str_preicon : $str_pictname;
    
    if ( $this->int_currpage <= 1 )
      $rs = null;
    else {
      $str_href = $this->_getRequestStr_($this->int_preflag);
      $rs = '<A HREF="'.$str_href.'"><IMG SRC="'.$str_pictname.'" '.
            ' VSPACE='.$int_vspace.' HSPACE='.$int_hspace.
            ' border=0 align="absmiddle" ALT="'.$str_pictalt.'"></A>';
    }
    
    return $rs;
  }



  /*****************************************************************************
   * get next page ICON HTML link code
   *
   *  @param str $str_pictalt  : pict icon alt text
   *  @param int $int_hspace
   *             $int_vspace   : pict hspace and vspace
   *  @param str $str_pictname : ex. 'pict/nexticon.gif'
   *
   *  @return str              : the HTML code
   *  @access public
   ****************************************************************************/

  function nextpage($str_pictalt="next page", $int_hspace=3, $int_vspace=3, $str_pictname="")
  {
    $str_pictname = ($str_pictname=="") ? $this->str_nexticon : $str_pictname;

    if ( $this->int_currpage >= $this->int_lastpage )
      $rs = null;
    else {
      $str_href = $this->_getRequestStr_($this->int_nextflag);
      $rs = '<A HREF="'.$str_href.'"><IMG SRC="'.$str_pictname.'" '.
            ' VSPACE='.$int_vspace.' HSPACE='.$int_hspace.
            ' border=0 align="absmiddle" ALT="'.$str_pictalt.'"></A>';
    }

    return $rs;
  }



  /*****************************************************************************
   * get COMBO SELECT LIST page
   *
   *  @param str $str_menutxt   : the combo list menu text
   *  @param str $str_formstyle : css styles string
   *
   *  @return string            : the HTML code
   *  @access public
   ****************************************************************************/

  function selectpage($str_menutxt="jump to page", $str_formstyle="")
  {


    // -- chk if need return string --------------------------------------------
    if ($this->int_totnums <= $this->int_pagesize) {
      return null;
    }
    // -------------------------------------------------------------------------
    

    // -- make Combolist HTML code ---------------------------------------------
    $rs = ' <SELECT NAME="PAGEJUMP" '.$str_formstyle.
          ' onChange="location.href=this.options[this.selectedIndex].value;">'.
          ' <OPTION VALUE='.$_SERVER["REQUEST_URI"].'> '.$str_menutxt;
    
    for ($i=1; $i<=$this->int_lastpage; $i++) {
      $str_selected = ($i==$this->int_currpage) ? "SELECTED" : "" ;

      $rs .= '<OPTION VALUE="'.
             $this->_getRequestStr_($i*($this->int_pagesize) - $this->int_pagesize).
             '" '.$str_selected.'> page '.$i." / ".$this->int_lastpage;
    }
    
    $rs .= '</SELECT>';
    // -------------------------------------------------------------------------
    
    
    return $rs;
  }
  
  

  /*****************************************************************************
   * make request string
   *
   *  @param int $int_flag : the flag num
   *
   *  @return string       : ex. 'main.php?op=123&po=456'
   *  @access private
   ****************************************************************************/

  function _getRequestStr_($int_flag)
  {
    $bol_judgeflag = false;
    $str_scriptname = $_SERVER["SCRIPT_NAME"];  //  main.php
    $str_querystr   = $_SERVER["QUERY_STRING"]; //  op=123&po=456
    $ary_newquery   = array();
    
    
    if ($str_querystr<>"") {
      $ary_querystr = explode("&", $str_querystr);
      
      foreach($ary_querystr as $ROW) {
        $tmp_ary = explode("=", $ROW);
        
        if ($tmp_ary[0]==$this->str_formfieldname) {
          $tmp_ary[1] = $int_flag;
          $bol_judgeflag = true;
        }
        
        $ary_newquery[] = $tmp_ary[0]."=".$tmp_ary[1];
      }
    }
    
    if ($bol_judgeflag<>true)
      $ary_newquery[] = $this->str_formfieldname."=".$int_flag;

    return $scriptname."?".implode("&", $ary_newquery);
  }



}



?>
