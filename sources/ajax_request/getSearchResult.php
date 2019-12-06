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

if(!empty($_POST['search_que']) && empty($_POST['field_name']))
{
	$search_que = $_POST['search_que'];
	$tables = 'spcl_signup as T1, spcl_student_registration as T2, spcl_student_info as T3';
	$condition = "(T1.uid LIKE '%$search_que%' OR T1.user_id LIKE '%$search_que%' OR T2.nationality LIKE '%$search_que%' OR T2.marital_status LIKE '%$search_que%' 
	OR T2.passport_no LIKE '%$search_que%' OR T2.per_address LIKE '%$search_que%' OR T2.per_phone_no LIKE '%$search_que%' OR T2.cur_address LIKE '%$search_que%'
	OR T2.cur_phone_no LIKE '%$search_que%' OR T2.stud_email LIKE '%$search_que%' OR T2.emer_mobile_no LIKE '%$search_que%' OR T2.emer_land_no LIKE '%$search_que%'
	OR T2.emer_email LIKE '%$search_que%' OR T3.title LIKE '%$search_que%' OR T3.first_name LIKE '%$search_que%' OR T3.last_name LIKE '%$search_que%' OR T3.dob LIKE '%$search_que%'
	OR T3.course LIKE '%$search_que%' OR T3.course_fee LIKE '%$search_que%' OR T3.level LIKE '%$search_que%' OR T3.session LIKE '%$search_que%' OR T3.academic LIKE '%$search_que%'
	OR T3.reporting_date LIKE '%$search_que%' OR T3.awarding_body LIKE '%$search_que%') AND (T1.uid = T2.uid AND T1.uid = T3.uid)";

	$searchResult = select(array(), $tables, $condition);
}	
elseif(!empty($_POST['search_que']) && !empty($_POST['field_name']))
{
	$search_que = $_POST['search_que'];
	if($_POST['field_name'] == 1)
	{
		$tableName = 'spcl_student_info as T1, spcl_student_registration as T2';
		$condition = "(T1.first_name = '$search_que' OR T1.last_name = '$search_que') AND (T1.uid = T2.uid)";
	}
	elseif($_POST['field_name'] == 2)
	{
		$tableName = 'spcl_student_info as T1, spcl_student_registration as T2';
		$condition = "T1.dob = '$search_que' AND T1.uid = T2.uid";
	}
	elseif($_POST['field_name'] == 3)
	{
		$tableName = 'spcl_signup as T1, spcl_student_info as T2, spcl_student_registration as T3';
		$condition = "T1.user_id = '$search_que' AND T1.uid = T2.uid AND T1.uid = T3.uid";
	}
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
