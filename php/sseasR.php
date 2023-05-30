<?php
		$servername = "tajfun.sseas.cz";
		$username = "sisr";
		$password = "BQHV6CnVbFZX2yxB";
		$dbname = "sisr";
		$sseasSupl = [];
		$sseasOzn = [];
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		mysqli_set_charset($conn, "utf8");
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = 'SELECT t.nazev as trida, s.komentar, s.hodina, p.nazev as predmet, s.pocet_hodin, u.titul, u.prijmeni, s.ucebna, s.komentar FROM suplovani s JOIN tridy t ON(t.id=s.trida) JOIN predmety p ON(p.id=s.predmet) JOIN uzivatele u ON(u.id=s.suplujici) WHERE s.datum="'.date("Y")."-".date("m")."-".date("d").'"';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$suplS = [];
				array_push($suplS, $row['trida']);
				if($row['pocet_hodin'] > 1)
					array_push($suplS, $row['hodina'].'.-'.($row['hodina']+$row['pocet_hodin']-1).'. ['.$row['predmet'].']');
				else
					array_push($suplS, $row['hodina'].'. ['.$row['predmet'].']');
				
				array_push($suplS, $row['titul'].' '.$row['prijmeni']);
				if($row['ucebna'] == NULL)
					array_push($suplS, '');
				else
					array_push($suplS, $row['ucebna']);

				array_push($suplS, $row['komentar']);
				
				array_push($sseasSupl, $suplS);
			}
		}

		$sql = 'SELECT o.nadpis,o.text,o.adresati FROM oznameni o ORDER BY o.datum DESC';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if($row['adresati'] == '')
					array_push($sseasOzn, $row['nadpis'].' - '.$row['text']);
			}
		}
?>
