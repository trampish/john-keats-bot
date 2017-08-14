<?php

    $myfile = fopen("counter.txt", "w") or die("Unable to open file!");
    $txt = "3";
    fwrite($myfile, $txt);
    fclose($myfile);
    file_put_contents("previoustweetid.txt", "889674881981435905");


?>
