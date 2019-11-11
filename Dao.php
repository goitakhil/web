<?php
require_once 'KLogger.php';

class Dao {
	private $host = "localhost";
	private $db = "loginstore";
	private $user = "root";
	private $pass = "";
	protected $logger;

	public function __construct () {
		$this->logger = new KLogger ( "log.txt" , KLogger::DEBUG );
	}
	public function getConnection () {
		$this->logger->LogDebug("Getting a connection.");
		try {
			$conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,$this->pass);
		} catch (Exception $e) {
			$this->logger->LogError(__CLASS__ . "::" . __FUNCTION__ . " The database exploded " . print_r($e,1));
			echo print_r($e,1);
			exit;
		}
		return $conn;
	}

	public function getUser ($email) {
	$this->logger->LogWarn("getting User [{$email}]");
	$conn = $this->getConnection();
	$q = $conn->prepare("SELECT count(email) from usersdata where email = :email");
	$q->bindParam(":email", $email);
	$q->execute();
	$user= $q->fetchColumn();
	return $user;
}

	public function getid ($email, $password) {
	 $this->logger->LogWarn("getting User [{$email}]");
	$conn = $this->getConnection();
	$q = $conn->prepare("SELECT id from usersdata where email = :email And password = :password");
	$q->bindParam(":email",$email);
	$q->bindParam(":password",$password);
	$q->execute();
	$user= $q->setFetchMode(PDO::FETCH_ASSOC);
	$user= $q->fetch();
	return $user;
}


	public function createUser ($email, $password, $password2) {
        $this->logger->LogInfo("getting password [{$email}]");
        $conn = $this->getConnection();
				$saveQuery = "INSERT into usersdata ( email, password, password2) values (:email, :password, :password2)";
        $q = $conn->prepare($saveQuery);
				$q->bindParam(":email", $email);

  			$q->bindParam(":password", $password);

				$q->bindParam(":password2", $password2);
        $q->execute();
      }

			public function verify_Password ($email, $password){
				$this->logger->LogInfo("getting password [{$email}]");
        $conn = $this->getConnection();
				$q = $conn->prepare("SELECT count(email) from usersdata where email = :mail And  password = :password");
				$q->bindParam(":mail", $email);

  			$q->bindParam(":password", $password);
        $q->execute();
				$password = $q->fetchColumn();
				return $password;
			}


	}
	?>
