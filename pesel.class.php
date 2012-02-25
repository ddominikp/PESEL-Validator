<?php
class pesel{
	private $pesel;
	private $sex;
	private $birthdate;
	private $lp;
	
	function setPesel($pesel){
		if(is_numeric($pesel)){
			if(strlen($pesel)==11){
				$this->pesel = $pesel;
				return true;
			} else throw new Exception("The length of given PESEL number is wrong!");
		} else throw new Exception("PESEL is not numeric!");
	}
	function getPesel(){
		if($this->pesel) return $this->pesel;
		else return false;
	}
	function getSex(){
		if($this->sex == "M") return "Male";
		if($this->sex == "F") return "Female";
	}
	function getBirthDate(){
		return $this->birthdate;
	}
	function getLP(){
		return $this->lp;
	}
	function isValid(){
		if(empty($this->pesel)) throw new Exception("You have to set PESEL number first");
		$pesel = $this->pesel;
 		$w = array(1,3,7,9);
 		for($i=0;$i<=9;$i++)
 			$wk=($wk+$pesel[$i]*$w[$i % 4]) % 10;
 		$k = (10-$wk) % 10;
 		if ($pesel[10]==$k) return true;
 		else return false;
	}
	function loadData(){
		if($this->isValid($this->pesel)){
			$y = substr($this->pesel, 0,2);
			$m = substr($this->pesel, 2,2);
			$d = substr($this->pesel, 4,2);
			$this->sex = ($this->pesel[9]%2==0) ? "F" : "M";
			if($m>12){
				if($m>80 && $m<93) $this->birthdate = $d.'.'.($m-80).'.'.'18'.$y;
				if($m>20 && $m<33) $this->birthdate = $d.'.'.($m-20).'.'.'20'.$y;
				if($m>40 && $m<53) $this->birthdate = $d.'.'.($m-40).'.'.'21'.$y;
				if($m>60 && $m<73) $this->birthdate = $d.'.'.($m-60).'.'.'22'.$y;
			} else $this->birthdate = $d.'.'.$m.'.'.'19'.$y;
			$this->lp = substr($this->pesel, 6,3);
		}
	}
}
?>