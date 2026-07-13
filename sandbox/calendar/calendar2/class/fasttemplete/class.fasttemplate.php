<?php

/*******************************************************************************
 * Fast Templete Class
 *
 * origin : Author     : ??
 *          Web        : ??
 *          Class name : fasttemplete
 *
 *                                                               update by Kevin
 *                                                                    2005/06/01
 ******************************************************************************/



class FastTemplate
{


  /*****************************************************************************
   * var property
   ****************************************************************************/

  var $FILELIST  = array();   // Holds the array of filehandles FILELIST[HANDLE] == "fileName"
  var $DYNAMIC   = array();   // Holds the array of dynamic blocks, and the fileHandles they live in.
  var $PARSEVARS = array();   // Holds the array of Variable handles. PARSEVARS[HANDLE] == "value"
  var $LOADED    = array();   // We only want to load a template once - when it's used.
                              // LOADED[FILEHANDLE] == 1 if loaded undefined if not loaded yet.
  var $HANDLE    = array();   // Holds the handle names assigned by a call to parse()
  var $ROOT      = null;      // Holds path-to-templates
  var $WIN32     = false;     // Set to true if this is a WIN32 server
  var $ERROR     = null;      // Holds the last error message
  var $LAST      = null;      // Holds the HANDLE to the last template parsed by parse()
  var $STRICT    = true;      // Strict template checking.
                              // Unresolved vars in templates will generate a warning when found.



  /*****************************************************************************
   * CONSTRUCTOR FormatDate
   *
   *  @param str $pathToTemplates : path
   *  @param str $os              : os name, like ... 'win'
   *
   *  @return void
   ****************************************************************************/

  function FastTemplate($pathToTemplates="", $os="")
  {
    if($os=="win")
      $this->set_win32();

    if( !empty($pathToTemplates) )
      $this->set_root($pathToTemplates);
  }



  /*****************************************************************************
   * Set root directory
   *  All templates will be loaded from this "root" directory
   *  Can be changed in mid-process by re-calling with a new  value.
   *
   *  @param str $root : template file root Path
   *
   *  @return void
   *  @access private
   ****************************************************************************/

  function set_root($root)
  {
    $trailer = substr($root, -1);

    if( !$this->WIN32 ) {

      if( (ord($trailer)) != 47 )
        $root = "$root".chr(47);

      if( is_dir($root) )
        $this->ROOT = $root;
      else {
        $this->ROOT = "";
        $this->error("Specified ROOT dir [".$root."] is not a directory");
      }
    }

    else {
      // -- WIN32 box - no testing --
      if( (ord($trailer)) != 92 )
        $root = "$root" . chr(92);

      $this->ROOT = $root;
    }
  }



  /*****************************************************************************
   * Call this Class if the OS is WIN32
   *
   *  @param
   *
   *  @return void
   *  @access private
   ****************************************************************************/

  function set_win32()
  {
    $this->WIN32 = true;
  }



  /*****************************************************************************
   * Strict template checking, if true sends warnings to STDOUT when
   * parsing a template with undefined variable references
   * Used for tracking down bugs-n-such. Use no_strict() to disable.
   *
   *  @param
   *
   *  @return void
   *  @access public
   ****************************************************************************/

  function strict()
  {
    $this->STRICT = true;
  }



  /*****************************************************************************
   * Silently discards (removes) undefined variable references found in templates
   *
   *  @param
   *
   *  @return void
   *  @access public
   ****************************************************************************/

  function no_strict()
  {
    $this->STRICT = false;
  }



  /*****************************************************************************
   * A quick check of the template file before reading it.
   * This is -not- a reliable check, mostly due to inconsistencies
   * in the way PHP determines if a file is readable.
   *
   *  @param str $filename : file name
   *
   *  @return bol
   *  @access public
   ****************************************************************************/

