<?php
session_start();
include '../../includes/restrictions.inc.php';
admin_protect();
include '../../includes/header.php';
include '../../includes/dbh.inc.php';
?>
<!-- Sidebar -->
<label href="#" class="list-group-item" style="width: auto;">Admin Panel
	<button class="btn" id="menu-toggle"><i class="fas fa-bars"></i></button>
</label>
<div class="d-flex" id="wrapper">
	<div class="bg-light border-right" id="sidebar-wrapper">
		<div class="list-group list-group-flush">
			<a href="/BikeLabs/pages/admin/admindash.php" class="list-group-item list-group-item-action bg-light">Dashboard</a>
			<a href="/BikeLabs/pages/admin/admin-jobs.php" class="list-group-item list-group-item-action bg-light">Pending Jobs</a>
			<a href="/BikeLabs/pages/admin/admin-orders.php" class="list-group-item list-group-item-action bg-light">Pending Orders</a>
			<a href="/BikeLabs/pages/admin/admin-vendor.php" class="list-group-item list-group-item-action bg-light">Vendor management</a>
			<a href="/BikeLabs/pages/admin/admin-sales.php" class="list-group-item list-group-item-action bg-light">Sales</a>
			<a href="/BikeLabs/pages/admin/admin-bikes.php" class="list-group-item list-group-item-action bg-light">Add new Bikes</a>
			<a href="/BikeLabs/pages/admin/admin-parts.php" class="list-group-item list-group-item-action bg-light">Add new Parts</a>
			<a href="/BikeLabs/pages/admin/admin-bike-parts.php" class="list-group-item list-group-item-action bg-light">Bikes/Parts Posted</a>
			<a href="/BikeLabs/pages/admin/admin-modaltpkg.php" class="list-group-item list-group-item-action bg-light">Add Mod/Alt packages</a>
		</div>
	</div>

	<!-- Main content -->
	<section class="section modsection content content2" style="padding-left:5%;width: 100%;">
		<div class="pb-5" >
			<h4>Admin panel</h4>
		</div>
		<div class="row pt-2" style="width: 100%;">
			<!-- Left col -->
			<div class="col-sm-6 ">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Latest Orders</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
							<table class="table no-margin">
								<thead>
									<tr>
										<th>Order id</th>
										<th>Order type</th>
										<th>Order status</th>
										<th>Order date</th>
									</tr>
								</thead>
								<tbody>
									<?php

									$sql = "SELECT * FROM order_table WHERE order_status = 'Processing' ORDER BY order_date DESC LIMIT 5;";
									$stmt = mysqli_stmt_init($conn);
									if (!mysqli_stmt_prepare($stmt, $sql)) 
									{
										header("Location: ../index.php?error=sqlerror");
										exit();
									}
									else
									{
										mysqli_stmt_execute($stmt);
										$result = mysqli_stmt_get_result($stmt);
										while($row = mysqli_fetch_assoc($result))
										{
											$orderid = $row['order_id'];
											$sql2 = "SELECT * FROM order_items WHERE order_id = ?;";
											$stmt2 = mysqli_stmt_init($conn);
											if (!mysqli_stmt_prepare($stmt2, $sql2)) 
											{
												header("Location: ../index.php?error=sqlerror");
												exit();
											}
											else
											{
												mysqli_stmt_bind_param($stmt2, "s", $orderid);
												mysqli_stmt_execute($stmt2);
												$result2 = mysqli_stmt_get_result($stmt2);
												while($row2 = mysqli_fetch_assoc($result2))
												{
													?>
													<tr>
														<td><span class="label label-success"><?php echo $row['order_id']; ?></span></td>
														<td><?php echo $row['order_type']; ?></td>
														<td><span class="label label-success"><?php echo $row['order_status']; ?></span></td>
														<td><?php echo $row['order_date']; ?></td>
													</tr>
													<?php
												}
											}
										}
									}
									?>
								</tbody>
							</table>
						</div>
						<!-- /.table-responsive -->
					</div>
					<!-- /.box-body -->
					<div class="box-footer clearfix">
						<a href="/BikeLabs/pages/admin/admin-orders.php" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
					</div>
					<!-- /.box-footer -->
				</div>
				<!-- /.box -->
			</div>
			<div class="col-sm-6 ">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Latest members</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
							<table class="table no-margin">
								<thead>
									<tr>
										<th>Username</th>
										<th>User address</th>
										<th>User contact</th>
										<th>User email</th>
									</tr>
								</thead>
								<tbody>
									<?php

									$sql = "SELECT * FROM users WHERE User_type = '0' LIMIT 5;";
									$stmt = mysqli_stmt_init($conn);
									if (!mysqli_stmt_prepare($stmt, $sql)) 
									{
										header("Location: ../index.php?error=sqlerror");
										exit();
									}
									else
									{
										mysqli_stmt_execute($stmt);
										$result = mysqli_stmt_get_result($stmt);
										while($row = mysqli_fetch_assoc($result))
										{
											
											?>
											<tr>
												<td><span class="label label-success"><?php echo $row['uidUsers']; ?></span></td>
												<td><?php echo $row['User_Address']; ?></td>
												<td><span class="label label-success"><?php echo $row['User_Contact']; ?></span></td>
												<td><?php echo $row['emailUsers']; ?></td>
											</tr>
											<?php

										}
									}
									?>
								</tbody>
							</table>
						</div>
						<!-- /.table-responsive -->
					</div>
					<!-- /.box-body -->
					<div class="box-footer clearfix">
						<a href="#" class="btn btn-sm btn-default btn-flat pull-right">View All Users</a>
					</div>
					<!-- /.box-footer -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->


			<!-- /.col -->
		</div>
		

	</section>
	
</div>
<script>
	$(function () {
		$('#example1').DataTable()
		$('#example2').DataTable({
			'paging'      : true,
			'lengthChange': false,
			'searching'   : false,
			'ordering'    : true,
			'info'        : true,
			'autoWidth'   : false
		})
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
