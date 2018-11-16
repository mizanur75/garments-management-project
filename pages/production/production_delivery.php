<?php
	require_once("functions.php");
	if (isset($_POST["btnSubmit"])) {
		unset($_SESSION["Indent"]);
		$production_id=$_POST["txtProductionId"];

		$production_master_table=$db->query("select item_id,qty from mr_production_master where id='$production_id'");
		while (list($item_id,$qty)=$production_master_table->fetch_row()) {
			//echo $item_id;
			if (!isset($_SESSION["Indent"])) {
				$_SESSION["Indent"]=array();
			}

			$_SESSION["Indent"][$item_id]["qty"]=($qty-get_production_delivery_qty($production_id));
		}
	}

	if (isset($_POST["btnDeliver"])) {
		$production_id=$_POST["txtProductionId"];
		if (isset($_SESSION["Indent"])) {
			foreach ($_SESSION["Indent"] as $key => $item) {
				$item_id=$key;
				$qty=$item["qty"];

				$db->query("insert into mr_production_delivery(production_id,item_id,qty)values('$production_id','$item_id','$qty')");
			}
		}

		unset($_SESSION["Indent"]);
		echo "Successful!";
	}

	if (isset($_POST["btnDec"])) {
		$item_id=$_POST["txtId"];
		dec_item($item_id);
	}
	if (isset($_POST["btnDel"])) {
		$item_id=$_POST["txtId"];
		del_item($item_id);
	}
	if(isset($_POST["btnClear"])){
		if(isset($_SESSION["Indent"])){
			unset($_SESSION["Indent"]);
		}
	}
?>
<div class="app-title">
  <h4>View Delivery</h4>
  <div class="toolbar">
    <div class="group">
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=29">Create BOM</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=30">Details BOM</a>
      <a class="btn btn-sm btn-outline-primary active" href="home.php?page=31">Delivery</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=32">View</a>
    </div>
  </div>
</div>
<form action="#" method="post">
	<input type="text" name="txtProductionId" value="<?php echo isset($production_id)?$production_id:''?>">
	<input type="submit" name="btnSubmit" value="GO">


<?php
  if (isset($_SESSION["Indent"])) {
    $sn=1;
    echo "<table class='table table-sm table-striped'>";
    echo "<tr><th>SN.</th><th>Product</th><th style='text-align: right;'>Qty</th><th style='text-align: right;'>Action</th></tr>";

      //$subtotal=0;

      foreach ($_SESSION["Indent"] as $key => $item) {
        $item_id=$key;
        $qty=$item["qty"];
        //$price=$item["unit_price"];

        //$subtotal+=$qty*$price;

        echo "<tr>
                <td width='10%'>".$sn++."</td>
                <td width='30%'>".get_item_name($item_id)."</td>
                <td width='30%' style='text-align: right;'>$qty</td>
                <td width='30%' style='text-align: right;'><form action='#' method='post'>
                <input type='hidden' value='$item_id' name='txtId'>
                <input type='submit' value=' - ' name='btnDec'>
				<input type='submit' value='Del' name='btnDel'>
                </form></td>
              </tr>";
      }
    echo "<tr><th style='text-align: right;' colspan='3'></th><th style='text-align: right;'><input type='submit' name='btnClear' value='Clear All' /><input type='submit' name='btnDeliver' /></th></tr>";
    echo "</table";
  }
?>

</form>