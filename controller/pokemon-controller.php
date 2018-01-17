<?php
    function after ($regex, $inthat)
  {
      if (!is_bool(strpos($inthat, $regex)))
      return substr($inthat, strpos($inthat,$regex)+strlen($regex));
  };
 ?>
