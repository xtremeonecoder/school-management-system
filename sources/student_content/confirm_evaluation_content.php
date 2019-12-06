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
function evaluateNow()
{
        location.href = 'evaluation_form.php?uid=<?php echo $_GET['uid']; ?>&code=<?php echo $_GET['code']; ?>';
}
function evaluateLater()
{
        location.href = 'home.php';
}
</script>

<div>	
        <h3>Confirm Evaluation</h3>
        <br /><br />
        <input type="button" style="margin-left:0px;" value="Evaluate Now" onclick="evaluateNow()" class="formbutton" />
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" value="Evaluate Later" style="margin-left:0px;" onclick="evaluateLater()" class="formbutton" />
        <br /><br />
</div>