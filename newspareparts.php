<?php
$title = 'New Spareparts';
include_once 'includes/header.php';
include_once 'includes/dbh.inc.php';
include_once 'includes/restrictions.inc.php';
redirect();

?>
<!-- New Bikes -->
<section id="spparts" class="section sppartsection content">
	<div class="container">
		<h3>New Spareparts</h3> <br>
		<form class="example" action="includes/search.inc.php" method="post">
			<input type="text" id="search-bar" placeholder="Search.." name="search">
			<button type="submit" name="submit-search-nsp"><img style="width:16px;height: 16px;" src="images/search-solid.svg"></button>
		</form>
		<div class="search-page-new">
			<div class="row">
				<div class="mt-4 col-md-2 used-car-refine-search">
					<div class="sidebar-filters border-new">
						<div class="filter-panel-new box">
							<form action="includes/search.inc.php" method="post">
								<div class="accordion-group" id="price">
									<div class="accordion-heading">
										<a class="accordion-toggle" data-toggle="collapse" href="#collapse_2">
											Price<img style="width: 10px;float:right;padding-top: 5px;" src="images/caret-down.svg">
										</a>
									</div>
									<div id="collapse_2" class="accordion-body collapse in">
										<div class="accordion-inner">

											<select id="fromInput" style="width: 100%;" class="nomargin" name="fromval">
												<option value="">Price From</option>
												<option value="100">100</option>
												<option value="1000">1,000</option>
												<option value="5000">5,000</option>
												<option value="10000">10,000</option>
												<option value="20000">20,000</option>
												<option value="30000">30,000</option>
												<option value="40000">40,000</option>
												<option value="50000">50,000</option>
												<option value="60000">60,000</option>
												<option value="70000">70,000</option>
												<option value="80000">80,000</option>
												<option value="90000">90,000</option>
												<option value="100000">100,000</option>
											</select>
											<div class="mb10">
											</div>
											<select id="toInput" class="nomargin" style="width: 100%;" name="toval">
												<option value="" selected="selected">Price To</option>
												<option value="100">100</option>
												<option value="1000">1,000</option>
												<option value="5000">5,000</option>
												<option value="10000">10,000</option>
												<option value="20000">20,000</option>
												<option value="30000">30,000</option>
												<option value="40000">40,000</option>
												<option value="50000">50,000</option>
												<option value="60000">60,000</option>
												<option value="70000">70,000</option>
												<option value="80000">80,000</option>
												<option value="90000">90,000</option>
												<option value="100000">100,000</option>
											</select>
											<div id="clear-selection">

											</div>

										</div>
									</div>
								</div>
								<input type="submit" disabled="disabled" class="btn btn-primary btn-block" id="btngo" name="search-parts" value="Go">
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-10 bike-results">
					<div class="row">
						
						<?php
						if (isset($_GET['pageno'])) {
							$pageno = $_GET['pageno'];
						} else {
							$pageno = 1;
						}
						$no_of_records_per_page = 12;
						$offset = ($pageno-1) * $no_of_records_per_page;

						$total_pages_sql = "SELECT COUNT(*) FROM spare_parts";
						$result = mysqli_query($conn,$total_pages_sql);	

						$total_rows = mysqli_fetch_array($result)[0];
						$total_pages = ceil($total_rows / $no_of_records_per_page);		
						?>
						<?php
						if (isset($_GET['s'])) 
						{
							$stmt = mysqli_stmt_init($conn);
							$query = $_GET['s'];
							$searchsql = "SELECT * FROM spare_parts WHERE part_name LIKE '%$query%' OR part_description LIKE '%$query%' OR part_price LIKE '%$query%' LIMIT {$offset}, {$no_of_records_per_page};";
							$resultsearch = mysqli_query($conn, $searchsql);
							$queryResult = mysqli_num_rows($resultsearch);
							if ($queryResult > 0) { 
								while ($row = mysqli_fetch_assoc($resultsearch)) 
								{
									$imgnamesqlprice = "SELECT part_image_name, MIN(part_image_thumb) FROM spare_part_images WHERE part_id = {$row['part_id']} GROUP BY part_id;";

									if(!mysqli_stmt_prepare($stmt, $imgnamesqlprice))
									{
										echo "SQL statement failed";
									}
									else
									{
										mysqli_stmt_execute($stmt);
										$result1 = mysqli_stmt_get_result($stmt);

										while ($row1 = mysqli_fetch_assoc($result1)) 
											{?>
												<div class="col-md-4">
													<div class="product-item">
														<a href="pages/new-parts/new-parts.php?partid=<?php echo $row['part_id'] ?>">
															<img src="images/sparepartimg/<?php echo $row1['part_image_name'] ?>" style="height: 200px !important;width: 100% !important;">
															<div class="ellipsis">
																<label class="productName"><?php echo $row['part_name'] ?></label><br>
																<label><b>Price:</b></label>
																<label class="price"><?php echo number_format($row['part_price']) ?> Rs.</label>
															</div>
														</a>
													</div>
												</div>
												<?php
											}
										}
								}
							} 
							else 
							{ 
								?>
								<div class="pt-5 pl-5" id="noresult">
									<label>Nothing matched your query</label>
								</div>
								<?php
							}
						}
						else
						{
						?>
						<?php 
						$spaartsql = "SELECT * FROM spare_parts LIMIT {$offset}, {$no_of_records_per_page};";
						$stmt = mysqli_stmt_init($conn);
						if(!mysqli_stmt_prepare($stmt, $spaartsql))
						{
							echo "SQL statement failed";
						}
						else
						{
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);

							while ($row = mysqli_fetch_assoc($result)) {
								$imgnamesql = "SELECT part_image_name, MIN(part_image_thumb) FROM spare_part_images WHERE part_id = {$row['part_id']} GROUP BY part_id;";

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
										if (isset($_GET['pricefrom']) || isset($_GET['priceto'])) 
										{
											$pricefrom = 0;
											$priceto = 0;
											$priceflag = 0;

											if (isset($_GET['pricefrom']) || isset($_GET['priceto'])) {
												$pricefrom = $_GET['pricefrom'];
												$priceto = $_GET['priceto'];
												$priceflag = 1;
											}
											if ($priceflag == 1) {
												if (!$pricefrom == "" || !$priceto == "") 
												{
													$pricesql = "SELECT * FROM spare_parts WHERE part_price >= {$pricefrom} AND part_price <= {$priceto};";
													$stmt = mysqli_stmt_init($conn);
													if(!mysqli_stmt_prepare($stmt, $pricesql))
													{
														echo "SQL statement failed";
													}
													else
													{
														mysqli_stmt_execute($stmt);
														$result = mysqli_stmt_get_result($stmt);
														if (mysqli_num_rows($result) == 0) { ?>
															<div class="pt-5 pl-5" id="noresult">
																<label>Nothing matched your query</label>
															</div>
															<?php 
														} 
														else 
														{ 
															while ($row = mysqli_fetch_assoc($result)) {
																$imgnamesqlprice = "SELECT part_image_name, MIN(part_image_thumb) FROM spare_part_images WHERE part_id = {$row['part_id']} GROUP BY part_id;";

																if(!mysqli_stmt_prepare($stmt, $imgnamesqlprice))
																{
																	echo "SQL statement failed";
																}
																else
																{
																	mysqli_stmt_execute($stmt);
																	$result1 = mysqli_stmt_get_result($stmt);

																	while ($row1 = mysqli_fetch_assoc($result1)) 
																		{?>
																			<div class="col-md-4">
																				<div class="product-item">
																					<a href="pages/new-parts/new-parts.php?partid=<?php echo $row['part_id'] ?>">
																						<img src="images/sparepartimg/<?php echo $row1['part_image_name'] ?>" style="height: 200px !important;width: 100% !important;">
																						<div class="ellipsis">
																							<label class="productName"><?php echo $row['part_name'] ?></label><br>
																							<label><b>Price:</b></label>
																							<label class="price"><?php echo number_format($row['part_price']) ?> Rs.</label>
																						</div>
																					</a>
																				</div>
																			</div>
																			<?php
																		}
																	}
																}
															}
														}
													}
												}
											}
											else
											{
												?>
												<div class="col-md-4">
													<div class="product-item">
														<a href="pages/new-parts/new-parts.php?partid=<?php echo $row['part_id'] ?>">
															<img src="images/sparepartimg/<?php echo $row1['part_image_name'] ?>" style="height: 200px !important;width: 100% !important;">
															<div class="ellipsis">
																<label class="productName"><?php echo $row['part_name'] ?></label><br>
																<label><b>Price:</b></label>
																<label class="price"><?php echo number_format($row['part_price']) ?> Rs.</label>
															</div>
														</a>
													</div>
												</div>
												<?php 
											}
										}			
									}
								}
							}
								?>
								<div class="container pt-5">
									<ul class="pagination" style="margin-left: 35%;">
										<li><a href="?pageno=1">First</a></li>
										<li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
											<a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
										</li>
										<li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
											<a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
										</li>
										<li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
									</ul>
								</div>
								<?php	
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>	
</section>
<script type="text/javascript">
	$('div.tags').find('input:checkbox').on('click', function() {
		let
		els = $('.results > div').hide(),
		checked = $('div.tags').find('input:checked').each(function() {
			els.filter('.'+$(this).attr('rel')).show();
		});
		if (!checked.length) els.show();
	});
</script>
<script type="text/javascript">
$(document).ready(function(){
	$('#toInput').change(function(){
		var val = $('#fromInput').val();
		var val2 = $('#toInput').val();
		if (val == '' || val2 == '') {
			$('#btngo').attr('disabled', 'disabled');
		}else{
			$('#btngo').removeAttr('disabled');
		}
	});
	$('#fromInput').change(function(){
		var val = $('#fromInput').val();
		var val2 = $('#toInput').val();
		if (val == '' || val2 == '') {
			$('#btngo').attr('disabled', 'disabled');
		}else{
			$('#btngo').removeAttr('disabled');
		}
	});
});
</script>
<script type="text/javascript">
	var $noresult = $('#noresult');
	var $pagination = $('.pagination');

	if(!$('#noresult').length == 0 || window.location.href.indexOf("pricefrom") > -1 || window.location.href.indexOf("priceto") > -1 || window.location.href.indexOf("model") > -1) 
	{
		$pagination.html('');
	}
</script>

	<?php
	include_once 'includes/footer.php';
	?>