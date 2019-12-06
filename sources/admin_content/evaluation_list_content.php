<?php
/**
 * School Management System (SMS)
 *
 * @category   Web Application
 * @package    school-management-system
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 */

$results = select(array(), 'spcl_active_evaluation', NULL, NULL, 'active_evaluation_id DESC');
?>
<div>	
        <h3>Evaluation List</h3>
</div>
<?php if(!empty($_GET['statusMessage'])){ ?><h4><?php echo $_GET['statusMessage']; ?></h4><?php } ?>
<table>
        <tr>
                <th>ID</th>
                <th>Teacher Name</th>
                <th>Awarding Body</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th style="width:100px;">Actions</th>
        </tr>
        <?php
        $serialNo = 1;
        foreach($results as $result){
        ?>
        <tr>
                <td><?php echo $serialNo; ?></td>
                <td><?php echo $result->teacher_name; ?></td>
                <td><?php echo $result->awarding_body; ?></td>
                <td><?php echo date('M d, Y', strtotime($result->start_date)); ?></td>
                <td><?php echo date('M d, Y', strtotime($result->end_date)); ?></td>
                <td><?php echo !empty($result->enable) ? 'Enabled' : 'Disabled'; ?></td>
                <td><a href="#">Enable</a> | <a href="#" onclick="return confirm('Are you sure to delete the teacher?');">Delete</a></td>
        </tr>
        <?php
        $serialNo++;
        }
        ?>
</table>
