<?php
	//$wc=$_SESSION["s_username"];
	if(isset($_GET["page"])){
		$page=$_GET["page"];
		
		if($page==1){

//================= User ===========================================

			include("pages/user/add_user.php");
		}elseif($page==3){
			include("pages/user/view_user.php");
		//}elseif($page==2){
		//	include("pages/user/manage_user.php");
		}elseif($page==4){
			include("pages/user/edit_user.php");
			
//================== employee =====================================

		}elseif($page==6){
			include("pages/employee/view_employee.php");
		}elseif($page==7){
			include("pages/employee/add_employee.php");
		}elseif($page==8){
			include("pages/employee/manage_employee.php");
		}elseif($page==9){
			include("pages/employee/edit_employee.php");
		}elseif($page==10){
			include("salary/add_salary.php");
			
			
//=================== Sales Order ===========================================
			
		}elseif($page==11){
			include("pages/order/create_order.php");
		}elseif($page==12){
			include("pages/order/view_orders.php");
		}elseif($page==18){
			include("pages/order/deliver_order.php");
		}elseif($page==15){
			include("pages/order/customer.php");
		}elseif($page==26){
			include("pages/order/customer_edit.php");
		}elseif($page==27){
			include("pages/order/customer_details.php");
		}elseif($page==25){
			include("pages/order/sales_invoice.php");


//================== Supplier ==============================

		}elseif($page==14){
			include("pages/supplier/supplier.php");
		}elseif($page==23){
			include("pages/supplier/view_supplier.php");
		}elseif($page==24){
			include("pages/supplier/edit_supplier.php");

//==================== Purchase ============================
		}elseif($page==16){
			include("pages/purchase/create_purchase.php");
		}elseif($page==21){
			include("pages/purchase/purchase_delivery.php");
		}elseif($page==17){
			include("pages/purchase/view_purchase_details.php");
		}elseif($page==22){
			include("pages/purchase/purchase_invoice.php");
		


//=============== Product =================================

		}elseif($page==13){
			include("pages/product/add_product.php");
		}elseif($page==19){
			include("pages/product/view_products.php");
		}elseif($page==20){
			include("pages/product/edit_product.php");
		}elseif($page==28){
			include("pages/product/view_rowmaterials.php");
		}elseif($page==34){
			include("pages/product/view_inventory.php");
		}
//================= Production ============================
		elseif($page==29){
			include("pages/production/create_bom.php");
		}elseif($page==30){
			include("pages/production/view_bom.php");
		}elseif($page==31){
			include("pages/production/production_delivery.php");
		}elseif($page==32){
			include("pages/production/view.php");


//============== wear house =================================

		}elseif($page==33){
			include("stock_transition.php");
		}elseif($page==35){
			include("pages/wearhouse/wearhouse.php");
		}

//============== 34 Pages =================================
	}else{
		include("charts.php");
	}



?>