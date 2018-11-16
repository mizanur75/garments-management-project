<div class="app-title">
  <h4>Purchase Invoice</h4>
  <div class="toolbar">
    <div class="group">
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=16">Create Purchase</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=17">View Purchase</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=21">Delivery Purchase</a>
      <a class="btn btn-sm btn-outline-primary active" href="home.php?page=22">Purchase Invoice</a>
    </div>
  </div>
</div>
<div style="text-align: right;"><i class="material-icons" style="cursor: pointer;" onclick="window.print();">print</i></div>
<div style="width: 100%; text-align: center;"><h3>Garments Management System</h3></div>
<div style="width: 100%; text-align: center;">Phone: 01710472020</div>
<div style="width: 100%; text-align: center;">Email: mizanurrahman615@gmail.com</div>
<div style="width: 100%; text-align: center;">Keary Plaza, Dhanmondi-15, Dhaka-1209.</div>
<form action="#" method="post">
    <input type="text" name="purchaseId" />
    <input type="submit" class="btn-primary" name="btnInvoice" value="Invoice" />
</form>
<?php
	require_once("pur_lib.php");
	if(isset($_POST["btnInvoice"])){
		$purchase_id=$_POST["purchaseId"];
		$purchase_master_table=$db->query("select pm.id,s.name,s.phone,s.email,s.address,pm.payment_method,pm.order_date,pm.delivery_date,pm.remark from mr_purchase_master pm, mr_supplier s where s.id=pm.supplier_id and pm.id='$purchase_id'");
		

		while(list($id,$name,$phone,$email,$address,$payment_method,$order_date,$delivery_date,$remark)=$purchase_master_table->fetch_row()){
			echo "<div class='table-responsive'>";
				echo "<table>
						<tr>
							<th>P.Invoice No.</th><td>: $id</td>
						</tr>
						<tr>
							<th>Supplier Name</th><td>: $name</td></td><th colspan='5' style='text-align:right'>Order Date</th><td>: $order_date</td>
						</tr>
						<tr>
							<th>Phone</th><td>: $phone</td><th colspan='5' style='text-align:right'>Delivery Date</th><td>: $delivery_date</td>
						</tr>
						<tr>
							<th>Email</th><td width='20%'>: $email</td><th> Address</th><td width='16%'>: $address</td><th> Payment Method</th><td width='12%'>: $payment_method</td><th> Remark</th><td width='17%'>: $remark</td>					
						</tr>
					</table>";
			echo "</div>";
		}
		
		echo "<div class='table-responsive' style='margin-top:10px;'>";
			$purchase_delivery_table=$db->query("select item_id,qty,unit_price from mr_purchase_delivery where purchase_id='$purchase_id'");
			$sn=1;
			echo "<table class='table table-striped table-sm' border='2px'>";
			echo "<tr><th>SN.</th><th>Product Name</th><th>Quantity</th><th>Unit Price</th><th>Total Price</th></tr>";

			$total=0;
			
			while (list($item_id,$qty,$price)=$purchase_delivery_table->fetch_row()) {
				
				$total +=$qty*$price;


				echo "<tr><td>".$sn++."</td><td>".get_item_name($item_id)."</td><td>$qty</td><td>$price</td><td>".$qty*$price."</td></tr>";

			}
			echo "<tr><th colspan='4' style='text-align: right;'>Total=></th><th>$total</th></tr>";
			echo "</table>";
		echo "</div>";
	}
?>




