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
        foreach($_POST['scoreId'] as $scoreId)
        {
                delete('spcl_evaluation_score', "`score_id` = $scoreId");
        }
}

$evaluationInfo = select(array(), 'spcl_active_evaluation', "`enable` = 1", NULL, 'active_evaluation_id DESC');
?>

<style type="text/css">
.success {display:none; color:#006633;}
.fail {display:none; color:#CC0000;}
</style>

<script type="text/javascript">
function clickOnRequest(obj)
{
        var id = $(obj).attr('id');
        $('#details_' + id).toggle('slow');
}

// To check all checkbox
$(document).ready(function(){
        $('.checkAll').live('change', function(){
                $('.scoreId').attr('checked', $(this).is(':checked') ? 'checked' : '');
                $(this).next().text($(this).is(':checked') ? 'Uncheck All' : 'Check All');
        });
});			
</script>
<div id="request">	
        <h3>Teacher Evaluation Report</h3>
        <?php if($evaluationInfo){  ?>
                <h4 id="statusMessage"></h4>
                <form name="teacherEvaluation" method="post" action="evaluation_report.php">
                <div style="margin-left: 35px; margin-bottom: 10px;">
                        <input type="submit" class="formbutton" name="submit" value="Delete Selected" style="margin-left:0px;" />
                        &nbsp;&nbsp;&nbsp;&nbsp;<span><input type="checkbox" class="checkAll" /> <b>Check All</b> <span>
                </div>
                <ul style="list-style:none outside;">
                <?php
                if(count($evaluationInfo))
                {
                        foreach($evaluationInfo as $info)
                        {		
                                $scoreInfo = select(array(), 'spcl_evaluation_score', "`teacher_name` = '".$info->teacher_name."'");
                                $total_applicant = 0;	
                                $total_score = 0;		
                                if(count($scoreInfo))
                                {
                                        foreach($scoreInfo as $score)
                                        {
                                                if(!empty($score->score_id))
                                                {
                                                        $total_applicant++;
                                                        $total_score += $score->score;
                                                }							
                                        }
                                }	
                                @$percentage = ($total_score * 100) / (40 * $total_applicant)
                ?>
                        <li style="font-weight:bold;" onclick="clickOnRequest(this)" id="<?php echo @$info->active_evaluation_id; ?>"><input type="checkbox" name="scoreId[]" class="scoreId" value="<?php echo @$info->active_evaluation_id; ?>" />&nbsp;&nbsp;<?php echo @$info->teacher_name.' - '.@$info->awarding_body.' - '.@$info->start_date.' to '.@$info->end_date; ?></li>
                        <div id="details_<?php echo @$info->active_evaluation_id; ?>" style="padding:10px; border:1px #009999 solid; width:90%; margin:10px 0 20px 0; display:none;">
                                <table border="0" cellpadding="1" cellspacing="2" style="font-weight: bold;">
                                        <tr bgcolor="#DFDFFF"><td width="35%">Teacher Name</td><td width="2%">:</td><td><?php echo @$info->teacher_name; ?></td></tr>
                                        <tr bgcolor="#DFDFFF"><td>Course Name</td><td>:</td><td><?php echo @$info->course; ?></td></tr>
                                        <tr bgcolor="#DFDFFF"><td>Subjects Name</td><td>:</td><td><?php echo @$info->subject; ?></td></tr>
                                        <tr bgcolor="#DFDFFF"><td>Evalualtion Duration</td><td>:</td><td><?php echo @$info->start_date.' to '.@$info->end_date; ?></td></tr>
                                        <tr bgcolor="#DFDFFF"><td>Total Applicants</td><td>:</td><td><?php echo @$total_applicant; ?></td></tr>
                                        <tr bgcolor="#DFDFFF"><td>Total Score</td><td>:</td><td><?php echo @$total_score; ?></td></tr>
                                        <tr bgcolor="#DFDFFF"><td>Percentage</td><td>:</td><td><?php echo @$percentage.' %'; ?></td></tr>
                                </table>
                        </div>					
                <?php }} ?>
                </ul>
                </form>
        <?php } ?>	
</div>				