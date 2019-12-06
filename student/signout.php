<?php
/**
 * School Management System (SMS)
 *
 * @category   Web Application
 * @package    school-management-system
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 */

session_start();
unset($_SESSION['uid']);
unset($_SESSION['user_id']);
unset($_SESSION['user_type']);
unset($_SESSION['first_name']);
unset($_SESSION['last_name']);
unset($_SESSION['code']);
session_destroy();
header("Location: ../index.php");
?>