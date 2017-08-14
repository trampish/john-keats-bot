<?php

  $count = 1;
  $handle = fopen("endymion_i.txt", "r");
  if ($handle) {
    $cnt = 1;
    $line = "";
      while (($line = fgets($handle)) !== false) {
          if ($cnt == $count) {
  //            echo $count . ": " . $line;
            $draft = $count . ": " . $line;

          } else if ($cnt == ($count+1)) {

            $draft = $draft . ($count+1) . $line . " #Endymion @_john_keats";

            // echo $draft . " (" . strlen($draft) . ") \n";
            echo $count . "\n";

            if (strlen($draft) > 140) {
              echo "tweet overflow on line " . $cnt;
            } else {
              // echo "line " . $cnt . " okay.";
              // if (strlen($draft) > 100) { echo "line " . $cnt . " cutting it close"; }
            }

            $count = $count+1;

            $draft = "";
          }
          $cnt++;


      }

      fclose($handle);
  } else {
      // error opening the file.
  }

?>
