<?php
session_start();
if(!isset($_SESSION['userUId'])){
	$current_page = $_SERVER['REQUEST_URI'];
	$_SESSION['curr_page'] = $current_page;	
	
	header("Location:LoginOrRegister.php");
}
$modoralt = $_SESSION['modORalt'];
$title = 'Payment';
include_once 'includes/header.php';
?>
<section id="payment" class="section paymentsec content">
	<div class="container">
		<h1>Your order</h1><br>
		<div class="order-method-div-top p-3 border-new border border-dark rounded" <?php if(isset($_SESSION['cart'])){?>style="border-bottom: 0px !important;<?php } ?>">
			<b>Order method:</b>
			<!-- <?php
				//echo POST['ORDER-METHOD'];
			?> -->
			<img src="">
			<a href="addresscon.php" id="orderredirect">Change order method</a><br><br>
			<div>
				<?php
					if ($modoralt == "modification") 
					{
					?>
				<p><b>Current address:</b> <?php
				foreach($_SESSION['modaddress'] as $value)
				{
					echo $value['modadhname'] . ", " . $value['modadpcode'] . ", " . $value['modadcountry'];
				}
				?></p><?php 
				}
				if ($modoralt == "alteration") 
					{
				?>
				<p><b>Current address:</b> <?php
				foreach($_SESSION['altaddress'] as $value)
				{
					echo $value['altadhname'] . ", " . $value['altadpcode'] . ", " . $value['altadcountry'];
				}
				?></p><?php 
				}?>
			</div>
		</div>
		<?php
		if(isset($_SESSION['cart'])){
		?>
		<div class="cart-div-second p-3 border-new border border-dark border-top-0 rounded">
			<!-- <?php
				//echo POST['order-item(n)'];
			?> -->
			<a href="">Edit your shopping bag</a>
		</div>
	<?php } ?>
		<div class="paymentmain" style="margin-left: 0px;margin-right: 0px">
			<div class="p-3 mt-3 border-new border border-dark rounded paymentleft">
				<div class="payment-method-div-third">
					<div style="width: 98%;">
						<h5><b>Pay using Cash on delivery</b></h5><br>
						<p>Depending on your chosen order method above, your payment will be made using cash on delivery</p>
						<?php
		 					//if ($ordermethod == "pickup") {
		 						# code...
		 					//}
		 					//else if($ordermethod == "dropoff"){
		 						# code...
		 					//}
						?>

					</div>
					
				</div>
			</div>

			<div class="p-3 mt-3 border-new border-0 border-dark rounded paymentright">
				<h4 class="pb-3">Your cart</h4>
				<?php
				if(isset($_SESSION['cart']))
				{
					foreach($_SESSION['cart'] as $item)
					{
						echo $item['product_id'];?><br><?php
						echo $item['title'];?><br><?php
						echo $item['price'];?><br><?php
						echo $item['quantity'];?><br><?php
					}
				}

				if ($modoralt == "modification") {
					?>
					<h4><b>Custom Modification</b></h4><br>
					<?php
					foreach ($_SESSION['modcart'] as $item) {
						if ($item['selectedpkg'] == 1) {?>
							<div class="accordion-group" id="make">
								<div class="accordion-heading">
									<div class="border border-dark border-new accordion-toggle collapsed" data-toggle="collapse" href="#collapse_0" aria-expanded="false">
										<b><h5 class="p-2">Selected package</h5><?php echo $item['selectedpkg'];?><br></b>
										<a href="#">Click for package details
											<i class="fa fa-caret-down"></i>
										</a>
									</div>
								</div>
								<div id="collapse_0" class="accordion-body in collapse" style="">
									<ul style="list-style: none; padding: 10px;">
										<li>Remove jump cover</li>
										<li>Reflectors</li>
										<li>Remove mudguard</li>
										<li>Body paint (User defined)</li>
									</ul>
								</div>
							</div>
							<!-- <div class="border border-dark border-new"><h5 class="p-2">Paint</h5><?php echo $item['paint'];?><br></div> -->
							<div class="border border-dark border-new"><h5 class="p-2">Instructions for mechanic</h5><?php echo $item['description'];?><br></div>
							<div class="border border-dark border-new"><h5 class="p-2">Package Price</h5><?php echo $item['price']." Rs.";?><br></div><?php
						}
						elseif ($item['selectedpkg'] == 2){?>
							<div class="accordion-group" id="make">
								<div class="accordion-heading">
									<div class="border border-dark border-new accordion-toggle collapsed" data-toggle="collapse" href="#collapse_0" aria-expanded="false">
										<h5 class="p-2">Selected package</h5><?php echo $item['selectedpkg'];?><br>
										<a href="#">Click for package details
											<i class="fa fa-caret-down"></i>
										</a>
									</div>
								</div>
								<div id="collapse_0" class="accordion-body in collapse" style="">
									<ul style="list-style: none; padding: 10px;">
										<li>Remove jump cover</li>
										<li>Reflectors</li>
										<li>HID Lights</li>
										<li>Remove mudguard</li>
										<li>Add theme (User defined)</li>
										<li>Body paint (User defined)</li>
									</ul>
								</div>
							</div>
							<!-- <div class="border border-dark border-new"><h5 class="p-2">Paint</h5><?php echo $item['paint'];?><br></div>
							<div class="border border-dark border-new"><h5 class="p-2">Theme</h5><?php echo $item['theme'];?><br></div> -->
							<div class="border border-dark border-new"><h5 class="p-2">Instructions for mechanic</h5><?php echo $item['description'];?><br></div>
							<div class="border border-dark border-new"><h5 class="p-2">Package Price</h5><?php echo $item['price']." Rs.";?><br></div><?php
						}
						elseif ($item['selectedpkg'] == 3){?>
							<div class="accordion-group" id="make">
								<div class="accordion-heading">
									<div class="border border-dark border-new accordion-toggle collapsed" data-toggle="collapse" href="#collapse_0" aria-expanded="false">
										<h5 class="p-2">Selected package</h5><?php echo $item['selectedpkg'];?><br>
										<a href="#">Click for package details
											<i class="fa fa-caret-down"></i>
										</a>
									</div>
								</div>
								<div id="collapse_0" class="accordion-body in collapse" style="">
									<ul style="list-style: none; padding: 10px;">
										<li>Remove jump cover</li>
										<li>Reflectors</li>
										<li>HID Lights</li>
										<li>Remove mudguard</li>
										<li>Short meter</li>
										<li>Remove headlight holders</li>
										<li>Add theme (User defined)</li>
										<li>Body paint (User defined)</li>
									</ul>
								</div>
							</div>
							<!-- <div class="border border-dark border-new"><h5 class="p-2">Paint</h5><?php echo $item['paint'];?><br></div>
							<div class="border border-dark border-new"><h5 class="p-2">Theme</h5><?php echo $item['theme'];?><br></div> -->
							<div class="border border-dark border-new"><h5 class="p-2">Instructions for mechanic</h5><?php echo $item['description'];?><br></div>
							<div class="border border-dark border-new"><h5 class="p-2">Package Price</h5><?php echo $item['price']." Rs.";?><br></div>
							
						<?php }
						elseif ($item['selectedpkg'] == "custom") {?>
							<div class="accordion-group" id="make">
								<div class="accordion-heading">
									<div class="border border-dark border-new accordion-toggle collapsed" data-toggle="collapse" href="#collapse_0" aria-expanded="false">
										<h5 class="p-2">Selected package</h5><?php echo $item['selectedpkg'];?><br>
										<a href="#">Click for package details
											<i class="fa fa-caret-down"></i>
										</a>
									</div>
								</div>
								<div id="collapse_0" class="accordion-body in collapse" style="">
									<ul style="list-style: none; padding: 10px;">
										<?php 
											foreach($_SESSION['pkg4'] as $key=>$value)
												{?>
													 <li><?php echo $value; ?></li>

												<?php }
										?>
									</ul>
								</div>
							</div>
							<!-- <div class="border border-dark border-new"><h5 class="p-2">Paint</h5><?php echo $item['paint'];?><br></div>
							<div class="border border-dark border-new"><h5 class="p-2">Theme</h5><?php echo $item['theme'];?><br></div> -->
							<div class="border border-dark border-new"><h5 class="p-2">Instructions for mechanic</h5><?php echo $item['description'];?><br></div>
							<div class="border border-dark border-new"><h5 class="p-2">Package Price</h5><?php echo $item['price']." Rs.";?><br></div>

						<?php }
					}
				}
				elseif ($modoralt == "alteration") {
					?>
					<h4>Custom Alteration</h4><br>
					<?php
					foreach ($_SESSION['altcart'] as $item) {
						if ($item['selectedpkg'] == 1) {?>
							<div class="accordion-group" id="make">
								<div class="accordion-heading">
									<div class="border border-dark border-new accordion-toggle collapsed" data-toggle="collapse" href="#collapse_0" aria-expanded="false">
										<h5 class="p-2">Selected package</h5><?php echo $item['selectedpkg'];?><br>
										<a href="#">Click for package details
											<i class="fa fa-caret-down"></i>
										</a>
									</div>
								</div>
								<div id="collapse_0" class="accordion-body in collapse" style="">
									<ul style="list-style: none; padding: 10px;">
										<li>Chain spocket</li>
										<li>Silencer</li>
										<li>125cc Carburetor</li>
										<li>Remove filter</li>
									</ul>
								</div>
							</div>
							<div class="border border-dark border-new"><h5 class="p-2">Paint</h5><?php echo $item['paint'];?><br></div>
							<div class="border border-dark border-new"><h5 class="p-2">Instructions for mechanic</h5><?php echo $item['description'];?><br></div>
							<div class="border border-dark border-new"><h5 class="p-2">Package Price</h5><?php echo $item['price']." Rs.";?><br></div><?php
						}
						elseif ($item['selectedpkg'] == 2){?>
							<div class="accordion-group" id="make">
								<div class="accordion-heading">
									<div class="border border-dark border-new accordion-toggle collapsed" data-toggle="collapse" href="#collapse_0" aria-expanded="false">
										<h5 class="p-2">Selected package</h5><?php echo $item['selectedpkg'];?><br>
										<a href="#">Click for package details
											<i class="fa fa-caret-down"></i>
										</a>
									</div>
								</div>
								<div id="collapse_0" class="accordion-body in collapse" style="">
									<ul style="list-style: none; padding: 10px;">
										<li>Piston (0, 50, 90)</li>
										<li>Weights</li>
										<li>Head removal</li>
										<li>Cylinder removal</li>
									</ul>
								</div>
							</div>
							<div class="border border-dark border-new"><h5 class="p-2">Paint</h5><?php echo $item['paint'];?><br></div>
							<div class="border border-dark border-new"><h5 class="p-2">Theme</h5><?php echo $item['theme'];?><br></div>
							<div class="border border-dark border-new"><h5 class="p-2">Instructions for mechanic</h5><?php echo $item['description'];?><br></div>
							<div class="border border-dark border-new"><h5 class="p-2">Package Price</h5><?php echo $item['price']." Rs.";?><br></div><?php
						}
						elseif ($item['selectedpkg'] == 3){?>
							<div class="accordion-group" id="make">
								<div class="accordion-heading">
									<div class="border border-dark border-new accordion-toggle collapsed" data-toggle="collapse" href="#collapse_0" aria-expanded="false">
										<h5 class="p-2">Selected package</h5><?php echo $item['selectedpkg'];?><br>
										<a href="#">Click for package details
											<i class="fa fa-caret-down"></i>
										</a>
									</div>
								</div>
								<div id="collapse_0" class="accordion-body in collapse" style="">
									<ul style="list-style: none; padding: 10px;">
										<li>Genuine 70cc Carburetor</li>
										<li>Genuine Piston</li>
										<li>Genuine head cylinder</li>
										<li>Genuine chain spocket</li>
										<li>Genuine silencer</li>
										<li>Genuine pipes</li>
									</ul>
								</div>
							</div>
							<!-- <div class="border border-dark border-new"><h5 class="p-2">Paint</h5><?php echo $item['paint'];?><br></div>
							<div class="border border-dark border-new"><h5 class="p-2">Theme</h5><?php echo $item['theme'];?><br></div> -->
							<div class="border border-dark border-new"><h5 class="p-2">Instructions for mechanic</h5><?php echo $item['description'];?><br></div>
							<div class="border border-dark border-new"><h5 class="p-2">Package Price</h5><?php echo $item['price']." Rs.";?><br></div>
							
						<?php }
					}
				}
				?>
				<form action="includes/payment.inc.php" method="post">
					<div class="payment-btn pt-4">
						<button type="submit" name="btnplaceorder" class="btn btn-outline-danger" value="">Place order</button>
					</div>
				</form>
			</div>
		</div>
		
	</div>
</section>		
<script type="text/javascript" src="script/getparameters.js"></script>
<script>
	
	// $('#orderredirect').click(function() {
	// 	var a = document.getElementById('orderredirect'); 
	// 	a.href = "addresscon.php?quant="+quant;
	// });
	var query = window.location.search.substring(1);
	var qs = parse_query_string(query);

	var partid = localStorage.getItem('partid'); //part-id from spareparttemp.php
	console.log(partid);	

	// console.log(qs.quant);	
	
	var title = qs.title;
	localStorage.setItem('title', title); //title from addresscon.php
	var third = localStorage.getItem('title');
	console.log(third);	

	var fname = qs.fname;
	localStorage.setItem('fname', fname); //fname from addresscon.php
	var fourth = localStorage.getItem('fname');
	console.log(fourth);	

	var lname = qs.lname;
	localStorage.setItem('lname', lname); //lname from addresscon.php
	var fifth = localStorage.getItem('lname');
	console.log(fifth);	

	var phone = qs.phone;
	localStorage.setItem('phone', phone); //phone from addresscon.php
	var sixth = localStorage.getItem('phone');
	console.log(sixth);	

	var countryorregion = qs.countryorregion;
	localStorage.setItem('countryorregion', countryorregion); //countryorregion from addresscon.php
	var seventh = localStorage.getItem('countryorregion');
	console.log(seventh);	

	var hnameorno = qs.hnameorno;
	localStorage.setItem('hnameorno', hnameorno); //hnameorno from addresscon.php
	var eigth = localStorage.getItem('hnameorno');
	console.log(eigth);	

	var pcode = qs.pcode;
	localStorage.setItem('pcode', pcode); //pcode from addresscon.php
	var ningth = localStorage.getItem('pcode');
	console.log(ningth);	

</script>
<?php
include_once 'includes/footer.php';
?>