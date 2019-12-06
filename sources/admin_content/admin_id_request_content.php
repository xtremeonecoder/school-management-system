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
        // Delete Request			
        foreach($_POST['letterRequest'] as $requestId)
        {
                delete('spcl_student_request', "`id` = '$requestId'");
        }
}
?>

<style type="text/css">
.success {display:none; color:#006633;}
.fail {display:none; color:#CC0000;}
</style>

<?php
$irRequests = select(array(), 'spcl_student_request', "request_type = 'ID'", '', 'id DESC');
?>

<script type="text/javascript">
function clickOnRequest(obj)
{
        var id = $(obj).attr('id');
        $.post("../sources/ajax_request/mark_as_read.php", {id: id}, function(data){
                if(data == 'yes')
                {
                        $(obj).css('font-weight', 'normal');
                        $('#details_' + id).toggle('slow');
                }else{
                        $('#statusMessage').removeClass().addClass('fail').text("Sorry, an error occured while executing! !!").show('slow');
                }
        });								
}

// This function will open printable page
function printThePage(id, uid)
{
        window.open('printable_ir_request.php?user_id='+uid+'&id='+id, 'mywindow', 'width=400, height=200, left=0, top=100, screenX=0, screenY=100');
}

// To check all checkbox
$(document).ready(function(){
        $( '.checkAll' ).live( 'change', function() {
                $( '.letterRequest' ).attr( 'checked', $( this ).is( ':checked' ) ? 'checked' : '' );
                $( this ).next().text( $( this ).is( ':checked' ) ? 'Uncheck All' : 'Check All' );
        });
});			
</script>
<div id="request">	
        <h3>ID Requests</h3>
        <?php if($irRequests){  ?>
                <h4 id="statusMessage"></h4>
                <form name="letterRequestDeleteForm" method="post" action="admin_id_request.php">
                <div style="margin-left: 35px; margin-bottom: 10px;">
                        <input type="submit" class="formbutton" name="submit" value="Delete Selected" style="margin-left:0px;" />
                        &nbsp;&nbsp;&nbsp;&nbsp;<span><input type="checkbox" class="checkAll" /> <b>Check All</b> <span>
                </div>
                <ul style="list-style:none outside;">
                <?php
                foreach($irRequests as $request){
                $userInfo = selectRow(array(), 'spcl_signup as T1, spcl_student_info as T2', "T1.uid = T2.uid AND T1.uid = '".$request->uid."'");
                ?>
                        <li<?php if($request->read == 0){echo " style='font-weight:bold;'";} ?> onclick="clickOnRequest(this)" id="<?php echo $request->id; ?>"><input type="checkbox" name="letterRequest[]" class="letterRequest" value="<?php echo @$request->id; ?>" /> <?php echo $userInfo->title.' '.$userInfo->first_name.' '.$userInfo->last_name.' has sent request for '.$request->letter_type.' on '.date('M d, Y', strtotime($request->send_date)); ?></li>
                        <div id="details_<?php echo $request->id; ?>" style="padding:10px; border:1px #009999 solid; width:90%; margin:10px 0 20px 0; display:none;">
                                <table border="0" cellpadding="1" cellspacing="2" style="font-weight: bold;">
                                        <tr bgcolor="#DFDFFF"><td width="35%">Student Name</td><td width="2%">:</td><td><?php echo $userInfo->title.' '.$userInfo->first_name.' '.$userInfo->last_name; ?></p></td></tr>
                                        <tr bgcolor="#DFDFFF"><td>Student ID</td><td>:</td><td><?php echo $userInfo->user_id; ?></p></td></tr>
                                        <tr bgcolor="#DFDFFF"><td>Request On</td><td>:</td><td><?php echo date('M d, Y', strtotime($request->send_date)); ?></p></td></tr>
                                        <tr bgcolor="#DFDFFF"><td>Level</td><td>:</td><td><?php echo $userInfo->level; ?></p></td></tr>
                                        <tr bgcolor="#DFDFFF"><td>Study Session</td><td>:</td><td><?php echo $userInfo->session; ?></p></td></tr>
                                        <tr bgcolor="#DFDFFF"><td>Academic Year</td><td>:</td><td><?php echo $userInfo->academic; ?></p></td></tr>
                                        <tr bgcolor="#DFDFFF"><td>Awarding Body</td><td>:</td><td><?php echo $userInfo->awarding_body; ?></p></td></tr>
                                </table>	
                                <input type="button" class="formbutton" value="Print" onClick="printThePage(<?php echo $request->id; ?>, <?php echo $request->uid; ?>)" />							
                        </div>					
                <?php } ?>
                </ul>
                </form>
        <?php } ?>	
</div>				