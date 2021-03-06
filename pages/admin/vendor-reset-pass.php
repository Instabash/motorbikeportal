<?php
session_start();
include '../../includes/restrictions.inc.php';
admin_protect();
$title = 'Manage vendors';
include '../../includes/header.php';
include '../../includes/dbh.inc.php';
include '../../includes/sidebar.inc.php';
?>
<!-- Sidebar -->
<label href="#" class="list-group-item" style="width: auto;">Admin Panel
	<button class="btn" id="menu-toggle"><img style="width: 10px;" src="../../images/bars-solid.svg"></button>
</label>
<div class="d-flex" id="wrapper">
	<?php
	adminsidebar();
	?>

	<!-- Main content -->
	<section class="section modsection content content2" style="padding-left:5%;width: 100%;">
		<div class="pb-5" >
			<h3>Admin Panel</h3>
		</div>

		<div>
			<b><h4>Change Password</h4></b>
		</div>

		<div class="border border-new border-black p-5 rounded mt-3">
			<form action="../../includes/change-pass.inc.php" method="post">
				<label>Old Password</label>
				<div class="form-row formrowad p-2 pt-2 mb-3">
					<div>
						<div class="input-group">
							<input class="form-control" id="CapsLockIn" type="password" name="oldpass" placeholder="Old Password">
							<p class="Caps" style="display: none;padding: 5px;padding-left: 10px;">Caps Lock is On</p>
						</div>
					</div>
				</div>
				<label>New Password</label>
				<div class="form-row formrowad p-2 pt-2 mb-3">
					<div>
						<div class="input-group">
							<input class="form-control" id="CapsLockIn" type="password" name="newpass" placeholder="New Password">
							<p class="Caps" style="display: none;padding: 5px;padding-left: 10px;">Caps Lock is On</p>
						</div>
					</div>
				</div>
				<label>Confirm New Password</label>
				<div class="form-row formrowad p-2 pt-2 mb-3">
					<div>
						<div class="input-group">
							<input class="form-control" id="CapsLockIn" type="password" name="connewpass" placeholder="Confirm New Password">
							<p class="Caps" style="display: none;padding: 5px;padding-left: 10px;">Caps Lock is On</p>
						</div>
					</div>
				</div>
				<?php
				if (isset($_GET['error'])) 
				{
					if ($_GET['error'] == "emptyfields") 
					{
						echo '<p style="color:red !important;padding:5px;";>Fill in all fields</p>';
					}
					elseif ($_GET['error'] == "pwdstr") 
					{
						echo '<p style="color:red !important;padding:5px;";>Please enter a strong password!</p>';
					}
					elseif ($_GET['error'] == "passwordcheck") 
					{
						echo '<p style="color:red !important;padding:5px;";>The two passwords must be matching!</p>';
					}
					elseif ($_GET['error'] == "pwdchange") 
					{
						echo '<p style="color:red !important;padding:5px;";>Please enter a different password than your previous password!</p>';
					}
				}
				
				?>
				<div id="capsLockWarning" style="font-weight: bold; color: maroon; margin: 0 0 10px 0; display: none;">Caps Lock is on.</div>
				<div class="form-row formrowad p-2 pt-2 mb-3">
					<div>
						<input type="hidden" name="vid" value="<?php echo $_GET['vid']; ?>">
						<button class="loginbtn" type="submit" name="pwd-reset-submit-vendor">Change password</button>
					</div>
				</div>
			</form>
		</div>
	</section>	
</div>

<script language="javascript">
	function isCapsLockOn(e) {
		var keyCode = e.keyCode ? e.keyCode : e.which;
		var shiftKey = e.shiftKey ? e.shiftKey : ((keyCode == 16) ? true : false);
		return (((keyCode >= 65 && keyCode <= 90) && !shiftKey) || ((keyCode >= 97 && keyCode <= 122) && shiftKey))
	}
	$(document).ready(function() {
		$(":password").keypress(function(e) {
			if (isCapsLockOn(e))
				$("#capsLockWarning").show();
			else
				$("#capsLockWarning").hide();
		});                           
	});
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