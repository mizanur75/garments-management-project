<?php
	require_once("lib.php");
	if (isset($_POST["btnSubmit"])) {
		unset($_SESSION["Orders"]);
		$order_id=$_POST["txtOrderId"];

		$order_details_table=$db->query("select item_id,qty,unit_price from mr_order_details where order_id='$order_id'");
		while (list($item_id,$qty,$unit_price)=$order_details_table->fetch_row()) {
			//echo $item_id;
			if (!isset($_SESSION["Orders"])) {
				$_SESSION["Orders"]=array();
			}

			$_SESSION["Orders"][$item_id]["qty"]=$qty-get_delivery_qty_by_order_id($order_id);
			$_SESSION["Orders"][$item_id]["unit_price"]=$unit_price;
		}
	}

	if (isset($_POST["btnDeliver"])) {
		$order_id=$_POST["txtOrderId"];
		if (isset($_SESSION["Orders"])) {
			foreach ($_SESSION["Orders"] as $key => $item) {
				$item_id=$key;
				$qty=$item["qty"];
				$price=$item["unit_price"];

				$db->query("insert into mr_order_delivery(order_id,item_id,qty,unit_price)values('$order_id','$item_id','$qty','$price')");
			}
		}

		unset($_SESSION["Orders"]);
		echo "Successful!";
	}

	if (isset($_POST["btnDec"])) {
		$order_id=$_POST["txtOrderId"];
		$item_id=$_POST["txtId"];
		dec_item($item_id);
	}
	if (isset($_POST["btnDel"])) {
		$order_id=$_POST["txtOrderId"];
		$item_id=$_POST["txtId"];
		del_item($item_id);
	}
	if(isset($_POST["btnClear"])){
		if(isset($_SESSION["Orders"])){
			unset($_SESSION["Orders"]);
		}
	}
	if(isset($_POST["btnClear"])){
		if(isset($_SESSION["Orders"])){
			unset($_SESSION["Orders"]);
		}
	}


?>

<div class="app-title">
  <h4>Delivery Order</h4>
  <div class="toolbar">
    <div class="group">
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=11">Create Order</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=12">View Orders</a>
      <a class="btn btn-sm btn-outline-primary active" href="home.php?page=18">Delivery Orders</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=25">Sales Invoice</a>
    </div>
  </div>
</div>
<form action="#" method="post">
	<input type="text" name="txtOrderId" value="<?php echo isset($order_id)?$order_id:''?>">
	<input type="submit" name="btnSubmit" value="GO">


<?php
  if (isset($_SESSION["Orders"])) {
    $sn=1;
    echo "<table class='table table-sm table-striped'>";
    echo "<tr><th>SN.</th><th>Product</th><th style='text-align: right;'>Qty</th><th style='text-align: right;'>Unit Price</th><th style='text-align: right;'>Total</th><th style='text-align: right;'>Action</th></tr>";

      $subtotal=0;

      foreach ($_SESSION["Orders"] as $key => $item) {
        $item_id=$key;
        $qty=$item["qty"];
        $price=$item["unit_price"];

        $subtotal+=$qty*$price;

        echo "<tr>
                <td width='8%'>".$sn++."</td>
                <td width='22%'>".get_item_name($item_id)."</td>
                <td width='7%' style='text-align: right;'>$qty</td>
                <td width='25%' style='text-align: right;'>$price</td>
                <td width='15%' style='text-align: right;'>".$qty*$price."</td>
                <td width='20%' style='text-align: right;'><form action='#' method='post'>
                <input type='hidden' value='$item_id' name='txtId'>
                <input type='submit' value=' - ' name='btnDec'>
				<input type='submit' value='Del' name='btnDel'>
                </form></td>
              </tr>";
      }

    echo "<tr><th style='text-align: right;' colspan='4'></th><th style='text-align: right;'>Total=> $$subtotal</th></tr>";
    echo "<tr><th style='text-align: right;' colspan='5'></th><th style='text-align: right;'><input type='submit' name='btnClear' value='Clear All' /><input type='submit' name='btnDeliver' /></th></tr>";
    echo "</table";
  }
?>

</form>