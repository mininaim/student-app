<?php

/** DB class */
class dbManager
  {
    function __construct()
      {
      }
    
    
    function connect($host = DB_HOST, $login = DB_LOGIN, $pass = DB_PASSWORD, $db = DB_NAME)
      {
        @mysql_connect($host, $login, $pass);
        return @mysql_select_db($db);
      }
    
    function execute($query)
      {
        $result = mysql_query($query);
        return $result;
      }
    
    function fetchArray($result)
      {
        if ($result)
            return mysql_fetch_array($result);
      }
    
    function fetchObject($result)
      {
        if ($result)
            return mysql_fetch_object($result);
      }
    
    function fetchRow($result)
      {
        if ($result)
            return mysql_fetch_row($result);
      }
    
    function numRows($result)
      {
        if ($result)
            return mysql_num_rows($result);
      }
    
    function freeResult($result)
      {
        if ($result)
            return mysql_free_result($result);
      }
    
    function getMaxId($field, $table)
      {
        if ($table && $field)
          {
            $result = $this->execute('SELECT MAX(' . $field . ') as max_id FROM ' . $table);
            if ($row = $this->fetchArray($result))
              {
                $maxId = $row['max_id'];
              }
          }
        return $maxId;
      }
    
    
    function getId($field, $table)
      {
        if ($table && $field)
          {
            $id = $this->getMaxId($field, $table) + 1;
          }
        return $id;
      }
    
    
    function info()
      {
        return mysql_info();
      }
    
    function sqlError()
      {
        return mysql_error();
      }
    
    function sqlErrNo()
      {
        return mysql_errno();
      }
  }
