<?php
session_start();

include_once 'dbh.inc.php';
if (isset($_POST['images'])) 
{
	$Title = $_POST['sptitle'];
	$Condition = $_POST['spcondition'];
	$Description = $_POST['spdescription'];
	$Price = $_POST['spprice'];
	$HomeName = $_POST['sphomename'];
	$PostCode = $_POST['sppcode'];
	$CountryReg = $_POST['spcountryregion'];
	$Phone = $_POST['spphone'];
	$ad_type = "sparepart";
	$ad_date = date('Y-m-d H:i:s');
	$user = $_SESSION['userId'];
	
	$sql = "INSERT INTO post_ad (ad_title, ad_type, ad_date, ad_price, ad_description, idUsers, ad_condition, ad_user_hname, ad_user_pcode, ad_user_country, ad_user_phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) 
	{
		echo "SQL statement failed";
	}	
	else
	{
		mysqli_stmt_bind_param($stmt, "sssssssssss", $Title, $ad_type, $ad_date, $Price, $Description, $user, $Condition, $HomeName, $PostCode, $CountryReg, $Phone);
		mysqli_stmt_execute($stmt);
		$ad_id = $conn->insert_id;
	}

	for($i=0;$i<count(json_decode($_POST['images']));$i++){
		$j = json_decode($_POST['images']);

		$fileName = $j[$i]->FileName;
		//$fileTmpName = $_FILES["files"]["tmp_name"][$i];
		$fileSize =  $j[$i]->FileSizeInBytes;
		//$fileError = $_FILES["files"]['error'][$i];
		//$fileType = $_FILES["files"]['type'][$i];

		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));
		$allowed = array('jpg', 'jpeg', 'png');	

		$thumbnail = $i;

		// if (empty($Title) || empty($Condition) || empty($Description) || empty($Price) || empty($HomeName) || empty($PostCode) || empty($CountryReg) || empty($Phone))
		// {
		// 	header("Location: ../postad.php?error=empty");
		// 	exit();
		// }
		// else
		// {
			if (in_array($fileActualExt, $allowed)) 
			{
				// if ($fileError === 0) 
				// {
					if ($fileSize < 5000000) 
					{
						$fileNameNew = uniqid('', true).'.'.$fileActualExt;
						$fileDestination = '../images/sparepartimg/' . $fileNameNew;

						$sql = "SELECT * FROM post_ad";

						if (!mysqli_stmt_prepare($stmt, $sql)) {
							echo "SQL statement failed";
						}
						else
						{
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							$rowCount = mysqli_num_rows($result);
							$setImageOrder = $rowCount + 1;

							$sqlimage = "INSERT INTO post_ad_images (ad_id, ad_image_name, ad_image_thumb) VALUES (?, ?, ?)";
							if (!mysqli_stmt_prepare($stmt, $sqlimage)) 
							{
								echo "SQL statement failed";
							}	
							else
							{
								mysqli_stmt_bind_param($stmt, "sss", $ad_id, $fileNameNew, $thumbnail);
								mysqli_stmt_execute($stmt);
								file_put_contents($fileDestination, base64_decode($j[$i]->Content));
								// move_uploaded_file($fileTmpName, $fileDestination);
								header("Location: ../postad.php?uploadsuccess");
										// print_r($ad_date);	
							}
						}
					}
					else
					{
						echo "Your file is too big";
					}
				// }
				// else 
				// {
				// 	echo "There was an error uploading your file";
				// }
			}
			else
			{
				echo "You cannot upload files of this type";

			}
		// }
	}
}
?>