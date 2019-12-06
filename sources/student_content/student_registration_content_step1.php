<?php
/**
 * School Management System (SMS)
 *
 * @category   Web Application
 * @package    school-management-system
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 */

if(!$_POST || !empty($errors))
{
$id = $_SESSION['uid'];
$studentInfo = selectRow(array(), 'spcl_student_info', "uid='$id'");
?>

<script type="text/javascript">
$(function(){
        $('#issue_date').datepicker();
        $('#expire_date').datepicker();
        $('#visa_issue_date').datepicker();
        $('#visa_expire_date').datepicker();
});
</script>

<div id="signup_form">	
        <h3>Student Registration: <span class="required">(*) Mandatory Field</span></h3>
        <h5>Name: <?php echo $studentInfo->title.' '.$studentInfo->first_name.' '.$studentInfo->last_name; ?></h5>
        <h5>Date of Birth: <?php echo date('M d, Y', strtotime($studentInfo->dob)); ?></h5>
        <h5>Academic Year: <?php echo $studentInfo->academic; ?></h5>
        <h5>Study Session: <?php echo $studentInfo->session; ?></h5>
        <h5>Course Details: <?php echo $studentInfo->course; ?></h5>
        <h5>Course Fees: <?php echo $studentInfo->course_fee.' Pounds'; ?></h5>
        <form action="student_registration.php" name="stud_info_form" method="post">
                <h4>Student Details</h4>
                <?php if(!empty($errors)){ ?><p style="color:#CC0000; font-weight:bold;"><?php echo $errors; ?></p><?php } ?>
                <p>
                        <label for="nationality">Nationality:<span class="required">*</span></label>
                        <input type="text" name="nationality" id="nationality" value="<?php echo @$_POST['nationality']; ?>" /><br />
                </p>

                <p>
                        <label for="marital_status">Marital Status:</label>
                        <select name="marital_status" id="marital_status">
                                <option value="Married." <?php if(@$_POST['marital_status'] == 'Married'){echo "select='select'";} ?>>Married</option>
                                <option value="Unmarried" <?php if(@$_POST['marital_status'] == 'Unmarried'){echo "select='select'";} ?>>Unmarried</option>
                                <option value="Divorced" <?php if(@$_POST['marital_status'] == 'Divorced'){echo "select='select'";} ?>>Divorced</option>
                                <option value="Separated" <?php if(@$_POST['marital_status'] == 'Separated'){echo "select='select'";} ?>>Separated</option>
                        </select>
                </p>

                <p>
                        <label for="passport_no">Passport No:<span class="required">*</span></label>
                        <input type="text" name="passport_no" id="passport_no" value="<?php echo @$_POST['passport_no']; ?>" /><br />
                </p>

                <p>
                        <label for="issue_date">Date of Issue:<span class="required">*</span></label>
                        <input type="text" name="issue_date" id="issue_date" value="<?php echo @$_POST['issue_date']; ?>" />&nbsp;&nbsp;(Date Format : DD-MM-YYYY)<br />
                </p>

                <p>
                        <label for="expire_date">Date of Expire:<span class="required">*</span></label>
                        <input type="text" name="expire_date" id="expire_date" value="<?php echo @$_POST['expire_date']; ?>" />&nbsp;&nbsp;(Date Format : DD-MM-YYYY)<br />
                </p>

                <p>
                        <label for="visa_issue_date">Visa Issue Date:<span class="required">*</span></label>
                        <input type="text" name="visa_issue_date" id="visa_issue_date" value="<?php echo @$_POST['visa_issue_date']; ?>" />&nbsp;&nbsp;(Date Format : DD-MM-YYYY)<br />
                </p>

                <p>
                        <label for="visa_expire_date">Visa Expire Date:<span class="required">*</span></label>
                        <input type="text" name="visa_expire_date" id="visa_expire_date" value="<?php echo @$_POST['visa_expire_date']; ?>" />&nbsp;&nbsp;(Date Format : DD-MM-YYYY)<br />
                </p>

                <br /><br /><h4>Student Address Details</h4>
                <h5>Parmanent Address:</h5>

                <p>
                        <label for="per_address">Address:<span class="required">*</span></label>
                        <textarea name="per_address" id="per_address" style="width: 300px;"><?php echo @$_POST['per_address']; ?></textarea><br />
                </p>

                <p>
                        <label for="per_phone_no">Phone Number:<span class="required">*</span></label>
                        <input type="text" name="per_phone_no" id="per_phone_no" value="<?php echo @$_POST['per_phone_no']; ?>" /><br />
                </p>

                <h5>Mailing / Current Address:</h5>

                <p>
                        <label for="cur_address">Address:<span class="required">*</span></label>
                        <textarea name="cur_address" id="cur_address" style="width: 300px;"><?php echo @$_POST['cur_address']; ?></textarea><br />
                </p>

                <p>
                        <label for="cur_phone_no">Phone Number:<span class="required">*</span></label>
                        <input type="text" name="cur_phone_no" id="cur_phone_no" value="<?php echo @$_POST['cur_phone_no']; ?>" /><br />
                </p>

                <p>
                        <label for="stud_email">Email:<span class="required">*</span></label>
                        <input type="text" name="stud_email" id="stud_email" value="<?php echo @$_POST['stud_email']; ?>" /><br />
                </p>

                <br /><br /><h4>Emergency Contact Details:</h4>

                <p>
                        <label for="contact_person_name">Contact Person Name:<span class="required">*</span></label>
                        <input type="text" name="contact_person_name" id="contact_person_name" value="<?php echo @$_POST['contact_person_name']; ?>" /><br />
                </p>

                <p>
                        <label for="relationship">Relationship with him/her:<span class="required">*</span></label>
                        <input type="text" name="relationship" id="relationship" value="<?php echo @$_POST['relationship']; ?>" /><br />
                </p>

                <br /><br /><h4>Emergency Contact Address:<span class="required">*</span></h4>

                <p>
                        <label for="emer_mobile_no">Mobile No:<span class="required">*</span></label>
                        <input type="text" name="emer_mobile_no" id="emer_mobile_no" value="<?php echo @$_POST['emer_mobile_no']; ?>" /><br />
                </p>

                <p>
                        <label for="emer_land_no">Land Phone No:<span class="required">*</span></label>
                        <input type="text" name="emer_land_no" id="emer_land_no" value="<?php echo @$_POST['emer_land_no']; ?>" /><br />
                </p>

                <p>
                        <label for="emer_email">Email:<span class="required">*</span></label>
                        <input type="text" name="emer_email" id="emer_email" value="<?php echo @$_POST['emer_email']; ?>" /><br />
                </p>

                <br /><br /><h4>Referee:</h4>

                <p>
                        <label for="ref_name">Name:<span class="required">*</span></label>
                        <input type="text" name="ref_name" id="ref_name" value="<?php echo @$_POST['ref_name']; ?>" /><br />
                </p>

                <p>
                        <label for="ref_post">Post:</label>
                        <input type="text" name="ref_post" id="ref_post" value="<?php echo @$_POST['ref_post']; ?>" /><br />
                </p>

                <p>
                        <label for="organization">Organization:</label>
                        <input type="text" name="organization" id="organization" value="<?php echo @$_POST['organization']; ?>" /><br />
                </p>

                <p>
                        <label for="ref_address">Address:<span class="required">*</span></label>
                        <input type="text" name="ref_address" id="ref_address" value="<?php echo @$_POST['ref_address']; ?>" /><br />
                </p>

                <p>
                        <label for="ref_mobile_no">Mobile No:<span class="required">*</span></label>
                        <input type="text" name="ref_mobile_no" id="ref_mobile_no" value="<?php echo @$_POST['ref_mobile_no']; ?>" /><br />
                </p>

                <p>
                        <label for="ref_land_no">Land Phone No:</label>
                        <input type="text" name="ref_land_no" id="ref_land_no" value="<?php echo @$_POST['ref_land_no']; ?>" /><br />
                </p>

                <p>
                        <label for="ref_email">Email:<span class="required">*</span></label>
                        <input type="text" name="ref_email" id="ref_email" value="<?php echo @$_POST['ref_email']; ?>" /><br />
                </p>

                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <p><input type="submit" name="stud_info" class="formbutton" value="Continue" /></p>
        </form>
</div>
<?php } ?>
