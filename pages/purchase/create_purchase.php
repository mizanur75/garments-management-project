<?php
	//$db=new mysqli("localhost","root","","gms");
	require_once("pur_lib.php");
	$now=date("Y-m-d");
	if (isset($_POST["btnCreate"])) {
		$supplier=$_POST["cmbSupplier"];
		$payment_method=$_POST["cmbPaymentMethod"];
		$delivery_date=$_POST["txtDelivery"];
		$remark=$_POST["cmbRemark"];
		$order_date=date("Y-m-d H:i:s");


		if (isset($_SESSION["purchase"])) {

			$db->query("insert into mr_purchase_master(supplier_id,payment_method,order_date,delivery_date,remark)values('$supplier','$payment_method','$order_date','$delivery_date','$remark')");

			$purchase_id=$db->insert_id;

			foreach ($_SESSION["purchase"] as $key => $item) {
				$barcode=$item["barcode"];
				$type=$item["type"];
				$item_id=$key;
				$qty=$item["qty"];
				$price=$item["unit_price"];

				$db->query("insert into mr_purchase_details(purchase_id,barcode,type_id,item_id,qty,unit_price)values('$purchase_id','$barcode','$type','$item_id','$qty','$price')");
			}

			unset($_SESSION["purchase"]);
			$success="<b style='color: green; background-color: lightgreen; padding: 5px;'>Successfull Placed Order!</b>";
		}else{
			$error="<b style='color: red; background-color: lightgray; padding: 5px;'>Field Should Be Required!</b>";
		}
	}		
//=============== session ======================
	if (isset($_POST["btnAdd"])) {
		$barcode=$_POST["txtBarcode"];
		$type=$_POST["cmbProductType"];
		$item_id=$_POST["cmbProduct"];
		$qty=$_POST["txtQty"];
		$price=$_POST["txtUnitPrice"];

		if (!isset($_SESSION["purchase"])) {
			$_SESSION["purchase"]=array();
		}

		if (array_key_exists($item_id,$_SESSION["purchase"])) {
			$_SESSION["purchase"]["$item_id"]["qty"]++;
		}else{
			$_SESSION["purchase"]["$item_id"]["barcode"]=$barcode;
			$_SESSION["purchase"]["$item_id"]["type"]=$type;
			$_SESSION["purchase"]["$item_id"]["qty"]=$qty;
			$_SESSION["purchase"]["$item_id"]["unit_price"]=$price;
		}
	}
//=============== Dec/Inc/Del=====================

	if (isset($_POST["bntDec"])) {
		$item_id=$_POST["txtId"];
		dec_item($item_id);
	}

	if (isset($_POST["bntInc"])) {
		$item_id=$_POST["txtId"];
		inc_item($item_id);
	}

	if (isset($_POST["btnDel"])) {
		$item_id=$_POST["txtId"];
		del_item($item_id);
	}

//================= Clear Session================

	if (isset($_POST["btnClear"])) {
		if (isset($_SESSION["purchase"])) {
			unset($_SESSION["purchase"]);
		}
	}

?>




<div class="app-title">
  <h4>Create Purchase</h4>
  <div class="toolbar">
    <div class="group">
      <a class="btn btn-sm btn-outline-primary active" href="home.php?page=16">Create Purchase</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=17">View Purchase</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=21">Delivery Purchase</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=22">Purchase Invoice</a>
    </div>
  </div>
