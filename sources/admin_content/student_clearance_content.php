<?php 
/**
 * School Management System (SMS)
 *
 * @category   Web Application
 * @package    school-management-system
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 */

if(isset($_POST['submit']))
{
        $errors = '';
        $uid = $_SESSION['uid'];
        $errors .= validator('account_clearance_code', 'Account Clearance Code', 'required');
        extract($_POST);

        if(empty($errors))
        {
                if(insert(array('uid' => $uid, 'account_clearance_code' => $account_clearance_code), 'spcl_account_clearance'))
                {
                        $success = 'Account clearance code saved successfully!';
                }	
        }
}
?>
<div>	
        <h3>Add Account Clearance Code</h3>
        <?php if(!empty($errors)){ ?><p style="font-weight:bold; color:#CC0000;"><?php echo $errors; ?></p><?php } ?>
        <?php if(!empty($success)){ ?><p style="font-weight:bold; color:#006633;"><?php echo $success; ?></p><?php } ?>
        <form name="accountClearance" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <p>
                        <label>Account Clearance Code:<br /><input type="text" name="account_clearance_code" style="width:300px;" /></label>
                        <input type="hidden" name="uid" value="<?php echo $_GET['id']; ?>" />
                </p>
                <br /><br /><br />
                <p><input type="submit" name="submit" class="formbutton" value="Add Clearance Code" style="margin-left:0px;" /></p>
        </form>
</div>