<?php
/**
 * School Management System (SMS)
 *
 * @category   Web Application
 * @package    school-management-system
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 */

$evaluationInfo = select(array(), 'spcl_active_evaluation', "`enable` = 1");

if(count($evaluationInfo))
{
        $highPercentage = 0;
        $best_teacher = '';
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
                @$percentage = ($total_score * 100) / (40 * $total_applicant);
                if($percentage > $highPercentage)
                {
                        $highPercentage = $percentage;
                        $best_teacher = $info->teacher_name;
                }
        }	
}
$bestTeacherInfo = selectRow(array(), 'spcl_active_evaluation', "`teacher_name` = '$best_teacher' AND `enable` = 1");
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
        <h3>Best Teacher</h3>
        <?php
        $scoreInfo = select(array(), 'spcl_evaluation_score', "`teacher_name` = '$best_teacher'");
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
        <div>
                <table border="0" cellpadding="1" cellspacing="2" style="font-weight: bold;">
                        <tr bgcolor="#DFDFFF"><td colspan="3" align="center" valign="middle"><h3 style="color:#000000;">Best Teacher <?php echo @$bestTeacherInfo->teacher_name; ?></h3></td></tr>
                        <tr bgcolor="#DFDFFF"><td width="35%">Teacher Name</td><td width="2%">:</td><td><?php echo @$bestTeacherInfo->teacher_name; ?></td></tr>
                        <tr bgcolor="#DFDFFF"><td>Course Name</td><td>:</td><td><?php echo @$bestTeacherInfo->course; ?></td></tr>
                        <tr bgcolor="#DFDFFF"><td>Subjects Name</td><td>:</td><td><?php echo @$bestTeacherInfo->subject; ?></td></tr>
                        <tr bgcolor="#DFDFFF"><td>Evalualtion Duration</td><td>:</td><td><?php echo @$bestTeacherInfo->start_date.' to '.@$bestTeacherInfo->end_date; ?></td></tr>
                        <tr bgcolor="#DFDFFF"><td>Total Applicants</td><td>:</td><td><?php echo @$total_applicant; ?></td></tr>
                        <tr bgcolor="#DFDFFF"><td>Total Score</td><td>:</td><td><?php echo @$total_score; ?></td></tr>
                        <tr bgcolor="#DFDFFF"><td>Percentage</td><td>:</td><td><?php echo @$percentage.' %'; ?></td></tr>
                        <tr bgcolor="#DFDFFF"><td colspan="3">&nbsp;</td></tr>
                </table>
        </div>					
</div>				