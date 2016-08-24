<?php
      $delurl = $_GP['pic'];
        
        if (file_delete($delurl)) {
        
         
            echo 1;
        } else {
            echo 0;
        }