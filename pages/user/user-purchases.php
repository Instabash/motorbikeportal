<?php
session_start();
include '../../includes/restrictions.inc.php';
user_protect();
$title = 'Purchases';
include '../../includes/header.php';
include '../../includes/dbh.inc.php';
include '../../includes/sidebar.inc.php';
$user_id = $_SESSION['userId'];
$spaartsql = "SELECT * FROM order_table WHERE idUsers = {$user_id} AND order_status = 'Approved';";
$stmt = mysqli_stmt_init($conn);
?>
<label href="#" class="list-group-item" style="width: auto;">User Panel
	<button class="btn" id="menu-toggle"><img style="width: 10px;" src="../../images/bars-solid.svg"></button>
</label>
<div class="d-flex" id="wrapper">
	<?php
	usersidebar();
	?>

	<!-- Main content -->
	<section class="section bike-parts modsection content content2" style="padding-left:5%;width: 100%;">
		<div style="overflow-x:auto;">
			<div class="pb-5" >
				<h3>Purchased Items</h3><hr style="border-color:black !important">
			</div>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Order type</th>
						<th>Order status</th>
						<th>Order date</th>
						<th>Order address</th>
						<th>Order price</th>
						<th>Order quantity</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if(!mysqli_stmt_prepare($stmt, $spaartsql))
					{
						echo "SQL statement failed";
					}
					else
					{
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);
						$isOdd = true;
						while ($row = mysqli_fetch_assoc($result)) {
							$imgnamesql = "SELECT * FROM order_items WHERE order_id = {$row['order_id']};";

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
									<tr>
										<td><?php echo $row['order_type']; ?></td>
										<td><?php echo $row['order_status']; ?></td>
										<td><?php echo $row['order_date']; ?></td>
										<td><?php echo $row1['Order_Address']; ?></td>
										<td><?php echo $row1['Order_price']; ?></td>
										<td><?php echo $row1['Order_quantity']; ?></td>
									</tr>		
									<?php 
								}			
							}
						}	
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th>Order type</th>
						<th>Order status</th>
						<th>Order date</th>
						<th>Order address</th>
						<th>Order price</th>
						<th>Order quantity</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</section>	
</div>
<script>
	$('#example1').DataTable(
	{
		'paging'      : true,
		'searching'   : false,
		'searching'   : true,
		'ordering'    : true,
		'info'        : false
	})
	
</script>
<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>
<?php
include_once '../../includes/footer.php';
?>