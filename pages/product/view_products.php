<div class="app-title">
  <h3>Product Details</h3>
  <div class="toolbar">
    <div class="group">
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=13">Add Product</a>
      <a class="btn btn-sm btn-outline-primary active" href="home.php?page=19">Product Details</a>
    </div>
  </div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tile">
  <div class="tile-body">
  <table class="table table-hover table-bordered table-sm" id="products">
   <thead class="bg-primary" style="color: white;">
   		<tr><th>ID</th><th>Barcode</th><th>Category</th><th>Type</th><th>Name</th><th>UoM</th><th>Qty</th><th>Unit Price</th><th>Manufacturer</th><th>Description</th><th>Action</th></tr>
	</thead>
<?php
    require_once("functions.php");
	if(isset($_POST["btnDelete"])){
	  $product_id=$_POST["txtId"];
	  
	  $db->query("delete from mr_product where id='$product_id'");
	  echo "Deleted";
	} 
   $con_table=$db->query("select p.id,p.barcode,c.name,t.name,p.name,u.name,p.qty,p.unit_price,p.manufacturer,p.description from mr_product p,mr_product_category c,mr_product_type t,mr_product_uom u where c.id=p.category_id and t.id=p.type_id and u.id=p.uom_id group by p.name");   
   while(list($id,$barcode,$category,$type,$name,$uom,$qty,$price,$mfg,$desc)=$con_table->fetch_row()){
	   
	   //$added_on=date("d M Y h:i A",strtotime($added_on));
	   
	   
	 echo "<tr><td>$id</td><td>$barcode</td><td>$category</td><td>$type</td><td>$name</td><td>$uom</td><td>$qty</td><td>$price</td><td>$mfg</td><td>$desc</td><td>
			<form action='home.php?page=20' method='post' style='display:inline'>
			<input type='hidden' name='txtId' value='$id' />
			<button type='submit' name='btnEdit' class='btn btn-sm btn-info'><i class='fa fa-edit'></i></button>
			</form>
			<form action='home.php?page=19' method='post' style='display:inline' onsubmit='return confirm(\"Are you sure?\")'><input type='hidden' name='txtId' value='$id' /><button type='submit' name='btnDelete' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></button></form></td></tr>";  
   }
?>
</table>
</div>
</div>
</div>
</div>
<script type="text/javascript">
	$(function(){
		$('#products').DataTable();
	});
</script>