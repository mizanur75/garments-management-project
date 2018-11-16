<?php
    //$db=new mysqli("localhost","root","","gms");
    require_once("lib.php");
    $now=date("Y-m-d");

    if (isset($_POST["btnSubmit"])) {
      $customer = $_POST["cmbCustomer"];
      $payment_method = $_POST["txtPaymentMethod"];
      $shipping_address = $_POST["txtShippingtAddress"];
      $delivery_date = $_POST["txtDelivery"];
      $remark = $_POST["cmbRemark"];

      $order_date=date("Y-m-d H:i:s");

    if (isset($_SESSION["Orders"])) {

     $db->query("insert into mr_order_master(customer_id,payment_method,shipping_address,order_date,delivery_date,remark)values('$customer','$payment_method','$shipping_address','$order_date','$delivery_date','$remark')");

     $order_id=$db->insert_id;
      
      
        foreach ($_SESSION["Orders"] as $key => $item) {
          $item_id=$key;
          $size=$item["size"];
          $qty=$item["qty"];
          $unit_price=$item["unit_price"];

          $db->query("insert into mr_order_details(order_id,item_id,size,qty,unit_price)values('$order_id','$item_id','$size','$qty','$unit_price')");
        }

        unset($_SESSION["Orders"]);
        $success="<b style='color: green; background-color: lightgreen; padding: 5px;'>Successfull Placed Order!</b>";
      }else{
        $error="<b style='color: red; background-color: lightgray; padding: 5px;'>Field Should Be Required!</b>";
      }
    }


// ==================== Add SESSION==============================

  //unset($_SESSION["Orders"]);
  if (isset($_POST["btnAdd"])) {
    $item_id=$_POST["cmbProduct"];
    $size=$_POST["txtSize"];
    $qty=$_POST["txtQty"];
    $price=$_POST["txtPrice"];

    if (!isset($_SESSION["Orders"])) {
      $_SESSION["Orders"]= array();
    }

    if(array_key_exists($item_id,$_SESSION["Orders"])){
          
        $_SESSION["Orders"][$item_id]["qty"]++;   
      
    }else{
        
      $_SESSION["Orders"][$item_id]["qty"]=$qty;
      $_SESSION["Orders"][$item_id]["size"]=$size;
      $_SESSION["Orders"][$item_id]["unit_price"]=$price;
      
    }
  }

  if (isset($_POST["btnDelete"])) {
    $item_id=$_POST["txtId"];
    del_item($item_id);
  }

  if (isset($_POST["btnInc"])) {
    $item_id=$_POST["txtId"];
    inc_item($item_id);
  }

  if (isset($_POST["btnDec"])) {
    $item_id=$_POST["txtId"];
    dec_item($item_id);
  }


  if (isset($_POST["btnClear"])) {
    if (isset($_SESSION["Orders"])) {
      unset($_SESSION["Orders"]);
    }
  }

?>
<div class="app-title">
  <h4>Create Order</h4>
  <div class="toolbar">
    <div class="group">
      <a class="btn btn-sm btn-outline-primary active" href="home.php?page=11">Create Order</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=12">View Orders</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=18">Delivery Orders</a>
      <a class="btn btn-sm btn-outline-primary" href="home.php?page=25">Sales Invoice</a>
    </div>
  </div>
</div>

