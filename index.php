<?php
/**
 * School Management System (SMS)
 *
 * @category   Web Application
 * @package    school-management-system
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 */

// Here essential.php file is included
include_once('sources/essential.php');

// Here database connection function is called
db_connection();

// When the form will be submitted then this 'if' will work to signin the user
// isset() - this php function checks whether a variable is set with value or not
if(isset($_POST['submit']))
{
	$user_id 		= $_POST['user_id'];
	$password 		= md5($_POST['password']);
	$condition 		= "T1.user_id = '$user_id' AND T1.password = '$password' AND T1.uid = T2.uid";
	//$limit = 1;
	$row = selectRow(array(), 'spcl_signup as T1, spcl_student_info as T2', $condition);

	// This if will work if the desire user exists in database
	if($row)
	{
		@session_start();
		$_SESSION['uid'] 	= $row->uid;
		$_SESSION['user_id'] 	= $row->user_id;
		$_SESSION['user_type'] 	= $row->user_type;
		$_SESSION['first_name'] = $row->first_name;
		$_SESSION['last_name'] 	= $row->last_name;
		$_SESSION['code']	= time();
		if($row->user_type == 'admin')
		{
			@header("Location: admin/home.php");
		}
		elseif($row->user_type == 'student')
		{
			// Check is there any teacher's evaluation active or not
			$activeInfo = selectRow(array(), 'spcl_active_evaluation', "`awarding_body` = '".$row->awarding_body."' AND `enable` = 1", 'active_evaluation_id DESC');
			if(!empty($activeInfo->active_evaluation_id))
			{
				// Check the current student took part in teacher's evaluation or not
				$evaluationInfo = selectRow(array(), 'spcl_evaluation_score', "`teacher_name` = '".$activeInfo->teacher_name."' AND `uid` = ".$row->uid);
				if(empty($evaluationInfo->score_id))
				{
					@header("Location: student/confirm_evaluation.php?tid=".$activeInfo->teacher_id."&uid=".$row->uid."&code=".$_SESSION['code']);
				}else{
					@header("Location: student/home.php");
				}
			}else{
				@header("Location: student/home.php");
			}
		}
	}
	else
	{
		$errorMessage = 'Invalid Student ID or Password! !!';
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $websiteTitle; ?> | Signin Page</title>
<link rel="stylesheet" href="css/styles.css" type="text/css" />
</head>

<body>
	<div id="wrapper">
		<!-- Site Main Logo -->
		<div id="sitename">
			<?php include_once('layout/site_logo.php'); ?>
		</div>
		<!-- Site Main Logo End -->

		<!-- Site Top Nav Menu -->
		<div>
			<?php //include_once('layout/top_nav_menu.php'); ?>
		</div>
		<!-- Site Top Nav Menu End -->

		<!-- Site Main Header -->
		<div id="header">
			<?php include_once('layout/site_main_header.php'); ?>
		</div>
		<!-- Site Main Header End -->

		<!-- Site Content Body -->
		<div id="body" class="clear">
			<!-- Site Left Bar -->
			<div id="sidebar" class="column-left">
				<?php //include_once('layout/site_left_bar.php'); ?>
			</div>
			<!-- Site Left Bar End -->

			<!-- Site Right Content -->
			<div id="content" class="column-right">
				<div id="signup_form">
					<h3>Signin Form</h3>
					<p style="font-weight:bold; color:#CC0000;"><?php if(!empty($errorMessage)){echo $errorMessage;} ?></p>
					<form action="index.php" method="post">
						<p>
							<label for="user_id" style="font-weight:bold;">Username:</label>
							<input type="text" name="user_id" id="user_id" value="<?php echo @$_POST['user_id']; ?>" /><br />
						</p>

						<p>
							<label for="password" style="font-weight:bold;">Password:</label>
							<input type="password" name="password" id="password" value="<?php echo @$_POST['password']; ?>" /><br />
						</p>

						<p><input type="submit" name="submit" class="formbutton" value="Signin" /></p>
					</form>
				</div>
			</div>
			<!-- Site Right Content End -->
		</div>
		<!-- Site Content Body End -->

		<!-- Site Main Footer -->
		<div id="footer" class="clear">
			<?php include_once('layout/site_main_footer.php'); ?>
		</div>
		<!-- Site Main Footer End -->
	</div>
</body>
</html>
