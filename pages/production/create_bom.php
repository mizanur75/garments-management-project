<?php
    //$db=new mysqli("localhost","root","","gms");
    require_once("functions.php");

    if (isset($_POST["btnSubmit"])) {
      $product = $_POST["cmbProduct"];
      $quantity = $_POST["txtQuantity"];

    if (isset($_SESSION["Indent"])) {

     $db->query("insert into mr_production_master(item_id,qty)values('$product','$quantity')");

     $production_id=$db->insert_id;
      
      
        foreach ($_SESSION["Indent"] as $key => $item) {
          $item_id=$key;
          $qty=$item["qty"];
          $unit_price=$item["unit_price"];

          $db->query("insert into mr_production_details(item_id,qty,unit_price,production_id)values('$item_id','$qty','$unit_price','$production_id')");
        }

        unset($_SESSION["Indent"]);
        $success="<b style='color: green; background-color: lightgreen; padding: 5px;'>Successfull Placed Order!</b>";
      }else{
        $error="<b style='color: red; background-color: lightgray; padding: 5px;'>Field Should Be Required!</b>";
      }
    }


// ==================== Add SESSION==============================

  //unset($_SESSION["Indent"]);
  if (isset($_POST["btnAdd"])) {
    $quantity = $_POST["txtQuantity"];
    $item_id=$_POST["cmbRProduct"];
    $qty=$_POST["txtQty"];
    $price=$_POST["txtPrice"];

    if (!isset($_SESSION["Indent"])) {
      $_SESSION["Indent"]= array();
    }

    if(array_key_exists($item_id,$_SESSION["Indent"])){
          
        $_SESSION["Indent"][$item_id]["qty"]++;   
      
    }else{
        
      $_SESSION["Indent"][$item_id]["qty"]=$qty;
      $_SESSION["Indent"][$item_id]["unit_price"]=$price;
      
    }
  }

  if (isset($_POST["btnDelete"])) {
    $quantity = $_POST["txtQuantity"];
    $item_id=$_POST["txtId"];
    del_item($item_id);
  }

  if (isset($_POST["btnInc"])) {
    $quantity = $_POST["txtQuantity"];
    $item_id=$_POST["txtId"];
    inc_item($item_id);
  }

  if (isset($_POST["btnDec"])) {
    $quantity = $_POST["txtQuantity"];
    $item_id=$_POST["txtId"];
    dec_item($item_id);
  }


  if (isset($_POST["btnClear"])) {
    if (isset($_SESSION["Indent"])) {
      unset($_SESSION["Indent"]);
    }
  }

?>
<div class="app-title">
  <h4>Bill of Materials</h4>
  <div class="toolbar">
    <div class="group">
      <a class="btn btn-sm btn-outline-primary active" href="home.php?page=29">Create BOM</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=30">Details BOM</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=31">Delivery</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=32">View</a>
    </div>
  </div>
</div>

<div style="width: 100%;">
    <form action="#" method="post">
        <table class="table table-sm table-striped"><tr><th>Production No: <?php echo get_new_production_id()?><span style="float:right;"><?php echo isset($error)?$error:""; echo isset($success)?$success:"";?></span></th></tr></table>
        <div style="width:100%">
            <table class="">
              <tr>
                <th>Product Name </th>
                <td><b>:</b> <select name="cmbProduct" style="height: 27px; width: 168px;">
                  <option>======= Select =======</option>
                  <?php
                $product=$db->query("select id,name from mr_product where type_id=3");
                while (list($id,$name)=$product->fetch_row()) {
                  echo "<option value='$id'>$name</option>";
                }
                ?></select></td>
              </tr>
              <tr>
                <th>Quantity </th><td><b>:</b> <input type="text" name="txtQuantity" value="<?php echo isset($quantity)?$quantity:''?>"  style="height: 27px; width: 168px;"></td>
              </tr>
            </table>
        </div>
        
 <!--================== Cart Header=======================-->
        <br>
        <div style="width:100%;">
          <table class="table table-sm table-striped table-bordered">
            <tr>
              <th width="25%;">Materials Name </th>
              <th width="25%;">Qty</th>
              <th width="25%;">Unit Price</th>
              <th></th>
            </tr>
            <tr>
              <td width="32%;">
                <select name="cmbRProduct" id="cmbRproduct" class="form-control form-control-sm">
                  <option>======== Select ========</option>
                 <?php
                 $product=$db->query("select id,name from mr_product where category_id=1");
                 while (list($id,$name)=$product->fetch_row()) {
                   echo "<option value='$id'>$name</option>";
                 }
                 ?>
                </select>
              </td>
              <td width="32%;"><input class="form-control form-control-sm" type="text" name="txtQty" value="1"></td>
              <td width="32%;"><input class="form-control form-control-sm" type="text" name="txtPrice" id="txtPrice" value="0"></td>
              <td width="4%;"><input class="btn btn-sm btn-primary" type="submit" name="btnAdd" value=" + "></td>
            </tr>              
          </table>
         </div>
          
          <!--==================Added Details=======================-->
          
        <div style="margin-top: 10px;">
          <div align="center" style="width: 100%; border-radius: 5px;" class="bg-primary">
          	<h5 style="color: white; padding: 7px;">Added Details</h5>
          </div>
          
        
<!--================== Session Cart=======================-->

         <div class="table-responsive" style="max-height: 250px; width:100%;">
          <?php
            if (isset($_SESSION["Indent"])) {
              $sn=1;
              echo "<table class='table table-sm table-striped'>";
              echo "<tr><th>SN.</th><th>Product</th><th>Qty</th><th>Unit Price</th><th>Total</th><th>Action</th></tr>";

                $subtotal=0;

                foreach ($_SESSION["Indent"] as $key => $item) {
                  $item_id=$key;
                  $qty=$item["qty"];
                  $price=$item["unit_price"];

                  $subtotal+=$qty*$price;

                  echo "<tr>
                          <td width='8%'>".$sn++."</td>
                          <td width='22%'>".get_item_name($item_id)."</td>
                          <td width='10%'>$qty</td>
                          <td width='15%'>$price</td>
                          <td width='15%'>".$qty*$price."</td>
                          <td width='30%'><form action='#' method='post'>
                          <input type='hidden' value='$item_id' name='txtId'>
                          <input type='submit' value=' - ' name='btnDec'>
                          <input type='submit' value=' + ' name='btnInc'>
                          <input type='submit' value='DEL' name='btnDelete'>
                          </form></td>
                        </tr>";
                }

              echo "<tr><td colspan='4'></td><td>$subtotal</td></tr>";
              echo "</table";
            }
          ?>
        </div>
        </div>

<!--================== Action Cart=======================-->

            <div align="right" style="margin-top:10px;">
                <input type="submit" name="btnClear" class="btn btn-sm btn-outline-danger" value="Clear">
                <input type="submit" name="btnSubmit" class="btn btn-sm btn-outline-success" value="Create">
            </div>
        
       </div> 
        
    <!--================== End form div=======================-->

  </form>
  
</div>
<script>
	$(function(){
		$("#cmbRproduct").change(function () {
			var item_id=$(this).val();
			
			$.ajax({
				url: 'pages/production/select.php',
				method: 'post',
				data: {'cmbRproduct':item_id},
				success: function(echo){
					$("#txtPrice").val(echo);
				}
			});
			
		});
	});
</script>