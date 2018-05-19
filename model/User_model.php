<?php
class User_model extends DAO
{
	public function getUser($id = null)
	{
		if($id == null)
		{
			$sql = 'SELECT * FROM users WHERE deleted<>1';
		}
		else
		{
			$sql = 'SELECT * FROM users WHERE uid=:id AND deleted<>1';
		}
		
		$this->openDB();
		$this->prepareQuery($sql);
		if($id <> null)
		{
			$this->bindQueryParam(':id',$id);
		}
		$result = $this->executeQuery();
		$this->closeDB();
		return $result;	
	}
	
	public function createUser($full_name,$username,$email,$passwd,$directorate_code,$obsu_code,$activationcode)
	{
		$sql = '
		INSERT INTO users(
		full_name,
		username,
		email,
		passwd,
		directorate_code,
		obsu_code,
		activationcode,
		date_registered,
		last_modified,
		last_modified_by
		)
		VALUES
		(
		"'.$full_name.'",
		"'.$username.'",
		"'.$email.'",
		MD5("'.$passwd.'"),
		"'.$directorate_code.'",
		"'.$obsu_code.'",
		"'.$activationcode.'",
		NOW(),
		NOW(),
		99
		)
		';
		$this->openDB();
		$this->prepareQuery($sql);
		$this->beginTrans();
		$result = $this->executeUpdate();
		if($result)
		{
			$this->commitTrans();
			$execs = 1;
		}
		else{
			$this->rollbackTrans();
			$execs = 0;
		}
		$this->closeDB();
		return $execs;
	}
	
	public function updateUser($id,$full_name,$passwd,$directorate_code,$obsu_code)
	{
		$sql = '
		UPDATE users
		SET
		full_name=:full_name,
		passwd=MD5(:passwd),
		directorate_code=:directorate_code,
		obsu_code=:obsu_code
		WHERE
		uid=:uid
		';
		$this->openDB();
		$this->prepareQuery($sql);
		$this->bindQueryParam(':uid',$id);
		$this->bindQueryParam(':full_name',$full_name);
		$this->bindQueryParam(':passwd',$passwd);
		$this->bindQueryParam(':directorate_code',$directorate_code);
		$this->bindQueryParam(':obsu_code',$obsu_code);
		$this->beginTrans();
		$result = $this->executeUpdate();
		if($result)
		{
			$this->commitTrans();
			$execs = 1;
		}
		else{
			$this->rollbackTrans();
			$execs = 0;
		}
		$this->closeDB();
		return $execs;
	}
	
	public function deleteUser($id)
	{
		$sql = '
		UPDATE users
		SET
		deleted=1
		WHERE
		uid=:uid
		';
		$this->openDB();
		$this->prepareQuery($sql);
		$this->bindQueryParam(':uid',$id);
		$this->beginTrans();
		$result = $this->executeUpdate();
		if($result)
		{
			$this->commitTrans();
			$execs = 1;
		}
		else{
			$this->rollbackTrans();
			$execs = 0;
		}
		$this->closeDB();
		return $execs;
	}
	
	public function countUser($username,$passwd)
	{
		$sql = 'SELECT uid,COUNT(uid) as counterz FROM users WHERE username=:username AND passwd=MD5(:passwd) AND deleted<>1';
		
		$this->openDB();
		$this->prepareQuery($sql);
		$this->bindQueryParam(':username',$username);
		$this->bindQueryParam(':passwd',$passwd);
		$result = $this->executeQuery();
		$this->closeDB();
		return array(
			'uid' => $result[0]['uid'],
			'counterz' => $result[0]['counterz']
		);
	}
}