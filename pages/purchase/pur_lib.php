<?php

function dec_item($item_id){
	foreach($_SESSION["purchase"] as $key=>$item){
	   if($key==$item_id){		      
		$_SESSION["purchase"][$item_id]["qty"]--;
		
		if($_SESSION["purchase"][$item_id]["qty"]<=0){
			$_SESSION["purchase"][$item_id]["qty"]=1;
		}
		
		break;
	   }	
	}
	
}


function del_item($item_id){
	foreach($_SESSION["purchase"] as $key=>$item){  
	   if($key==$item_id){		
		$_SESSION["purchase"][$item_id]==$item_id;
			unset($_SESSION["purchase"][$item_id]);
		}	
	}
}


function inc_item($item_id){
	foreach($_SESSION["purchase"] as $key=>$item){
	   if($key==$item_id){		      
		$_SESSION["purchase"][$item_id]["qty"]++;	
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

//function get_supplier_name($supplier_id){
//	 global $db;
//	 
//	 $supplier=$db->query("select name from supplier where id='$supplier_id'");
//	 list($supplier_name)= $supplier->fetch_row();
//	 return $supplier_name;
//}

function get_new_purchase_id(){
	
	 global $db;
	 
	 $purchase=$db->query("select max(id)+1 from mr_purchase_master");
	 list($purchase_id)= $purchase->fetch_row();
	 return $purchase_id;
}
function get_delivery_qty_by_purchase_id($purchase_id){
	global $db;
	$delivery_table=$db->query("select sum(qty) from mr_purchase_delivery  where purchase_id='$purchase_id'");
	list($qty)=$delivery_table->fetch_row();
	return $qty;
}