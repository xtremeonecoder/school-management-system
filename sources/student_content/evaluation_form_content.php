<?php
/**
 * School Management System (SMS)
 *
 * @category   Web Application
 * @package    school-management-system
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 */

// Get Teacher ID
$teacherInfo = selectRow(array(), 'spcl_student_info as T1, spcl_active_evaluation as T2', "T1.awarding_body = T2.awarding_body AND T1.uid = '".$_SESSION['uid']."' AND T2.enable = 1");

if(isset($_POST['submit']))
{
        $errors = '';
        $errors .= validator('question1', 'Question (1)', 'required');
        $errors .= validator('question2', 'Question (2)', 'required');
        $errors .= validator('question3', 'Question (3)', 'required');
        $errors .= validator('question4', 'Question (4)', 'required');
        $errors .= validator('question5', 'Question (5)', 'required');
        $errors .= validator('question6', 'Question (6)', 'required');
        $errors .= validator('question7', 'Question (7)', 'required');
        $errors .= validator('question8', 'Question (8)', 'required');
        $errors .= validator('question9', 'Question (9)', 'required');
        $errors .= validator('question10', 'Question (10)', 'required');

        if(empty($errors))
        {
                $score = $_POST['question1']+$_POST['question2']+$_POST['question3']+$_POST['question4']+$_POST['question5']+$_POST['question6']+$_POST['question7']+$_POST['question8']+$_POST['question9']+$_POST['question10'];				
                $data = array(
                        'teacher_name'	=>	$teacherInfo->teacher_name,
                        'uid'			=>	$_SESSION['uid'],
                        'score'			=>	$score
                );

                if(insert($data, 'spcl_evaluation_score'))
                {
                        @header("Location: home.php");
                }
        }else{
                $errors = 'Please give answer of every question.';
        }
}
?>

<div id="signup_form" style="margin:20px 40px 20px 150px;">	
        <h3>Teacher's Evaluation Form</h3>
        <?php if(!empty($errors)){ ?><p style="font-weight:bold; color:#CC0000;"><?php echo $errors; ?></p><?php } ?>
        <?php if(!empty($success)){ ?><p style="font-weight:bold; color:#006633;"><?php echo $success; ?></p><?php } ?>
        <h5 style="color:#000000;">Teacher's Name : <?php echo $teacherInfo->teacher_name; ?></h5>
        <h5 style="color:#000000;">Course Name : <?php echo $teacherInfo->course; ?></h5>
        <h5 style="color:#000000;">Subject Name : <?php echo $teacherInfo->subject; ?></h5>
        <form method="post" action="evaluation_form.php">
                <p style="float: left; width: 50%;">
                        <label for="question1" style="width:100%; font-weight:bold;">1. Teacher starts his class just on time?</label><br />
                        <input type="radio" name="question1" value="1" /> Rarely<br />
                        <input type="radio" name="question1" value="2" /> Sometimes<br />
                        <input type="radio" name="question1" value="3" /> Most of the time<br />
                        <input type="radio" name="question1" value="4" /> Always<br />
                </p>

                <p style="float: left; width: 50%;">
                        <label for="question2" style="width:100%; font-weight:bold;">2. Teacher speaks clearly in the class?</label><br />
                        <input type="radio" name="question2" value="1" /> Rarely<br />
                        <input type="radio" name="question2" value="2" /> Sometimes<br />
                        <input type="radio" name="question2" value="3" /> Most of the time<br />
                        <input type="radio" name="question2" value="4" /> Always<br />
                </p>

                <p style="float: left; width: 50%;">
                        <label for="question3" style="width:100%; font-weight:bold;">3. Teacher prepared for his class?</label><br />
                        <input type="radio" name="question3" value="1" /> Rarely<br />
                        <input type="radio" name="question3" value="2" /> Sometimes<br />
                        <input type="radio" name="question3" value="3" /> Most of the time<br />
                        <input type="radio" name="question3" value="4" /> Always<br />
                </p>

                <p style="float: left; width: 50%;">
                        <label for="question4" style="width:100%; font-weight:bold;">4. Teacher can explain things clearly?</label><br />
                        <input type="radio" name="question4" value="1" /> Rarely<br />
                        <input type="radio" name="question4" value="2" /> Sometimes<br />
                        <input type="radio" name="question4" value="3" /> Most of the time<br />
                        <input type="radio" name="question4" value="4" /> Always<br />
                </p>

                <p style="float: left; width: 50%;">
                        <label for="question5" style="width:100%; font-weight:bold;">5. Teacher manages students' participation?</label><br />
                        <input type="radio" name="question5" value="1" /> Rarely<br />
                        <input type="radio" name="question5" value="2" /> Sometimes<br />
                        <input type="radio" name="question5" value="3" /> Most of the time<br />
                        <input type="radio" name="question5" value="4" /> Always<br />
                </p>

                <p style="float: left; width: 50%;">
                        <label for="question6" style="width:100%; font-weight:bold;">6. Teacher gives homework to students?</label><br />
                        <input type="radio" name="question6" value="1" /> Rarely<br />
                        <input type="radio" name="question6" value="2" /> Sometimes<br />
                        <input type="radio" name="question6" value="3" /> Most of the time<br />
                        <input type="radio" name="question6" value="4" /> Always<br />
                </p>

                <p style="float: left; width: 50%;">
                        <label for="question7" style="width:100%; font-weight:bold;">7. Teacher takes class test regularly?</label><br />
                        <input type="radio" name="question7" value="1" /> Rarely<br />
                        <input type="radio" name="question7" value="2" /> Sometimes<br />
                        <input type="radio" name="question7" value="3" /> Most of the time<br />
                        <input type="radio" name="question7" value="4" /> Always<br />
                </p>

                <p style="float: left; width: 50%;">
                        <label for="question8" style="width:100%; font-weight:bold;">8. Teacher grades fairly</label><br />
                        <input type="radio" name="question8" value="1" /> Rarely<br />
                        <input type="radio" name="question8" value="2" /> Sometimes<br />
                        <input type="radio" name="question8" value="3" /> Most of the time<br />
                        <input type="radio" name="question8" value="4" /> Always<br />
                </p>

                <p style="float: left; width: 50%;">
                        <label for="question9" style="width:100%; font-weight:bold;">9. Teacher gives the feedback of student query?</label><br />
                        <input type="radio" name="question9" value="1" /> Rarely<br />
                        <input type="radio" name="question9" value="2" /> Sometimes<br />
                        <input type="radio" name="question9" value="3" /> Most of the time<br />
                        <input type="radio" name="question9" value="4" /> Always<br />
                </p>

                <p style="float: left; width: 50%;">
                        <label for="question10" style="width:100%; font-weight:bold;">10. I trust this teacher....</label><br />
                        <input type="radio" name="question10" value="1" /> Rarely<br />
                        <input type="radio" name="question10" value="2" /> Sometimes<br />
                        <input type="radio" name="question10" value="3" /> Most of the time<br />
                        <input type="radio" name="question10" value="4" /> Always<br />
                </p>

                <p><input type="submit" value="Submit" class="formbutton" name="submit" style="margin-left:0px;" /></p>
        </form>
</div>