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
check_admin_session();

// Here database connection function is called
db_connection();

if(!empty($_POST['result_id']))
{
	
	if(update(array('enable' => $_POST['status']), 'spcl_exam_result', "result_id = '".$_POST['result_id']."'"))
	{
		echo 'yes';
	}else{
		echo 'no';
	}
}
elseif(!empty($_POST['schedule_id']))
{
	
	if(update(array('enable' => $_POST['status']), 'spcl_exam_schedule', "schedule_id = '".$_POST['schedule_id']."'"))
	{
		echo 'yes';
	}else{
		echo 'no';
	}
}else{
	echo 'invalid';
}	
?>