<?php

/*******************************************************************************
 * Database Class for Postgres
 *
 * origin : Author     : Justin Vincent (justin@visunet.ie)
 *          Web        : http://php.justinvincent.com
 *          Class name : ezSQL
 *
 *                                                                    2004/08/31
 ******************************************************************************/



/*******************************************************************************
 * pre DEFINE
 ******************************************************************************/

  define("EZSQL_VERSION"      , "1.25");
  define("OBJECT", "OBJECT"   , true);
  define("ARRAY_A", "ARRAY_A" , true);
  define("ARRAY_N", "ARRAY_N" , true);



/*******************************************************************************
 * Main class Start
 ******************************************************************************/

class db_pgsql
{

  var $debug_called;
  var $vardump_called;
  var $show_errors = true;
  var $num_queries = 0;
  var $debug_all = false;
  var $last_query;
  var $col_info;



  /*****************************************************************************
   * CONSTRUCTOR FormatDate
   *
   *  @param str $dbuser, $dbpassword, $dbname, $dbhost
   ****************************************************************************/

  function db_pgsql($dbuser, $dbpassword, $dbname, $dbhost)
  {
    $connect_str = "";

    if (! empty($dbhost)) $connect_str .= " host=$dbhost";
    if (! empty($dbname)) $connect_str .= " dbname=$dbname";
    if (! empty($dbuser)) $connect_str .= " user=$dbuser";
    if (! empty($dbpassword)) $connect_str .= " password=$dbpassword";

    $this->dbh = pg_connect($connect_str);

    if ( ! $this->dbh )
      $this->print_error("db connect err");
    else {
      // Remember these values for the select function
      $this->dbuser = $dbuser;
      $this->dbpassword = $dbpassword;
      $this->dbname = $dbname;
      $this->dbhost = $dbhost;
    }
  }



  /*****************************************************************************
   * Select a DB (if another one needs to be selected)
   *
   *  @param str $dbname : DB name
   *
   *  @return
   *  @access private
   ****************************************************************************/

  function selectDB($db)
  {
    $this->db($this->dbuser, $this->dbpassword, $db, $this->dbhost);
  }



  /*****************************************************************************
   * Format a string correctly for safe insert under all PHP conditions
   *
   *  @param str $str
   *
   *  @return
   *  @access private
   ****************************************************************************/

  function escape($str)
  {
    return pg_escape_string(stripslashes($str));
  }



  /*****************************************************************************
   * Output SQL / DB error msg
   *
   *  @param str $str
   *
   *  @return
   *  @access private
   ****************************************************************************/

  function print_error($str="")
  {

    // All erros go to the global error array $EZSQL_ERROR..
    global $EZSQL_ERROR;

    // If no special error string then use mysql default..
    if ( !$str )
      // $str = pg_last_error();   ... original
      $str = pg_result_error();

    // Log this error to the global array..
    $EZSQL_ERROR[] = array( "query"     => $this->last_query,
                            "error_str" => $str );


    // Is error output turned on or not..
    if ( $this->show_errors ) {

      // If there is an error then take note of it
      print "<blockquote><font face=arial size=2 color=ff0000>";
      print "<b>SQL/DB Error --</b> ";
      print "[<font color=000077>$str</font>]";
      print "</font></blockquote>";
    }
    else
      return false;

  }



  /*****************************************************************************
   * Turn error handling on or off..
   *
   *  @return
   *  @access private
   ****************************************************************************/

  function show_errors()
  {
    $this->show_errors = true;
  }

  function hide_errors()
  {
    $this->show_errors = false;
  }



  /*****************************************************************************
   * Kill cached query results
   *
   *  @param str $str
   *
   *  @return
   *  @access private
   ****************************************************************************/

  function flushData()
  {
    // Get rid of these
    $this->last_result = null;
    $this->col_info    = null;
    $this->last_query  = null;
  }



  /*****************************************************************************
   * Try to get last ID
   *
   *  @param str $str
   *
   *  @return
   *  @access private
   ****************************************************************************/