  function is_safe($filename)
  {
    if ( !file_exists($filename) ) {
      $this->error("[".$filename."] does not exist", 0);
      return false;
    }

    return true;
  }



  /*****************************************************************************
   * Grabs a template from the root dir and
   * reads it into a (potentially REALLY) big string
   *
   *  @param $template :
   *
   *  @return bol or
   *  @access private
   ****************************************************************************/

  function get_template($template)
  {
    if ( empty($this->ROOT) ) {
      $this->error("Cannot open template. Root not valid.", 1);
       return false;
    }

    $filename = $this->ROOT.$template;
    $contents = implode("", file($filename));

    if ( !$contents or empty($contents) ) {
      $this->error("get_template() failure: [".$filename."] ", 1);
      return;
    }

    return $contents;
  }



  /*****************************************************************************
   * Prints the warnings for unresolved variable references
   * in template files. Used if STRICT is true
   *
   *  @param str $Line : string
   *
   *  @return void
   *  @access private
   ****************************************************************************/

  function show_unknowns($Line)
  {
    $unknown = array();

    if ( ereg("({[A-Z0-9_]+})", $Line, $unknown) ) {
      $UnkVar = $unknown[1];

      if ( !empty($UnkVar) )
        @error_log("[FastTemplate] Warning: no value found for variable: ".$UnkVar, 0);
    }
  }



  /*****************************************************************************
   * This routine get's called by parse() and does the actual
   * {VAR} to VALUE conversion within the template.
   *
   *  @param str $template   :
   *  @param ary $tpl_array  :
   *
   *  @return void or str
   *  @access private
   ****************************************************************************/

  function parse_template($template, $tpl_array)
  {
    while ( list($key, $val) = each($tpl_array) ) {
      if ( !empty($key) ) {

        if ( gettype($val) != "string" )
          settype($val, "string");

        $template = str_replace("{".$key."}", $val, $template);
      }
    }

    if (!$this->STRICT) {
      // Silently remove anything not already found
      $template = ereg_replace("\{"."([A-Z0-9_]+)"."\}", "", $template);
    }
    else {
      // Warn about unresolved template variables
      if ( ereg("({[A-Z0-9_]+})", $template) ) {
        $unknown = split("\n", $template);

        while ( list($Element, $Line) = each($unknown) ) {
          $UnkVar = $Line;
          if ( !empty($UnkVar) )
            $this->show_unknowns($UnkVar);
        }
      }
    }

    $template = str_replace("###{###", "{", $template);

    return $template;
  }




  /*****************************************************************************
   * The meat of the whole class. The magic happens here.
   *
   *  @param str $ReturnVar :
   *  @param str $FileTags  :
   *
   *  @return void
   *  @access private
   ****************************************************************************/

  function parse($ReturnVar, $FileTags)
  {
    $append = false;
    $this->LAST = $ReturnVar;
    $this->HANDLE[$ReturnVar] = 1;

    if ( gettype($FileTags)=="array" ) {
      // -- Clear any previous data --
      unset($this->$ReturnVar);

      while ( list($key ,$val) = each($FileTags) ) {

        if ( (!isset($this->$val)) || (empty($this->$val)) ) {
          $this->LOADED["$val"] = 1;

          if ( isset($this->DYNAMIC[$val]) )
            $this->parse_dynamic($val, $ReturnVar);
          else {
            $fileName = $this->FILELIST[$val];
            $this->$val = $this->get_template($fileName);
          }
        }

        // -- Array context implies overwrite --
        $this->$ReturnVar = $this->parse_template($this->$val, $this->PARSEVARS);

        // -- For recursive calls. --
        $this->assign( array( $ReturnVar => $this->$ReturnVar ) );
      }
    }

    else {
      // -- FileTags is not an array --
      $val = $FileTags;

      if ( (substr($val,0,1))=="." ) {
        // -- Append this template to a previous ReturnVar --
        $append = true;
        $val = substr($val, 1);
      }

      if ( (!isset($this->$val)) || (empty($this->$val)) ) {
        $this->LOADED[$val] = 1;

        if (isset($this->DYNAMIC[$val]))
          $this->parse_dynamic($val, $ReturnVar);
        else {
          $fileName = $this->FILELIST[$val];
          $this->$val = $this->get_template($fileName);
        }
      }

      if($append)
        $this->$ReturnVar .= $this->parse_template($this->$val, $this->PARSEVARS);
      else
        $this->$ReturnVar = $this->parse_template($this->$val, $this->PARSEVARS);


      // -- For recursive calls. --
      $this->assign(array($ReturnVar => $this->$ReturnVar));
    }

  }


