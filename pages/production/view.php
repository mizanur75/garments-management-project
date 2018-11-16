
<div class="app-title">
  <h4>View Delivery</h4>
  <div class="toolbar">
    <div class="group">
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=29">Create BOM</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=30">Details BOM</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=31">Delivery</a>
      <a class="btn btn-sm btn-outline-primary active" href="home.php?page=32">View</a>
    </div>
  </div>
</div>
<div style="margin-bottom: 10px; height: 700px;">
<?php
require_once("pagination.php");
require_once("functions.php");
if(isset($_POST["btnDel"])){
  $production_id=$_POST["txtId"];
  
  $db->query("delete from mr_production_master where id='$production_id'");
}

$perpage = 10;
$pg=(isset($_GET["pg"])) ? (int)$_GET["pg"]:1;
$start_at= $perpage * ($pg - 1);

$rows = $db->query("select count(*) from mr_production_delivery");
list($total)=$rows->fetch_row();
$totalPages = ceil($total / $perpage);
$production_delivery_table=$db->query("select id,item_id,qty,production_id,date from mr_production_delivery");
echo "<table class='table table-sm table-striped'>";
echo "<tr><th>ID</th><th>Product Name</th><th>Qty</th><th>Production ID</th><th>Date/Time</th></tr>";
while (list($id,$item_id,$qty,$production_id,$date)=$production_delivery_table->fetch_row()) {
	echo "<tr>
	<td>$id</td>
	<td>".get_item_name($item_id)."</td>
	<td>$qty</td>
  <td>$production_id</td>
	<td>$date</td>
	</tr>";
}
echo "</table>";
?>
</div>
<div>
  <?php
    echo pagination($pg,$totalPages,32);
  ?>
</div>