<?php
  require_once("config.php");

  $count = 1;

  $tweets = 1;
  $handle = fopen($script_path . "endymion_i.txt", "r");

  if ($handle) {

    $cnt = 1;
    $line = "";

    while (($line = fgets($handle)) !== false) {

      if ($cnt == $count) {

        // first line of the file
        $draft = $line;

      } else if ($cnt == ($count+1)) {

        $draft = $draft . $line . "";

        if ($count > 1) {

          echo $draft . "";
          // $tweets++;

        } else {

          echo $draft;
          $count=$count+2;
          $tweets++;

        }
        $count++;

        // exit;
      }

      $cnt++;
      // $count=$count+2;

    }

    fclose($handle);

  } else {

      echo "error opening the source text.";

  }

?>