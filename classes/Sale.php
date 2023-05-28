<?php
class Sale
{
	/*
		CREATE TABLE `Sale` (
        `id` BIGINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
        `company_id` INT NOT NULL,
        `client_id` BIGINT NOT NULL,
        `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
        FOREIGN KEY (`company_id`) REFERENCES `Company` (`id`),
        FOREIGN KEY (`client_id`) REFERENCES `Client` (`id`));
	*/

	private $pdo;
	private $base_root_path;
	private $table_name;
	private $showSavedMessages;

	function __construct()
	{
		global $db_host, $db_name, $db_user, $db_pwd;
		$this->pdo = new pdo('mysql:host=' . $db_host . ';dbname=' . $db_name, $db_user, $db_pwd);
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->table_name = 'Sale';
		$this->showSavedMessages = true;
	}

	public function save($company_id, $client_id)
	{

		try {

			$sql = 'INSERT INTO `' . $this->table_name . '` SET `company_id` = :company_id, `client_id` = :client_id;';

			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':company_id', $company_id, PDO::PARAM_STR);
			$stmt->bindValue(':client_id', $client_id, PDO::PARAM_STR);

			$stmt->execute();
		} catch (PDOException $e) {
			throw new Exception("Error trying to add record to {$this->table_name} table: " . $e->getMessage());
		}
	}

	public function getAll($orderByDesc = true, $limit = 0)
	{

		$result = array();
		$orderBy = $orderByDesc ? 'DESC' : 'ASC';
		$limitString = $limit == 0 ? '' : ' LIMIT ' . $limit;

		try {
			$sql = " SELECT * FROM {$this->table_name}";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			throw new Exception("Error trying to get records from {$this->table_name} table: " . $e->getMessage());
		}

		return $result;
	}

	public function getLastIdByClient($client_id)
	{
		$result = array();

		try{
			$sql = "SELECT MAX(id) AS 'id' FROM {$this->table_name} ";
			$sql .= 'WHERE `client_id` = :client_id';
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':client_id', $client_id, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			throw new Exception("Error trying to get records from {$this->table_name} table: " . $e->getMessage());
		}

		return $result;
	}

	public function getById($id)
	{

		$result = array();

		try {
			$sql = " SELECT * FROM {$this->table_name} ";
			$sql .= ' WHERE `id` = :id';
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			throw new Exception("Error trying to get records from {$this->table_name} table: " . $e->getMessage());
		}

		return $result;
	}

	public function delete($id)
	{
		try {
			$sql = 'DELETE FROM ' . $this->table_name . ' WHERE `id` = :id';
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			throw new Exception("Error trying to delete record (id): {$id} from {$this->table_name} table. " . $e->getMessage());
		}

		return $result;
	}

	public function update($id, $company_id, $client_id)
	{

		try {

			$sql = 'UPDATE `' . $this->table_name . '` SET `company_id` = :company_id, `client_id` = :client_id';
			$sql .= '  WHERE `id` = :id';

			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':company_id', $company_id, PDO::PARAM_STR);
			$stmt->bindValue(':client_id', $client_id, PDO::PARAM_STR);

			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
		} catch (PDOException $e) {
			throw new Exception("Error trying to update record (id): {$id} on {$this->table_name} table. " . $e->getMessage());
		}
	}
}