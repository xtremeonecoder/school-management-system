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

if(isset($_POST['submit']))
{
        // Form validation
        $errors = '';
        $errors .= validator('nationality', 'Nationality', 'required|trim|ucwords');
        $errors .= validator('passport_no', 'Passport No', 'required|trim');
        $errors .= validator('issue_date', 'Issue Date', 'required|trim');
        $errors .= validator('expire_date', 'Expire Date', 'required|trim');
        $errors .= validator('visa_issue_date', 'Visa Issue Date', 'required|trim');
        $errors .= validator('visa_expire_date', 'Visa Expire Date', 'required|trim');
        $errors .= validator('per_address', 'Permanent Address', 'required|trim');
        $errors .= validator('per_phone_no', 'Permanent Phone No', 'required|trim');
        $errors .= validator('cur_address', 'Current Address', 'required|trim');
        $errors .= validator('cur_phone_no', 'Current Phone No', 'required|trim');
        $errors .= validator('stud_email', 'Student Email', 'required|trim');
        $errors .= validator('contact_person_name', 'Contact Person Name', 'required|trim|ucwords');
        $errors .= validator('relationship', 'Relationship', 'required|trim|ucwords');
        $errors .= validator('emer_mobile_no', 'Emergency Mobile No', 'required|trim');
        $errors .= validator('emer_land_no', 'Emergency Land No', 'required|trim');
        $errors .= validator('emer_email', 'Emergency Email', 'required|trim');
        $errors .= validator('ref_name', 'Referee Name', 'required|trim|ucwords');
        $errors .= validator('ref_address', 'Referee Address', 'required|trim');
        $errors .= validator('ref_mobile_no', 'Referee Mobile No', 'required|trim');
        $errors .= validator('ref_email', 'Referee Email', 'required|trim');

        if(empty($errors))
        {
                $data = array(
                        'uid'				=>	$_SESSION['uid'],
                        'nationality'			=>	$_POST['nationality'],
                        'marital_status'		=>	$_POST['marital_status'],
                        'passport_no'			=>	$_POST['passport_no'],
                        'issue_date'			=>	$_POST['issue_date'],
                        'expire_date'			=>	$_POST['expire_date'],
                        'visa_issue_date'		=>	$_POST['visa_issue_date'],
                        'visa_expire_date'		=>	$_POST['visa_expire_date'],
                        'per_address'			=>	$_POST['per_address'],
                        'per_phone_no'			=>	$_POST['per_phone_no'],
                        'cur_address'			=>	$_POST['cur_address'],
                        'cur_phone_no'			=>	$_POST['cur_phone_no'],
                        'stud_email'			=>	$_POST['stud_email'],
                        'contact_person_name'           =>	$_POST['contact_person_name'],
                        'relationship'			=>	$_POST['relationship'],
                        'emer_mobile_no'		=>	$_POST['emer_mobile_no'],
                        'emer_land_no'			=>	$_POST['emer_land_no'],
                        'emer_email'			=>	$_POST['emer_email'],
                        'ref_name'			=>	$_POST['ref_name'],
                        'ref_post'			=>	$_POST['ref_post'],
                        'organization'			=>	$_POST['organization'],
                        'ref_address'			=>	$_POST['ref_address'],
                        'ref_mobile_no'			=>	$_POST['ref_mobile_no'],
                        'ref_land_no'			=>	$_POST['ref_land_no'],
                        'ref_email'			=>	$_POST['ref_email'],
                );	

                if(update($data, 'spcl_student_registration', "`uid` = '$uid' AND `status` = 'current'"))
                {
                        $success = 'Information updated successfully!';
                }
        }
}

