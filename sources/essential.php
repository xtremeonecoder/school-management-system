<?php
/**
 * School Management System (SMS)
 *
 * @category   Web Application
 * @package    school-management-system
 * @author     Suman Barua
 * @developer  Suman Barua <sumanbarua576@gmail.com>
 */

// Off all error reporting
error_reporting();

// Global Variable
$mysqli = null;

// site title
$websiteTitle = 'School Management System';

// This function help to connect to the database
function db_connection()
{
	global $mysqli;
	$db_hostname = 'localhost';
	$db_username = 'root';
	$db_passowrd = '';
	$db_name = 'spcl_sss_db';

	$mysqli = @mysqli_connect($db_hostname, $db_username, $db_password) or die('Server Connecting Error : '.mysqli_connect_error());
	@mysqli_select_db($mysqli, $db_name) or die('Database Connecting Error : '.mysqli_connect_error());
}

// This function checks admin seassion and deny other users to access to admin page
function check_admin_session()
{
	@session_start();
	if(empty($_SESSION['user_id']) || empty($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin')
	{
		@header("Location: ../index.php");
	}
}

// This function checks student seassion and deny other users to access to student page
function check_student_session()
{
	@session_start();
	if(empty($_SESSION['user_id']) || empty($_SESSION['user_type']) || $_SESSION['user_type'] != 'student')
	{
		@header("Location: ../index.php");
	}
}

// This function do 'the sql insert operation'
function insert($data = array(), $tableName = NULL)
{
	$totalArrayElements = count($data);
	if($totalArrayElements)
	{
		$fields = '';
		$values = '';
		$loopCounter = 1;

		foreach($data as $key => $value)
		{
			$fields .= $key;
			$values .= "'".$value."'";
			if($loopCounter != $totalArrayElements)
			{
				$fields .= ', ';
				$values .= ', ';
			}
			$loopCounter++;
		}

		$query = "INSERT INTO $tableName ($fields) VALUES ($values)";
		if(run_query($query))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}

// This function works as mysql select query
function select($data = array(), $tableName = NULL, $condition = NULL, $limit = NULL, $order = NULL)
{
	$fields = '';
	$totalArrayElements = count($data);
	if($totalArrayElements)
	{
		$loopCounter = 1;

		foreach($data as $value)
		{
			$fields .= $value;

			if($totalArrayElements != $loopCounter)
			{
				$fields .= ', ';
			}

			$loopCounter++;
		}
	}
	else
	{
		$fields .= '*';
	}

	$query = "SELECT $fields FROM $tableName";

	// If there is a condition
	if(!empty($condition))
	{
		$query .= " WHERE $condition";
	}

	// If there is a order
	if(!empty($order))
	{
		$query .= " ORDER BY $order";
	}

	// If there is a limit
	if(!empty($limit))
	{
		$query .= " LIMIT $limit";
	}

	$rows = run_query($query);
	return fetchAll($rows);
}

// This function works as mysql select query, this function can fetch only 1 row
function selectRow($data = array(), $tableName = NULL, $condition = NULL, $order = NULL)
{
	$fields = '';
	$totalArrayElements = count($data);
	if($totalArrayElements)
	{
		$loopCounter = 1;

		foreach($data as $value)
		{
			$fields .= $value;

			if($totalArrayElements != $loopCounter)
			{
				$fields .= ', ';
			}

			$loopCounter++;
		}
	}
	else
	{
		$fields .= '*';
	}

	$query = "SELECT $fields FROM $tableName";

	// If there is a condition
	if(!empty($condition))
	{
		$query .= " WHERE $condition";
	}

	// If there is a order
	if(!empty($order))
	{
		$query .= " ORDER BY $order";
	}

	// Assign Limit
	$query .= " LIMIT 1";

	$rows = run_query($query);
	return fetchRow($rows);
}

// This function count number of rows on condition
function countRows($field = NULL, $tableName = NULL, $condition = NULL)
{
	$query = "SELECT $field FROM $tableName";
	if(!empty($condition))
	{
		$query .= " WHERE $condition";
	}

	return mysqli_num_rows(run_query($query));
}

// This function do 'the sql update operation'
function update($data = array(), $tableName = NULL, $condition = NULL)
{
	$totalArrayElements = count($data);
	if($totalArrayElements)
	{
		$fields = '';
		$values = '';
		$loopCounter = 1;

		foreach($data as $key => $value)
		{
			$values .= "`$key`='$value'";
			if($loopCounter != $totalArrayElements)
			{
				$values .= ', ';
			}
			$loopCounter++;
		}

		$query = "UPDATE $tableName SET $values WHERE $condition";
		if(run_query($query))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}

function delete($tableName = NULL, $condition = NULL)
{
	if(!empty($tableName) && !empty($condition))
	{
		$query = "DELETE FROM $tableName WHERE $condition";
		if(run_query($query))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}

// This function is an alias of mysqli_fetch_object() function. This function works when only 1 row is fetched by select query
function fetchRow($rows)
{
	return @mysqli_fetch_object($rows);
}

// This function is an alias of mysqli_fetch_object() function. This function works when more than 1 row is fetched by select query
function fetchAll($rows)
{
	$array = array();
	while($row = @mysqli_fetch_object($rows))
	{
		$array[] = $row;
	}
	return $array;
}

// This function helps to run a query
function run_query($query = NULL)
{
	global $mysqli;
	if(!empty($query))
	{
		if($rows = @mysqli_query($mysqli, $query))
		{
			return $rows;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}

// This function helps to validate the form
function validator($field = NULL, $fieldTitle = NULL, $rules = NULL)
{
	$errors = '';
	if(!empty($rules))
	{
		$rules = explode('|', $rules);
		foreach($rules as $rule)
		{
			if($rule == 'required')
			{
				$errors .= required($field, $fieldTitle);
			}
			elseif($rule == 'trim')
			{
				@$_POST[$field] = trim($_POST[$field]);
			}
			elseif($rule == 'ucfirst')
			{
				@$_POST[$field] = ucfirst($_POST[$field]);
			}
			elseif($rule == 'ucwords')
			{
				@$_POST[$field] = ucwords($_POST[$field]);
			}
			elseif($rule == 'htmlentity')
			{
				@$_POST[$field] = htmlentities($_POST[$field], ENT_QUOTES);
			}
			elseif(substr($rule, 0, 5) == 'match')
			{
				$errors .= match($field, $fieldTitle, $rule);
			}
			elseif(substr($rule, 0, 6) == 'length')
			{
				$errors .= length($field, $fieldTitle, $rule);
			}
			elseif($rule == 'unique')
			{
				$errors .= isUserExists($field, $fieldTitle, $rule);
			}
			elseif($rule == 'valid_email')
			{
				$errors .= isValidEmail($field, $fieldTitle, $rule);
			}
		}
	}

	return $errors;
}

// This function checks a field is empty or not
function required($field, $fieldTitle)
{
	return empty($_POST[$field]) ? "The {$fieldTitle} field is required! !!<br />" : '';
}

// This function matches password and confirm password
function match($passwordField, $fieldTitle, $rule)
{
	$confirmPasswordField = str_replace(']', '', str_replace('match[', '', $rule));
	return ($_POST[$passwordField] != $_POST[$confirmPasswordField]) ? "The {$fieldTitle} fields didn't match! !!<br />" : '';
}

// This function checks length of a string
function length($field, $fieldTitle, $rule)
{
	$params = str_replace(']', '', str_replace('length[', '', $rule));
	$limit = explode(',', $params);
	return (strlen($_POST[$field]) >= trim($limit[0]) && strlen($_POST[$field]) <= trim($limit[1])) ? '' : "The {$fieldTitle} field length must be between ".trim($limit[0])." and ".trim($limit[1])." characters! !!<br />";
}

// This function checks whether user_id is previously exist or not
function isUserExists($field, $fieldTitle, $rule)
{
	$row = selectRow(array('user_id'), 'spcl_signup', "user_id = '".$_POST[$field]."'");
	return (!empty($row->user_id)) ? "This {$fieldTitle} already exists in database! !!<br />" : '';
}

// This function checks whether email address is valid or not
function isValidEmail($field, $fieldTitle, $rule)
{
	return (!preg_match("/^[a-z0-9_\-]+(\.[_a-z0-9\-]+)*@([_a-z0-9\-]+\.)+([a-z]{2}|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)$/i", $_POST[$field])) ? "This {$fieldTitle} is invalid! !!<br />" : '';
}

// This function helps to upload flies
function uploadFile($destination, $fieldName)
{
	$result = false;
	// Define the directory name where the file will be stored
	define ("FILE_DIR", $destination);

	// This 'if' condition will check whether file variable $_FILES is empty or not.
	if (is_uploaded_file($_FILES[$fieldName]['tmp_name']))
	{
		// '$name' contains the upload file name.
        $name = $_FILES[$fieldName]['name'];

		// This function upload the source file to the given destination
		$result = move_uploaded_file($_FILES[$fieldName]['tmp_name'], FILE_DIR."/$name");
		// This 'if' condition will ensure whether the file is downloaded or not
		if ($result == 1)
		{
			$result = true;
		}
	}

	return $result;
}
?>
