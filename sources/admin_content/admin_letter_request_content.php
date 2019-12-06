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
$lrRequests = select(array(), 'spcl_student_request', "request_type = 'Letter'", '', 'id DESC');
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
        window.open('printable_letter_request.php?user_id='+uid+'&id='+id, 'mywindow', 'width=400, height=200, left=0, top=100, screenX=0, screenY=100');
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
        <h3>Letter Requests</h3>
        <?php if($lrRequests){  ?>
                <h4 id="statusMessage"></h4>
                <form name="letterRequestDeleteForm" method="post" action="admin_letter_request.php">
                <div style="margin-left: 35px; margin-bottom: 10px;">
                        <input type="submit" class="formbutton" name="submit" value="Delete Selected" style="margin-left:0px;" />
                        &nbsp;&nbsp;&nbsp;&nbsp;<span><input type="checkbox" class="checkAll" /> <b>Check All</b> <span>
                </div>
                <ul style="list-style:none outside;">
                <?php
                foreach($lrRequests as $request){					
                $userInfo = @selectRow(array(), 'spcl_signup as T1, spcl_student_info as T2', "T1.uid = T2.uid AND T1.uid = '".$request->uid."'");
                ?>
                        <li<?php if(@$request->read == 0){echo " style='font-weight:bold;'";} ?> onclick="clickOnRequest(this)" id="<?php echo @$request->id; ?>"><input type="checkbox" name="letterRequest[]" class="letterRequest" value="<?php echo @$request->id; ?>" /> <?php echo @$userInfo->title.' '.@$userInfo->first_name.' '.@$userInfo->last_name.' has sent request for '.@$request->letter_type.' Letter on '.date('M d, Y', strtotime(@$request->send_date)); ?></li>
                        <div id="details_<?php echo $request->id; ?>" style="padding:10px; border:1px #009999 solid; width:90%; margin:10px 0 20px 0; display:none;">
                                <table border="0" cellpadding="1" cellspacing="2" style="font-weight: bold;">
                                        <tr bgcolor="#DFDFFF"><td width="35%">Student Name</td><td width="2%">:</td><td><?php echo $userInfo->title.' '.$userInfo->first_name.' '.$userInfo->last_name; ?></p></td></tr>
                                        <tr bgcolor="#DFDFFF"><td>Student ID</td><td>:</td><td><?php echo $userInfo->user_id; ?></p></td></tr>
                                        <tr bgcolor="#DFDFFF"><td>Course</td><td>:</td><td><?php echo $userInfo->course; ?></p></td></tr>
                                        <tr bgcolor="#DFDFFF"><td>Request On</td><td>:</td><td><?php echo date('M d, Y', strtotime($request->send_date)); ?></p></td></tr>
                                        <?php
                                        $bankLetter = $bankName = $holidayLetter = $holiday = $otherLetter = $other = $ctLetter = $inLetter = '';
                                        $letter_type = explode(', ', $request->letter_type);
                                        $i = 0;

                                        foreach($letter_type as $letter)
                                        {
                                                if($letter == 'Bank' OR $letter == 'Holiday' OR $letter == 'Others')
                                                {
                                                        $contentVar[$i] = $letter;
                                                        $i++;
                                                }
                                                elseif($letter == 'Council Tax')
                                                {
                                                        $ctLetter = 'Council Tax';
                                                        $ctDoc = 'Tenancy Agreement Letter';
                                                }
                                                elseif($letter == 'Invitation')
                                                {
                                                        $inLetter = 'Invitation';
                                                        $inDoc = 'Parents/Spouse/Dependant Passport Copy';
                                                }
                                        }

                                        $content = explode('|||', $request->content);
                                        $count = @count($contentVar);
                                        for($i=0; $i<$count; $i++)
                                        {
                                                if(@$contentVar[$i] == 'Bank')
                                                {
                                                        $bankLetter = $contentVar[$i];
                                                        $bankName = $content[$i];
                                                }
                                                if(@$contentVar[$i] == 'Holiday')
                                                {
                                                        $holidayLetter = $contentVar[$i];
                                                        $holiday = $content[$i];
                                                }
                                                if(@$contentVar[$i] == 'Others')
                                                {
                                                        $otherLetter = $contentVar[$i];
                                                        $other = $content[$i];
                                                }
                                                unset($contentVar[$i]);
                                        }
                                        ?>
                                        <tr bgcolor="#DFDFFF">
                                                <td>Request For</td>
                                                <td>:</td>
                                                <td>
                                                        <ol style="margin: 0pt 0pt 0pt 16px;">
                                                        <?php foreach($letter_type as $letter){ ?>
                                                                <li style="color:#000000;"><?php echo $letter; ?> Letter</li>
                                                        <?php } ?>
                                                        </ol>
                                                </td>
                                        </tr>
                                        <?php if($bankLetter == 'Bank'){ ?><tr bgcolor="#DFDFFF"><td>Bank Name</td><td>:</td><td><?php echo $bankName; ?></td></tr><?php } ?>
                                        <?php if($holidayLetter == 'Holiday'){ ?><tr bgcolor="#DFDFFF"><td>Holiday Type</td><td>:</td><td><?php echo $holiday; ?></td></tr><?php } ?>
                                        <?php if($otherLetter == 'Others'){ ?><tr bgcolor="#DFDFFF"><td>Others Letter</td><td>:</td><td><?php echo $other; ?></td></tr><?php } ?>
                                        <?php if($ctLetter == 'Council Tax'){ ?><tr bgcolor="#DFDFFF"><td>Supporting Documents for Council Tax Letter</td><td>:</td><td><?php echo $ctDoc; ?></td></tr><?php } ?>
                                        <?php if($inLetter == 'Invitation'){ ?><tr bgcolor="#DFDFFF"><td>Supporting Documents for Invitation Letter</td><td>:</td><td><?php echo $inDoc; ?></td></tr><?php } ?>
                                </table>
                                <input type="button" class="formbutton" value="Print" onClick="printThePage(<?php echo $request->id; ?>, <?php echo $request->uid; ?>)" />							
                        </div>					
                <?php } ?>
                </ul>
                </form>
        <?php } ?>	
</div>				