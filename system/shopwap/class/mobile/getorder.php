<?php
        $orderid = intval($_GP['id']);
        $orders = mysqld_select("SELECT status FROM " . table('shop_order') . " WHERE id = :id ", array(':id' => $orderid));
        	
        	
	echo json_encode($orders);