<?php
	require_once("pur_lib.php");
	if (isset($_POST["btnGo"])) {
		unset($_SESSION["purchase"]);
		$purchase_id=$_POST["txtPurchaseId"];

		$purchase_details_table=$db->query("select item_id,qty,unit_price from mr_purchase_details where purchase_id='$purchase_id'");
		while (list($item_id,$qty,$unit_price)=$purchase_details_table->fetch_row()) {
			//echo $item_id;
			if (!isset($_SESSION["purchase"])) {
				$_SESSION["purchase"]=array();
			}

			$_SESSION["purchase"][$item_id]["qty"]=$qty-get_delivery_qty_by_purchase_id($purchase_id);
			$_SESSION["purchase"][$item_id]["unit_price"]=$unit_price;
		}
	}

	if (isset($_POST["btnDeliver"])) {
		$purchase_id=$_POST["txtPurchaseId"];
		if (isset($_SESSION["purchase"])) {
			foreach ($_SESSION["purchase"] as $key => $item) {
				$item_id=$key;
				$qty=$item["qty"];
				$price=$item["unit_price"];

				$db->query("insert into mr_purchase_delivery(purchase_id,item_id,qty,unit_price)values('$purchase_id','$item_id','$qty','$price')");
			}
		}

		unset($_SESSION["purchase"]);
		echo "Successful!";
	}

	if (isset($_POST["btnDec"])) {
		$purchase_id=$_POST["txtPurchaseId"];
		$item_id=$_POST["txtId"];
		dec_item($item_id);
	}
	if (isset($_POST["btnDel"])) {
		$purchase_id=$_POST["txtPurchaseId"];
		$item_id=$_POST["txtId"];
		del_item($item_id);
	}
	
	if (isset($_POST["btnClear"])) {
		if(isset($_SESSION["purchase"])){
			unset($_SESSION["purchase"]);
		}
	}


?>

<div class="app-title">
  <h4>Delivery Purchase</h4>
  <div class="toolbar">
    <div class="group">
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=16">Create Purchase</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=17">View Purchase</a>
      <a class="btn btn-sm btn-outline-primary active" href="home.php?page=21">Delivery Purchase</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=22">Purchase Invoice</a>
    </div>
  </div>
</div>

<form action="#" method="post">
	<div class="row">
		<div class="col-md-3">
			<input class="form-control form-control-sm" type="text" name="txtPurchaseId" value="<?php echo isset($purchase_id)?$purchase_id:'' ;?>">
		</div>
		<input type="submit" name="btnGo" value="GO" class="btn btn-sm btn-success">

	</div>


<?php
  if (isset($_SESSION["purchase"])) {
    $sn=1;
    echo "<table class='table table-sm table-striped'>";
    echo "<tr><th>SN.</th><th>Product</th><th style='text-align: right;'>Qty</th><th style='text-align: right;'>Unit Price</th><th style='text-align: right;'>Total</th><th style='text-align: right;'>Action</th></tr>";

      $subtotal=0;

      foreach ($_SESSION["purchase"] as $key => $item) {
        $item_id=$key;
        $qty=$item["qty"];
        $price=$item["unit_price"];

        $subtotal+=$qty*$price;

        echo "<tr>
                <td width='8%'>".$sn++."</td>
                <td width='22%'>".get_item_name($item_id)."</td>
                <td width='7%' style='text-align: right;'>$qty</td>
                <td width='15%' style='text-align: right;'>$price</td>
                <td width='15%' style='text-align: right;'>".$qty*$price."</td>
                <td width='30%' style='text-align: right;'><form action='#' method='post'>
                <input type='hidden' value='$item_id' name='txtId'>
                <input type='submit' class='btn btn-sm btn-outline-warning' value=' - ' name='btnDec'>
				<input type='submit' class='btn btn-sm btn-outline-danger' value='Del' name='btnDel'>
                </form></td>
              </tr>";
      }

    echo "<tr><th style='text-align: right;' colspan='4'></th><th style='text-align: right;'>Total=> $$subtotal</th>
    <th style='text-align: right;'>
    	<input type='submit' name='btnClear' value='Clear All' class='btn btn-sm btn-outline-danger'>
    <input type='submit' name='btnDeliver' value='Deliver' class='btn btn-sm btn-outline-success' />
    </div>
    </th>
    </tr>";
    echo "</table";
  }
?>

</form>