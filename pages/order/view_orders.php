<div class="app-title">
  <h4>View Orders</h4>
  <div class="toolbar">
    <div class="group">
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=11">Create Order</a>
      <a class="btn btn-sm btn-outline-primary active" href="home.php?page=12">View Orders</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=18">Delivery Orders</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=25">Sales Invoice</a>
    </div>
  </div>
</div>
<div style="margin-bottom: 10px; height: 700px;">
<?php
	require_once("lib.php");
	if(isset($_POST["btnDel"])){
		$order_id=$_POST["txtId"];
		
		$db->query("delete from mr_order_master where id='$order_id'");
	}
	
	$perpage = 10;
	$pg=(isset($_GET["pg"])) ? (int)$_GET["pg"]:1;
	$start_at= $perpage * ($pg - 1);

	$rows = $db->query("select count(*) from mr_order_master");
	list($total)=$rows->fetch_row();
	$totalPages = ceil($total / $perpage);

	if(isset($_GET["order_id"])){
	 	$order_id=$_GET["order_id"];
		
		echo "<table><tr><th>Order No: </th><th>$order_id</th><th><a class='btn btn-sm btn-outline-primary' href='home.php?page=12'>Go Back</a></th></tr></table>";
		
		$order_details_table=$db->query("select p.id,p.name,od.size,od.qty,od.unit_price from mr_order_master o,mr_product p,mr_order_details od where o.id=od.order_id and p.id=od.item_id and o.id='$order_id'");
		
		echo "<table class='table table-striped table-sm'>";
		echo "<tr><th>SN</th><th>Item</th><th>Size</th><th>Qty</th><th>Unit Price</th><th>Total</th></tr>";
		$sn=1;
		$invoice_total=0;
		while(list($item_id,$item,$size,$qty,$price)=$order_details_table->fetch_row()){
			
			$line_total=$qty*$price;
			$invoice_total+=$line_total;
			
			echo "<tr><td>".($sn++)."</td><td>$item</td><td>$size</td><td>$qty</td><td>$price</td><td>".($qty*$price)."</td></tr>";
			
		}
		echo "<tr><th colspan='5' style='text-align:right;'>Total= </th><th>$$invoice_total</th></tr>";
		echo "<tr><th colspan='6' style='text-align:right;'><form><input type='button' value='Print' onClick='window.print()' /></form></th></tr>";
		echo "</table>";
		
		 
	}else{
	   
	   $con_table=$db->query("select o.id,c.name,o.payment_method,o.shipping_address,o.order_date,o.delivery_date,o.remark from mr_order_master o,mr_customer c where c.id=o.customer_id limit $start_at,$perpage");
	   
	   echo "<table class='table table-striped table-sm'>";
	   echo "<tr><th>Order Id</th><th>Customer Name</th><th>Payment Method</th><th>Shipping Address</th><th>Order Date</th><th>Delivery Date</th><th>Remark</th><th>Action</th></tr>";
   		
	    while(list($id,$name,$payment_method,$shipping_address,$order_date,$delivery_date,$remark)=$con_table->fetch_row()){
		   
		   //$added_on=date("d M Y h:i A",strtotime($added_on));
		  // $order_datetime=date("d M y h:i A",strtotime($order_datetime));
		   
		 echo "<tr><td><a class='btn btn-sm btn-outline-primary' href='home.php?page=12&order_id=$id'>$id</a></td><td>$name</td><td>$payment_method</td><td>$shipping_address</td><td>$order_date</td><td>$delivery_date</td><td>$remark</td><td><form action='home.php?page=12' method='post' style='display:inline' onsubmit='return confirm(\"Are you sure?\")'><input type='hidden' name='txtId' value='$id' /><input type='submit' name='btnDel' style='color: red;' class='material-icons' value='delete'></form></td></tr>";  
	    }
   
   		echo "</table>";
	}
?>
</div>
<div>
	<?php
	echo pagination($pg,$totalPages,12);
	?>
</div>