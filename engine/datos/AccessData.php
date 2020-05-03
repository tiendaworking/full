<?php
class AccessData {
	public static $tablename = "access";


	public function AccessDataB(){
		$this->name = "";
		$this->lastname = "";
		$this->email = "";
		$this->password = "";
		$this->created_at = "NOW()";
	}

	public static function add($id){
		$sql = "insert into ".self::$tablename." (user_id,created_at) ";
		$sql .= "value ($id,NOW())";
		return Executor::doit($sql);
	}

	public static function deleteFromUserId($id){
		$sql = "delete from ".self::$tablename." where user_id=$id";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new AccessData());
	}

	public static function getAllByUserId($id){
		echo $id;
		$sql = "select * from ".self::$tablename." where user_id=$id";
		echo $sql;
		$query = Executor::doit($sql);
		//return Model::many($query[0],new AccessData());		
		return Model::one($query[0],new AccessData());				
	}



}

?>