<?php
        global $_GP;
        $spec = array(
            "id" => $_GP['specid']
        );
        $specitem = array(
            "id" => random(10),
            "title" => $_GP['title'],
            "show" => 1
        );
        include page('goods_spec_item');