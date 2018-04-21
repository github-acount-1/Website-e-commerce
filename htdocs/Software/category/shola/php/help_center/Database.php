<?php

include 'config.php';


class Database {

	protected $server_name;
	protected $username;

	protected $db;
	protected $pass;

	protected $dsn;

	public $connection;

	protected $opt = [
					    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
					    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
					    PDO::ATTR_EMULATE_PREPARES   => false,
					];

	public function __construct(){
		$this->server_name = SERVER_NAME;
		$this->username = USERNAME;
		$this->db = DB_NAME;
		$this->pass = PASSWORD;

		$this->dsn = "mysql:host=$this->server_name;dbname=$this->db;charset=utf8mb4";

		$this->connection = $this->connect($this->server_name, $this->username, $this->db, $this->pass);
	}


	public function connect($server_name, $username, $db, $pass){
		$pdo = new PDO($this->dsn, $this->username, $this->pass, $this->opt);

		return $pdo;
	}

	public function update($sql, $params=[]){
		$stmt = $this->connection->prepare($sql);
		$result = $stmt->execute($params);	

		return $result;
	}

	public function select($sql, $params=[]){
		$stmt = $this->connection->prepare($sql);
		$stmt->execute($params);	

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function delete($sql, $params=[]){
		$stmt = $this->connection->prepare($sql);
		$stmt->execute($params);					

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	public function insert($sql, $params=[]){
		$stmt = $this->connection->prepare($sql);
		$stmt->execute($params);			

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

}