<?php
/**
 * School Management System (SMS)
 *
 * @category   Web Application
 * @package    school-management-system
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 */

if(!empty($row->step4))
{
        if(empty($row->step5))
        {
                $data = array(
                        'step5'	=>	'done'
                );

                update($data, 'spcl_student_registration', "id = '".$_POST['id']."'");
                echo "<div id='signup_form'><h3>You have registered successfully! !!</h3></div>";
        }else{
                echo "<div id='signup_form'><h3>You have already registered! !!</h3></div>";
        }
}
?>
