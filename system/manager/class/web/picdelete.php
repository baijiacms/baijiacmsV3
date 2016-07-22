<?php
      $delurl = $_GP['pic'];
        
        if (file_delete($delurl)) {
        
         $filename=basename(SYSTEM_WEBROOT . '/attachment/' . $delurl);
      
            echo 1;
        } else {
            echo 0;
        }