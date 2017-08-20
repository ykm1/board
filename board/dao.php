<?php
require_once 'dto.php';
class boardDao {
	private $conn = null;
	public function connect() { // db 연결하는 함수
		try {
			$this->conn = new PDO ( 'mysql:host=localhost;dbname=mydb;charset=utf8', 'hr', 'hr' );
			$this->conn->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$this->conn->setAttribute ( PDO::ATTR_EMULATE_PREPARES, false );
		} catch ( PDOException $e ) {
			print $e->getMessage ();
		}
	}
	public function disconnect() { // db 끊어주는 함수
		$this->conn = null;
	}
	public function insert($article) {
		$this->connect();
		try{
			$sql = "insert into board values(null,now(),?,?,?,?,?)";
			$stm = $this->conn->prepare($sql);
			$stm->bindValue (1, $article->getTitle ());
			$stm->bindValue (2, $article->getContent ());
			$stm->bindValue (3, $article->getWriter ());
			$stm->bindValue (4, $article->getCategory ());
			$stm->bindValue (5, $article->getParent ());
			$stm->execute();							
		}catch (PDOException $e){	
			print $e->getMessage();
		}
		$this->disconnect();
	}
	public function selectByNum($num) {
		$a = null;
		$this->connect();
		try{
			$sql = "select * from board where num=?";
			$stm = $this->conn->prepare($sql);
			$stm->bindValue (1, $num);
			$stm->execute();
			$cnt = $stm->rowCount();
			if($cnt >0){
				$row = $stm->fetch(PDO::FETCH_ASSOC);
				$a = new Article($row ['num'], $row ['wdate'], $row ['title'], $row ['content'], $row ['writer'], $row ['category']);
			}
		}catch (PDOException $e){
			print $e->getMessage();
		}
		$this->disconnect();
		return $a;
	}
	public function selectByWriter($writer) {
		$arr = array();
		$this->connect();
		try{
			$sql = "select * from board where writer=?";
			$stm = $this->conn->prepare($sql);
			$stm->bindValue (1, $writer);
			$stm->execute();
			$cnt = $stm->rowCount();
			if($cnt >0){
				while ($row = $stm->fetch(PDO::FETCH_ASSOC)){
				$arr[] = new Article($row ['num'], $row ['wdate'], $row ['title'], $row ['content'], $row ['writer'], $row ['category']);
				}
			}
		}catch (PDOException $e){
			print $e->getMessage();
		}
		$this->disconnect();
		return $arr;
	}
	public function selectByCategory($category) {
		$arr = array ();
		$this->connect ();
		try {
			$sql = "select * from board where category=?";
			$stm = $this->conn->prepare( $sql );
			$stm->bindValue(1, $category);
			$stm->execute();
			$cnt = $stm->rowCount ();
			if ($cnt > 0) {
				while ( $row = $stm->fetch ( PDO::FETCH_ASSOC ) ) {
					$arr [] = new Article( $row ['num'], $row ['wdate'], $row ['title'], $row ['content'], $row ['writer'], $row ['category']);
				}
			}
		} catch ( Exception $e ) {
			print $e->getMessage ();
		}
		$this->disconnect ();
		return $arr;
	}
	public function selectByTitle($title) {
		$arr = array ();
		$this->connect ();
		try {
			$sql = "select * from board where title like '%".$title."%'";
			$stm = $this->conn->prepare ( $sql );
			$stm->execute();
			$cnt = $stm->rowCount ();
			if ($cnt > 0) {
				while ( $row = $stm->fetch ( PDO::FETCH_ASSOC ) ) {
					$arr [] = new Article( $row ['num'], $row ['wdate'], $row ['title'], $row ['content'], $row ['writer'], $row ['category']);
				}
			}
		} catch ( Exception $e ) {
			print $e->getMessage ();
		}
		$this->disconnect ();
		return $arr;
	}
	public function selectAll() {
		$arr = array ();
		$this->connect ();
		try {
			$sql = "select * from board";
			$stm = $this->conn->prepare( $sql );
			$stm->execute();
			$cnt = $stm->rowCount ();
			if ($cnt > 0) {
				while ( $row = $stm->fetch ( PDO::FETCH_ASSOC ) ) {
					$arr [] = new Article( $row ['num'], $row ['wdate'], $row ['title'], $row ['content'], $row ['writer'], $row ['category']);
				}
			}
		} catch ( Exception $e ) {
			print $e->getMessage ();
		}
		$this->disconnect ();
		return $arr;
	}
	public function update($article){
		$this->connect();
		try{
			$sql = "update board set wdate=now(), title=?, content=?, category=? where num=?";
			$stm = $this->conn->prepare ($sql);
			$stm->bindValue (1, $article->getTitle ());
			$stm->bindValue (2, $article->getContent ());
			$stm->bindValue (3, $article->getCategory ());
			$stm->bindValue (4, $article->getNum ());
			$stm->execute();
		}catch (PDOException $e){
			print $e->getMessage();
		}
		$this->disconnect();
	}
	public function delete($num){
		$this->connect();
		try{
			$sql = "delete from board where num=?";
			$stm = $this->conn->prepare ($sql);
			$stm->bindValue (1, $num);
			$stm->execute();
		}catch (PDOException $e){
			print $e->getMessage();
		}
		$this->disconnect();
	}
}
?>