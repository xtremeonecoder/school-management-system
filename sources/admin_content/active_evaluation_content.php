<?php
/**
 * School Management System (SMS)
 *
 * @category   Web Application
 * @package    school-management-system
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 */

// Get Teacher's Information
$teachers = select(array(), 'spcl_teacher_registration', "`enable` = 1");

if(isset($_POST['submit']))
{
        $errors = '';
        $errors .= validator('teacher_name', 'Teacher Name', 'required|trim');
        $errors .= validator('awarding_body', 'Awarding Body', 'required|trim');
        $errors .= validator('course', 'Course Name', 'required|trim');
        $errors .= validator('subject', 'Subject Name', 'required|trim');
        $errors .= validator('start_date', 'Start Date', 'required|trim');
        $errors .= validator('end_date', 'End Date', 'required|trim');

        if(empty($errors))
        {
                $data = array(
                        'teacher_name'	=>	$_POST['teacher_name'],
                        'awarding_body'	=>	$_POST['awarding_body'],
                        'course'		=>	$_POST['course'],
                        'subject'		=>	$_POST['subject'],
                        'start_date'	=>	$_POST['start_date'],
                        'end_date'		=>	$_POST['end_date']
                );

                if(insert($data, 'spcl_active_evaluation'))
                {
                        $success = 'Evaluation Activated Successfully! !!';
                }
        }
}
?>

<script type="text/javascript">
$(function(){
        $('#start_date').datepicker();
        $('#end_date').datepicker();
});
</script>

<script type="text/javascript">
$(document).ready(function(){
   // Event function for awarding body wise 'course combo box' loading.
   $('#awarding_body').change(function(){
           var awarding_body = $(this).val();
           if(awarding_body == 'ACP')
           {
                   // This combo box will load when awarding body is 'ACP'
                   var comboBox = "<label for='course'>Course:</label><br />" +
                                                  "<select name='course' id='course'>" +
                                                        "<option value=''>Select Course</option>" +
                                                        "<option value='ACP Diploma in Information System Analysis & Design'>ACP Diploma in Information System Analysis & Design</option>" +
                                                        "<option value='ACP Advanced Diploma in Computing Science'>ACP Advanced Diploma in Computing Science</option>" +
                                                  "</select><br />";
           }else if(awarding_body == 'ABP')
           {
                   // This combo box will load when awarding body is 'ABP'
                   var comboBox = "<label for='course'>Course:</label><br />" +
                                                  "<select name='course' id='course'>" +
                                                        "<option value=''>Select Course</option>" +
                                                        "<option value='Postgraduate Diploma in Information Systems'>Postgraduate Diploma in Information Systems</option>" +
                                                  "</select><br />";
           }else if(awarding_body == 'ACCA')
           {
                   // This combo box will load when awarding body is 'ACCA'
                   var comboBox = "<label for='course'>Course:</label><br />" +
                                                  "<select name='course' id='course'>" +
                                                        "<option value=''>Select Course</option>" +
                                                        "<option value='ACCA (Association of Chartered Certified Accountant)'>ACCA (Association of Chartered Certified Accountant)</option>" +                                               
                                                  "</select><br />";
           }else if(awarding_body == 'ABE')
           {
                   // This combo box will load when awarding body is 'ABE'
                   var comboBox = "<label for='course'>Course:</label><br />" +
                                                  "<select name='course' id='course'>" +
                                                         "<option value=''>Select Course</option>" +
                                                         "<option value='Diploma in Business Management'>Diploma in Business Management</option>" +
                                                         "<option value='Advance Diploma in Business Management'>Advance Diploma in Business Management</option>" +
                                                  "</select><br />";
           }else if(awarding_body == 'OTHM')
           {
                   // This combo box will load when awarding body is 'OTHM'
                   var comboBox = "<label for='course'>Course:</label><br />" +
                                                  "<select name='course' id='course'>" +
                                                         "<option value=''>Select Course</option>" +
                                                         "<option value='Professional Certificate in Hospitality Management'>Professional Certificate in Hospitality Management</option>" +
                                                         "<option value='Professional Diploma in Hospitality Management'>Professional Diploma in Hospitality Management</option>" +
                                                         "<option value='Professional Higher Diploma in Hospitality Management'>Professional Higher Diploma in Hospitality Management</option>" +
                                                         "<option value='Post Graduate Diploma in Hospitality Management'>Post Graduate Diploma in Hospitality Management</option>" +
                                                  "</select><br />";
           }
           $('#courseCombo').html(comboBox);
   });
});
</script>

<div id="signup_form">	
        <h3>Active Teacher Evaluation</h3>
        <?php if(!empty($errors)){ ?><p style="font-weight:bold; color:#CC0000;"><?php echo $errors; ?></p><?php } ?>
        <?php if(!empty($success)){ ?><p style="font-weight:bold; color:#006633;"><?php echo $success; ?></p><?php } ?>
        <form method="post" action="active_evaluation.php">
                <p>
                        <label for="teacher_id">Teacher Name</label><br />
                        <input type="text" name="teacher_name" id="teacher_name" /><br />
                </p>

                <p>
                        <label for="awarding_body">Awarding Body:</label><br />						
                        <select name="awarding_body" id="awarding_body" style="width:300px;">
    <option value="">Select Awarding Body</option>
                                <option value="ACP" <?php if(@$_POST['awarding_body'] == 'ACP'){echo "selected='selected'";} ?>>ACP</option>
                                <option value="ABP" <?php if(@$_POST['awarding_body'] == 'ABP'){echo "selected='selected'";} ?>>ABP</option>
                                <option value="ACCA" <?php if(@$_POST['awarding_body'] == 'ACCA'){echo "selected='selected'";} ?>>ACCA</option>
                                <option value="ABE" <?php if(@$_POST['awarding_body'] == 'ABE'){echo "selected='selected'";} ?>>ABE</option>
    <option value="OTHM" <?php if(@$_POST['awarding_body'] == 'OTHM'){echo "selected='selected'";} ?>>OTHM</option>
                        </select><br />
                </p>

                <p id="courseCombo">
                        <label for="course">Course:</label><br />						
                        <select name="course" id="course" style="width:300px;">
    <option value="">Select Course</option>
                        </select><br />          
                </p>

                <p>
                        <label for="start_date">Subject Name</label><br />
                        <input type="text" name="subject" id="subject" /><br />
                </p>

                <p>
                        <label for="start_date">Start Date</label><br />
                        <input type="text" name="start_date" id="start_date" /><br />
                </p>

                <p>
                        <label for="end_date">End Date</label><br />
                        <input type="text" name="end_date" id="end_date" /><br />
                </p>

                <p><input type="submit" value="Submit" class="formbutton" name="submit" style="margin-left:0px;" /></p>
        </form>
</div>