  function get_insert_id($query)
  {
    $this->last_oid = pg_last_oid($this->result);

    // try to find table name
    ereg("insert *into *([^ ]+).*", $query, $regs);

    //print_r($regs);
    $table_name = $regs[1];
    $query_for_id = "SELECT * FROM $table_name WHERE oid='$this->last_oid'";

    //echo $query_for_id."<br>";
    $result_for_id = pg_query($this->dbh, $query_for_id);

    if(pg_num_rows($result_for_id)) {
      $id = pg_fetch_array($result_for_id,0,PGSQL_NUM);

      //print_r($id);
      return $id[0];
    }
  }



  /*****************************************************************************
   * Basic Query - see docs for more detail
   *
   *  @param str $query : sql query strings
   *
   *  @return
   *
   *  @access public
   ****************************************************************************/

  function query($query)
  {
    $this->flushData();                            // Flush cached values..
    $this->func_call = "\$db->query(\"$query\")";  // Log how the function was called
    $this->last_query = $query;                    // Keep track of the last query for debug..


    // Perform the query via std pg_query function..
    if (!$this->result = pg_query($this->dbh, $query)) {
      $this->print_error();
      return false;
    }

    $this->num_queries++;

    // If there was an insert, delete or update see how many rows were affected
    // (Also, If there there was an insert take note of the last OID
    $query_type = array("insert", "delete", "update", "replace");

    // loop through the above array
    foreach ($query_type as $word) {

      // This is true if the query starts with insert, delete or update
      if ( preg_match("/^\\s*$word /", strtolower($query)) ) {
        $this->rows_affected = pg_affected_rows($this->result);

        // This gets the insert ID
        if ($word == "insert") {
          $this->insert_id = $this->get_insert_id($query);

          // If insert id then return it - true evaluation
          return $this->insert_id;
        }

        // Set to false if there was no insert id
        $this->result = false;
      }
    }

    // In other words if this was a select statement..
    if ($this->result) {

      // -- Take note of column info -------------------------------------------
      $i=0;
      while ($i < pg_num_fields($this->result)) {
        $this->col_info[$i]->name = pg_field_name($this->result, $i);
        $this->col_info[$i]->type = pg_field_type($this->result, $i);
        $this->col_info[$i]->size = pg_field_size($this->result, $i);
        $i++;
      }
      // -----------------------------------------------------------------------


      // -- Store Query Results ------------------------------------------------
      $i=0;
      // while ( $row = pg_fetch_object($this->result, $i, PGSQL_ASSOC) ) {    // < php 4.3
      while ( $row = pg_fetch_object($this->result) ) {    // > php 4.3

        // Store relults as an objects within main array
        $this->last_result[$i] = $row;
        $i++;
      }
      // -----------------------------------------------------------------------


      // Log number of rows the query returned
      $this->num_rows = $i;

      @pg_free_result($this->result);

      // If debug ALL queries
      $this->debug_all ? $this->debug() : null ;

      // If there were results then return true for $db->query
      if ($i)  return true;
      else     return false;
    }

    else {

      // If debug ALL queries
      $this->debug_all ? $this->debug() : null ;

      // Update insert etc. was good..
      return true;
    }
  }



  /*****************************************************************************
   * Get one variable from the DB - see docs for more detail
   *
   *  @param str $query : sql query strings
   *  @param int $x, $y :
   *
   *  @return string, int, or NULL
   *  @access public
   ****************************************************************************/

  function get_var($query=null, $x=0, $y=0)
  {

    // Log how the function was called
    $this->func_call = "\$db->get_var(\"$query\",$x,$y)";

    // If there is a query then perform it if not then use cached results..
    if ( $query )
      $this->query($query);


    // Extract var out of cached results based x,y vals
    if ( $this->last_result[$y] )
      $values = array_values(get_object_vars($this->last_result[$y]));


    // If there is a value return it else return null
    return (isset($values[$x]) && $values[$x]!=='') ? $values[$x] : null;
  }



  /*****************************************************************************
   * Get one row from the DB - see docs for more detail
   *
   *  @param str $query     : sql query strings
   *  @param object $output : object, ARRAY_A, ARRAY_N
   *
   *  @return array, null or errmessage
   *  @access public
   ****************************************************************************/

