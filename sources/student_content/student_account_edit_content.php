<?php
/**
 * School Management System (SMS)
 *
 * @category   Web Application
 * @package    school-management-system
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 */

// When the form will be submitted then this 'if' will work to insert form data to database and show the success message
// isset() - this php function checks whether a variable is set with value or not
if(isset($_POST['submit']))
{
        // trim() = Remove the blank space from beginning and ending of the string
        // ucwords() = Make the 1st letter uppercase each word of phrase
        $id 			= trim($_POST['id']);
        $title 			= trim($_POST['title']);
        $first_name             = ucwords(trim($_POST['first_name']));
        $last_name 		= ucwords(trim($_POST['last_name']));
        $dob 			= trim($_POST['dob']);
        $course 		= trim($_POST['course']);
        $level 			= trim($_POST['level']);
        $reporting_date         = trim($_POST['reporting_date']);
        $awarding_body          = trim($_POST['awarding_body']);
        $academic 		= trim($_POST['academic']);
        $session 		= ucwords(trim($_POST['session']));
        $course_fee             = trim($_POST['course_fee']);

        // Inject all the posted data into an associated array
        $data = array(
                'title'			=>	$title,
                'first_name'		=>	$first_name,
                'last_name'		=>	$last_name,
                'dob'			=>	$dob,
                'course'		=>	$course,
                'level'			=>	$level,
                'reporting_date'	=>	$reporting_date,
                'awarding_body'		=>	$awarding_body,
                'academic'		=>	$academic,
                'session'		=>	$session,
                'course_fee'		=>	$course_fee,
        );

        // calling the insert() function to insert the data
        if(update($data, 'spcl_student_info', "id='$id'"))
        {
                echo '<h3>Student account updated successfully! !!</h3>';
        }
}
// Initially this 'elseif' will work to show the signup form
elseif(!isset($_POST['submit']))
{
        $uid = $_SESSION['uid'];
        // Get particular user data
        $result = selectRow(array(), 'spcl_signup as T1, spcl_student_info as T2', "T1.uid = T2.uid AND T1.uid='$uid'");

        // Set the value to the variables
        $id 			= $result->id;
        $title 			= $result->title;
        $first_name             = $result->first_name;
        $last_name	 	= $result->last_name;
        $dob 			= $result->dob;
        $course 		= $result->course;
        $level 			= $result->level;
        $reporting_date         = $result->reporting_date;
        $awarding_body          = $result->awarding_body;
        $academic 		= $result->academic;
        $session 		= $result->session;
        $course_fee             = $result->course_fee;
?>
        <div id="signup_form">	
                <h3>Student Account Edit</h3>
                <form action="student_account_edit.php" method="post">
                        <p>
                                <label for="title">Student Title:</label>
                                <select name="title" id="title">
                                        <option value="Mr." <?php if($title == 'Mr.'){echo "select='select'";} ?>>Mr.</option>
                                        <option value="Mrs." <?php if($title == 'Mrs.'){echo "select='select'";} ?>>Mrs.</option>
                                        <option value="Mis." <?php if($title == 'Mis.'){echo "select='select'";} ?>>Mis.</option>
                                        <option value="Ms." <?php if($title == 'Ms.'){echo "select='select'";} ?>>Ms.</option>
                                </select>
                                <br />
                        </p>

                        <p>
                                <label for="first_name">First name:</label>
                                <input type="text" name="first_name" id="first_name" value="<?php echo $first_name; ?>" /><br />
                        </p>

                        <p>
                                <label for="last_name">Last Name:</label>
                                <input type="text" name="last_name" id="last_name" value="<?php echo $last_name; ?>" /><br />
                        </p>

                        <p>
                                <label for="dob">Date of Birth:</label>
                                <input type="text" name="dob" id="dob" value="<?php echo $dob; ?>" />&nbsp;&nbsp;(Date Format : DD/MM/YYYY)<br />
                        </p>

                        <p>
                                <label for="course">Course:</label>
                                <input type="text" name="course" id="course" value="<?php echo $course; ?>" /><br />
                        </p>

                        <p>
                                <label for="level">Level:</label>
                                <input type="text" name="level" id="level" value="<?php echo $level; ?>" /><br />
                        </p>

                        <p>
                                <label for="reporting_date">Reporting Date:</label>
                                <input type="text" name="reporting_date" id="reporting_date" value="<?php echo $reporting_date; ?>" />&nbsp;&nbsp;(Date Format : DD/MM/YYYY)<br />
                        </p>

                        <p>
                                <label for="awarding_body">Awarding Body:</label>
                                <input type="text" name="awarding_body" id="awarding_body" value="<?php echo $awarding_body; ?>" /><br />
                        </p>

                        <p>
                                <label for="academic">Academic:</label>
                                <input type="text" name="academic" id="academic" value="<?php echo $academic; ?>" /><br />
                        </p>

                        <p>
                                <label for="session">Session:</label>
                                <input type="text" name="session" id="session" value="<?php echo $session; ?>" /><br />
                        </p>

                        <p>
                                <label for="course_fee">Course Fee:</label>
                                <input type="text" name="course_fee" id="course_fee" value="<?php echo $course_fee; ?>" /><br />
                        </p>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <p><input type="submit" name="submit" class="formbutton" value="Update" /></p>
                </form>
        </div>
<?php } ?>