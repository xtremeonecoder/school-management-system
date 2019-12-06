<?php
/**
 * School Management System (SMS)
 *
 * @category   Web Application
 * @package    school-management-system
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 */

if(isset($_POST['submit']))
{
        $errors = '';
        $errors .= validator('title', 'Exam Schedule Title', 'required|trim');

        if(empty($errors))
        {
                $data = array(
                        'title'		=>	$_POST['title'],
                        'name'		=>	$_FILES['file_name']['name'],
                        'type'		=>	$_FILES['file_name']['type'],
                        'size'		=>	$_FILES['file_name']['size']
                );

                if(insert($data, 'spcl_exam_schedule'))
                {
                        if(uploadFile('../upload_files/exam_schedule', 'file_name'))
                        {
                                $success = 'Exam Schedule Uploaded Successfully! !!';
                        }
                }
        }
}
?>

<div id="signup_form">	
        <h3>Exam Schedule Upload</h3>
        <?php if(!empty($errors)){ ?><p style="font-weight:bold; color:#CC0000;"><?php echo $errors; ?></p><?php } ?>
        <?php if(!empty($success)){ ?><p style="font-weight:bold; color:#006633;"><?php echo $success; ?></p><?php } ?>
        <form method="post" action="add_exam_schedule.php" enctype="multipart/form-data">
                <p>
                        <label for="title">Exam Schedule Title</label><br />
                        <input type="text" value="" id="title" name="title" /><br />
                </p>

                <p>
                        <label for="file_name">Upload Exam Schedule</label><br />
                        <input type="file" name="file_name"><br />
                </p>

                <p><input type="submit" value="Upload File" class="formbutton" name="submit" /></p>
        </form>
</div>