<?php
/**
 * School Management System (SMS)
 *
 * @category   Web Application
 * @package    school-management-system
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 */

$block = true;
$table = 'spcl_signup as T1, spcl_student_registration as T2, spcl_student_info as T3';
if($_REQUEST['q'] == 'ms')
{
        $customCondition = " AND T3.title = 'Mr.'";
}
elseif($_REQUEST['q'] == 'fs')
{
        $customCondition = " AND T3.title = 'Mis.' OR T3.title = 'Mrs.' OR T3.title = 'Ms.'";
}
elseif($_REQUEST['q'] == 'cs' OR $_REQUEST['q'] == 'as')
{
        $block = false;
        //$customCondition = '';//" AND T2.title LIKE '%".$_GET['q']."%'";
}
elseif($_REQUEST['q'] == 'country')
{
        $customCondition = " AND T2.nationality LIKE '%".$_POST['key']."%'";
}
elseif($_REQUEST['q'] == 'course')
{
        $customCondition = " AND T3.awarding_body LIKE '%".$_POST['key']."%'";
}
else
{
        $customCondition = "";
}
if($block)
{
        $condition = "T1.uid = T2.uid AND T1.uid = T3.uid".$customCondition;
        $searchResult = select(array(), $table, $condition);
}	
?>
<div>	
<?php if($block){ ?>
        <h3>Student Statistics Page</h3>

        <script type="text/javascript">
        var globalId;
        function setValue(id)
        {
                globalId = id;
        }

        function openTheLink()
        {
                if(document.getElementById("uid_" + globalId).checked)
                {		
                        var id = document.getElementById("uid_" + globalId).value;	
                        location.href = "student_info.php?id=" + id;
                }	
        }
        </script>

        <?php if(@count($searchResult)){ ?>
        <table>
                <tr>
                        <th>&nbsp;</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th>Course</th>
                        <th>Level</th>
                        <th>Phone No</th>
                        <th>Email</th>
                </tr>
                <?php foreach($searchResult as $result){ ?>
                <tr>
                        <td><input type="radio" name="uid" id="uid_<?php echo $result->uid; ?>" onClick="setValue(<?php echo $result->uid; ?>)" value="<?php echo $result->uid; ?>" /></td>
                        <td><?php echo @$result->first_name; ?></td>
                        <td><?php echo @$result->last_name; ?></td>
                        <td><?php echo @date('M d, Y', strtotime($result->dob)); ?></td>
                        <td><?php echo @$result->course; ?></td>
                        <td><?php echo @$result->level; ?></td>
                        <td><?php echo @$result->cur_phone_no; ?></td>
                        <td><?php echo @$result->stud_email; ?></td>
                </tr>
                <?php } ?>
        </table>
        <br />
        <input type="button" value="Open Selected Entry" class="formbutton" onClick="openTheLink()" name="submit" style="margin-left:0px;" />
        <?php 
                }else{
                        echo "<h4>Sorry, no result found!</h4>";
                }					
        }elseif($_REQUEST['q'] == 'cs'){ ?>
        <form name="searchByCountry" id="searchByCountry" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label style="font-weight:bold;">Type Country Name:<br /><input type="text" name="key" style="width:300px;" /></label>
                <input type="hidden" name="q" value="country" />
                <br /><br /><input type="submit" class="formbutton" style="margin-left:0px;" name="submit" value="Search" />
        </form>
        <?php }elseif($_REQUEST['q'] == 'as'){ ?>
        <form name="searchByCourse" id="searchByCourse" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label style="font-weight:bold;">Type Country Name:<br /><input type="text" name="key" style="width:300px;" /></label>
                <input type="hidden" name="q" value="course" />
                <br /><br /><input type="submit" name="submit" class="formbutton" style="margin-left:0px;" value="Search" />
        </form>
        <?php } ?>
</div>