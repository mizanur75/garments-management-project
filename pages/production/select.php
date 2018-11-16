<?php
	$db=new mysqli("localhost","root","","gms");
	$item_id=$_POST["cmbRproduct"];

	$product_table=$db->query("select unit_price from mr_product where id='$item_id'");
	
	list($price)=$product_table->fetch_row();
	echo $price;
	
?>