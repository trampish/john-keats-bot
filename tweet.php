<?php
  require_once("config.php");
  
  require_once($script_path . 'TwitterAPIExchange.php');

  $url = 'https://api.twitter.com/1.1/statuses/update.json';
  $requestMethod = 'POST';

  $count = file_get_contents($script_path . "counter.txt");

  $handle = fopen($script_path . "endymion_i.txt", "r");
  if ($handle) {
    $cnt = 1;
    $line = "";
      while (($line = fgets($handle)) !== false) {
          if ($cnt == $count) {
//            echo $count . ": " . $line;
            $draft = $line;

          } else if ($cnt == ($count+1)) {

            $draft = $draft . $line . " #Endymion";

            if ($count > 1) {
              $previoustweetid = file_get_contents($script_path . "previoustweetid.txt");
              $postfields = array(
                  'status' => "" . $draft . " @_john_keats",
                  'in_reply_to_status_id' => $previoustweetid
              );
            } else {
              $postfields = array(
                  'status' => $draft
              );
            }

            $twitter = new TwitterAPIExchange($settings);
            $results = $twitter->buildOauth($url, $requestMethod)
              ->setPostfields($postfields)
              ->performRequest();

            $resultsarr = json_decode($results);

            $newtweetid = $resultsarr->id;

            file_put_contents($script_path . "previoustweetid.txt", $newtweetid);

            file_put_contents($script_path . "jsonresultslog.txt", date("F j, Y, g:i a") . " - posted tweet " . $newtweetid . " and set line counter to " . ($count+2) . " and received \n" . $results . "\n\n\n", FILE_APPEND);

            file_put_contents($script_path . "counter.txt", $count+2);

            file_put_contents($script_path . "tweetlog.txt", date("F j, Y, g:i a") . " - posted tweet " . $newtweetid . " and set line counter to " . ($count+2) . "\n", FILE_APPEND);

            exit;
          }
          $cnt++;
      }

      fclose($handle);
  } else {
      // error opening the file.
      echo "error opening the source text.";
  }




?>
