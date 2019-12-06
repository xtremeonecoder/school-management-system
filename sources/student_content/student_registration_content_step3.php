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

<style type="text/css">
.success {display:none; color:#006633;}
.fail {display:none; color:#CC0000;}
</style>

<?php
if(!empty($row->step2))
{
?>
<script type="text/javascript">
$(document).ready(function(){
    $('#validCode').click(function(){
        $.post("../sources/ajax_request/check_account_clearance.php", {account_clearance_code: $('#account_clearance_code').val()}, function(data){
            if(data == 'valid')
            {							
                $('#statusMessage').removeClass().addClass('success').text("Thanks, your account clearance code is valid! !!").show('slow');
                $('#accountClearanceDiv').hide();
                $('#payment').show();
            }	
            else if(data != 'valid')
            {							
                $('#statusMessage').removeClass().addClass('fail').text("Sorry, your account clearance code is invalid! !!").show('slow');
            }	
        });					
    });

    $('#exit').click(function(){
        $('#statusMessage').removeClass().addClass('success').text("You've saved all the data successfully! !!").show('slow');
    });
});
</script>

<div id="signup_form">	
    <h3>Payment:</h3>
    <h4 id="statusMessage"></h4>
    <form action="student_registration.php" name="stud_payment" method="post">
    <div id="accountClearanceDiv">
        <h4>Please input the Accounts Clearance Code here</h4>
        <input type="text" name="account_clearance_code" id="account_clearance_code" value="" />
        <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
        <input type="button" name="validCode" id="validCode" class="formbutton" value="Check for Validity" style="margin-left: 10px;" />
        <br /><br /><br />
        <h4>If you don't know the valid code, you need to contact with Accounts Department to go to the next page. Please click on SAVE and EXIT before close this window.</h4>
        <br /><br />
        <input type="button" name="exit" id="exit" class="formbutton" value="Save and Exit" />
    </div>
    <input type="submit" name="payment" id="payment" style="display:none;" class="formbutton" value="Continue" />				
    <br /><br />				
    </form>
</div>
<?php } ?>