<div style="width: 100%;">
    <form action="#" method="post">
        <table class="table table-sm table-striped"><tr><th>Order No: <?php echo get_new_order_id()?><span style="float:right;"><?php echo isset($error)?$error:""; echo isset($success)?$success:"";?></span></th></tr></table>
        <div style="width:100%">
            <table class="">
              <tr>
                <th>Customer Name </th>
                <td><b>:</b> <select name="cmbCustomer" style="height: 27px; width: 168px;">
                  <option value=''>===== Select =====</option>
                  <?php
                $customer=$db->query("select id,name from mr_customer");
                while (list($id,$name)=$customer->fetch_row()) {
                  echo "<option value='$id'>$name</option>";
                }
                ?></select></td>
              </tr>
              <tr>
                <th>Payment Method </th><td><b>:</b>
                  <select type="text" name="txtPaymentMethod" style="height: 27px; width: 168px;">
                  <option>Cash</option>
                  <option>Cheque</option>
                  <option>Credit Card</option>
                  <option>Online Banking</option>
                </select></td>
                <tr>
                  <th>Shipping Address</th><td><b>:</b> <textarea type="text" name="txtShippingtAddress" style="width: 220px; height: 27px;"></textarea></td>
                  <th>Order Date</th><td> <b>:</b><input style="height: 27px; width: 90px;" type="text" value="<?php echo $now ;?>" disabled></td>
                  <th>Delivery Date</th><td><b>:</b> <input type="date" name="txtDelivery"></td>
                  <th>Remark</th>
                  <td>
                    :<select name="cmbRemark" style="height: 27px; width: 70px;">
                      <option value="Paid">Paid</option>
                      <option value="Due">Due</option>
                    </select>
                  </td>
                </tr>
              </tr>
            </table>
        </div>
        
 <!--================== Cart Header=======================-->
        <br>
        <div style="width:100%;">
          <table class="table table-sm table-striped table-bordered">
            <tr>
              <th width="25%;">Product Name </th>
              <th width="25%;">Size</th>
              <th width="25%;">Qty</th>
              <th width="25%;">Unit Price</th>
              <th></th>
            </tr>
            <tr>
              <td width="25%;">
                <select name="cmbProduct" id="cmbProduct" class="form-control form-control-sm">
                  <option value=''>========= Select =========</option>
                 <?php
                 $product=$db->query("select id,name from mr_product where category_id=2");
                 while (list($id,$name)=$product->fetch_row()) {
                   echo "<option value='$id'>$name</option>";
                 }
                 ?>
                </select>
              </td>
              <td width="25%;">
                <select name="txtSize" class="form-control form-control-sm">
                  <option>N/A</option>
                  <option value="S">S</option>
                  <option value="M">M</option>
                  <option value="L">L</option>
                  <option value="XL">XL</option>
                  <option value="XML">XML</option>
                </select>
              </td>
              <td width="25%;"><input class="form-control form-control-sm" type="text" name="txtQty" value="0"></td>
              <td width="25%;"><input class="form-control form-control-sm" type="text" name="txtPrice" id="txtPrice" value="0"></td>
              <td width="25%;"><input class="btn btn-sm btn-primary" type="submit" name="btnAdd" value=" + "></td>
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
            if (isset($_SESSION["Orders"])) {
              $sn=1;
              echo "<table class='table table-sm table-striped'>";
              echo "<tr><th>SN.</th><th>Product</th><th>Size</th><th>Qty</th><th>Unit Price</th><th>Total</th><th>Action</th></tr>";

                $subtotal=0;

                foreach ($_SESSION["Orders"] as $key => $item) {
                  $item_id=$key;
                  $size=$item["size"];
                  $qty=$item["qty"];
                  $price=$item["unit_price"];

                  $subtotal+=$qty*$price;

                  echo "<tr>
                          <td width='8%'>".$sn++."</td>
                          <td width='22%'>".get_item_name($item_id)."</td>
                          <td width='10%'>$size</td>
                          <td width='10%'>$qty</td>
                          <td width='15%'>$$price</td>
                          <td width='15%'>$".$qty*$price."</td>
                          <td width='30%'><form action='#' method='post'>
                          <input type='hidden' value='$item_id' name='txtId'>
                          <input type='submit' value=' - ' name='btnDec'>
                          <input type='submit' value=' + ' name='btnInc'>
                          <input type='submit' value='DEL' name='btnDelete'>
                          </form></td>
                        </tr>";
                }

              echo "<tr><td colspan='5'></td><td>$$subtotal</td></tr>";
              echo "</table";
            }
          ?>
        </div>
        </div>

<!--================== Action Cart=======================-->

            <div align="right" style="margin-top:10px;">
                <input type="submit" name="btnClear" class="btn btn-sm btn-outline-danger" value="Clear">
                <input type="submit" name="btnSubmit" class="btn btn-sm btn-outline-success" value="Create Order">
            </div>
        
       </div> 
        
    <!--================== End form div=======================-->

  </form>
  
</div><!--================== End div=======================-->

<script>
	$(function(){
		$("#cmbProduct").change(function(){
			var item_id=$(this).val();
			$.ajax({
				url: 'pages/order/ajax.php',
				method: 'post',
				data:{'cmbProduct': item_id},
				success: function(echo){
					$("#txtPrice").val(echo);
				}
			});
		});
	});
</script>