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
    // when 'Change of Address' check box is checked then this event will trigger
    $('#choice1').click(function(){
        $('#address_section').toggle(this.checked);
        $('#submit_button').toggle(this.checked);
        $('#varification_section').toggle(this.checked);
    });

    // when 'Change of Contact Number' check box is checked then this event will trigger
    $('#choice2').click(function(){
        $('#number_section').toggle(this.checked);
        $('#submit_button').toggle(this.checked);
        $('#varification_section').toggle(this.checked);
    });

    // when 'Change of Email Address' check box is checked then this event will trigger
    $('#choice3').click(function(){
        $('#email_section').toggle(this.checked);
        $('#submit_button').toggle(this.checked);
        $('#varification_section').toggle(this.checked);
    });
});
</script>

<?php
if(isset($_POST['submit']))
{
        $errors = '';
        // Check for validation
        $errors .= validator('cur_address', 'Current Address', 'required|trim');
        $errors .= validator('cur_phone_no', 'Contact Number', 'required|trim');
        $errors .= validator('stud_email', 'Email Address', 'required|trim|valid_email');
        $errors .= validator('varification', 'Varification', 'required');

        if(empty($errors))
        {
                $data = array(
                        'cur_address'	=>	$_POST['cur_address'],
                        'cur_phone_no'	=>	$_POST['cur_phone_no'],
                        'stud_email'	=>	$_POST['stud_email']
                );

                // Update your new data
                if(update($data, 'spcl_student_registration', "uid = '".$_SESSION['uid']."' AND status = 'current'"))
                {
                        $letter_type = '';
                        $content = '';
                        // when 'Current Address' will be checked
                        if(!empty($_POST['choice1']))
                        {
                                $letter_type	.=	(!empty($_POST['choice2']) OR !empty($_POST['choice3'])) ? 'Address, ' : 'Address';
                                $content	.=	(!empty($_POST['choice2']) OR !empty($_POST['choice3'])) ? $_POST['cur_address'].'|||' : $_POST['cur_address'];
                        }
                        // when 'Contact Number' will be checked
                        if(!empty($_POST['choice2']))
                        {
                                $letter_type	.=	(!empty($_POST['choice3'])) ? 'Contact Number, ' : 'Contact Number';
                                $content	.=	(!empty($_POST['choice3'])) ? $_POST['cur_phone_no'].'|||' : $_POST['cur_phone_no'];
                        }
                        // when 'Email Address' will be checked
                        if(!empty($_POST['choice3']))
                        {
                                $letter_type	.=	'Email';
                                $content	.=	$_POST['stud_email'];
                        }

                        $ccData = array(
                                'uid'		=>	$_SESSION['uid'],
                                'request_type'	=>	'Change Circumstances',
                                'letter_type'	=>	$letter_type,
                                'content'	=>	$content
                        );
                        if(insert($ccData, 'spcl_student_request'))
                        {
                                $success = 'Your Request Has Been Sent Successfully! !!';
                        }else{
                                $errors = 'Sorry, failed to send data! !!';
                        }	
                }
        }
}
// Fetch the current information...
$result = selectRow(array('cur_address','cur_phone_no','stud_email'), 'spcl_student_registration', "uid = '".$_SESSION['uid']."' AND status = 'current'");
?>

<div>	
        <h3>Change Circumstances</h3>
        <?php if(!empty($errors)){ ?><p style="color:#CC0000; font-weight:bold;"><?php echo $errors; ?></p><?php } ?>
        <?php if(!empty($success)){ ?><p style="color:#006633; font-weight:bold;"><?php echo $success; ?></p><?php } ?>
        <form name="change_circumstances" id="change_circumstances" method="post" action="change_circumstances.php">
                <p>
                        <label style="width:200px;"><input type="checkbox" name="choice1" id="choice1" value="choice1" /> Change of Address</label>						
                </p>
                <br />
                <p>
                        <label style="width:200px;"><input type="checkbox" name="choice2" id="choice2" value="choice2" /> Change of Contact Number</label>						
                </p>
                <br />
                <p>
                        <label style="width:200px;"><input type="checkbox" name="choice3" id="choice3" value="choice3" /> Change of Email Address</label>						
                </p>

                <br /><br />
                <p id="address_section" style="display:none;">
                        <label>Current Address : <textarea name="cur_address" id="cur_address" style="width:360px; height:100px;"><?php echo $result->cur_address; ?></textarea></label>
                </p>

                <br /><div style="clear:both;"></div>

                <p id="number_section" style="display:none;">
                        <label>Contact Number : <input type="text" name="cur_phone_no" id="cur_phone_no" style="width:360px;" value="<?php echo $result->cur_phone_no; ?>" /></label>
                </p>

                <br /><div style="clear:both;"></div>

                <p id="email_section" style="display:none;">
                        <label>Email Address : <input type="text" name="stud_email" id="stud_email" style="width:360px;" value="<?php echo $result->stud_email; ?>" /></label>
                </p>

                <br /><div style="clear:both;"></div><br />

                <p id="varification_section" style="display:none;">
                        <label style="width:200px;"><input type="checkbox" name="varification" id="varification" value="varification" /> The above information is true.</label>
                </p>

                <br /><div style="clear:both;"></div><br />

                <p id="submit_button" style="display:none;">	
                        <input type="submit" name="submit" id="submit" value="Submit" class="formbutton" />
                </p>	
        </form>
</div>