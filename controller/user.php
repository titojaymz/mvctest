<?php
class user
{
	public function loginUser($username,$password)
	{
		$User_model = new User_model();
		
		$is_exist = $User_model->countUser($username,$password);
		
		if($is_exist['counterz'] > 0)
		{
			$userAccount = $User_model->getUser($is_exist['uid']);
			$_SESSION['s_userid'] = $userAccount[0]['uid'];
			$_SESSION['s_full_name'] = $userAccount[0]['full_name'];
			
			header('location: userlist.php');
			
			return false;
		}
		else
		{
			return 'User does not exist!<BR> Not a user yet? Click Register to signup!';
		}
	}
	
	public function registerUser() // $full_name,$username,$email,$passwd,$directorate_code,$obsu_code,$activationcode
	{
		$User_model = new User_model();
		
		$full_name = $_REQUEST['x_full_name'];
		$username = $_REQUEST['x_username'];
		$email = $_REQUEST['x_email'];
		$passwd = $_REQUEST['x_passwd'];
		$directorate_code = $_REQUEST['x_directorate_code'];
		$obsu_code = $_REQUEST['x_obsu_code'];
		$activationcode = date("YmdHis");
		
		if($full_name <> '' && $username <> '' && $email <> '' && $passwd <> '' && $directorate_code <> '' && $obsu_code <> '')
		{
			$checkInsert = $User_model->createUser($full_name,$username,$email,$passwd,$directorate_code,$obsu_code,$activationcode);
			
			if($checkInsert > 0)
			{
				return 'User successfully added!';
			}
			else
			{
				return 'Error saving record!';
			}
		}
		else
		{
			return 'Please recheck your form and try again!';
		}
	}
	
	public function listUser()
	{
		$User_model = new User_model();
		
		$userlist = $User_model->getUser();
		
		foreach($userlist as $i=>$oData)
		{
			$html .= '<tr>';
			$html .= '<td><a href="edit.php?id=' . $oData['uid'] . '">Update</a></td>';
			$html .= '<td>' . $oData['uid'] . '</td>';
			$html .= '<td>' . $oData['full_name'] . '</td>';
			$html .= '<td>' . $oData['username'] . '</td>';
			$html .= '<td>' . $oData['email'] . '</td>';
			$html .= '<td>' . $oData['obsu_code'] . '</td>';
			$html .= '</tr>';
		}
		return $html;
	}
	
	public function sessionCheck()
	{
		if($_SESSION['s_userid'] <> '' && $_SESSION['s_full_name'] <> '')
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function sessionDestroy()
	{
		session_unset();
		session_destroy();
	}
}