  /*****************************************************************************
   * output and Display on website
   *
   *  @param str $template :
   *
   *  @return void
   *  @access public
   ****************************************************************************/

  function FastPrint($template="")
  {
    if ( empty($template) )
      $template = $this->LAST;

    if ( (!(isset($this->$template))) || (empty($this->$template)) ) {
      $this->error("Nothing parsed, nothing printed", 0);
      return;
    }
    else
      print $this->$template;

    return;
  }



  /*****************************************************************************
   * output HTML code
   *
   *  @param str $template :
   *
   *  @return str
   *  @access public
   ****************************************************************************/

  function fetch($template="")
  {
    if ( empty($template) )
      $template = $this->LAST;

    if( (!(isset($this->$template))) || (empty($this->$template)) ) {
      $this->error("Nothing parsed, nothing printed", 0);
      return;
    }

    return $this->$template;
  }



  /*****************************************************************************
   * A dynamic block lives inside another template file.
   * It will be stripped from the template when parsed
   * and replaced with the {$Tag}.
   *
   *  @param str $Macro      :
   *  @param str $ParentName :
   *
   *  @return bol
   *  @access public
   ****************************************************************************/

  function define_dynamic($Macro, $ParentName)
  {
    $this->DYNAMIC[$Macro] = $ParentName;
    return true;
  }



  /*****************************************************************************
   * Parse Dynamic
   * The file must already be in memory.
   *
   *  @param str $Macro      :
   *  @param str $ParentName :
   *
   *  @return bol
   *  @access private
   ****************************************************************************/

  function parse_dynamic($Macro, $MacroName)
  {
    $ParentTag = $this->DYNAMIC[$Macro];

    if ( (!$this->$ParentTag) or (empty($this->$ParentTag)) ) {
      $fileName = $this->FILELIST[$ParentTag];
      $this->$ParentTag = $this->get_template($fileName);
      $this->LOADED[$ParentTag] = 1;
    }

    if ($this->$ParentTag) {
      $template = $this->$ParentTag;
      $DataArray = split("\n", $template);
      $newMacro = "";
      $newParent = "";
      $outside = true;
      $start = false;
      $end = false;

      while ( list($lineNum, $lineData) = each($DataArray) ) {
        $lineTest = trim($lineData);

        if ("<!-- BEGIN DYNAMIC BLOCK: $Macro -->" == $lineTest) {
          $start = true;
          $end = false;
          $outside = false;
        }

        if ("<!-- END DYNAMIC BLOCK: $Macro -->" == $lineTest ) {
          $start = false;
          $end = true;
          $outside = true;
        }

        // Restore linebreaks
        if( !$outside and !$start and !$end )
            $newMacro .= $lineData."\n";

        // Restore linebreaks
        if ( $outside and !$start and !$end )
          $newParent .= $lineData."\n";

        if ($end)
          $newParent .= "{".$MacroName."}\n";

        // Next line please
        if ($end)    $end = false;
        if ($start)  $start = false;
      }

      $this->$Macro = $newMacro;
      $this->$ParentTag = $newParent;
      return true;
    }

    else{
      @error_log("ParentTag: [$ParentTag] not loaded!", 0);
      $this->error("ParentTag: [$ParentTag] not loaded!", 0);
      return false;
    }

  }



