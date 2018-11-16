<?php




function dec_item($item_id){
	foreach($_SESSION["Orders"] as $key=>$item){
	   if($key==$item_id){		      
		$_SESSION["Orders"][$item_id]["qty"]--;
		
		if($_SESSION["Orders"][$item_id]["qty"]<=0){
			$_SESSION["Orders"][$item_id]["qty"]=1;
		}
		
		break;
	   }	
	}
	
}


function del_item($item_id){
	foreach($_SESSION["Orders"] as $key=>$item){  
	   if($key==$item_id){		
		$_SESSION["Orders"][$item_id]==$item_id;
			unset($_SESSION["Orders"][$item_id]);
		}	
	}
}


function inc_item($item_id){
	foreach($_SESSION["Orders"] as $key=>$item){
	   if($key==$item_id){		      
		$_SESSION["Orders"][$item_id]["qty"]++;	
		break;
	   }	
	}
}

function get_item_name($item_id){
	 global $db;
	 
	 $item=$db->query("select name from mr_product where id='$item_id'");
	 list($item_name)= $item->fetch_row();
	 return $item_name;
}


function get_new_order_id(){
	
	 global $db;
	 
	 $order=$db->query("select max(id)+1 from mr_order_master");
	 list($order_id)= $order->fetch_row();
	 return $order_id;
}


function get_delivery_qty_by_order_id($order_id){
	global $db;
	$delivery_table=$db->query("select sum(qty) from mr_order_delivery  where order_id='$order_id'");
	list($qty)=$delivery_table->fetch_row();
	return $qty;
}