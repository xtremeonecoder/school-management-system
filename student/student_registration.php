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
$pageId = 'registration';
$pageTitle = 'Student Registration';

// This 'if' will work, when Student Information Form will be submitted
if(isset($_POST['stud_info']))
{	
	// Form validation
	$errors = '';
	$errors .= validator('nationality', 'Nationality', 'required|trim|ucwords');
	$errors .= validator('passport_no', 'Passport No', 'required|trim');
	$errors .= validator('issue_date', 'Issue Date', 'required|trim');
	$errors .= validator('expire_date', 'Expire Date', 'required|trim');
	$errors .= validator('visa_issue_date', 'Visa Issue Date', 'required|trim');
	$errors .= validator('visa_expire_date', 'Visa Expire Date', 'required|trim');
	$errors .= validator('per_address', 'Permanent Address', 'required|trim');
	$errors .= validator('per_phone_no', 'Permanent Phone No', 'required|trim');
	$errors .= validator('cur_address', 'Current Address', 'required|trim');
	$errors .= validator('cur_phone_no', 'Current Phone No', 'required|trim');
	$errors .= validator('stud_email', 'Student Email', 'required|trim');
	$errors .= validator('contact_person_name', 'Contact Person Name', 'required|trim|ucwords');
	$errors .= validator('relationship', 'Relationship', 'required|trim|ucwords');
	$errors .= validator('emer_mobile_no', 'Emergency Mobile No', 'required|trim');
	$errors .= validator('emer_land_no', 'Emergency Land No', 'required|trim');
	$errors .= validator('emer_email', 'Emergency Email', 'required|trim');
	$errors .= validator('ref_name', 'Referee Name', 'required|trim|ucwords');
	$errors .= validator('ref_address', 'Referee Address', 'required|trim');
	$errors .= validator('ref_mobile_no', 'Referee Mobile No', 'required|trim');
	$errors .= validator('ref_email', 'Referee Email', 'required|trim');
	
	if(empty($errors))
	{
		$data = array(
			'uid'					=>	$_SESSION['uid'],
			'nationality'			=>	$_POST['nationality'],
			'marital_status'		=>	$_POST['marital_status'],
			'passport_no'			=>	$_POST['passport_no'],
			'issue_date'			=>	$_POST['issue_date'],
			'expire_date'			=>	$_POST['expire_date'],
			'visa_issue_date'		=>	$_POST['visa_issue_date'],
			'visa_expire_date'		=>	$_POST['visa_expire_date'],
			'per_address'			=>	$_POST['per_address'],
			'per_phone_no'			=>	$_POST['per_phone_no'],
			'cur_address'			=>	$_POST['cur_address'],
			'cur_phone_no'			=>	$_POST['cur_phone_no'],
			'stud_email'			=>	$_POST['stud_email'],
			'contact_person_name'           =>	$_POST['contact_person_name'],
			'relationship'			=>	$_POST['relationship'],
			'emer_mobile_no'		=>	$_POST['emer_mobile_no'],
			'emer_land_no'			=>	$_POST['emer_land_no'],
			'emer_email'			=>	$_POST['emer_email'],
			'ref_name'			=>	$_POST['ref_name'],
			'ref_post'			=>	$_POST['ref_post'],
			'organization'			=>	$_POST['organization'],
			'ref_address'			=>	$_POST['ref_address'],
			'ref_mobile_no'			=>	$_POST['ref_mobile_no'],
			'ref_land_no'			=>	$_POST['ref_land_no'],
			'ref_email'			=>	$_POST['ref_email'],
			'step1'				=>	'done',
			'status'			=>	'current'
		);	

		insert($data, 'spcl_student_registration');
	}
}
// This 'elseif' will work, when Qualification Form will be submitted
elseif(isset($_POST['qualification']))
{
	// Form validation
	$errors = '';
	$errors .= validator('year1', 'Year', 'required|trim');
	$errors .= validator('degree1', 'Degree', 'required|trim');
	$errors .= validator('institute1', 'Institute Name', 'required|trim');
	$errors .= validator('grade1', 'Grade', 'required|trim');
	
	if(empty($errors))
	{
		$data = array(
			'year'					=>	$_POST['year1'].':'.$_POST['year2'].':'.$_POST['year3'],
			'degree'				=>	$_POST['degree1'].':'.$_POST['degree2'].':'.$_POST['degree3'],
			'institute'				=>	$_POST['institute1'].':'.$_POST['institute2'].':'.$_POST['institute3'],
			'grade'					=>	$_POST['grade1'].':'.$_POST['grade2'].':'.$_POST['grade3'],
			'step2'					=>	'done'
		);
		
		update($data, 'spcl_student_registration', "id = '".$_POST['id']."'");
	}	
}
// This 'elseif' will work, when Payment Form will be submitted
elseif(isset($_POST['payment']))
{
	// Form validation
	$errors = '';
	
	if(empty($errors))
	{
		$data = array(
			'account_clearance_code'=>	$_POST['account_clearance_code'],
			'step3'					=>	'done'
		);
		
		update($data, 'spcl_student_registration', "id = '".$_POST['id']."'");
	}	
}
// This 'elseif' will work, when Save and Exit Button will be pressed
elseif(isset($_POST['complete']))
{
	// Form validation
	$errors = '';
	
	if(empty($errors))
	{
		$data = array(
			'step4'					=>	'done'
		);
		
		update($data, 'spcl_student_registration', "id = '".$_POST['id']."'");
	}	
}

$row = selectRow(array('id','step1','step2','step3','step4','step5'), 'spcl_student_registration', "uid = '".$_SESSION['uid']."' AND status = 'current'");
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
			<?php
				if(empty($row->step1)){include_once('../sources/student_content/student_registration_content_step1.php');}
				elseif(empty($row->step2)){include_once('../sources/student_content/student_registration_content_step2.php');}
				elseif(empty($row->step3)){include_once('../sources/student_content/student_registration_content_step3.php');}
				elseif(empty($row->step4)){include_once('../sources/student_content/student_registration_content_step4.php');}
				elseif(!empty($row->step4)){include_once('../sources/student_content/student_registration_content_step5.php');}
			?>
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
