<?php
class Client
{

	/*
		id - [BIGINT PRIMARY KEY AUTO_INCREMENT NOT NULL]
		name - [VARCHAR(50) NOT NULL]
		lastname - [VARCHAR(60) NOT NULL]
		address - [VARCHAR(60) NOT NULL]
		phone - [VARCHAR(13) NOT NULL]
		document - [BIGINT NOT NULL]
		document_type - [TINYINT NOT NULL]
		email - [VARCHAR(60)]
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
		$this->table_name = 'client';
		$this->showSavedMessages = true;
	}

	public function save($name, $lastname, $address, $phone, $document, $document_type, $email = null)
	{

		try {

			$sql = 'INSERT INTO `' . $this->table_name . '` SET `name` = :name, `lastname` = :lastname';
			$sql .= ', `address` = :address';
			$sql .= ', `phone` = :phone';
			$sql .= ', `document` = :document';
			$sql .= ', `document_type` = :document_type';
			$sql .= !empty($email) ? ', `email` = :email' : '';
			$sql .= ';';

			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':name', $name, PDO::PARAM_STR);
			$stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
			$stmt->bindValue(':address', $address, PDO::PARAM_STR);
			$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
			$stmt->bindValue(':document', $document, PDO::PARAM_STR);
			$stmt->bindValue(':document_type', $document_type, PDO::PARAM_STR);

			if (!empty($email)) {
				$stmt->bindValue(':email', $email, PDO::PARAM_STR);
			}

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

	public function update($id, $name, $lastname, $address, $phone, $document, $document_type, $email = null)
	{

		try {

			$sql = 'UPDATE `' . $this->table_name . '` SET `name` = :name, `lastname` = :lastname';
			$sql .= ', `address` = :address';
			$sql .= ', `phone` = :phone';
			$sql .= ', `document` = :document';
			$sql .= ', `document_type` = :document_type';
			$sql .= !empty($email) ? ', `email` = :email' : '';
			$sql .= '  WHERE `id` = :id';

			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':name', $name, PDO::PARAM_STR);
			$stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
			$stmt->bindValue(':address', $address, PDO::PARAM_STR);
			$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
			$stmt->bindValue(':document', $document, PDO::PARAM_STR);
			$stmt->bindValue(':document_type', $document_type, PDO::PARAM_STR);

			if (!empty($email)) {
				$stmt->bindValue(':email', $email, PDO::PARAM_STR);
			}

			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
		} catch (PDOException $e) {
			throw new Exception("Error trying to update record (id): {$id} on {$this->table_name} table. " . $e->getMessage());
		}
	}
}