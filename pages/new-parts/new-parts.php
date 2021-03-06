<?php
include_once '../../includes/dbh.inc.php';
$part_id = $_GET["partid"];
$sql = "SELECT * FROM spare_parts WHERE part_id='$part_id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result)<1) {
	header("Location: /BikeLabs/404-page.php");
}
else{
	$title = 'New Spareparts';
include_once '../../includes/header.php';
include_once '../../includes/restrictions.inc.php';
redirect();
$stmt = mysqli_stmt_init($conn);
?>
<section id="biketemplate" class="section biketemplatesec content">
	<div class="container max-w">
		<div class="paymentmain imageDiv" style="margin-left: 0px;margin-right: 0px">
			<div class="paymentleft border-new border border-dark rounded mt-5 imageDivRight" style="">
				<div class="w3-content w3-display-container">

					<?php
					$imgnamesql = "SELECT part_image_name FROM spare_part_images WHERE part_id = {$_GET["partid"]};";
					if(!mysqli_stmt_prepare($stmt, $imgnamesql))
					{
						echo "SQL statement failed";
					}
					else
					{
						mysqli_stmt_execute($stmt);
						$result1 = mysqli_stmt_get_result($stmt);

						while ($row1 = mysqli_fetch_assoc($result1)) 
						{
							?>
							<img class="mySlides" src="../../images/sparepartimg/<?php echo $row1['part_image_name'] ?>" style="width:100%;height: 500px;">
							<?php 
						}			
					}
					?>
					<button class="w3-button w3-display-left w3-black" onclick="plusDivs(-1)">&#10094;</button>
					<button class="w3-button w3-display-right w3-black" onclick="plusDivs(1)">&#10095;</button>
				</div>
				<div class=" w3-row-padding w3-section">
					<?php
					$imgnamesql = "SELECT part_image_name FROM spare_part_images WHERE part_id = {$_GET["partid"]};";
					if(!mysqli_stmt_prepare($stmt, $imgnamesql))
					{
						echo "SQL statement failed";
					}
					else
					{
						$i = 0;
						mysqli_stmt_execute($stmt);
						$result1 = mysqli_stmt_get_result($stmt);
						while ($row1 = mysqli_fetch_assoc($result1)) 
						{ 
							$i++;
							?>
							<div class="w3-col s4">
								<img class="demo w3-opacity w3-hover-opacity-off border-new border border-dark rounded " src="../../images/sparepartimg/<?php echo $row1['part_image_name'] ?>" style="width:100px;height:75.47px !important;cursor:pointer" onclick="currentDiv(<?php echo $i ?>)">
							</div>
							<?php 
						}
					}		
					?>
				</div>
			</div>
			<div class="paymentright imageDivRight">
				<div class="border-new border border-dark rounded mt-5 p-3" style="">
					<?php
					if($row = mysqli_fetch_assoc($result))
					{
						?>
						<div>
							<h5><b><?php echo $row['part_name']; ?></b></h5><br>
							<p><?php echo $row['part_price']; ?> Rs.</p>

							<?php 
							$sqladdesc = "SELECT * FROM users WHERE idUsers ={$row["idUsers"]}";
							if(!mysqli_stmt_prepare($stmt, $sqladdesc))
							{
								echo "SQL statement failed";
							}
							else
							{
								mysqli_stmt_execute($stmt);
								$result3 = mysqli_stmt_get_result($stmt);
								while ($row3 = mysqli_fetch_assoc($result3)) 
								{
									?>
									<?php
									if ($row3['User_type'] == '1'){
										?>
										<p>Posted by BikeLabs</p>
										<?php
									}
									elseif ($row3['User_type'] == '2'){
										?>
										<p>Posted by : <?php echo " " .  $row3['uidUsers']; ?></p>
										<?php 
									}
								}
							}
							?>
						</div>
						<?php
					}
					?>
				</div>
				<form action="/BikeLabs/includes/cartprocess.inc.php?partid=<?php echo $part_id;  ?>" method="post">
					<div class="border-new border border-dark rounded mt-5 p-3">
						<p>
							Quantity
						</p><br>
						<div class="input-group quantityDiv" style="padding-left: 100px;padding-right: 100px;">
							<span class="input-group-btn">
								<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant">
									<img style="width: 14px;" src="/BikeLabs/images/minus-square-solid.svg">
								</button>
							</span>
							<input type="text" name="quant" class="form-control input-number" value="1" min="1" max="10">
							<span class="input-group-btn">
								<button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant">
									<img style="width: 14px;" src="/BikeLabs/images/plus-square-solid.svg">
								</button>
							</span>
						</div>
						<p></p>
					</div>
					<div class="border-new border border-dark rounded mt-5 p-3">
						<button type="submit" name="cartBtn-parts" class="btn btn-outline-danger">Add to cart</button>
						<button type="submit" name="buyBtn-parts" class="btn btn-outline-danger">Buy now</button>
					</div>
				</form>
			</div>
		</div>
		<div class="paymentmain imageDiv" style="margin-left: 0px;margin-right: 0px">
			<div class="paymentleft imageDivRight" >
				<div class="border-new border border-dark rounded mt-5 p-3" style="">
					<div>
					<h5><b>Description</b></h5><br>	
					<p style="word-break: break-all;"><?php echo $row['part_description']; ?></p>
					</div>
					
				</div>
			</div>
			
		</div>
	</div>
</section>
<script type="text/javascript" src="../../script/getparameters.js"></script>
<script>
	var slideIndex = 1;
	showDivs(slideIndex);

	function plusDivs(n) {
		showDivs(slideIndex += n);
	}

	function showDivs(n) {
		var i;
		var x = document.getElementsByClassName("mySlides");
		if (n > x.length) {slideIndex = 1}
			if (n < 1) {slideIndex = x.length}
				for (i = 0; i < x.length; i++) {
					x[i].style.display = "none";  
				}
				x[slideIndex-1].style.display = "block";  
			}
			$('.btn-number').click(function(e){
				e.preventDefault();

				fieldName = $(this).attr('data-field');
				type      = $(this).attr('data-type');
				var input = $("input[name='"+fieldName+"']");
				var currentVal = parseInt(input.val());
				if (!isNaN(currentVal)) {
					if(type == 'minus') {

						if(currentVal > input.attr('min')) {
							input.val(currentVal - 1).change();
						} 
						if(parseInt(input.val()) == input.attr('min')) {
							$(this).attr('disabled', true);
						}

					} else if(type == 'plus') {

						if(currentVal < input.attr('max')) {
							input.val(currentVal + 1).change();
						}
						if(parseInt(input.val()) == input.attr('max')) {
							$(this).attr('disabled', true);
						}

					}
				} else {
					input.val(0);
				}
			});
			$('.input-number').focusin(function(){
				$(this).data('oldValue', $(this).val());
			});
			$('.input-number').change(function() {

				minValue =  parseInt($(this).attr('min'));
				maxValue =  parseInt($(this).attr('max'));
				valueCurrent = parseInt($(this).val());

				name = $(this).attr('name');
				if(valueCurrent >= minValue) {
					$(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
				} else {
					alert('Sorry, the minimum value was reached');
					$(this).val($(this).data('oldValue'));
				}
				if(valueCurrent <= maxValue) {
					$(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
				} else {
					alert('Sorry, the maximum value was reached');
					$(this).val($(this).data('oldValue'));
				}


			});
			$(".input-number").keydown(function (e) {
	// Allow: backspace, delete, tab, escape, enter and .
	if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
	// Allow: Ctrl+A
	(e.keyCode == 65 && e.ctrlKey === true) || 
	// Allow: home, end, left, right
	(e.keyCode >= 35 && e.keyCode <= 39)) {
	// let it happen, don't do anything
return;
}
	// Ensure that it is a number and stop the keypress
	if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
		e.preventDefault();
	}
});

			var query = window.location.search.substring(1);
			var qs = parse_query_string(query);
	// console.log(qs.quant);	
	var partid = qs.partid;
	localStorage.setItem('partid', partid);
</script>

<?php
include_once '../../includes/footer.php';
}
?>