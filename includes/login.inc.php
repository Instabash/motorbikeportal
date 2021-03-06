<?php
session_start();
if (isset($_POST['login-submit'])) 
{
	require 'dbh.inc.php';

	$mailuid = $_POST['mailuid'];
	$password= $_POST['pwd'];

	if (empty($mailuid) || empty($password)) 
	{
		if (!isset($_SESSION['current_page1'])) {
			$_SESSION['current_page1'] = $_SERVER['HTTP_REFERER'];
			// header("Location: ". $_SESSION['current_page1']."?error=emptyfields");
			header("Location: ". $_SESSION['current_page1']);
			$_SESSION['error'] = "empty";
			exit();	
		}
		else{
			header("Location: ".$_SESSION['current_page1']."?error=emptyfields");
			header("Location: ".$_SESSION['current_page1']);
			$_SESSION['error'] = "empty";
			exit();	
		}
	}
	else
	{
		$sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers = ?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) 
		{
			header("Location: ../index.php?error=sqlerror");
			exit();
		}
		else
		{
			mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if($row = mysqli_fetch_assoc($result))
			{
				$pwdCheck = password_verify($password, $row['pwdUsers']);
				if ($pwdCheck == false) 
				{
					if (!isset($_SESSION['current_page1'])) {
						$_SESSION['current_page1'] = $_SERVER['HTTP_REFERER'];
						// header("Location: ". $_SESSION['current_page1']."?error=wrongpwd2");
						header("Location: ". $_SESSION['current_page1']);
						$_SESSION['error'] = "wrongpwd";
						exit();	
					}
					else{
						// header("Location: ".$_SESSION['current_page1']."?error=wrongpwd2");
						header("Location: ".$_SESSION['current_page1']);
						$_SESSION['error'] = "wrongpwd";
						exit();	
					}
				}
				elseif ($pwdCheck == true) 
				{
					
					$_SESSION['userId'] = $row['idUsers'];
					$_SESSION['userUId'] = $row['uidUsers'];
					$_SESSION['usertype'] = $row['User_type'];
					$_SESSION['FullName'] = $row['User_fname'] . " " .  $row['User_lname'];
					
					
						$_SESSION['current_page'] = $_SERVER['HTTP_REFERER'];
						if ($row['User_type'] == 1) {
							header("Location: /BikeLabs/pages/admin/admindash.php");
							exit();	
						}
						elseif ($row['User_type'] == 2) {
							header("Location: /BikeLabs/pages/vendor/vendordash.php");
							exit();	
						}
						elseif (isset($_SESSION['curr_page'])) {
							header("Location: ../..".$_SESSION['curr_page']);
							unset($_SESSION['error']);
							exit();
						}
						else{
							//removing usertype=".row['User_type'] because of compare bike trouble"
							header("Location: ". $_SESSION['current_page']);
							exit();	
						}
						
					exit();
				}
				else
				{
					if (!isset($_SESSION['current_page1'])) {
						$_SESSION['current_page1'] = $_SERVER['HTTP_REFERER'];
						// header("Location: ". $_SESSION['current_page1']."?error=wrongpwd");
						header("Location: ". $_SESSION['current_page1']);
						$_SESSION['error'] = "wrongpwd";
						exit();	
					}
					else{
						// header("Location: ".$_SESSION['current_page1']."?error=wrongpwd");
						header("Location: ".$_SESSION['current_page1']);
						$_SESSION['error'] = "wrongpwd";
						exit();	
					}
				}
			}
			else
			{
				if (!isset($_SESSION['current_page1'])) {
					$_SESSION['current_page1'] = $_SERVER['HTTP_REFERER'];
					// header("Location: ". $_SESSION['current_page1']."?error=nouser");
					header("Location: ". $_SESSION['current_page1']);
					$_SESSION['error'] = "nouser";
					exit();	
				}
				else{
					// header("Location: ".$_SESSION['current_page1']."?error=nouser");
					header("Location: ".$_SESSION['current_page1']);
					$_SESSION['error'] = "nouser";
					exit();	
				}
			}
		}
	}
}
else
{
	header("Location: ../index.php");
	exit();
}