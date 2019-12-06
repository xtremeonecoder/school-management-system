<?php
/**
 * School Management System (SMS)
 *
 * @category   Web Application
 * @package    school-management-system
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 */
?>

<script type="text/javascript">
$(document).ready(function(){
   // Event function for awarding body wise 'course combo box' loading.
   $('#awarding_body').change(function(){
           var awarding_body = $(this).val();
           if(awarding_body == 'ACP')
           {
                   // This combo box will load when awarding body is 'ACP'
                   var comboBox = "<label for='course'>Select Course*</label>" +
                                                  "<select name='course' id='course' style='width:300px;'>" +
                                                        "<option value=''>Select Course</option>" +
                                                        "<option value='ACP Diploma in Information System Analysis & Design'>ACP Diploma in Information System Analysis & Design</option>" +
                                                        "<option value='ACP Advanced Diploma in Computing Science'>ACP Advanced Diploma in Computing Science</option>" +
                                                  "</select>";
           }else if(awarding_body == 'ABP')
           {
                   // This combo box will load when awarding body is 'ABP'
                   var comboBox = "<label for='course'>Select Course*</label>" +
                                                  "<select name='course' id='course' style='width:300px;'>" +
                                                        "<option value=''>Select Course</option>" +
                                                        "<option value='Postgraduate Diploma in Information Systems'>Postgraduate Diploma in Information Systems</option>" +
                                                  "</select>";
           }else if(awarding_body == 'ACCA')
           {
                   // This combo box will load when awarding body is 'ACCA'
                   var comboBox = "<label for='course'>Select Course*</label>" +
                                                  "<select name='course' id='course' style='width:300px;'>" +
                                                        "<option value=''>Select Course</option>" +
                                                        "<option value='ACCA (Association of Chartered Certified Accountant)'>ACCA (Association of Chartered Certified Accountant)</option>" +                                               
                                                  "</select>";
           }else if(awarding_body == 'ABE')
           {
                   // This combo box will load when awarding body is 'ABE'
                   var comboBox = "<label for='course'>Select Course*</label>" +
                                                  "<select name='course' id='course' style='width:300px;'>" +
                                                         "<option value=''>Select Course</option>" +
                                                         "<option value='Diploma in Business Management'>Diploma in Business Management</option>" +
                                                         "<option value='Advance Diploma in Business Management'>Advance Diploma in Business Management</option>" +
                                                  "</select>";
           }else if(awarding_body == 'OTHM')
           {
                   // This combo box will load when awarding body is 'OTHM'
                   var comboBox = "<label for='course'>Select Course*</label>" +
                                                  "<select name='course' id='course' style='width:300px;'>" +
                                                         "<option value=''>Select Course</option>" +
                                                         "<option value='Professional Certificate in Hospitality Management'>Professional Certificate in Hospitality Management</option>" +
                                                         "<option value='Professional Diploma in Hospitality Management'>Professional Diploma in Hospitality Management</option>" +
                                                         "<option value='Professional Higher Diploma in Hospitality Management'>Professional Higher Diploma in Hospitality Management</option>" +
                                                         "<option value='Post Graduate Diploma in Hospitality Management'>Post Graduate Diploma in Hospitality Management</option>" +
                                                  "</select>";
           }
           $('#courseCombo').html(comboBox);
   });
});

//Ajax call for getting search result
function getCustomSearchResult(obj)
{
        var formData = $(obj).serialize();
        $.ajax({
                type: "POST",
                url: "../sources/ajax_request/getCustomSearchResult.php",
                data: formData,
                dataType: "html",
                success: function(response){
                        $('#searchResult').css('display', 'block').html(response).show('slow');
                },
        });
}			
</script>
<div>	
        <h3>Query Builder (Group of Student)</h3>
        <form method="post" action="custom_student_search.php">
                <p>
                        <label for="academic">Select Academic Year*</label>						
                        <select name="academic" id="academic" style="width:300px;">
                                <option value="">Select Academic Year</option>
                                <?php for($year=date('Y'); $year<=2050; $year++){ ?>
                                        <option value="<?php echo $year; ?>" <?php if(@$_POST['session'] == $year){echo "select='select'";} ?>><?php echo $year; ?></option>
                                <?php } ?>
                        </select>
                </p>

                <p>
                        <label for="session">Select Session*</label>
                        <select name="session" id="session" style="width:300px;">
    <option value="">Select Study Session</option>
                                <option value="January" <?php if(@$_POST['session'] == 'January'){echo "selected='selected'";} ?>>January</option>
                                <option value="March" <?php if(@$_POST['session'] == 'March'){echo "selected='selected'";} ?>>March</option>
                                <option value="June" <?php if(@$_POST['session'] == 'June'){echo "selected='selected'";} ?>>June</option>
                                <option value="September" <?php if(@$_POST['session'] == 'September'){echo "selected='selected'";} ?>>September</option>
                        </select>
                </p>

                <p>
                        <label for="awarding_body">Select Awarding Body*</label>						
                        <select name="awarding_body" id="awarding_body" style="width:300px;">
    <option value="">Select Awarding Body</option>
                                <option value="ACP" <?php if(@$_POST['awarding_body'] == 'ACP'){echo "selected='selected'";} ?>>ACP</option>
                                <option value="ABP" <?php if(@$_POST['awarding_body'] == 'ABP'){echo "selected='selected'";} ?>>ABP</option>
                                <option value="ACCA" <?php if(@$_POST['awarding_body'] == 'ACCA'){echo "selected='selected'";} ?>>ACCA</option>
                                <option value="ABE" <?php if(@$_POST['awarding_body'] == 'ABE'){echo "selected='selected'";} ?>>ABE</option>
    <option value="OTHM" <?php if(@$_POST['awarding_body'] == 'OTHM'){echo "selected='selected'";} ?>>OTHM</option>
                        </select>
                </p>

                <p id="courseCombo">
                        <label for="course">Select Course*</label>						
                        <select name="course" id="course" style="width:300px;">
    <option value="">Select Course</option>
                        </select>          
                </p>

                <p id="levelCombo">
                        <label for="level">Select Level*</label>
                        <select name="level" id="level" style="width:300px;">
    <option value="">Select Course Level</option>  
                                <?php for($level=1; $level<=10; $level++){ ?>
                                        <option value="<?php echo "Level-$level"; ?>"><?php echo "Level-$level"; ?></option>
                                <?php } ?>
                        </select>
                </p>

                <p>
                        <label style="width:200px;"><input type="checkbox" name="dob" value="yes" /> Date of Birth</label>
                        <label style="width:200px;"><input type="checkbox" name="dob" value="yes" /> Passport Number</label>
                        <label style="width:200px;"><input type="checkbox" name="dob" value="yes" /> Email</label><br />
                        <label style="width:200px;"><input type="checkbox" name="dob" value="yes" /> Phone Number</label>
                        <label style="width:200px;"><input type="checkbox" name="dob" value="yes" /> Mailing/Current Address</label>
                        <label style="width:200px;"><input type="checkbox" name="dob" value="yes" /> Permanent Address</label><br />
                        <label style="width:200px;"><input type="checkbox" name="dob" value="yes" /> Sex</label>
                        <label style="width:200px;"><input type="checkbox" name="dob" value="yes" /> Emergency Contact Details</label>
                        <label style="width:200px;"><input type="checkbox" name="dob" value="yes" /> Referee Details</label>
                </p>
                <br />
                <p><input type="button" value="Search Student" class="formbutton" onClick="getCustomSearchResult(this.form)" name="submit" style="margin-left:0px;" /></p>
        </form>

        <br />

        <div id="searchResult"></div>
        <br />
</div>