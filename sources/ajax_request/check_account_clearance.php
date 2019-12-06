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
include_once('../essential.php');

// Check admin session
check_student_session();

// Here database connection function is called
db_connection();

if(!empty($_POST['account_clearance_code']))
{
//	$res = selectRow(array('id'), 'spcl_account_clearance', "uid = '".$_SESSION['uid']."' AND account_clearance_code = '".$_POST['account_clearance_code']."' AND status = '1'");
//	if(!empty($res->id))
//	{
//		echo 'valid';
//	}else{
//		echo 'invalid';
//	}
echo 'valid';
}else{
	echo 'invalid';
}	
?>