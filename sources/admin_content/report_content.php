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
        <h3>Reports</h3>
        <h4 style="color:#000000;">Student Reports:</h4>
        <ul>
                <li><a href="custom_student_search.php">Quick Search</a></li>
                <li><a href="student_search.php">Query Builder</a></li>
        </ul>

        <h4 style="color:#000000;">Teacher Reports:</h4>
        <ul>
                <li><a href="evaluation_report.php">Teachers Evaluation Report</a></li>
                <li><a href="best_teacher.php">Best Teacher by Evaluation</a></li>
                <li><a href="worst_teacher.php">Worst Teacher by Evaluation</a></li>
        </ul>

        <h4 style="color:#000000;">Management Reports:</h4>
        <ul>
                <li><a href="student_statistics.php?q=rs">Total Registered Students</a></li>
                <li><a href="student_statistics.php?q=ms">Total Male Students</a></li>
                <li><a href="student_statistics.php?q=fs">Total Female Students</a></li>					
                <li><a href="student_statistics.php?q=cs">Students by Country</a></li>					
                <li><a href="student_statistics.php?q=as">Students by Course</a></li>					
        </ul>
</div>