  /*****************************************************************************
   * Strips a DYNAMIC BLOCK from a template.
   *
   *  @param str $Macro :
   *
   *  @return bol
   *  @access public
   ****************************************************************************/

  function clear_dynamic($Macro="")
  {
    if ( empty($Macro) )
      return false;

    $ParentTag = $this->DYNAMIC["$Macro"];

    if ( (!$this->$ParentTag) or (empty($this->$ParentTag)) ) {
      $fileName = $this->FILELIST[$ParentTag];
      $this->$ParentTag = $this->get_template($fileName);
      $this->LOADED[$ParentTag] = 1;
    }

    if ($this->$ParentTag) {
      $template = $this->$ParentTag;
      $DataArray = split("\n", $template);
      $newParent = "";
      $outside = true;
      $start = false;
      $end = false;

      while ( list($lineNum,$lineData) = each($DataArray) ) {
        $lineTest = trim($lineData);

        if ("<!-- BEGIN DYNAMIC BLOCK: $Macro -->" == "$lineTest") {
          $start = true;
          $end = false;
          $outside = false;
        }

        if ("<!-- END DYNAMIC BLOCK: $Macro -->" == "$lineTest") {
          $start = false;
          $end = true;
          $outside = true;
        }

        // Restore linebreaks
        if ( $outside and !$start and !$end )
          $newParent .= $lineData."\n";

        // Next line please
        if ($end)    $end = false;
        if ($start)  $start = false;
      }

      $this->$ParentTag = $newParent;
      return true;
    }

    else {
      @error_log("ParentTag: [$ParentTag] not loaded!", 0);
      $this->error("ParentTag: [$ParentTag] not loaded!", 0);
      return false;
    }

  }



  /*****************************************************************************
   * Set property for this class
   *
   *  @param ary $fileList :
   *
   *  @return bol
   *  @access public
   ****************************************************************************/

  function define($fileList)
  {
    while ( list ($FileTag, $FileName) = each($fileList) )
      $this->FILELIST["$FileTag"] = $FileName;

    return true;
  }



  /*****************************************************************************
   * Clear Some property
   *
   *  @param str $ReturnVar :
   *
   *  @return void
   *  @access public
   ****************************************************************************/

  function clear($ReturnVar="")
  {


    // -- Clears out hash created by call to parse() ---------------------------
    if ( !empty($ReturnVar) ) {

      if ( gettype($ReturnVar) != "array" ) {
        unset($this->$ReturnVar);
        return;
      }
      else {
        while ( list($key, $val) = each($ReturnVar) )
          unset($this->$val);

        return;
      }
    }
    // -------------------------------------------------------------------------


    // -- Empty - clear all of them --------------------------------------------
    while ( list($key, $val) = each($this->HANDLE) ) {
      $KEY = $key;
      unset($this->$KEY);
    }
    // -------------------------------------------------------------------------


  }



  /*****************************************************************************
   * Clear tpl
   *
   *  @param ary $fileHandle :
   *
   *  @return void
   *  @access public
   ****************************************************************************/

  function clear_tpl($fileHandle="")
  {


    // -- Nothing loaded, nothing to clear -------------------------------------
    if ( empty($this->LOADED) )
      return true;
    // -------------------------------------------------------------------------


    // -- Clear ALL fileHandles ------------------------------------------------
    if ( empty($fileHandle) ) {

      while ( list($key, $val) = each($this->LOADED) )
        unset($this->$key);

      unset($this->LOADED);
      return true;
    }

    else {
      if ( gettype($fileHandle) != "array" ) {

        if ( (isset($this->$HANDLE)) || (!empty($this->$HANDLE)) ) {
          unset($this->LOADED[$fileHandle]);
          unset($this->$HANDLE);
          return true;
        }
      }
      else {
        while ( list($Key, $Val) = each($fileHandle) ) {
          unset($this->LOADED[$Key]);
          unset($this->$Key);
        }

        return true;
      }
    }
    // -------------------------------------------------------------------------


    return false;
  }