  function get_row($query=null, $output=OBJECT, $y=0)
  {

    // Log how the function was called
    $this->func_call = "\$db->get_row(\"$query\",$output,$y)";

    // If there is a query then perform it if not then use cached results..
    if ( $query )
      $this->query($query);

    // If the output is an object then return object using the row offset..
    if ( $output == OBJECT )
      return $this->last_result[$y] ? $this->last_result[$y] : null;

    // If the output is an associative array then return row as such..
    elseif ( $output == ARRAY_A )
      return $this->last_result[$y] ? get_object_vars($this->last_result[$y]) : null;

    // If the output is an numerical array then return row as such..
    elseif ( $output == ARRAY_N )
      return $this->last_result[$y] ? array_values(get_object_vars($this->last_result[$y])) : null;

    // If invalid output type was specified..
    else
      $this->print_error(" \$db->get_row(string query, output type, int offset) -- ".
                         " Output type must be one of: OBJECT, ARRAY_A, ARRAY_N");
  }



  /*****************************************************************************
   * Function to get 1 column from the cached result set based in X index
   *
   *  @param str $query : sql query strings
   *
   *  @return array, null or errmessage
   *  @access public
   ****************************************************************************/

  function get_col($query=null,$x=0)
  {

    // If there is a query then perform it if not then use cached results..
    if ($query)
      $this->query($query);

    // Extract the column values
    for ( $i=0; $i < count($this->last_result); $i++ )
      $new_array[$i] = $this->get_var(null,$x,$i);

    return $new_array;
  }



  /*****************************************************************************
   * Return the the query as a result set - see docs for more details
   *
   *  @param str $query     : sql query strings
   *  @param object $output : object, ARRAY_A, ARRAY_N

   *  @return errmsg, array
   *  @access public
   ****************************************************************************/

  function get_results($query=null, $output=OBJECT)
  {

    // Log how the function was called
    $this->func_call = "\$db->get_results(\"$query\", $output)";

    // If there is a query then perform it if not then use cached results..
    if ($query)
      $this->query($query);

    // Send back array of objects. Each row is an object
    if ($output==OBJECT)
      return $this->last_result;

    elseif ( $output == ARRAY_A || $output == ARRAY_N ) {

      if ($this->last_result) {
        $i=0;

        foreach($this->last_result as $row) {
          $new_array[$i] = get_object_vars($row);

          if ( $output == ARRAY_N )
            $new_array[$i] = array_values($new_array[$i]);

          $i++;
        }

        return $new_array;
      }
      else
        return null;

    }
  }



  /*****************************************************************************
   * Function to get column meta data info pertaining to the last query
   *
   *  @param str $query     : sql query strings
   *  @param object $output : object, ARRAY_A, ARRAY_N

   *  @return errmsg, array
   *  @access public
   ****************************************************************************/

  function get_col_info($info_type="name",  $col_offset=-1)
  {
    if ($this->col_info) {

      if ($col_offset==-1) {

        $i=0;
        foreach($this->col_info as $col ) {
          $new_array[$i] = $col->{$info_type};
          $i++;
        }
        return $new_array;
      }
      else
        return $this->col_info[$col_offset]->{$info_type};

    }
  }


  /*****************************************************************************
   * Dumps the contents of any input variable to screen in a nicely
   * formatted and easy to understand way - any type: Object, Var or Array
   *
   *  @param str $query     : sql query strings
   *  @param object $output : object, ARRAY_A, ARRAY_N

   *  @return errmsg, array
   *  @access public
   ****************************************************************************/

  function vardump($mixed='')
  {
    echo "<p><table><tr><td bgcolor=ffffff><blockquote><font color=000090>";
    echo "<pre><font face=arial>";

    if (!$this->vardump_called)
      echo "<font color=800080><b>ezSQL</b> (v".EZSQL_VERSION.") <b>Variable Dump..</b></font>\n\n";

    $var_type = gettype($mixed);

    print_r(($mixed?$mixed:"<font color=red>No Value / False</font>"));
    echo "\n\n<b>Type:</b> " . ucfirst($var_type) . "\n";
    echo "<b>Last Query</b> [$this->num_queries]<b>:</b> ".($this->last_query?$this->last_query:"NULL")."\n";
    echo "<b>Last Function Call:</b> " . ($this->func_call?$this->func_call:"None")."\n";
    echo "<b>Last Rows Returned:</b> ".count($this->last_result)."\n";
    echo "</font></pre></font></blockquote></td></tr></table>".$this->donation();
    echo "\n<hr size=1 noshade color=dddddd>";

    $this->vardump_called = true;
  }



