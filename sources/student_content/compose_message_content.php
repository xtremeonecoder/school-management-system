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
    <h3>Compose Message</h3>
    <form action="#" method="get">
            <p><label for="name">Name:</label>
            <input type="text" name="name" id="name" value="" /><br /></p>

            <p><label for="email">Email:</label>
            <input type="text" name="email" id="email" value="" /><br /></p>

            <p><label for="message">Message:</label>
            <textarea cols="60" rows="11" name="message" id="message"></textarea><br /></p>

            <p><input type="submit" name="send" class="formbutton" value="Send" /></p>
    </form>
</div>