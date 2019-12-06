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

if(!empty($_POST['id']))
{
	if(update(array('read' => 1), 'spcl_student_request', "id = '".$_POST['id']."'"))
	{
		echo 'yes';
	}else{
		echo 'no';
	}
}else{
	echo 'invalid';
}	
?>