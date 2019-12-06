<?php
/**
 * School Management System (SMS)
 *
 * @category   Web Application
 * @package    school-management-system
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 */

if(isset($_GET['result_id']))
{
        // Delete Result			
        delete('spcl_exam_result', "`result_id` = '".$_GET['result_id']."'");
}

if(isset($_POST['submit']))
{
        // Delete Result			
        foreach($_POST['resultId'] as $resultId)
        {
                delete('spcl_exam_result', "`result_id` = '$resultId'");
        }
}
?>

<style type="text/css">
.success {display:none; color:#006633;}
.fail {display:none; color:#CC0000;}
</style>

<script type="text/javascript">
function setStatus(result_id)
{
        var curStatus = $('#status_' + result_id).html();
        var status = (curStatus=='Disabled') ? 1 : 0;
        $.post("../sources/ajax_request/set_status.php", {result_id: result_id, status: status}, function(data){
                if(data == 'yes')
                {
                        var anchorHtml = (curStatus=='Disabled') ? 'Enable' : 'Disable';
                        var statusHtml = (curStatus=='Disabled') ? 'Enabled' : 'Disabled';
                        $('#anchor_' + result_id).html(anchorHtml);
                        $('#status_' + result_id).html(statusHtml);
                }else{
                        $('#statusMessage').removeClass().addClass('fail').text("Sorry, an error occured while executing! !!").show('slow');
                }
        });								
}

function submitForm()
{
        $('#scheduleListForm').submit();
}

$(document).ready(function(){
        $( '.checkAll' ).live( 'change', function() {
                $( '.examResult' ).attr( 'checked', $( this ).is( ':checked' ) ? 'checked' : '' );
                //$( this ).next().text( $( this ).is( ':checked' ) ? 'Uncheck All' : 'Check All' );
        });
});			
</script>

<?php
$rows = select(array(), 'spcl_exam_result', NULL, NULL, 'result_id DESC');
?>
<div>	
        <h3>Exam Result List</h3>
        <?php if(!empty($_GET['statusMessage'])){ ?><h4><?php echo $_GET['statusMessage']; ?></h4><?php } ?>
        <form name="resultListForm" action="exam_result.php" method="post">
        <table>
                <tr>
                        <th style="width:15px;"><input type="checkbox" class="checkAll" /></th>
                        <th>Result Title</th>
                        <th style="width:82px;">Published Date</th>
                        <th style="width:75px;">Result Status</th>
                        <th style="width:100px;">Actions</th>
                </tr>
                <?php
                foreach($rows as $row){
                ?>
                <tr>
                        <td><input name="resultId[]" type="checkbox" class="examResult" value="<?php echo $row->result_id; ?>" /></td>
                        <td><?php echo $row->title; ?></td>
                        <td><?php echo date('M d, Y', strtotime($row->modified_date)); ?></td>
                        <td id="status_<?php echo $row->result_id; ?>"><?php if($row->enable){echo 'Enabled';}else{echo 'Disabled';}; ?></td>
                        <td><a href="#" onClick="setStatus(<?php echo $row->result_id; ?>)" id="anchor_<?php echo $row->result_id; ?>"><?php echo ($row->enable) ? 'Enable' : 'Disable'; ?></a> | <a href="#">Edit</a> | <a href="exam_result.php?result_id=<?php echo $row->result_id; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a></td>
                </tr>
                <?php
                }
                ?>
        </table>
        <br />
        <input type="hidden" name="submit" value="yes" />
        <input type="button" name="button" class="formbutton" onClick="if(confirm('Are you sure to delete the selected items?')){submitForm();}" value="Delete Selected" style="margin-left:0px;" />
        </form>
</div>	