<?php
/**
 * School Management System (SMS)
 *
 * @category   Web Application
 * @package    school-management-system
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 */

$fields = array('T2.uid', 'T2.title', 'T2.first_name', 'T2.last_name', 'T2.level', 'T2.session');
$results = select($fields, 'spcl_signup as T1, spcl_student_info as T2', "T1.uid = T2.uid AND T1.user_type = 'student'", NULL, 'T2.id DESC');
?>
<div>	
        <h3>Student List</h3>
</div>
<?php if(!empty($_GET['statusMessage'])){ ?><h4><?php echo $_GET['statusMessage']; ?></h4><?php } ?>
<table>
        <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Level</th>
                <th>Session</th>
                <th style="width:150px;">Actions</th>
        </tr>
        <?php
        $serialNo = 1;
        foreach($results as $result){
        ?>
        <tr>
                <td><?php echo $serialNo; ?></td>
                <td><?php echo $result->title.' '.$result->first_name.' '.$result->last_name; ?></td>
                <td><?php echo $result->level; ?></td>
                <td><?php echo $result->session; ?></td>
                <td><a href="student_account_details.php?id=<?php echo $result->uid; ?>">Show</a> | <a href="student_account_edit.php?id=<?php echo $result->uid; ?>">Edit</a> | <a href="student_account_delete.php?id=<?php echo $result->uid; ?>" onclick="return confirm('Are you sure to delete the student?');">Delete</a> | <a href="student_clearance.php?id=<?php echo $result->uid; ?>">Clearance</a></td>
        </tr>
        <?php
        $serialNo++;
        }
        ?>
</table>
