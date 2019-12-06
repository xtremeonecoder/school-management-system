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
include_once('../sources/essential.php');

// Check admin session
check_student_session();

// Here database connection function is called
db_connection();
$pageId = 'account';
$pageTitle = 'Student Account';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_once('../layout/head.php'); ?>
</head>

<body>
	<div id="wrapper">
		<!-- Site Main Logo -->	
		<div id="sitename">
			<?php include_once('../layout/site_logo.php'); ?>
		</div>
		<!-- Site Main Logo End -->	
		
		<!-- Site Top Nav Menu -->	
		<div id="nav">
			<?php include_once('../layout/top_nav_menu.php'); ?>
		</div>
		<!-- Site Top Nav Menu End -->	
		
		<!-- Site Main Header -->	
		<div id="header">
			<?php include_once('../layout/site_main_header.php'); ?>
		</div>
		<!-- Site Main Header End -->	
		
		<!-- Site Content Body -->	
		<div id="body" class="clear">
			<!-- Site Left Bar -->
			<div id="sidebar" class="column-left">
				<?php include_once('../layout/site_left_bar.php'); ?>
			</div>
			<!-- Site Left Bar End -->
			
			<!-- Site Right Content -->		
			<div id="content" class="column-right">
				<?php include_once('../sources/student_content/student_account.php'); ?>
			</div>
			<!-- Site Right Content End -->	
		</div>
		<!-- Site Content Body End -->	
		
		<!-- Site Main Footer -->	
		<div id="footer" class="clear">
			<?php include_once('../layout/site_main_footer.php'); ?>
		</div>
		<!-- Site Main Footer End -->	
	</div>
</body>
</html>
