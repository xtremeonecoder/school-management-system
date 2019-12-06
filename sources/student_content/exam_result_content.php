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

<div>	
        <h3>Exam Results</h3>
        <?php
        $row = selectRow(array(), 'spcl_exam_result', "`enable` = 1");
        ?>
        <?php if(count($row)){ ?>
                <h4>Click on the link to download exam result.</h4>
                <ul>
                        <li><a href="../upload_files/exam_result/<?php echo $row->name; ?>" target="_blank"><?php echo $row->title; ?></a></li>
                </ul>	
        <?php }else{ ?>
                <p style="color:#006633; font-weight:bold;">Sorry, no exam result found! !!</p>
        <?php } ?>
</div>