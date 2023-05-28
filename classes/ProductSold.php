<?php
class ProductSold
{
	/*
		CREATE TABLE `Product_sold` (
		`sale_id` BIGINT NOT NULL,
		`product_id` INT NOT NULL,
		`amount` TINYINT NOT NULL,
		FOREIGN KEY (`sale_id`) REFERENCES `Sale` (`id`),
		FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`));
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
		$this->table_name = 'Product_sold';
		$this->showSavedMessages = true;
	}

	public function save($sale_id, $product_id, $amount)
	{

		try {

			$sql = 'INSERT INTO `' . $this->table_name . '` SET `sale_id` = :sale_id, `product_id` = :product_id, `amount` = :amount;';

			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':sale_id', $sale_id, PDO::PARAM_STR);
			$stmt->bindValue(':product_id', $product_id, PDO::PARAM_STR);
			$stmt->bindValue(':amount', $amount, PDO::PARAM_STR);

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

	public function getAllProductsBySale($sale_id){
		$result = array();

		try {
			$sql = " SELECT * FROM {$this->table_name} ";
			$sql .= ' WHERE `sale_id` = :sale_id';
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':sale_id', $sale_id, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

	public function update($id, $sale_id, $product_id, $amount)
	{

		try {

			$sql = 'UPDATE `' . $this->table_name . '` SET `sale_id` = :sale_id, `product_id` = :product_id, `amount` = :amount';
			$sql .= '  WHERE `id` = :id';

			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':sale_id', $sale_id, PDO::PARAM_STR);
			$stmt->bindValue(':product_id', $product_id, PDO::PARAM_STR);
			$stmt->bindValue(':amount', $amount, PDO::PARAM_STR);

			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
		} catch (PDOException $e) {
			throw new Exception("Error trying to update record (id): {$id} on {$this->table_name} table. " . $e->getMessage());
		}
	}
}