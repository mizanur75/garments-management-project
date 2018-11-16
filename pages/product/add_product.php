<?php 
	if(isset($_POST["btnSubmit"])){
    $barcode = $_POST["txtBarcode"];
    $category = $_POST["cmbCategory"];
		$type = $_POST["cmbType"];
    $name = $_POST["cmbProductName"];
    $uom = $_POST["cmbUom"];
    $qty = $_POST["txtQty"];
		$price = $_POST["txtPrice"];
    $mfg = $_POST["txtMfg"];
    $desc = $_POST["txtDesc"];

		$db->query("insert into mr_product(barcode,category_id,type_id,name,uom_id,qty,unit_price,manufacturer,description)values('$barcode','$category','$type','$name','$uom','$qty','$price','$mfg','$desc')");
		echo "successfull!";
	}
?>
<div class="app-title">
  <h4>Add Product</h4>
  <div class="toolbar">
    <div class="group">
      <a class="btn btn-sm btn-outline-primary active" href="home.php?page=13">Add Product</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=19">Product Details</a>
    </div>
  </div>
</div>
<div class="col-md-12">
  <div class="tile">
    <div class="tile-body">
	<form action="#" method="post"">

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Barcode</label>
        <div class="col-sm-3">
          <input type="text" name="txtBarcode" class="form-control">
        </div>
      </div>

      


      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Category</label>
        <div class="col-sm-3">
          <select name="cmbCategory" class="form-control">
            <?php
              $category_table=$db->query("select id,name from mr_product_category");
              while(list($id,$name)=$category_table->fetch_row()){
                  echo "<option value='$id'>$name</option>";
               }
            ?>
          </select>
        </div>
        <div class="col-sm-2">
          <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#myCategory">
              Add New
          </button>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Type</label>
        <div class="col-sm-3">
          <select name="cmbType" class="form-control">
            <?php
              $type_table=$db->query("select id,name from mr_product_type");
              while(list($id,$name)=$type_table->fetch_row()){
                  echo "<option value='$id'>$name</option>";
               }
            ?>
          </select>
        </div>
        <div class="col-sm-2">
          <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#myType">
              Add New
          </button>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-3">
          <select name="cmbProductName" class="form-control">
            <?php
            $product_name_table=$db->query("select id,name from mr_product_name");
            while(list($id,$name)=$product_name_table->fetch_row()){
            echo "<option value='$name'>$name</option>";
            }
            ?>
          </select>
        </div>
        <div class="col-sm-2">
          <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#myProduct">
              Add New
          </button>
        </div>
      </div>
      
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">UoM</label>
        <div class="col-sm-3">
          <select name="cmbUom" class="form-control">
            <?php
              $type_table=$db->query("select id,name from mr_product_uom");
              while(list($id,$name)=$type_table->fetch_row()){
                  echo "<option value='$id'>$name</option>";
               }
            ?>
          </select>
        </div>
        <div class="col-sm-2">
          <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#myUoM">
              Add New
          </button>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Quantity</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="txtQty">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Unit Price</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="txtPrice">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Manufacturer</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="txtMfg">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="txtDesc">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label"></label>
        <div class="col-sm-3">
          <input type="submit" style="float: right;" class="btn btn-primary" name="btnSubmit" value="Save" />
        </div>
      </div>
      
	</form>
</div>
</div>
</div>
