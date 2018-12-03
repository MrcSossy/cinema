<?php
	$HOST = 'localhost';
	$USER = 'root';
	$PASS = '';
	$DBNM = 'cinema';
	
	$connection = mysqli_connect($HOST, $USER, $PASS, $DBNM) or die('Errore di connessione al database');
	
	$QID = $_REQUEST["id"];
	$QUSER = $_REQUEST["user"];
	$QPASS = $_REQUEST["pass"];
	$QNOME = $_REQUEST["nome"];
	$QCOGNOME = $_REQUEST["cognome"];

	if ($QUSER == "" || $QPASS == "" || $QNOME == "" || $QCOGNOME == "" || $QID == "") {
		echo "<script>alert('Non puoi lasciare vuoti dei campi.')</script>";
	}
	
	if (isset($_REQUEST["menu"])){
		switch ($_REQUEST["menu"]) {
			case 'Inserisci':        
				if ($QUSER == "" || $QPASS == "" || $QNOME == "" || $QCOGNOME == ""){
					echo "<script>alert('Non puoi lasciare vuoti dei campi.')</script>";
				}
				else{
					$query_insert = "INSERT INTO $TABQ (user, password, nome, cognome) VALUES ('$QUSER', '$QPASS', '$QNOME', '$QCOGNOME')";
					mysqli_query($connection,$query_insert);
				}
				break;
			
			case 'Modifica':        
				if ($QUSER == "" || $QPASS == "" || $QNOME == "" || $QCOGNOME == "" || $QID == ""){
					echo "<script>alert('Non puoi lasciare vuoti dei campi.')</script>";
				}
				else{
						$query_edit = "UPDATE $TABQ SET user='$QUSER', password='$QPASS', nome='$QNOME', cognome='$QCOGNOME' WHERE id='$QID'";
						mysqli_query($connection,$query_edit);
				}
				break;
			
			case 'Cancella':
				if ($QID == ""){
					echo "<script>alert('Non puoi lasciare vuoti dei campi.')</script>";
				}
				else{
					$query_delete = "DELETE FROM $TABQ WHERE id='$QID'";
					mysqli_query($connection,$query_delete);
				}
				break;
			
			default:
				die("Non puoi lasciare vuota l'opzione");
		}
	}

	$query_table = "SELECT * from proiezione";
	$result = mysqli_query($connection,$query_table) or die('Errore nella tabella.');

	$numrows = mysqli_num_rows($result);
	echo "<table><tr><td colspan='5'>Database: $DBNM <br> Tabella: $TABQ</td></tr>";
	echo "<tr><td>ID</td><td>USER</td><td>PASSWORD</td><td>NOME</td><td>COGNOME</td></tr>";
	while ($row = mysqli_fetch_array($result))
	{
		echo '<tr><td>' . $row['id'] . '</td><td>' . $row['user'] . '</td><td>' . $row['password'] . '</td>';
		echo '<td>' . $row['nome'] . '</td><td>' . $row['cognome'] . '</td></tr>';
	}
	echo "</table>";

	mysqli_close($connection);
?>