<?php
/**
 * School Management System (SMS)
 *
 * @category   Web Application
 * @package    school-management-system
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 */

$uid = $_SESSION['uid'];
// Get particular user data
$result = selectRow(array(), 'spcl_signup as T1, spcl_student_info as T2', "T1.uid = T2.uid AND T1.uid='$uid'");
?>
<div>	
        <h3><?php echo "Account Details of $result->first_name $result->last_name"; ?></h3>
        <p><?php echo 'Full Name : '.$result->title.' '.$result->first_name.' '.$result->last_name; ?></p>
        <p><?php echo 'Date of Birth : '.date('M d, Y', strtotime($result->dob)); ?></p>
        <p><?php echo 'Course : '.$result->course; ?></p>
        <p><?php echo 'Course Fee : '.$result->course_fee.' &euro;'; ?></p>
        <p><?php echo 'Level : '.$result->level; ?></p>
        <p><?php echo 'Session : '.$result->session; ?></p>
        <p><?php echo 'Academic : '.$result->academic; ?></p>
        <p><?php echo 'Reporting Date : '.date('M d, Y', strtotime($result->reporting_date)); ?></p>
        <p><?php echo 'Awarding Body : '.$result->awarding_body; ?></p>
        <p><?php echo 'Student ID : '.$result->user_id; ?></p>				
        <p><?php echo 'Password : (Password is hidden for security reason)'; ?></p>				
</div>