$studentInfo = selectRow(array(), 'spcl_student_info as T1, spcl_student_registration as T2', "T1.uid = T2.uid AND T1.uid = '$uid' AND T2.status = 'current'");
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
        <?php if(!empty($errors)){ ?><p style="font-weight:bold; color:#CC0000;"><?php echo $errors; ?></p><?php } ?>
        <?php if(!empty($success)){ ?><p style="font-weight:bold; color:#006633;"><?php echo $success; ?></p><?php } ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="stud_info_form" method="post">
                <h4>Student Details</h4>
                <p>
                        <label for="nationality">Nationality:<span class="required">*</span></label>
                        <input type="text" name="nationality" id="nationality" value="<?php echo @$studentInfo->nationality; ?>" /><br />
                </p>

                <p>
                        <label for="marital_status">Marital Status:</label>
                        <select name="marital_status" id="marital_status">
                                <option value="Married." <?php if(@$studentInfo->marital_status == 'Married'){echo "select='select'";} ?>>Married</option>
                                <option value="Unmarried" <?php if(@$studentInfo->marital_status == 'Unmarried'){echo "select='select'";} ?>>Unmarried</option>
                                <option value="Divorced" <?php if(@$studentInfo->marital_status == 'Divorced'){echo "select='select'";} ?>>Divorced</option>
                                <option value="Separated" <?php if(@$studentInfo->marital_status == 'Separated'){echo "select='select'";} ?>>Separated</option>
                        </select>
                </p>

                <p>
                        <label for="passport_no">Passport No:<span class="required">*</span></label>
                        <input type="text" name="passport_no" id="passport_no" value="<?php echo @$studentInfo->passport_no; ?>" /><br />
                </p>

                <p>
                        <label for="issue_date">Date of Issue:<span class="required">*</span></label>
                        <input type="text" name="issue_date" id="issue_date" value="<?php echo @$studentInfo->issue_date; ?>" />&nbsp;&nbsp;(Date Format : DD-MM-YYYY)<br />
                </p>

                <p>
                        <label for="expire_date">Date of Expire:<span class="required">*</span></label>
                        <input type="text" name="expire_date" id="expire_date" value="<?php echo @$studentInfo->expire_date; ?>" />&nbsp;&nbsp;(Date Format : DD-MM-YYYY)<br />
                </p>

                <p>
                        <label for="visa_issue_date">Visa Issue Date:<span class="required">*</span></label>
                        <input type="text" name="visa_issue_date" id="visa_issue_date" value="<?php echo @$studentInfo->visa_issue_date; ?>" />&nbsp;&nbsp;(Date Format : DD-MM-YYYY)<br />
                </p>

                <p>
                        <label for="visa_expire_date">Visa Expire Date:<span class="required">*</span></label>
                        <input type="text" name="visa_expire_date" id="visa_expire_date" value="<?php echo @$studentInfo->visa_expire_date; ?>" />&nbsp;&nbsp;(Date Format : DD-MM-YYYY)<br />
                </p>

                <br /><br /><h4>Student Address Details</h4>
                <h5>Parmanent Address:</h5>

                <p>
                        <label for="per_address">Address:<span class="required">*</span></label>
                        <textarea name="per_address" id="per_address" style="width: 300px;"><?php echo @$studentInfo->per_address; ?></textarea><br />
                </p>

                <p>
                        <label for="per_phone_no">Phone Number:<span class="required">*</span></label>
                        <input type="text" name="per_phone_no" id="per_phone_no" value="<?php echo @$studentInfo->per_phone_no; ?>" /><br />
                </p>

                <h5>Mailing / Current Address:</h5>

                <p>
                        <label for="cur_address">Address:<span class="required">*</span></label>
                        <textarea name="cur_address" id="cur_address" style="width: 300px;"><?php echo @$studentInfo->cur_address; ?></textarea><br />
                </p>

                <p>
                        <label for="cur_phone_no">Phone Number:<span class="required">*</span></label>
                        <input type="text" name="cur_phone_no" id="cur_phone_no" value="<?php echo @$studentInfo->cur_phone_no; ?>" /><br />
                </p>

                <p>
                        <label for="stud_email">Email:<span class="required">*</span></label>
                        <input type="text" name="stud_email" id="stud_email" value="<?php echo @$studentInfo->stud_email; ?>" /><br />
                </p>

                <br /><br /><h4>Emergency Contact Details:</h4>

                <p>
                        <label for="contact_person_name">Contact Person Name:<span class="required">*</span></label>
                        <input type="text" name="contact_person_name" id="contact_person_name" value="<?php echo @$studentInfo->contact_person_name; ?>" /><br />
                </p>

                <p>
                        <label for="relationship">Relationship with him/her:<span class="required">*</span></label>
                        <input type="text" name="relationship" id="relationship" value="<?php echo @$studentInfo->relationship; ?>" /><br />
                </p>

                <br /><br /><h4>Emergency Contact Address:<span class="required">*</span></h4>

                <p>
                        <label for="emer_mobile_no">Mobile No:<span class="required">*</span></label>
                        <input type="text" name="emer_mobile_no" id="emer_mobile_no" value="<?php echo @$studentInfo->emer_mobile_no; ?>" /><br />
                </p>

                <p>
                        <label for="emer_land_no">Land Phone No:<span class="required">*</span></label>
                        <input type="text" name="emer_land_no" id="emer_land_no" value="<?php echo @$studentInfo->emer_land_no; ?>" /><br />
                </p>

                <p>
                        <label for="emer_email">Email:<span class="required">*</span></label>
                        <input type="text" name="emer_email" id="emer_email" value="<?php echo @$studentInfo->emer_email; ?>" /><br />
                </p>

                <br /><br /><h4>Referee:</h4>

                <p>
                        <label for="ref_name">Name:<span class="required">*</span></label>
                        <input type="text" name="ref_name" id="ref_name" value="<?php echo @$studentInfo->ref_name; ?>" /><br />
                </p>

                <p>
                        <label for="ref_post">Post:</label>
                        <input type="text" name="ref_post" id="ref_post" value="<?php echo @$studentInfo->ref_post; ?>" /><br />
                </p>

                <p>
                        <label for="organization">Organization:</label>
                        <input type="text" name="organization" id="organization" value="<?php echo @$studentInfo->organization; ?>" /><br />
                </p>

                <p>
                        <label for="ref_address">Address:<span class="required">*</span></label>
                        <input type="text" name="ref_address" id="ref_address" value="<?php echo @$studentInfo->ref_address; ?>" /><br />
                </p>

                <p>
                        <label for="ref_mobile_no">Mobile No:<span class="required">*</span></label>
                        <input type="text" name="ref_mobile_no" id="ref_mobile_no" value="<?php echo @$studentInfo->ref_mobile_no; ?>" /><br />
                </p>

                <p>
                        <label for="ref_land_no">Land Phone No:</label>
                        <input type="text" name="ref_land_no" id="ref_land_no" value="<?php echo @$studentInfo->ref_land_no; ?>" /><br />
                </p>

                <p>
                        <label for="ref_email">Email:<span class="required">*</span></label>
                        <input type="text" name="ref_email" id="ref_email" value="<?php echo @$studentInfo->ref_email; ?>" /><br />
                </p>

                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <p><input type="submit" name="submit" class="formbutton" value="Update Information" /></p>
        </form>
</div>
