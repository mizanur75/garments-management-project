<?php

  if(isset($_POST["btnUpdate"])){
	  
	  $id=$_POST["txtId"];	  
    $barcode = $_POST["txtBarcode"];
    $category = $_POST["cmbCategory"];
    $type = $_POST["cmbType"];
    $name = $_POST["txtName"];
    $uom = $_POST["cmbUom"];
    $qty = $_POST["txtQty"];
    $price = $_POST["txtPrice"];
    $mfg = $_POST["txtMfg"];
    $desc = $_POST["txtDesc"];
	  
	  $db->query("update product set barcode='$barcode',category='$category',type='$type',name='$name',uom='$uom',qty='$qty',price='$price',mfg='$mfg',desc='$desc' where id='$id'");
  
	  echo "Success Updated!";
	  
  }
  
  
  if(isset($_POST["btnEdit"])){
	  $id=$_POST["txtId"];
	  
	  $product_tbl=$db->query("select barcode,category_id,type_id,name,uom_id,qty,unit_price,manufacturer,description from mr_product where id='$id'");
	  
	  
    list($barcode,$category,$type,$name,$uom,$qty,$price,$mfg,$desc)=$product_tbl->fetch_row();
	}
  

?>
<div class="app-title">
  <h4>Update Product</h4>
  <div class="toolbar">
    <div class="group">
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=13">Add Product</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=19">Product Details</a>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body">
<form action="#" method="post" style="margin: 0px auto; width: 100%;">
  
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">ID</label>
        <div class="col-sm-3">
          <input type="text" name="txtBarcode" class="form-control" placeholder="<?php echo isset($id)?$id:'';?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Barcode</label>
        <div class="col-sm-3">
          <input type="text" name="txtBarcode" class="form-control" placeholder="<?php echo isset($barcode)?$barcode:''?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Category</label>
        <div class="col-sm-3">
          <select name="cmbCategory" class="form-control" placeholder="<?php echo isset($category)?$category:''?>">
            <?php
              $category_table=$db->query("select id,name from mr_product_category");
              while(list($id,$name)=$category_table->fetch_row()){
                  echo "<option value='$id'>$name</option>";
               }
            ?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Type</label>
        <div class="col-sm-3">
          <select name="cmbType" class="form-control" placeholder="<?php echo isset($type)?$type:''?>">
            <?php
              $type_table=$db->query("select id,name from mr_product_type");
              while(list($id,$name)=$type_table->fetch_row()){
                  echo "<option value='$id'>$name</option>";
               }
            ?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="txtName" placeholder="<?php echo isset($name)?$name:''?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">UoM</label>
        <div class="col-sm-3">
          <select name="cmbUom" class="form-control" placeholder="<?php echo isset($uom)?$uom:''?>">
            <?php
              $type_table=$db->query("select id,name from mr_product_uom");
              while(list($id,$name)=$type_table->fetch_row()){
                  echo "<option value='$id'>$name</option>";
               }
            ?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Quantity</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="txtQty" placeholder="<?php echo isset($qty)?$qty:''?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Unit Price</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="txtPrice" placeholder="<?php echo isset($price)?$price:''?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Manufacturer</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="txtMfg" placeholder="<?php echo isset($mfg)?$mfg:''?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="txtDesc" placeholder="<?php echo isset($desc)?$desc:''?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label"></label>
        <div class="col-sm-3">
          <input type="submit" class="btn btn-primary" name="btnUpdate" value="Updated" />
        </div>
      </div>
      
  </form>
</div>
</div>
</div>
</div>