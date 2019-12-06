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
        // When 'NI Letter' checkbox is checked this javascript event will trigger
        $('#ni').click(function() {
                $("#ni_content").toggle(this.checked);
        });

        // When 'Bank Letter' checkbox is checked this javascript event will trigger
        $('#bank').click(function() {
                $("#bank_name").toggle(this.checked);
        });

        // When 'Holiday Letter' checkbox is checked this javascript event will trigger
        $('#holiday').click(function() {
                $("#holiday_type").toggle(this.checked);
        });

        // When 'Holiday Letter' checkbox is checked this javascript event will trigger
        $('#tax').click(function() {
                $("#tax_content").toggle(this.checked);
        });

        // When 'Holiday Letter' checkbox is checked this javascript event will trigger
        $('#invite').click(function() {
                $("#invite_content").toggle(this.checked);
        });

        // When 'Others Letter' checkbox is checked this javascript event will trigger
        $('#others').click(function() {
                $("#others_letter").toggle(this.checked);
        });

        $('#bank_name').focus(function(){
                if($(this).val() == 'Please write the bank name')
                {
                        $(this).val('');
                }
        });

        $('#bank_name').blur(function(){
                if($(this).val() == '')
                {
                        $(this).val('Please write the bank name');
                }
        });

        $('#agree').click(function(){
                $('#successDiv').hide('slow');
                $('#thanks').show('slow');
        });
});
</script>
<div>	
        <h3>Request for Letter</h3>
        <?php
        if(isset($_POST['submit']))
        {
                $errors = '';
                // this 'if' works when 'Bank Letter' checkbox is checked
                if(!empty($_POST['bank']))
                {
                        if($_POST['bank_name'] != 'Please write the bank name')
                        {
                                $errors .= validator('bank_name', 'Bank Name', 'required|trim|ucwords');
                        }else{
                                $errors .= 'Please give appropriate bank name! !!<br />';
                        }
                }
                // this 'if' works when 'Holiday Letter' checkbox is checked
                if(!empty($_POST['holiday']))
                {
                        $errors .= validator('holiday_type', 'Holiday Type', 'required');
                }
                // this 'if' works when 'Others Letter' checkbox is checked
                if(!empty($_POST['others']))
                {
                        if($_POST['others_letter'] != 'Please write your letter here')
                        {
                                $errors .= validator('others_letter', 'Others Letter', 'required');
                        }else{
                                $errors .= 'Please write your letter in the box! !!<br />';
                        }
                }

                if(empty($errors))
                {
                        $success = '';
                        $letter_type = '';
                        $content = '';
                        // this 'if' works when 'Enrolment Letter' checkbox is checked
                        if(!empty($_POST['enrolment']))
                        {
                                $letter_type .=	(!empty($_POST['ni']) OR !empty($_POST['bank']) OR !empty($_POST['gp']) OR !empty($_POST['holiday']) OR !empty($_POST['tax']) OR !empty($_POST['invite']) OR !empty($_POST['others'])) ? 'Enrolment, ' : 'Enrolment';
                                $success .= 'For Enrolement Letter please allow us Two(2) working days.<br/ >';
                        }
                        // this 'if' works when 'NI Letter' checkbox is checked
                        if(!empty($_POST['ni']))
                        {
                                $letter_type .=	(!empty($_POST['bank']) OR !empty($_POST['gp']) OR !empty($_POST['holiday']) OR !empty($_POST['tax']) OR !empty($_POST['invite']) OR !empty($_POST['others'])) ? 'NI, ' : 'NI';
                                $success .= 'For NI Letter please allow us Two(2) working days.<br/ >';
                        }
                        // this 'if' works when 'Bank Letter' checkbox is checked
                        if(!empty($_POST['bank']))
                        {
                                $letter_type .=	(!empty($_POST['gp']) OR !empty($_POST['holiday']) OR !empty($_POST['tax']) OR !empty($_POST['invite']) OR !empty($_POST['others'])) ? 'Bank, ' : 'Bank';
                                $content .=	(!empty($_POST['gp']) OR !empty($_POST['holiday']) OR !empty($_POST['tax']) OR !empty($_POST['invite']) OR !empty($_POST['others'])) ? $_POST['bank_name'].'|||' : $_POST['bank_name'];
                                $success .= 'For Bank Letter please allow us Two(2) working days.<br/ >';
                        }
                        // this 'if' works when 'GP Letter' checkbox is checked
                        if(!empty($_POST['gp']))
                        {
                                $letter_type .=	(!empty($_POST['holiday']) OR !empty($_POST['tax']) OR !empty($_POST['invite']) OR !empty($_POST['others'])) ? 'GP, ' : 'GP';
                                $success .= 'For GP Letter please allow us Two(2) working days.<br/ >';
                        }
                        // this 'if' works when 'Holiday Letter' checkbox is checked
                        if(!empty($_POST['holiday']))
                        {
                                $letter_type .=	(!empty($_POST['tax']) OR !empty($_POST['invite']) OR !empty($_POST['others'])) ? 'Holiday, ' : 'Holiday';
                                $content .=	(!empty($_POST['tax']) OR !empty($_POST['invite']) OR !empty($_POST['others'])) ? $_POST['holiday_type'].'|||' : $_POST['holiday_type'];
                                $success .= 'For Holiday Letter please allow us Two(2) working days.<br/ >';
                        }
                        // this 'if' works when 'Council Tax Letter' checkbox is checked
                        if(!empty($_POST['tax']))
                        {
                                $letter_type .=	(!empty($_POST['invite']) OR !empty($_POST['others'])) ? 'Council Tax, ' : 'Council Tax';
                                $success .= 'For Council Tax Letter please allow us Five(5) working days.<br/ >';
                        }
                        // this 'if' works when 'Invitation Letter' checkbox is checked
                        if(!empty($_POST['invite']))
                        {
                                $letter_type .=	(!empty($_POST['others'])) ? 'Invitation, ' : 'Invitation';
                                $success .= 'For Invitation Letter please allow us Five(5) working days.<br/ >';
                        }
                        // this 'if' works when 'Others Letter' checkbox is checked
                        if(!empty($_POST['others']))
                        {
                                $letter_type .=	'Others';
                                $content .=	$_POST['others_letter'];
                                $success .= 'Your Others Letter Request Sent Successfully! !!<br/ >';
                        }

                        $lrData = array (
                                'uid'			=>	$_SESSION['uid'],
                                'request_type'          =>	'Letter',
                                'letter_type'           =>	$letter_type,
                                'content'		=>	$content
                        );

                        if(insert($lrData, 'spcl_student_request'))
                        {
                                $success .= 'Please collect your letters from the admin office. Thank You.';
                        }else{
                                $errors = 'Sorry, your request failed to send! !!';
                        }
                }
        }
        ?>
        <?php if(!empty($errors)){ ?><p style="color:#CC0000; font-weight:bold;"><?php echo $errors; ?></p><?php } ?>
        <?php
        if(!empty($success)){ ?>
        <div id="successDiv">
                <p style="color:#006633; font-weight:bold;"><?php echo $success; ?></p><br />
                <input type="button" name="agree" id="agree" value="I Agree" class="formbutton" />
        </div>	
        <h2 id="thanks" style="display:none;">Thank You! !!</h2>
        <?php }else{ ?>
        <form name="letter_request" id="letter_request" method="post" action="letter_request.php">
                <p>
                        <label><input type="checkbox" name="enrolment" id="enrolment" value="enrolment" /> Enrolment Letter</label>						
                </p>
                <br />
                <p>	
                        <label><input type="checkbox" name="ni" id="ni" value="ni" /> NI Letter</label>
                        <span id="ni_content" style="border:1px solid #DDDDDD; padding:10px; display:none;">You don't need any letter for NI please call 00034347 for NI form</span>						
                </p>
                <br />
                <p>
                        <label><input type="checkbox" name="bank" id="bank" value="bank" /> Bank Letter</label>
                        <input type="text" name="bank_name" id="bank_name" value="Please write the bank name" style="display:none; width:356px;" />
            </p>
                <br />
                <p>
                        <label><input type="checkbox" name="gp" id="gp" value="gp" /> GP Letter</label>
                </p>
                <br />
                <p>	
                        <label><input type="checkbox" name="holiday" id="holiday" value="holiday" /> Holiday Letter</label>
                        <select name="holiday_type" id="holiday_type" style="display:none;">
                                <option value="">Select Holiday Type</option>
                                <option value="Mid Term">Mid Term</option>
                                <option value="Easter Holiday">Easter Holiday</option>
                                <option value="Christmas Holiday">Christmas Holiday</option>
                        </select>
                </p>	
                <br />
                <p>	
                        <label><input type="checkbox" name="tax" id="tax" value="tax" /> Council Tax Letter</label>
                        <span id="tax_content" style="border:1px solid #DDDDDD; padding:10px; display:none;">You need to come down to the college and submit your tenancy<br />agreement before two days of the delivery date.</span>
                </p>	
                <br />
                <p>	
                        <label><input type="checkbox" name="invite" id="invite" value="invite" /> Invitation Letter</label>
                        <span id="invite_content" style="border:1px solid #DDDDDD; padding:10px; display:none;">You need to come to the college and submit the copies of the passports,<br />to whom you want to invite before two days of the delivery date.</span>
                </p>	
                <br />
                <p>
                        <label style="width:320px;"><input type="checkbox" name="others" id="others" value="others" /> Further information to support your requests (if any)</label>
                        <textarea name="others_letter" id="others_letter" style="display:none; width:442px; height:160px;">Please write your letter here</textarea>
            </p>
                <br />
                <p>	
                        <input type="submit" name="submit" id="submit" value="Submit" class="formbutton" />
                </p>	
        </form>
        <?php } ?>
</div>