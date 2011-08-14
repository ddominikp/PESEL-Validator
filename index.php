<!DOCTYPE html>
<html lang="pl">
	<meta charset="UTF-8" />
	<link rel="Stylesheet" type="text/css" href="style.css" />
	<title>PESEL Checker</title>
	<div class="main">
	<?php
	if($_POST){
		include("pesel.class.php");
		try{
			$p = new pesel;
			$p->setPesel($_POST['pesel']);
			if($p->isValid()){
				$p->loadData();
				echo '	<div class="correct">Podany PESEL ('.$p->getPesel().') <strong>jest</strong> poprawny.</div>
';
				echo '	<div class="info">
		Dodatkowe informacje: <br />
		Płeć: '.$p->getSex().' <br />
		Data urodzenia: '.$p->getBirthDate().' <br />
		Liczba porządkowa: '.$p->getLP().' <br />
	</div>';
			} else{
				echo '	<div class="error">Podany PESEL ('.$p->getPesel().') <strong>nie</strong> jest poprawny.</div>';
			}
		} catch(Exception $e){
			echo '	<div class="error">'.$e->getMessage().'</div>';
		}
	}
	echo '
		<form action="'.basename($_SERVER['SCRIPT_NAME']).'" method="post">
		<div class="form">
			PESEL: <input type="text" name="pesel" id="pesel" size=21 />
			<input type="submit" value="Sprawdź" onclick="getData(\'post.php?pesel=\'+document.getElementById(pesel).value, )" /><br />
		</div>
		</form>
';
?>
	</div>
	<div class="validators">
		<a href="http://validator.w3.org/check?uri=http://<?=$_SERVER['SERVER_NAME'];?><?=$_SERVER['SCRIPT_NAME'];?>" title="HTML5 Valid!"><img src="html5-valid.png" alt="HTML5 Valid!" /></a>
		<a href="http://jigsaw.w3.org/css-validator/validator?uri=http://<?=$_SERVER['SERVER_NAME'];?><?=$_SERVER['SCRIPT_NAME'];?>" title="CSS3 Valid!"><img src="css3-valid.png" alt="CSS3 Valid!" /></a>
	</div>
</html>