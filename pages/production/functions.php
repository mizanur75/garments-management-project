<?php
function dec_item($item_id){
	foreach($_SESSION["Indent"] as $key=>$item){
	   if($key==$item_id){		      
		$_SESSION["Indent"][$item_id]["qty"]--;
		
		if($_SESSION["Indent"][$item_id]["qty"]<=0){
			$_SESSION["Indent"][$item_id]["qty"]=1;
		}
		break;
	   }	
	}
	
}


function del_item($item_id){
	foreach($_SESSION["Indent"] as $key=>$item){  
	   if($key==$item_id){		
		$_SESSION["Indent"][$item_id]==$item_id;
			unset($_SESSION["Indent"][$item_id]);
		}	
	}
}


function inc_item($item_id){
	foreach($_SESSION["Indent"] as $key=>$item){
	   if($key==$item_id){		      
		$_SESSION["Indent"][$item_id]["qty"]++;	
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


function get_new_production_id(){
	
	 global $db;
	 
	 $production=$db->query("select max(id)+1 from mr_production_master");
	 list($production_id)= $production->fetch_row();
	 return $production_id;
}


function get_delivery_qty_by_item_id($item_id){
	global $db;
	$delivery_table=$db->query("select sum(qty) from mr_purchase_delivery  where item_id='$item_id'");
	list($qty)=$delivery_table->fetch_row();
	return $qty;
}

function get_production_delivery_qty($production_id){
	global $db;
	$delivery_table=$db->query("select sum(qty) from mr_production_delivery  where production_id='$production_id'");
	list($qty)=$delivery_table->fetch_row();
	return $qty;
}
function get_production_master_qty($item_id){
	global $db;
	$delivery_table=$db->query("select sum(qty) from mr_production_master  where item_id='$item_id'");
	list($qty)=$delivery_table->fetch_row();
	return $qty;
}