  /*****************************************************************************
   * Clear define
   *
   *  @param str $FileTag :
   *
   *  @return void
   *  @access public
   ****************************************************************************/

  function clear_define($FileTag="")
  {
    if ( empty($FileTag) ) {
      unset($this->FILELIST);
      return;
    }

    if ( gettype($Files) != "array" ) {
      unset($this->FILELIST[$FileTag]);
      return;
    }
    else {
      while ( list($Tag, $Val) = each($FileTag) )
        unset($this->FILELIST[$Tag]);
    }
  }



  /*****************************************************************************
   * Aliased function - used for compatibility with CGI::FastTemplate
   *
   *  @param
   *
   *  @return void
   *  @access public
   ****************************************************************************/

  function clear_parse ()
  {
    $this->clear_assign();
  }



  /*****************************************************************************
   * Clears all variables set by assign()
   *
   *  @param
   *
   *  @return void
   *  @access
   ****************************************************************************/

  function clear_assign()
  {
    if ( !(empty($this->PARSEVARS)) ) {
      while ( list($Ref, $Val) = each($this->PARSEVARS) )
        unset($this->PARSEVARS[$Ref]);
    }
  }



  /*****************************************************************************
   * Clears all variables set by assign()
   *
   *  @param str $href :
   *
   *  @return void
   *  @access public
   ****************************************************************************/

  function clear_href($href)
  {
    if (!empty($href)) {
      if ( gettype($href) != "array" ) {
        unset($this->PARSEVARS[$href]);
        return;
      }
      else {
        while ( list($Ref, $val) = each($href) )
          unset($this->PARSEVARS[$Ref]);

        return;
      }
    }
    else  {
      // -- Empty - clear them all --
      $this->clear_assign();
    }
  }



  /*****************************************************************************
   * Clear all data in memory
   *
   *  @param
   *
   *  @return void
   *  @access public
   ****************************************************************************/

  function clear_all()
  {
    $this->clear();
    $this->clear_assign();
    $this->clear_define();
    $this->clear_tpl();

    return;
  }



  /*****************************************************************************
   * Clears all variables set by assign()
   *
   *  @param $tpl_array
   *  @param $trailer
   *
   *  @return void
   *  @access
   ****************************************************************************/

  function assign($tpl_array, $trailer="")
  {
    if ( gettype($tpl_array) == "array" ) {
      while ( list($key, $val) = each($tpl_array) ) {
        if ( !empty($key) ) {
          // -- Empty Keys are NOT --
          $val = str_replace("{", "###{###", $val);
          $this->PARSEVARS[$key] = $val;
        }
      }
    }


    // -- Empty values are allowed in non-array context now. -------------------
    else {
      if ( !empty($tpl_array) )
        $this->PARSEVARS[$tpl_array] = $trailer;
    }
    // -------------------------------------------------------------------------


  }



  /*****************************************************************************
   * Return the value of an assigned variable.
   *
   *  @param
   *
   *  @return bol
   *  @access
   ****************************************************************************/

  function get_assigned($tpl_name = "")
  {
    if ( empty($tpl_name) )
      return false;

    if ( isset($this->PARSEVARS["$tpl_name"]) )
      return ($this->PARSEVARS["$tpl_name"]);

    else
      return false;
  }



  /*****************************************************************************
   * Error msg show
   *
   *  @param str $errorMsg : errmsg
   *  @param int $die      :
   *
   *  @return void
   *  @access private
   ****************************************************************************/

  function error($errorMsg, $die=0)
  {
    $this->ERROR = $errorMsg;
    echo "ERROR: ".$this->ERROR." <BR> \n";

    if ($die == 1)
      exit;
  }


}



?>
