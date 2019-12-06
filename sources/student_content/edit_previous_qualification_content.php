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

    // This 'elseif' will work, when Qualification Form will be submitted
    if(isset($_POST['submit']))
    {
            // Form validation
            $errors = '';
            $errors .= validator('year1', 'Year', 'required|trim');
            $errors .= validator('degree1', 'Degree', 'required|trim');
            $errors .= validator('institute1', 'Institute Name', 'required|trim');
            $errors .= validator('grade1', 'Grade', 'required|trim');

            if(empty($errors))
            {
                    $data = array(
                            'year'					=>	$_POST['year1'].':'.$_POST['year2'].':'.$_POST['year3'],
                            'degree'				=>	$_POST['degree1'].':'.$_POST['degree2'].':'.$_POST['degree3'],
                            'institute'				=>	$_POST['institute1'].':'.$_POST['institute2'].':'.$_POST['institute3'],
                            'grade'					=>	$_POST['grade1'].':'.$_POST['grade2'].':'.$_POST['grade3'],
                    );

                    if(update($data, 'spcl_student_registration', "`id` = '".$_POST['id']."' AND `status` = 'current'"))
                    {
                            $success = 'Qualification updated successfully!';
                    }
            }	
    }

    $studentInfo        = selectRow(array('id', 'year', 'degree', 'institute', 'grade'), 'spcl_student_registration', "`uid` = '$uid' AND `status` = 'current'");	
    $year 		= explode(':', $studentInfo->year);
    $degree             = explode(':', $studentInfo->degree);
    $institute          = explode(':', $studentInfo->institute);
    $grade 		= explode(':', $studentInfo->grade);
    ?>

    <div id="signup_form">	
            <h3>Previous Qualification: <span class="required">(*) Mandatory Field</span></h3>
            <?php if(!empty($errors)){ ?><p style="font-weight:bold; color:#CC0000;"><?php echo $errors; ?></p><?php } ?>
            <?php if(!empty($success)){ ?><p style="font-weight:bold; color:#006633;"><?php echo $success; ?></p><?php } ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="stud_qualification" method="post">
                    <table width="100%" border="0" cellpadding="1" cellspacing="2">
  <tr>
    <th scope="col">Year</th>
    <th scope="col">Degree</th>
    <th scope="col">University/College Academic Institute</th>
    <th scope="col">Grade</th>
  </tr>
  <tr align="center" bgcolor="#DFDFFF">
    <td><input style="width: 80px;" type="text" name="year1" id="year1" value="<?php echo @$year[0]; ?>" /><span class="required">*</span></td>
    <td><input style="width: 100px;" type="text" name="degree1" id="degree1" value="<?php echo @$degree[0]; ?>" /><span class="required">*</span></td>
    <td><input style="width: 200px;" type="text" name="institute1" id="institute1" value="<?php echo @$institute[0]; ?>" /><span class="required">*</span></td>
    <td><input style="width: 80px;" type="text" name="grade1" id="grade1" value="<?php echo @$grade[0]; ?>" /><span class="required">*</span></td>
  </tr>
  <tr align="center" bgcolor="#DFDFFF">
    <td><input style="width: 80px;" type="text" name="year2" id="year2" value="<?php echo @$year[1]; ?>" /></td>
    <td><input style="width: 100px;" type="text" name="degree2" id="degree2" value="<?php echo @$degree[1]; ?>" /></td>
    <td><input style="width: 200px;" type="text" name="institute2" id="institute2" value="<?php echo @$institute[1]; ?>" /></td>
    <td><input style="width: 80px;" type="text" name="grade2" id="grade2" value="<?php echo @$grade[1]; ?>" /></td>
  </tr>
  <tr align="center" bgcolor="#DFDFFF">
    <td><input style="width: 80px;" type="text" name="year3" id="year3" value="<?php echo @$year[2]; ?>" /></td>
    <td><input style="width: 100px;" type="text" name="degree3" id="degree3" value="<?php echo @$degree[2]; ?>" /></td>
    <td><input style="width: 200px;" type="text" name="institute3" id="institute3" value="<?php echo @$institute[2]; ?>" /></td>
    <td><input style="width: 80px;" type="text" name="grade3" id="grade3" value="<?php echo @$grade[2]; ?>" /></td>
  </tr>
                      <tr><td bgcolor="#DFDFFF" colspan="4"><br /><input type="hidden" name="id" value="<?php echo $studentInfo->id; ?>" /><input type="submit" name="submit" class="formbutton" value="Update Qualification" /><br /><br /></td></tr>
</table>
            </form>
    </div>
