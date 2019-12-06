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

<ul class="clear">			
        <!-- MENU -->
        <li <?php if($pageId == 'home'){echo "class='current'";} ?>><a href="home.php"><span>Home</span></a></li>
        <?php if($_SESSION['user_type'] == 'admin'){ ?>
                <li <?php if($pageId == 'admin'){echo "class='current'";} ?>><a href="admin.php"><span>Admin</span></a></li>
                <li <?php if($pageId == 'student'){echo "class='current'";} ?>><a href="student.php"><span>Students</span></a></li>
                <?php
                $totalRequest = countRows('id', 'spcl_student_request', "`read` = '0'");	
                ?>
                <li <?php if($pageId == 'adminrequest'){echo "class='current'";} ?>><a href="admin_requests.php"><span>Requests<?php if($totalRequest != 0){ ?> (<?php echo $totalRequest; ?>)<?php } ?></span></a></li>
                <li <?php if($pageId == 'result_schedule'){echo "class='current'";} ?>><a href="result_schedule.php"><span>Exams/Results</span></a></li>
                <li <?php if($pageId == 'teacher'){echo "class='current'";} ?>><a href="teacher.php"><span>Teachers Evaluation</span></a></li>
                <li <?php if($pageId == 'report'){echo "class='current'";} ?>><a href="report.php"><span>Report</span></a></li>
        <?php }elseif($_SESSION['user_type'] == 'student'){ ?>
                <li <?php if($pageId == 'registration'){echo "class='current'";} ?>><a href="student_registration.php"><span>Registration</span></a></li>
                <li <?php if($pageId == 'details'){echo "class='current'";} ?>><a href="student_details.php"><span>My Details</span></a></li>
                <li <?php if($pageId == 'request'){echo "class='current'";} ?>><a href="requests.php"><span>Requests</span></a></li>
                <li <?php if($pageId == 'notice'){echo "class='current'";} ?>><a href="notice_board.php"><span>Notice Board</span></a></li>
                <li <?php if($pageId == 'search'){echo "class='current'";} ?>><a href="search.php"><span>Search</span></a></li>
        <?php } ?>
<!--				<li <?php //if($pageId == 'message'){echo "class='current'";} ?>><a href="message.php"><span>Message</span></a></li>
-->				<li <?php if($pageId == 'signout'){echo "class='current'";} ?>><a href="signout.php"><span>Signout</span></a></li>
        <!-- END MENU -->				
</ul>
