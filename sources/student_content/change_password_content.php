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
    $password = md5($_POST['password']);
    $newpass = md5($_POST['newpass']);
    $errors .= validator('password', 'Old Password', 'required');
    $checkAuth = countRows('uid', 'spcl_signup', "`uid` = '$uid' AND `password` = '$password'");
    $errors .= validator('newpass', 'New Password', 'required|length[4,10]|match[confpass]');

    if(empty($errors) AND !empty($checkAuth))
    {
            if(update(array('password' => $newpass), 'spcl_signup', "`uid` = '$uid' AND `password` = '$password'"))
            {
                    $success = 'Your password has been changed successfully!';
            }	
    }
    elseif(empty($errors) AND empty($checkAuth))
    {
            $errors .= "Your old password didn't matched!";
    }
}
?>
<div>	
    <h3>Change Password</h3>
    <?php if(!empty($errors)){ ?><p style="font-weight:bold; color:#CC0000;"><?php echo $errors; ?></p><?php } ?>
    <?php if(!empty($success)){ ?><p style="font-weight:bold; color:#006633;"><?php echo $success; ?></p><?php } ?>
    <form name="changePassword" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <p>
                    <label>Type Old Password:<br /><input type="password" name="password" /></label>
            </p>
            <br /><br /><br />
            <p>
                    <label>Type New Password:<br /><input type="password" name="newpass" /></label>
            </p>
            <br /><br /><br />
            <p>
                    <label>Confirm New Password:<br /><input type="password" name="confpass" /></label>
            </p>
            <br /><br /><br />
            <p><input type="submit" name="submit" class="formbutton" value="Change Password" style="margin-left:0px;" /></p>
    </form>
</div>