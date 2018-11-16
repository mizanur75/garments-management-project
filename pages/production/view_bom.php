<div class="app-title">
  <h4>Details BOM</h4>
  <div class="toolbar">
    <div class="group">
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=29">Create BOM</a>
      <a class="btn btn-sm btn-outline-primary active" href="home.php?page=30">Details BOM</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=31">Delivery</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=32">View</a>
    </div>
  </div>
</div>

<div style="margin-bottom: 10px; height: 700px;">
<?php
	require_once("functions.php");
	if(isset($_POST["btnDel"])){
		$production_id=$_POST["txtId"];
		
		$db->query("delete from mr_production_master where id='$production_id'");
	}
	
	$perpage = 10;
	$pg=(isset($_GET["pg"])) ? (int)$_GET["pg"]:1;
	$start_at= $perpage * ($pg - 1);

	$rows = $db->query("select count(*) from mr_production_master");
	list($total)=$rows->fetch_row();
	$totalPages = ceil($total / $perpage);

	if(isset($_GET["production_id"])){
	 	$production_id=$_GET["production_id"];
		
		echo "<table><tr><th>Production No: </th><th>$production_id</th></tr></table>";
		
		$production_details_table=$db->query("select pd.id,p.name,pd.qty,pd.unit_price from mr_production_master pm,mr_product p,mr_production_details pd where pm.id=pd.production_id and p.id=pd.item_id and pm.id='$production_id' limit $start_at,$perpage");
		
		echo "<table class='table table-striped table-sm'>";
		echo "<tr><th>SN</th><th>Item</th><th>Qty</th><th>Unit Price</th><th>Total</th></tr>";
		$sn=1;
		$invoice_total=0;
		while(list($item_id,$item,$qty,$price)=$production_details_table->fetch_row()){
			
			$line_total=$qty*$price;
			$invoice_total+=$line_total;
			
			echo "<tr><td>".($sn++)."</td><td>$item</td><td>$qty</td><td>$price</td><td>".$qty*$price."</td></tr>";
			
		}
		echo "<tr><th colspan='4' style='text-align:right;'>Total= </th><th>$$invoice_total</th></tr>";
		echo "</table>";
		
		 
	}else{
	   
	   $con_table=$db->query("select pm.id,p.name,pm.qty,pm.date from mr_product p,mr_production_master pm where p.id=pm.item_id");
	   
	   echo "<table class='table table-striped table-sm'>";
	   echo "<tr><th>Production Id</th><th>Product Name</th><th>Quantity</th><th>Date/Time</th><th>Action</th></tr>";
   		
	    while(list($id,$name,$qty,$date)=$con_table->fetch_row()){
		   
		   
		 echo "<tr><td><a class='btn btn-sm btn-outline-primary' href='home.php?page=30&production_id=$id'>$id</a></td><td>$name</td><td>$qty</td><td>$date</td><td><form action='home.php?page=30' method='post' style='display:inline' onsubmit='return confirm(\"Are you sure?\")'><input type='hidden' name='txtId' value='$id' /><input type='submit' name='btnDel' style='color: red;' class='material-icons' value='delete'></form></td></tr>";  
	    }
   
   		echo "</table>";
	}
?>
</div>
<div>
	<?php
	echo pagination($pg,$totalPages,30);
	?>
</div>