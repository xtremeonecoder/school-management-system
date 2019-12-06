<?php
/**
 * School Management System (SMS)
 *
 * @category   Web Application
 * @package    school-management-system
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 */

$id = $_GET['id'];
$studentInfo = selectRow(array(), 'spcl_student_info as T1, spcl_student_registration as T2', "T1.uid = T2.uid AND T1.uid = '$id' AND T2.status = 'current'");
?>
<div id="signup_form">	
        <h3>Summarize Information:</h3>
        <h5>Name: <?php echo $studentInfo->title.' '.$studentInfo->first_name.' '.$studentInfo->last_name; ?></h5>
        <h5>Date of Birth: <?php echo date('M d, Y', strtotime($studentInfo->dob)); ?></h5>
        <h5>Academic Year &nbsp; Session: <?php echo $studentInfo->academic.' / '.$studentInfo->session; ?></h5>
        <h5>Course Details: <?php echo $studentInfo->course; ?></h5>
        <h5>Course Fees: <?php echo $studentInfo->course_fee.' Pounds'; ?></h5>

        <h4>Student Details</h4>
        <?php if(!empty($studentInfo->nationality)){ ?>
        <p>
                <label for="nationality">Nationality:</label>
                <?php echo $studentInfo->nationality; ?>
        </p>
        <?php }if(!empty($studentInfo->marital_status)){ ?>
        <p>
                <label for="marital_status">Marital Status:</label>
                <?php echo $studentInfo->marital_status; ?>
        </p>
        <?php }if(!empty($studentInfo->passport_no)){ ?>
        <p>
                <label for="passport_no">Passport No:</label>
                <?php echo $studentInfo->passport_no; ?>
        </p>
        <?php }if(!empty($studentInfo->issue_date)){ ?>
        <p>
                <label for="issue_date">Date of Issue:</label>
                <?php echo $studentInfo->issue_date; ?>
        </p>
        <?php }if(!empty($studentInfo->expire_date)){ ?>
        <p>
                <label for="expire_date">Date of Expire:</label>
                <?php echo $studentInfo->expire_date; ?>
        </p>
        <?php }if(!empty($studentInfo->visa_issue_date)){ ?>
        <p>
                <label for="visa_issue_date">Visa Issue Date:</label>
                <?php echo $studentInfo->visa_issue_date; ?>
        </p>
        <?php }if(!empty($studentInfo->visa_expire_date)){ ?>
        <p>
                <label for="visa_expire_date">Visa Expire Date:</label>
                <?php echo $studentInfo->visa_expire_date; ?>
        </p>
        <?php } ?>
        <h4>Student Address Details</h4>
        <h5>Parmanent Address:</h5>
        <?php if(!empty($studentInfo->per_address)){ ?>
        <p>
                <label for="per_address">Address:</label>
                <?php echo $studentInfo->per_address; ?>
        </p>
        <?php }if(!empty($studentInfo->per_phone_no)){ ?>
        <p>
                <label for="per_phone_no">Phone Number:</label>
                <?php echo $studentInfo->per_phone_no; ?>
        </p>
        <?php } ?>
        <h5>Mailing / Current Address:</h5>
        <?php if(!empty($studentInfo->cur_address)){ ?>
        <p>
                <label for="cur_address">Address:</label>
                <?php echo $studentInfo->cur_address; ?>
        </p>
        <?php }if(!empty($studentInfo->cur_phone_no)){ ?>
        <p>
                <label for="cur_phone_no">Phone Number:</label>
                <?php echo $studentInfo->cur_phone_no; ?>
        </p>
        <?php }if(!empty($studentInfo->stud_email)){ ?>
        <p>
                <label for="stud_email">Email:</label>
                <?php echo $studentInfo->stud_email; ?>
        </p>
        <?php } ?>
        <h4>Emergency Contact Details:</h4>
        <?php if(!empty($studentInfo->contact_person_name)){ ?>
        <p>
                <label for="contact_person_name">Contact Person Name:</label>
                <?php echo $studentInfo->contact_person_name; ?>
        </p>
        <?php }if(!empty($studentInfo->relationship)){ ?>
        <p>
                <label for="relationship">Relationship with him/her:</label>
                <?php echo $studentInfo->relationship; ?>
        </p>
        <?php } ?>
        <h4>Emergency Contact Address:</h4>
        <?php if(!empty($studentInfo->emer_mobile_no)){ ?>
        <p>
                <label for="emer_mobile_no">Mobile No:</label>
                <?php echo $studentInfo->emer_mobile_no; ?>
        </p>
        <?php }if(!empty($studentInfo->emer_land_no)){ ?>
        <p>
                <label for="emer_land_no">Land Phone No:</label>
                <?php echo $studentInfo->emer_land_no; ?>
        </p>
        <?php }if(!empty($studentInfo->emer_email)){ ?>
        <p>
                <label for="emer_email">Email:</label>
                <?php echo $studentInfo->emer_email; ?>
        </p>
        <?php } ?>
        <h4>Referee:</h4>
        <?php if(!empty($studentInfo->ref_name)){ ?>
        <p>
                <label for="ref_name">Name:</label>
                <?php echo $studentInfo->ref_name; ?>
        </p>
        <?php }if(!empty($studentInfo->ref_post)){ ?>
        <p>
                <label for="ref_post">Post:</label>
                <?php echo $studentInfo->ref_post; ?>
        </p>
        <?php }if(!empty($studentInfo->organization)){ ?>
        <p>
                <label for="organization">Organization:</label>
                <?php echo $studentInfo->organization; ?>
        </p>
        <?php }if(!empty($studentInfo->ref_address)){ ?>
        <p>
                <label for="ref_address">Address:</label>
                <?php echo $studentInfo->ref_address; ?>
        </p>
        <?php }if(!empty($studentInfo->ref_mobile_no)){ ?>
        <p>
                <label for="ref_mobile_no">Mobile No:</label>
                <?php echo $studentInfo->ref_mobile_no; ?>
        </p>
        <?php }if(!empty($studentInfo->ref_land_no)){ ?>
        <p>
                <label for="ref_land_no">Land Phone No:</label>
                <?php echo $studentInfo->ref_land_no; ?>
        </p>
        <?php }if(!empty($studentInfo->ref_email)){ ?>
        <p>
                <label for="ref_email">Email:</label>
                <?php echo $studentInfo->ref_email; ?>
        </p>
        <?php }if(!empty($studentInfo->account_clearance_code)){ ?>
        <p>
                <label for="account_clearance_code">Account Clearance Code:</label>
                <?php echo $studentInfo->account_clearance_code; ?>
        </p>
        <?php } ?>

        <?php
        $year 		= explode(':', $studentInfo->year);
        $degree 	= explode(':', $studentInfo->degree);
        $institute 	= explode(':', $studentInfo->institute);
        $grade 		= explode(':', $studentInfo->grade);
        ?>	
        <table width="100%" border="0" cellpadding="1" cellspacing="2">
          <tr>
                <th scope="col">Year</th>
                <th scope="col">Degree</th>
                <th scope="col">University/College Academic Institute </th>
                <th scope="col">Grade</th>
          </tr>
          <?php if(!empty($year[0]) AND !empty($degree[0]) AND !empty($institute[0]) AND !empty($grade[0])){ ?>
          <tr bgcolor="#DFDFFF">
                <td><?php echo $year[0]; ?></td>
                <td><?php echo $degree[0]; ?></td>
                <td><?php echo $institute[0]; ?></td>
                <td><?php echo $grade[0]; ?></td>
          </tr>
          <?php }if(!empty($year[1]) AND !empty($degree[1]) AND !empty($institute[1]) AND !empty($grade[1])){ ?>
          <tr bgcolor="#DFDFFF">
                <td><?php echo $year[1]; ?></td>
                <td><?php echo $degree[1]; ?></td>
                <td><?php echo $institute[1]; ?></td>
                <td><?php echo $grade[1]; ?></td>
          </tr>
          <?php }if(!empty($year[2]) AND !empty($degree[2]) AND !empty($institute[2]) AND !empty($grade[2])){ ?>
          <tr bgcolor="#DFDFFF">
                <td><?php echo $year[2]; ?></td>
                <td><?php echo $degree[2]; ?></td>
                <td><?php echo $institute[2]; ?></td>
                <td><?php echo $grade[2]; ?></td>
          </tr>
          <?php } ?>
        </table>
</div>
<form action="student_registration.php" name="final_submission" method="post">
        <br />
        <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
        <p><input type="submit" name="complete" class="formbutton" value="Save and Exit" /></p>
</form>

