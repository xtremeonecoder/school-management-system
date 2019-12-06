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
        // This event will trigger when 'Yes' radio box will be selected
        $('#yes').click(function(){
                $('#confirm').hide();
                $('#yesDiv').show();
        });

        // This event will trigger when 'No' radio box will be selected
        $('#no').click(function(){
                $('#confirm').hide();
                $('#noDiv').show();
        });
});			
</script>

<?php 
if(isset($_POST['submit']))
{
        $success = false;
        // When 'Renew ID' is checked
        if(!empty($_POST['renew_id']))
        {
                $renewData = array(
                        'uid'		=>	$_SESSION['uid'],
                        'request_type'	=>	'ID',
                        'letter_type'	=>	'Renew ID'
                );
                if(insert($renewData, 'spcl_student_request'))
                {
                        $success = true;
                }
        }
        // When 'Lost ID' is checked
        if(!empty($_POST['lost_id']))
        {
                $lostData = array(
                        'uid'		=>	$_SESSION['uid'],
                        'request_type'	=>	'ID',
                        'letter_type'	=>	'Lost ID'
                );
                if(insert($lostData, 'spcl_student_request'))
                {
                        $success = true;
                }
        }
        // When 'Change Course' is checked
        if(!empty($_POST['change_id']))
        {
                $changeData = array(
                        'uid'		=>	$_SESSION['uid'],
                        'request_type'	=>	'ID',
                        'letter_type'	=>	'Change Course'
                );
                if(insert($changeData, 'spcl_student_request'))
                {
                        $success = true;
                }
        }
        if($success)
        {
                $success = 'Your ID request has been sent successfully! !!<br />Please allow us 5(five) working days to process your ID request. Thank You.';
        }else{
                $errors = 'Sorry, your request failed to send! !!';
        }
}
elseif(isset($_POST['new_id']))
{
        $newData = array(
                'uid'		=>	$_SESSION['uid'],
                'request_type'	=>	'ID',
                'letter_type'	=>	'New ID'
        );
        if(insert($newData, 'spcl_student_request'))
        {
                $success = 'Your ID request has been sent successfully! !!<br />Please allow us 5(five) working days to process your ID request. Thank You.';
        }
}
?>

<div>	
        <h3>Request for ID</h3>
        <?php if(!empty($errors)){ ?><p style="color:#CC0000; font-weight:bold;"><?php echo $errors; ?></p><?php } ?>
        <?php if(!empty($success)){ ?><p style="color:#006633; font-weight:bold;"><?php echo $success; ?></p><?php } ?>
        <form name="id_request" id="id_request" method="post" action="id_request.php">
        <?php if(!isset($_POST['submit']) AND !isset($_POST['new_id'])){ ?>
        <div id="confirm">
                Have you get any ID before from St. Peter's College of London?<br /><br />
                <p>
                        <label><input type="radio" name="yes" id="yes" value="yes" /> Yes</label>						
                </p>
                <br />
                <p>
                        <label><input type="radio" name="yes" id="no" value="no" /> No</label>						
                </p>
                <br />
        </div>	
        <?php } ?>
        <div style="clear:both;"></div>
        <div id="yesDiv" style="display:none;">
                Please inform us why you need another ID<br /><br />
                <p>	
                        <label style="width:200px;"><input type="checkbox" name="renew_id" id="renew_id" value="renew_id" /> I want to renew my old ID</label>
                </p>
                <br />
                <p>
                        <label style="width:200px;"><input type="checkbox" name="lost_id" id="lost_id" value="lost_id" /> My ID has lost / Stolen</label>
            </p>
                <br />
                <p>
                        <label style="width:200px;"><input type="checkbox" name="change_id" id="change_id" value="change_id" /> I have change my course</label>
                </p>
                <br />
                <p>	
                        <input type="submit" name="submit" id="submit" value="Submit" class="formbutton" />
                </p>	
        </div>	
        <div style="clear:both;"></div>
        <div id="noDiv" style="display:none;">
                Please click here to get your new ID.<br /><br />
                <p>	
                        <input type="submit" name="new_id" id="new_id" value="Get New ID" class="formbutton" />
                </p>	
        </div>	
        </form>
</div>