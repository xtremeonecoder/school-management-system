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
        $errors = '';
        // Form Validation
        $errors .= validator('first_name', 'First Name', 'required|ucwords|trim');
        $errors .= validator('last_name', 'Last Name', 'required|ucwords|trim');
        $errors .= validator('dob', 'Date of Birth', 'required|trim');
        $errors .= validator('course', 'Course', 'required|trim');
        $errors .= validator('level', 'Level', 'required|trim');
        $errors .= validator('reporting_date', 'Reporting Date', 'required|trim');
        $errors .= validator('awarding_body', 'Awarding Body', 'required|trim');
        $errors .= validator('academic', 'Academic', 'required|trim');
        $errors .= validator('session', 'Session', 'required|trim');
        $errors .= validator('course_fee', 'Course Fee', 'required|trim');
        $errors .= validator('user_id', 'Student ID', 'required|unique|trim');
        $errors .= validator('password', 'Password', 'required|trim|length[4,10]|match[confpass]');

        // trim() = Remove the blank space from beginning and ending of the string
        // ucwords() = Make the 1st letter uppercase each word of phrase
        $title 			= $_POST['title'];
        $first_name             = $_POST['first_name'];
        $last_name 		= $_POST['last_name'];
        $dob 			= $_POST['dob'];
        $course 		= $_POST['course'];
        $level 			= $_POST['level'];
        $reporting_date         = $_POST['reporting_date'];
        $awarding_body          = $_POST['awarding_body'];
        $academic 		= $_POST['academic'];
        $session 		= $_POST['session'];
        $course_fee             = $_POST['course_fee'];
        $user_id 		= $_POST['user_id'];
        $password 		= $_POST['password'];
        $confpass 		= $_POST['confpass'];

        if(empty($errors))
        {
                // Inject all the posted data into an associated array
                $data1 = array(
                        'user_id'	=>	$user_id,
                        'password'	=>	md5($password)
                );

                // calling the insert() function to insert data into spcl_signup table
                $is_inserted = insert($data1, 'spcl_signup');

                // To fetch the currently inserted user's ID No.
                $row = selectRow(array('uid'), 'spcl_signup', "user_id = '$user_id'");

                $data2 = array(
                        'uid'               =>  $row->uid,
                        'title'             =>	$title,
                        'first_name'        =>	$first_name,
                        'last_name'         =>	$last_name,
                        'dob'               =>	$dob,
                        'course'            =>	$course,
                        'level'             =>	$level,
                        'reporting_date'    =>	$reporting_date,
                        'awarding_body'     =>	$awarding_body,
                        'academic'          =>	$academic,
                        'session'           =>	$session,
                        'course_fee'        =>	$course_fee
                );
        }

        // calling the insert() function to insert the data into spcl_student_info table
        if(empty($errors))
        {
                if($is_inserted && insert($data2, 'spcl_student_info'))
                {
                        echo '<h3>Student created successfully! !!</h3>';

                        // For printing student ID, Password
                        if($_POST['print'] == 'yes')
                        {
                                echo "
                                <script type='text/javascript'>
                                        window.open('printable.php?user_id=$user_id&password=$password', 'mywindow', 'width=400, height=200, left=0, top=100, screenX=0, screenY=100');
                                </script>				
                                ";
                        }
                }
        }	
}
// Initially this 'if' will work to show the signup form
if(!isset($_POST['submit']) || !empty($errors)){                               
?>
<script type="text/javascript">
$(document).ready(function(){
    // Event function for userId generating
   $('#session').change(function(){
       var firstLetterOfFirstName = $('#first_name').val().slice(0, 1).toLowerCase(); // if first name is 'Aninda' then it gives output 'a
       var firstLetterOfLastName = $('#last_name').val().slice(0, 1).toLowerCase(); // if last name is 'Barua' then it gives output 'b'
       var academicYear = $('#academic').val().slice(2, 4); // if academic year is '2011' then it gives output '11'
       var sessionFirstLetter = ($('#session').val()=='June') ? $('#session').val().slice(0, 2).toLowerCase() : $('#session').val().slice(0, 1).toLowerCase(); // if session month is 'March' it gives output 'm'
       var split = $('#dob').val().split('/'); // if date of birth is 10/10/1982 then it splits Day, Month, and Year and store it into an array
       var birthDay = split[0]; // array element[0] gives the birthDay like 10
       var birthMonth = split[1]; // array element[1] gives the birthMonth like 10
       var birthYear = split[2].slice(2, 4); // array element[2] gives the birthYear like 82
       var userId = 'spcl' + academicYear + sessionFirstLetter + birthDay + birthMonth + birthYear + firstLetterOfFirstName + firstLetterOfLastName;

      // now inject the userId to the user_id field
       $('#user_id').val(userId);
   });

   // Event function for awarding body wise 'course combo box' loading.
   $('#awarding_body').change(function(){
       var awarding_body = $(this).val();
       if(awarding_body == 'ACP')
       {
           // This combo box will load when awarding body is 'ACP'
           var comboBox = "<label for='course'>Course:</label>" +
                          "<select name='course' id='course'>" +
                                "<option value=''>Select Course</option>" +
                                "<option value='ACP Diploma in Information System Analysis & Design'>ACP Diploma in Information System Analysis & Design</option>" +
                                "<option value='ACP Advanced Diploma in Computing Science'>ACP Advanced Diploma in Computing Science</option>" +
                                                          "</select>";
       }else if(awarding_body == 'ABP')
       {
           // This combo box will load when awarding body is 'ABP'
           var comboBox = "<label for='course'>Course:</label>" +
                          "<select name='course' id='course'>" +
                                "<option value=''>Select Course</option>" +
                                "<option value='Postgraduate Diploma in Information Systems'>Postgraduate Diploma in Information Systems</option>" +
                                                          "</select>";
       }else if(awarding_body == 'ACCA')
       {
           // This combo box will load when awarding body is 'ACCA'
           var comboBox = "<label for='course'>Course:</label>" +
                          "<select name='course' id='course'>" +
                                "<option value=''>Select Course</option>" +
                                "<option value='ACCA (Association of Chartered Certified Accountant)'>ACCA (Association of Chartered Certified Accountant)</option>" +                                               
                                                          "</select>";
       }else if(awarding_body == 'ABE')
       {
           // This combo box will load when awarding body is 'ABE'
           var comboBox = "<label for='course'>Course:</label>" +
                          "<select name='course' id='course'>" +
                             "<option value=''>Select Course</option>" +
                             "<option value='Diploma in Business Management'>Diploma in Business Management</option>" +
                             "<option value='Advance Diploma in Business Management'>Advance Diploma in Business Management</option>" +
                                                          "</select>";
       }else if(awarding_body == 'OTHM')
       {
           // This combo box will load when awarding body is 'OTHM'
           var comboBox = "<label for='course'>Course:</label>" +
                          "<select name='course' id='course'>" +
                             "<option value=''>Select Course</option>" +
                             "<option value='Professional Certificate in Hospitality Management'>Professional Certificate in Hospitality Management</option>" +
                             "<option value='Professional Diploma in Hospitality Management'>Professional Diploma in Hospitality Management</option>" +
                             "<option value='Professional Higher Diploma in Hospitality Management'>Professional Higher Diploma in Hospitality Management</option>" +
                             "<option value='Post Graduate Diploma in Hospitality Management'>Post Graduate Diploma in Hospitality Management</option>" +
                                                          "</select>";
       }
       $('#courseCombo').html(comboBox);
   });

   // Event function for course wise 'level combo box' loading
   $('#course').change(function(){
       var course = $(this).val();
       if(course == 'Postgraduate Diploma in Information Systems')
       {
           // This combo box will load when awarding body is 'Postgraduate Diploma in Information Systems'
           var comboBox = "<label for='level'>Level:</label>" +
                          "<select name='level' id='level'>" +
                              "<option value=''>Select Course Level</option>" +
                              <?php //for($level=1; $level<=10; $level++){ ?>
                                  "<option value='<?php //echo "Level-$level"; ?>'><?php //echo "Level-$level"; ?></option>" +
                              <?php //} ?>
                                          "</select>";
       }

       $('#levelCombo').html(comboBox);
   });
});
</script>
        <div id="signup_form">	
                <h3>Student Signup Form</h3>
                <p style="color:#CC0000; font-weight:bold;"><?php if(!empty($errors)){echo $errors;} ?></p>
                <form action="student_signup.php" method="post">
                        <p>
                                <label for="title">Student Title:</label>
                                <select name="title" id="title">
            <option value="">Select Student Title</option>
                                        <option value="Mr." <?php if(@$_POST['title'] == 'Mr.'){echo "selected='selected'";} ?>>Mr.</option>
                                        <option value="Mrs." <?php if(@$_POST['title'] == 'Mrs.'){echo "selected='selected'";} ?>>Mrs.</option>
                                        <option value="Mis." <?php if(@$_POST['title'] == 'Mis.'){echo "selected='selected'";} ?>>Mis.</option>
                                        <option value="Ms." <?php if(@$_POST['title'] == 'Ms.'){echo "selected='selected'";} ?>>Ms.</option>
                                </select>
                                <br />
                        </p>

                        <p>
                                <label for="first_name">First name:</label>
                                <input type="text" name="first_name" id="first_name" value="<?php echo @$_POST['first_name']; ?>" /><br />
                        </p>

                        <p>
                                <label for="last_name">Last Name:</label>
                                <input type="text" name="last_name" id="last_name" value="<?php echo @$_POST['last_name']; ?>" /><br />
                        </p>

                        <p>
                                <label for="dob">Date of Birth:</label>
                                <input type="text" name="dob" id="dob" value="<?php echo @$_POST['dob']; ?>" />&nbsp;&nbsp;(Date Format : DD/MM/YYYY)<br />
                        </p>

                        <p>
                                <label for="awarding_body">Awarding Body:</label>						
                                <select name="awarding_body" id="awarding_body">
            <option value="">Select Awarding Body</option>
                                        <option value="ACP" <?php if(@$_POST['awarding_body'] == 'ACP'){echo "selected='selected'";} ?>>ACP</option>
                                        <option value="ABP" <?php if(@$_POST['awarding_body'] == 'ABP'){echo "selected='selected'";} ?>>ABP</option>
                                        <option value="ACCA" <?php if(@$_POST['awarding_body'] == 'ACCA'){echo "selected='selected'";} ?>>ACCA</option>
                                        <option value="ABE" <?php if(@$_POST['awarding_body'] == 'ABE'){echo "selected='selected'";} ?>>ABE</option>
            <option value="OTHM" <?php if(@$_POST['awarding_body'] == 'OTHM'){echo "selected='selected'";} ?>>OTHM</option>
                                </select>
                        </p>

                        <p id="courseCombo">
                                <label for="course">Course:</label>						
                                <select name="course" id="course">
            <option value="">Select Course</option>
                                </select>          
                        </p>

                        <p id="levelCombo">
                                <label for="level">Level:</label>
                                <select name="level" id="level">
            <option value="">Select Course Level</option>  
                                        <?php for($level=1; $level<=10; $level++){ ?>
                                                <option value="<?php echo "Level-$level"; ?>"><?php echo "Level-$level"; ?></option>
                                        <?php } ?>
                                </select>
                        </p>

                        <p>
                                <label for="reporting_date">Reporting Date:</label>
                                <input type="text" name="reporting_date" id="reporting_date" value="<?php echo @$_POST['reporting_date']; ?>" />&nbsp;&nbsp;(Date Format : DD/MM/YYYY)<br />
                        </p>

                        <p>
                                <label for="academic">Academic:</label>						
                                <select name="academic" id="academic">
                                        <option value="">Select Academic Year</option>
                                        <?php for($year=date('Y'); $year<=2050; $year++){ ?>
                                                <option value="<?php echo $year; ?>" <?php if(@$_POST['session'] == $year){echo "select='select'";} ?>><?php echo $year; ?></option>
                                        <?php } ?>
                                </select>
                        </p>

                        <p>
                                <label for="session">Session:</label>
                                <select name="session" id="session">
            <option value="">Select Study Session</option>
                                        <option value="January" <?php if(@$_POST['session'] == 'January'){echo "selected='selected'";} ?>>January</option>
                                        <option value="March" <?php if(@$_POST['session'] == 'March'){echo "selected='selected'";} ?>>March</option>
                                        <option value="June" <?php if(@$_POST['session'] == 'June'){echo "selected='selected'";} ?>>June</option>
                                        <option value="September" <?php if(@$_POST['session'] == 'September'){echo "selected='selected'";} ?>>September</option>
                                </select>
                        </p>

                        <p>
                                <label for="course_fee">Course Fee:</label>
                                <input type="text" name="course_fee" id="course_fee" value="<?php echo @$_POST['course_fee']; ?>" /><br />
                        </p>

                        <p>
                                <label for="user_id">Student ID:</label>
                                <input type="text" name="user_id" id="user_id" value="<?php echo @$_POST['user_id']; ?>" /><br />
                        </p>

                        <p>
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" value="<?php echo @$_POST['password']; ?>" /><br />
                        </p>

                        <p>
                                <label for="confpass">Retype Password:</label>
                                <input type="password" name="confpass" id="confpass" value="<?php echo @$_POST['confpass']; ?>" /><br />
                        </p>

                        <p>
                                <label for="print">Take Print Out:</label>
                                <input type="radio" name="print" id="yes" value="yes" />&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="print" id="no" value="no" />&nbsp;No<br />
                        </p>

                        <p><input type="submit" name="submit" class="formbutton" value="Save" /></p>
                </form>
        </div>
<?php } ?>