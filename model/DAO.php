<?php
class DAO
{
	protected $db_conn;
	private $stmt;
	
	protected function openDB()
	{
		try
		{
			$conn_str = 'mysql:dbname='.DBNAME.';host='.DBHOST.';port='.DBPORT.';';
			$this->db_conn = new PDO($conn_str,DBUSERNAME,DBPASSWORD);
		}
		catch(PDOException $e)
		{
			echo '<pre>';
			print_r($this->db_conn->errorInfo(). ' ' . $e);
			echo '</pre>';
		}
	}
	
	protected function closeDB()
	{
		$this->db_conn = null;
	}
	
	protected function prepareQuery($sql)
	{
		$this->stmt = $this->db_conn->prepare($sql);
	}
	
	protected function bindQueryParam($param,$value)
	{
		$this->stmt->bindParam($param,$value);
	}
	
	protected function executeQuery()
	{
		$this->stmt->execute();
		return $this->stmt->fetchAll();
	}
	
	protected function executeUpdate()
	{
		try
		{
			return $this->stmt->execute();
		}
		catch(PDOException $e)
		{
			echo '<pre>';
			print_r($e);
			echo '</pre>';
		}
	}
	
	protected function beginTrans()
	{
		$this->db_conn->beginTransaction();
	}
	
	protected function commitTrans()
	{
		$this->db_conn->commit();
	}
	
	protected function rollbackTrans()
	{
		$this->db_conn->rollBack();
	}
}