  /*****************************************************************************
   * Alias for the above function
   *
   *  @param str $mixed     : sql query strings
   *
   *  @return errmsg, array
   *  @access public
   ****************************************************************************/

  function dumpvar($mixed)
  {
    $this->vardump($mixed);
  }



  /*****************************************************************************
   * Displays the last query string that was sent to the database
   *   and table listing results (if there were any).
   *   (abstracted into a seperate file to save server overhead).
   *
   *  @param
   *
   *  @return string
   *  @access public
   ****************************************************************************/

  function debug()
  {
    echo "<blockquote>";


    // Only show ezSQL credits once..
    if (!$this->debug_called)
      echo "<font color=800080 face=arial size=2><b>ezSQL</b> (v".EZSQL_VERSION.") <b>Debug..</b></font><p>\n";

    echo "<font face=arial size=2 color=000099><b>Query</b> [$this->num_queries] <b>--</b> ";
    echo "[<font color=000000><b>$this->last_query</b></font>]</font><p>";
    echo "<font face=arial size=2 color=000099><b>Query Result..</b></font>";
    echo "<blockquote>";

    if ($this->col_info) {


      // -- Results top rows ---------------------------------------------------
      echo "<table cellpadding=5 cellspacing=1 bgcolor=555555>";
      echo "<tr bgcolor=eeeeee><td nowrap valign=bottom><font color=555599 face=arial size=2><b>(row)</b></font></td>";

      for ( $i=0; $i<count($this->col_info); $i++ )
        echo "<td nowrap align=left valign=top><font size=1 color=555599 face=arial>{$this->col_info[$i]->type} {$this->col_info[$i]->max_length}</font><br><span style='font-family: arial; font-size: 10pt; font-weight: bold;'>{$this->col_info[$i]->name}</span></td>";

      echo "</tr>";
      // -----------------------------------------------------------------------


      // -- print main results -------------------------------------------------
      if ($this->last_result) {
        $i=0;
        foreach( $this->get_results(null, ARRAY_N) as $one_row ) {
          $i++;
          echo "<tr bgcolor=ffffff><td bgcolor=eeeeee nowrap align=middle><font size=2 color=555599 face=arial>$i</font></td>";

          foreach($one_row as $item)
            echo "<td nowrap><font face=arial size=2>$item</font></td>";

          echo "</tr>";
        }
      }
      // -----------------------------------------------------------------------


      // -- if last result ----------------------------------------------------
      else
        echo "<tr bgcolor=ffffff><td colspan=".(count($this->col_info)+1)."><font face=arial size=2>No Results</font></td></tr>";
      // -----------------------------------------------------------------------


      echo "</table>";
    }

    // -- if col_info ----------------------------------------------------------
    else
      echo "<font face=arial size=2>No Results</font>";
    // -------------------------------------------------------------------------


    echo "</blockquote></blockquote>".$this->donation()."<hr noshade color=dddddd size=1>";
    $this->debug_called = true;
  }



  /*****************************************************************************
   * Naughty little function to ask for some remuniration!
   *
   *  @param
   *
   *  @return string
   *  @access public
   ****************************************************************************/

  function donation()
  {
    return "<font size=1 face=arial color=000000>If ezSQL has helped <a href=\"https://www.paypal.com/xclick/business=justin%40justinvincent.com&item_name=ezSQL&no_note=1&tax=0\" style=\"color: 0000CC;\">make a donation!?</a> &nbsp;&nbsp;[ go on! you know you want to! ]</font>";
  }



}



/*******************************************************************************
 * Create object start
 ******************************************************************************/

// $db = new db(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);



?>
