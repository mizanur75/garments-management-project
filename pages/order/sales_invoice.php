<div class="app-title">
  <h4>Sales Invoice</h4>
  <div class="toolbar">
    <div class="group">
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=11">Create Order</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=12">View Orders</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=18">Delivery Orders</a>
      <a class="btn btn-sm btn-outline-primary active" href="home.php?page=25">Sales Invoice</a>
    </div>
  </div>
</div>

<div style="text-align: right;"><i class="material-icons" style="cursor: pointer;" onclick="window.print();">print</i></div>
<div style="width: 100%; text-align: center;"><h3>Garments Management System</h3></div>
<div style="width: 100%; text-align: center;">Phone: 01710472020</div>
<div style="width: 100%; text-align: center;">Email: mizanurrahman615@gmail.com</div>
<div style="width: 100%; text-align: center;">Keary Plaza, Dhanmondi-15, Dhaka-1209.</div>
<form action="#" method="post">
    <input type="text" name="orderId" />
    <input type="submit" name="btnInvoice" value="GO" />
</form>
<?php
	require_once("lib.php");
	if(isset($_POST["btnInvoice"])){
		$order_id=$_POST["orderId"];
		$order_master_table=$db->query("select o.id,c.name,c.phone,c.email,c.address,o.payment_method,o.order_date,o.delivery_date,o.remark from mr_order_master o, mr_customer c where c.id=o.customer_id and o.id='$order_id'");
		

		while(list($id,$name,$phone,$email,$address,$payment_method,$order_date,$delivery_date,$remark)=$order_master_table->fetch_row()){
			echo "<table>
					<tr>
						<th>ID</th><td>: $id</td>
					</tr>
					<tr>
						<th>Customer Name</th><td>: $name</td><td colspan='4'></td><th style='text-align:right'>Order Date</th><td>: $order_date</td>
					</tr>
					<tr>
						<th>Phone</th><td>: $phone</td><td colspan='4'><th style='text-align:right'>Delivery Date</th><td>: $delivery_date</td>
					</tr>
					<tr>
						<th>Email</th><td>: $email</td><th>Address</th><td>: $address</td><th>Payment Method</th><td>: $payment_method</td><th>Remark</th><td>: $remark</td>					
					</tr>
				</table>";
		}
		
		$order_delivery_table=$db->query("select item_id,qty,unit_price from mr_order_delivery where order_id='$order_id'");
		$sn=1;
		echo "<table class='table table-striped table-sm' border='2px'>";
		echo "<tr><th>SN.</th><th>Product Name</th><th>Quantity</th><th>Unit Price</th><th>Total Price</th></tr>";

		$total=0;
		
		while (list($item_id,$qty,$price)=$order_delivery_table->fetch_row()) {
			
			$total +=$qty*$price;


			echo "<tr><td>".$sn++."</td><td>".get_item_name($item_id)."</td><td>$qty</td><td>$price</td><td>".$qty*$price."</td></tr>";

		}
		echo "<tr><th colspan='4' style='text-align: right;'>Total=></th><th>$total</th></tr>";
		echo "</table>";
	}
?>


