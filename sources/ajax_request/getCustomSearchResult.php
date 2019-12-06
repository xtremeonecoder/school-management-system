<?php
/**
 * School Management System (SMS)
 *
 * @category   Web Application
 * @package    school-management-system
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 */

// Here essential.php file is included
include_once('../essential.php');

// Check admin session
check_admin_session();

// Here database connection function is called
db_connection();

if(!empty($_POST['academic']) && 
        !empty($_POST['session']) && 
        !empty($_POST['awarding_body']) && 
        !empty($_POST['course']) && 
        !empty($_POST['level']))
{
	extract($_POST);
	$tableName = 'spcl_student_info as T1, spcl_student_registration as T2';
	$condition = "T1.academic = '$academic' AND T1.session = '$session' AND T1.awarding_body = '$awarding_body' AND T1.course = '$course' AND T1.level = '$level' AND T1.uid = T2.uid";
	$searchResult = select(array(), $tableName, $condition);
}
?>

<script type="text/javascript">
var globalId;
function setValue(id)
{
	globalId = id;
}

function openTheLink()
{
	if(document.getElementById("uid_" + globalId).checked)
	{		
		var id = document.getElementById("uid_" + globalId).value;	
		location.href = "student_info.php?id=" + id;
	}	
}
</script>
<?php if(@count($searchResult)){ ?>
<table>
	<tr>
		<th>&nbsp;</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Date of Birth</th>
		<th>Course</th>
		<th>Level</th>
		<th>Phone No</th>
		<th>Email</th>
	</tr>
	<?php foreach($searchResult as $result){ ?>
	<tr>
		<td><input type="radio" name="uid" id="uid_<?php echo $result->uid; ?>" onClick="setValue(<?php echo $result->uid; ?>)" value="<?php echo $result->uid; ?>" /></td>
		<td><?php echo @$result->first_name; ?></td>
		<td><?php echo @$result->last_name; ?></td>
		<td><?php echo @date('M d, Y', strtotime($result->dob)); ?></td>
		<td><?php echo @$result->course; ?></td>
		<td><?php echo @$result->level; ?></td>
		<td><?php echo @$result->cur_phone_no; ?></td>
		<td><?php echo @$result->stud_email; ?></td>
	</tr>
	<?php } ?>
</table>
<br />
<input type="button" value="Open Selected Entry" class="formbutton" onClick="openTheLink()" name="submit" style="margin-left:0px;" />
<?php }else{ ?>
Sorry, no result found!
<?php } ?>
