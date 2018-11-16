<div class="app-title">
  <h3>Row Materials</h3>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tile">
  <div class="tile-body">
  <table class="table table-hover table-bordered table-sm" id="rowmaterials">
   <thead class="bg-primary" style="color: white;">
   	<tr><th>ID</th><th>Barcode</th><th>Name</th><th>UoM</th><th>Qty</th><th>Unit Price</th><th>Manufacturer</th><th>Description</th><th>Action</th></tr>
	</thead>
<?php 
	if(isset($_POST["btnDelete"])){
	  $product_id=$_POST["txtId"];
	  
	  $db->query("delete from mr_product where id='$product_id'");
	  echo "Deleted";
	}
	   
   $con_table=$db->query("select p.id,p.barcode,p.name,u.name,p.qty,p.unit_price,p.manufacturer,p.description from mr_product p,mr_product_uom u where u.id=p.uom_id and category_id=1");
   
   while(list($id,$barcode,$name,$uom,$qty,$price,$mfg,$desc)=$con_table->fetch_row()){   
	   
	 echo "<tr><td>$id</td><td>$barcode</td><td>$name</td><td>$uom</td><td>$qty</td><td>$price</td><td>$mfg</td><td>$desc</td><td>
			<form action='#' method='post' style='display:inline'>
			<input type='hidden' name='txtId' value='$id' />
			<button type='submit' name='btnEdit' class='btn btn-sm btn-info'><i class='fa fa-edit'></i></button>
			</form>
			<form action='home.php?page=28' method='post' style='display:inline' onsubmit='return confirm(\"Are you sure?\")'><input type='hidden' name='txtId' value='$id' /><button type='submit' name='btnDelete' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></button></form></td></tr>";  
   }   
?>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('#rowmaterials').DataTable();
	});
</script>