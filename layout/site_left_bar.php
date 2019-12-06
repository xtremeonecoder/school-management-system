<?php
/**
 * School Management System (SMS)
 *
 * @category   Web Application
 * @package    school-management-system
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 */
?>

<ul>	
        <li>
                <h4><?php if($pageId == 'registration'){echo 'Registration Process';}else{echo 'Sub-Links';} ?></h4>
                <ul>
                        <?php if($pageId == 'student'){ ?>
                                <li><a href="student.php" title="Student List">Student List</a></li>
                                <li><a href="student_signup.php" title="Create New Student">Create New Student</a></li>								
                                <li><a href="student_search.php" title="Student Search">Student Search</a></li>
                                <li><a href="custom_student_search.php" title="Custom Student Search">Custom Student Search</a></li>
                        <?php //}elseif($pageId == 'message'){ ?>	
<!--								<li><a href="compose_message.php" title="Compose Message">Compose Message</a></li>
                                <li><a href="message_inbox.php" title="Message Inbox">Message Inbox</a></li>
                                <li><a href="message_outbox.php" title="Message Outbox">Message Outbox</a></li>
-->							<?php }elseif($pageId == 'teacher'){ ?>	
                                <li><a href="evaluation_list.php" title="Active Teacher Evaluation List">Evaluation List</a></li>
                                <li><a href="active_evaluation.php" title="Active Teacher Evaluation">Active Teacher Evaluation</a></li>
                                <li><a href="teacher_evaluation.php" title="Teacher Evaluation">Teacher Evaluation</a></li>
                                <li><a href="evaluation_report.php" title="Evaluation Report">Evaluation Report</a></li>
                        <?php }elseif($pageId == 'notice'){ ?>	
                                <li><a href="exam_schedule.php" title="Exam Schedule">Exam Schedule</a></li>
                                <li><a href="exam_result.php" title="Exam Result">Exam Result</a></li>
                        <?php }elseif($pageId == 'admin'){ ?>	
                                <li><a href="admin_account.php" title="My Account">My Account</a></li>
                                <li><a href="change_password.php" title="Change Password">Change Password</a></li>
                        <?php }elseif($pageId == 'result_schedule'){ ?>	
                                <li><a href="add_exam_result.php" title="Add Exam Result">Add Exam Result</a></li>
                                <li><a href="exam_result.php" title="Exam Result List">Exam Result List</a></li>
                                <li><a href="add_exam_schedule.php" title="Add Exam Schedule">Add Exam Schedule</a></li>
                                <li><a href="exam_schedule.php" title="Exam Schedule List">Exam Schedule List</a></li>
                        <?php }elseif($pageId == 'details'){ ?>	
                                <li><a href="student_account.php" title="My Account">My Account</a></li>
                                <!--<li><a href="student_account_edit.php" title="Edit Account">Edit Account</a></li>-->								
                                <li><a href="student_profile.php" title="My Account">My Profile</a></li>
                                <li><a href="edit_student_details.php" title="My Details">Edit Details Information</a></li>								
                                <li><a href="edit_previous_qualification.php" title="My Previous Qualification">Edit Previous Qualification</a></li>								
                                <li><a href="change_password.php" title="Change Password">Change Password</a></li>
                        <?php }elseif($pageId == 'adminrequest'){ ?>	
                                <?php
                                // Count Unread Student Request
                                $numberOfCC = countRows('id', 'spcl_student_request', "`request_type` = 'Change Circumstances' AND `read` = '0'");	
                                $numberOfLR = countRows('id', 'spcl_student_request', "`request_type` = 'Letter' AND `read` = '0'");	
                                $numberOfIR = countRows('id', 'spcl_student_request', "`request_type` = 'ID' AND `read` = '0'");	
                                ?>
                                <li><a href="admin_change_circumstances.php" title="Notification for Change Circumstances">Notification for Change Circumstances<?php if($numberOfCC != 0){ ?> <span style="color:#CC0000;">(<?php echo $numberOfCC; ?>)</span><?php } ?></a></li>
                                <li><a href="admin_letter_request.php" title="Request for Letters">Request for Letters<?php if($numberOfLR != 0){ ?> <span style="color:#CC0000;">(<?php echo $numberOfLR; ?>)</span><?php } ?></a></li>
                                <li><a href="admin_id_request.php" title="Request for ID">Request for ID<?php if($numberOfIR != 0){ ?> <span style="color:#CC0000;">(<?php echo $numberOfIR; ?>)</span><?php } ?></a></li>
                        <?php }elseif($pageId == 'request'){ ?>	
                                <li><a href="change_circumstances.php" title="Notification for Change Circumstances">Notification for Change Circumstances</a></li>
                                <li><a href="letter_request.php" title="Request for Letters">Request for Letters</a></li>
                                <li><a href="id_request.php" title="Request for ID">Request for ID</a></li>
                        <?php }elseif($pageId == 'registration'){ ?>	
                                <li <?php if(empty($row->step1)){echo "class='step'";} ?>>Step-1 : Student Details</li>
                                <li <?php if(!empty($row->step1) AND empty($row->step2)){echo "class='step'";} ?>>Step-2 : Previous Qualification</li>								
                                <li <?php if(!empty($row->step2) AND empty($row->step3)){echo "class='step'";} ?>>Step-3 : Payment System</li>
                                <li <?php if(!empty($row->step3) AND empty($row->step4)){echo "class='step'";} ?>>Step-4 : Summarize Information</li>								
                                <li <?php if(!empty($row->step4) AND empty($row->step5)){echo "class='step'";} ?>>Step-5 : Success Message</li>								
                        <?php } ?>		
                </ul>
        </li>
</ul>
