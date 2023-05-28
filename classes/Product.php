<?php
class Product
{
	/*
		CREATE TABLE `Product` (
		id - [INT PRIMARY KEY AUTO_INCREMENT NOT NULL]
		name - [VARCHAR(50) NOT NULL]
		nup [INT NOT NULL]
		makerId - [INT NOT NULL]
		categoryId - [INT NOT NULL]
		price - [INT NOT NULL]
		details - [TEXT NULL]
		created_at - [TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL]

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
		$this->table_name = 'Product';
		$this->showSavedMessages = true;
	}

	public function save($name, $nup, $maker_id, $category_id, $price, $details = null)
	{

		try {

			$sql = 'INSERT INTO `' . $this->table_name . '` SET `name` = :name, `nup` = :nup, `maker_id` = :maker_id, `category_id` = :category_id, `price` = :price';
			$sql .= !empty($details) ? ', `details` = :details' : '';
			$sql .= ';';

			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':name', $name, PDO::PARAM_STR);
			$stmt->bindValue(':nup', $nup, PDO::PARAM_STR);
			$stmt->bindValue(':maker_id', $maker_id, PDO::PARAM_STR);
			$stmt->bindValue(':category_id', $category_id, PDO::PARAM_STR);
			$stmt->bindValue(':price', $price, PDO::PARAM_STR);

			if (!empty($details)) {
				$stmt->bindValue(':details', $details, PDO::PARAM_STR);
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

	public function update($id, $name, $nup, $maker_id, $category_id, $price, $details = null)
	{

		try {

			$sql = 'UPDATE `' . $this->table_name . '` SET `name` = :name, `nup` = :nup, `maker_id` = :maker_id, `category_id` = :category_id, `price` = :price';
			$sql .= !empty($birthday) ? ', `details` = :details' : '';
			$sql .= '  WHERE `id` = :id';

			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':name', $name, PDO::PARAM_STR);
			$stmt->bindValue(':nup', $nup, PDO::PARAM_STR);
			$stmt->bindValue(':maker_id', $maker_id, PDO::PARAM_STR);
			$stmt->bindValue(':category_id', $category_id, PDO::PARAM_STR);
			$stmt->bindValue(':price', $price, PDO::PARAM_STR);

			if (!empty($email)) {
				$stmt->bindValue(':details', $details, PDO::PARAM_STR);
			}

			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
		} catch (PDOException $e) {
			throw new Exception("Error trying to update record (id): {$id} on {$this->table_name} table. " . $e->getMessage());
		}
	}
}