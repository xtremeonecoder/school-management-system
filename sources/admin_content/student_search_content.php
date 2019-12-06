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

<script type="text/javascript">
//Ajax call for getting search result
function getSearchResult(obj)
{
        var formData = $(obj).serialize();
        $.ajax({
                type: "POST",
                url: "../sources/ajax_request/getSearchResult.php",
                data: formData,
                dataType: "html",
                success: function(response){
                        $('#searchResult').css('display', 'block').html(response).show('slow');
                },
        });
}			
</script>

<div>	
        <h3>Student Search</h3>

        <form method="post" action="student_search.php">
                <p>
                        <input type="text" name="search_que" id="search_que" style="width:300px;" /><br /><br />
                        <label style="width:130px;"><input type="radio" name="field_name" value="1" /> First / Last Name</label> 
                        <label style="width:130px;"><input type="radio" name="field_name" value="2" /> Date of Birth</label> 
                        <label style="width:130px;"><input type="radio" name="field_name" value="3" /> Student ID</label> 
                </p>

                <p><br /><input type="button" value="Search Student" class="formbutton" onClick="getSearchResult(this.form)" name="submit" style="margin-left:0px;" /></p>
        </form>

        <br />

        <div id="searchResult"></div>
        <br />
</div>