<?php
// Here essential.php file is included
include_once('../sources/essential.php');

// Check admin session
check_admin_session();

// Here database connection function is called
db_connection();

// Delete function is called
$id = $_GET['id'];
if(delete('spcl_signup', "uid='$id'") AND delete('spcl_student_info', "uid='$id'"))
{
	$statusMessage = 'Student deleted successfully! !!';
}
else
{
	$statusMessage = 'Student delete operation failed! !!';
}
@header("Location: student.php?statusMessage=$statusMessage");
?>