</div>
<div style="width: 100%;">
<form action="#" method="post">
	<div style="background-color:#CCC; padding:7px; margin-bottom: 10px; border-radius: 5px;"><b style="color: blue;">Purchase No: </b><?php echo get_new_purchase_id()?><span style="float:right;" class="title"><?php echo isset($error)?$error:""; echo isset($success)?$success:"";?></span></div>



	<div style="width: 100%;" class="title-body">
		<table class="table table-bordered table-sm">
			<tr>
				<th>Supplier Name</th>
				<td>
					<b>:</b> 
					<select name="cmbSupplier" style="height: 30px; width: 90%;">
						<option selected>==== Select Name====</option>
						<?php
						$supplier_table=$db->query("select id,name from mr_supplier");
						while(list($id,$name)=$supplier_table->fetch_row()){
							echo "<option value='$id'>$name</option>";
						}
						?>
					</select>
				</td>

			</tr>
			<tr>
				<th>Payment Method</th>
				<td>
					<b>:</b> <select name="cmbPaymentMethod" style="height: 30px; width: 90%;">
						<option selected>== Select Payment Method ==</option>
						<option value="Cash">Cash</option>
						<option value="VISA">VISA</option>
						<option value="Master Card">Master Card</option>
					</select>
				</td>
				<th>Order Date</th><td>:<input style="height: 30px; width: 90px;" type="text" value="<?php echo $now ;?>" disabled></td>
				<th>Delivery Date</th><td>:<input type="date" name="txtDelivery"></td>
				<th>Remark</th>
				<td>
					: <select name="cmbRemark" style="height: 30px; width: 90px;">
						<option value="Paid">Paid</option>
						<option value="Due">Due</option>
					</select>
				</td>
			</tr>
		</table>
	</div>
	<br>



	<div style="width: 100%;">
		<table class="table table-sm table-striped table-bordered">
			<tr>
				<th width="10%">Barcode</th>
				<th width="30%">Name</th>
				<th width="30%">Type</th>
				<th width="13%">Qty</th>
				<th width="13%">Unit Price</th>
				<th width="4%"></th>
			</tr>
			<tr>
				<td><input class="form-control form-control-sm" type="text" name="txtBarcode"></td>
				<td>
					<select name="cmbProduct" id="cmbProduct" class="form-control form-control-sm">
						<option selected>==== Select Item ====</option>
						<?php
						$product_table=$db->query("select id,name from mr_product where category_id=1");
						while (list($id,$name)=$product_table->fetch_row()) {
							echo "<option value='$id'>$name</option>";
						}
						?>
					</select>
				</td>
				<td>
					<select name="cmbProductType" class="form-control form-control-sm">
						<?php
						$product_type_table=$db->query("select id,name from mr_product_type");
						while(list($id,$name)=$product_type_table->fetch_row()){
							echo "<option value='$id'>$name -$id</option>";
						}
						?>
					</select>
				</td>
				<td><input class="form-control form-control-sm" name="txtQty" type="text" value="1"></td>
				<td><input class="form-control form-control-sm" name="txtUnitPrice" id="txtUnitPrice" type="text" value="0"></td>
				<td><input type="submit" value=" + " class='btn btn-sm btn-primary' name="btnAdd"></td>
			</tr>
		</table>
	</div>


	<div style="margin-top: 10px;">
		<div class="bg-primary" style="text-align: center; width: 100%; padding: 5px 0px 1px 0px; box-sizing: border-box; color: white; border-radius: 5px;"><h5>Added Details</h5></div>
		<div style="max-height: 250px; margin-bottom: 10px; width: 100%;" class="table-responsive">
		<?php
		if (isset($_SESSION["purchase"])) {
			$sn=1;
			echo "<table class='table'>";
			echo "<tr><th>SN.</th><th>Barcode</th><th>Product Name</th><th>Type</th><th>Qty</th><th>Unit Price</th><th>Total</th><th>Action</th></tr>";
			$subtotal=0;
			foreach ($_SESSION["purchase"] as $key => $item) {
				$barcode=$item["barcode"];
				$type=$item["type"];
				$item_id=$key;
				$qty=$item["qty"];
				$price=$item["unit_price"];
				$subtotal+=$qty*$price;

				echo "<tr>
						<td>".$sn++."</td>
						<td>$barcode</td>
						<td>".get_item_name($item_id)."</td>
						<td>$type</td>
						<td>$qty</td>
						<td>$$price</td>
						<td>$".$qty*$price."</td>
						<td>
						<input type='hidden' name='txtId' value='$item_id' />
						<input type='submit' name='bntDec' value='-' class='btn btn-sm btn-outline-warning' />
						<input type='submit' name='bntInc' value='+' class='btn btn-sm btn-outline-success' />
						<input type='submit' name='btnDel' value='DEL' class='btn btn-sm btn-outline-danger' />
						</td>
					 </tr>";
			}
			echo "<tr><th style='text-align:right;' colspan='6'>Total=></th><td>$$subtotal</td></tr>";
			echo "</table>";
		}
		?>
		</div>
		<div align="right">
			<input type="submit" class="btn btn-sm btn-outline-danger" value="Clear" name="btnClear">
			<input type="submit" class="btn btn-sm btn-outline-success" value="Create Order" name="btnCreate">
		</div>
	</div>
</form>
</div>

<script>
	$(function(){
		$("#cmbProduct").change(function(){
			var item_id=$(this).val();
			$.ajax({
				url: 'pages/purchase/ajax.php',
				method: 'post',
				data:{'cmbProduct': item_id},
				success: function(echo){
					$("#txtUnitPrice").val(echo);
				}
			});
		});
	});
</script>
