<div class="app-title">
  <h4>Purchase Details</h4>
  <div class="toolbar">
    <div class="group">
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=16">Create Purchase</a>
      <a class="btn btn-sm btn-outline-primary active" href="home.php?page=17">View Purchase</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=21">Delivery Purchase</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=22">Purchase Invoice</a>
    </div>
  </div>
</div>
<div style="margin-bottom: 10px; height: 700px;">
<?php

	if (isset($_POST["btnDelete"])) {
		$purchase_id=$_POST["txtId"];
		$db->query("delete from mr_purchase_master where id='$purchase_id'");
	}

	$perpage = 10;
	$pg = (isset($_GET["pg"])) ? (int)$_GET["pg"]:1;
	$start_at = $perpage * ($pg - 1);

	$rows = $db->query("select count(*) from mr_purchase_master");
	list($total)=$rows->fetch_row();
	$totalPages=ceil($total / $perpage);


	if (isset($_GET["purchase_id"])) {
		$purchase_id=$_GET["purchase_id"];

		echo "<table>
				<tr>
					<th>Purchase No: </th><th>$purchase_id</th>
				</tr>
			</table>";

		$purchase_details_table=$db->query("select pd.barcode,p.name,t.name,pd.qty,pd.unit_price from mr_product p,mr_product_type t,mr_purchase_details pd,mr_purchase_master pm where t.id=pd.type_id and pm.id=pd.purchase_id and p.id=pd.item_id and pm.id='$purchase_id' limit $start_at, $perpage");
		echo "<table class='table table-striped table-sm'>";
		echo "<tr>
				<th>SN.</th>
				<th>Barcode</th>
				<th>Item</th>
				<th>Type</th>
				<th>Quantity</th>
				<th>Unit Price</th>
				<th>Total Price</th>
			  </tr>";

			$sn=1;
			$subtotal=0;


		while(list($barcode,$item,$type,$qty,$price)=$purchase_details_table->fetch_row()){
			$total=$qty*$price;
			$subtotal+=$total;

			echo "<tr>
					<td>".$sn++."</td>
					<td>$barcode</td>
					<td>$item</td>
					<td>$type</td>
					<td>$qty</td>
					<td>$$price</td>
					<td>$$total</td>
				  </tr>";

		}

		echo "<tr><th colspan='6' style='text-align:right;'>Total= <th>$$subtotal</th></th></tr>";
		echo "</table>";
	}else{
		$purchase_master_table=$db->query("select pm.id,s.name,pm.payment_method,pm.order_date,pm.delivery_date,pm.remark from mr_purchase_master pm,mr_supplier s where s.id=pm.supplier_id");

		echo "<table class='table table-striped table-sm'>";
		echo "<tr><th>ID</th><th>Supplier Name</th><th>Payment</th><th>Order Date</th><th>Delivery Date</th><th>Remark</th><th>Action</th></tr>";
		while(list($id,$supplier_name,$payment_method,$order_date,$delivery_date,$remark)=$purchase_master_table->fetch_row()){
			echo "<tr><td><a class='btn btn-sm btn-outline-secondary' href='home.php?page=17&purchase_id=$id'>$id</a></td><td>$supplier_name</td><td>$payment_method</td><td>$order_date</td><td>$delivery_date</td><td>$remark</td><td>
				<form action='home.php?page=17' method='post' onsubmit='return confirm(\"Are you sure?\")'>
				<input type='hidden' name='txtId' value='$id' />
				<input type='submit' name='btnDelete' style='color: red;' class='material-icons' value='delete' />
				</form>
				</td></tr>";
		}

		echo "</table>";
	}
	
?>
</div>
<div>
	<?php
	echo pagination($pg,$totalPages,17);
	?>
</div>