    <?php
    /**
     * School Management System (SMS)
     *
     * @category   Web Application
     * @package    school-management-system
     * @author     Suman Barua
     * @developer  Suman Barua <sumanbarua576@gmail.com>
     */

    if(!empty($row->step1))//!isset($_POST['qualification']) AND isset($_POST['stud_info']))
    {
    ?>
    <div id="signup_form">	
            <h3>Previous Qualification: <span class="required">(*) Mandatory Field</span></h3>
            <?php if(!empty($errors)){ ?><p style="color:#CC0000; font-weight:bold;"><?php echo $errors; ?></p><?php } ?>
            <form action="student_registration.php" name="stud_qualification" method="post">
                    <table width="100%" border="0" cellpadding="1" cellspacing="2">
  <tr>
    <th scope="col">Year</th>
    <th scope="col">Degree</th>
    <th scope="col">University/College Academic Institute</th>
    <th scope="col">Grade</th>
  </tr>
  <tr align="center" bgcolor="#DFDFFF">
    <td><input style="width: 80px;" type="text" name="year1" id="year1" value="<?php echo @$_POST['year1']; ?>" /><span class="required">*</span></td>
    <td><input style="width: 100px;" type="text" name="degree1" id="degree1" value="<?php echo @$_POST['degree1']; ?>" /><span class="required">*</span></td>
    <td><input style="width: 200px;" type="text" name="institute1" id="institute1" value="<?php echo @$_POST['institute1']; ?>" /><span class="required">*</span></td>
    <td><input style="width: 80px;" type="text" name="grade1" id="grade1" value="<?php echo @$_POST['grade1']; ?>" /><span class="required">*</span></td>
  </tr>
  <tr align="center" bgcolor="#DFDFFF">
    <td><input style="width: 80px;" type="text" name="year2" id="year2" value="<?php echo @$_POST['year2']; ?>" /></td>
    <td><input style="width: 100px;" type="text" name="degree2" id="degree2" value="<?php echo @$_POST['degree2']; ?>" /></td>
    <td><input style="width: 200px;" type="text" name="institute2" id="institute2" value="<?php echo @$_POST['institute2']; ?>" /></td>
    <td><input style="width: 80px;" type="text" name="grade2" id="grade2" value="<?php echo @$_POST['grade2']; ?>" /></td>
  </tr>
  <tr align="center" bgcolor="#DFDFFF">
    <td><input style="width: 80px;" type="text" name="year3" id="year3" value="<?php echo @$_POST['year3']; ?>" /></td>
    <td><input style="width: 100px;" type="text" name="degree3" id="degree3" value="<?php echo @$_POST['degree3']; ?>" /></td>
    <td><input style="width: 200px;" type="text" name="institute3" id="institute3" value="<?php echo @$_POST['institute3']; ?>" /></td>
    <td><input style="width: 80px;" type="text" name="grade3" id="grade3" value="<?php echo @$_POST['grade3']; ?>" /></td>
  </tr>
                      <tr><td bgcolor="#DFDFFF" colspan="4"><br /><input type="hidden" name="id" value="<?php echo $row->id; ?>" /><input type="submit" name="qualification" class="formbutton" value="Continue" /><br /><br /></td></tr>
</table>
            </form>
    </div>
    <?php } ?>
