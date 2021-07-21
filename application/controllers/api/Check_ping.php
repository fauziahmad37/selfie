<?php

include_once('Api.php');

class check_ping extends Api {
	function index() {
	echo '<table><th>Ping</th><th>Desc</th><th>IP</th><th>Port</th>';
// 	echo '<tr><td style="text-align:center">'.$this->ping('10.0.9.200').'</td><td>DB Simtax Pool Bekasi A</td><td style="text-align:right">10.0.9.200</td><td style="text-align:right">3306</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('10.0.10.200').'</td><td>DB Simtax Pool Bekasi B</td><td style="text-align:right">10.0.10.200</td><td style="text-align:right">3306</td></tr>';	
	echo '<tr><td style="text-align:center">'.$this->ping('10.0.11.200').'</td><td>DB Simtax Pool Bekasi C</td><td style="text-align:right">10.0.11.200</td><td style="text-align:right">3306</td></tr>';	
//	echo '<tr><td style="text-align:center">'.$this->ping('10.0.14.200').'</td><td>DB Simtax Pool Bekasi D</td><td style="text-align:right">10.0.14.200</td><td style="text-align:right">3306</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('10.0.19.200').'</td><td>DB Simtax Pool Cipayung</td><td style="text-align:right">10.0.19.200</td><td style="text-align:right">3306</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('10.0.26.200').'</td><td>DB Simtax Pool Pekapuran</td><td style="text-align:right">10.0.26.200</td><td style="text-align:right">3306</td></tr>';	
	echo '<tr><td style="text-align:center">'.$this->ping('10.0.3.200').'</td><td>DB Simtax Pool Jagakarsa</td><td style="text-align:right">10.0.3.200</td><td style="text-align:right">3306</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('10.0.2.200').'</td><td>DB Simtax Pool Ciganjur</td><td style="text-align:right">10.0.2.200</td><td style="text-align:right">3306</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('10.0.4.200').'</td><td>DB Simtax Pool Star</td><td style="text-align:right">10.0.4.200</td><td style="text-align:right">3306</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('10.0.5.200').'</td><td>DB Simtax Pool Joglo Lama</td><td style="text-align:right">10.0.5.200</td><td style="text-align:right">3306</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('10.0.18.200').'</td><td>DB Simtax Pool Joglo Baru</td><td style="text-align:right">10.0.18.200</td><td style="text-align:right">3306</td></tr>';
	//echo '<tr><td style="text-align:center">'.$this->ping('10.0.6.200').'</td><td>DB Simtax Pool Cipondoh A</td><td style="text-align:right">10.0.6.200</td><td style="text-align:right">3306</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('10.0.7.200').'</td><td>DB Simtax Pool Cipondoh B</td><td style="text-align:right">10.0.7.200</td><td style="text-align:right">3306</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('10.0.8.200').'</td><td>DB Simtax Pool Cipondoh C</td><td style="text-align:right">10.0.8.200</td><td style="text-align:right">3306</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('10.0.16.200').'</td><td>DB Simtax Pool Depok</td><td style="text-align:right">10.0.16.200</td><td style="text-align:right">3306</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('10.0.13.200').'</td><td>DB Simtax Pool Tangsel</td><td style="text-align:right">10.0.13.200</td><td style="text-align:right">3306</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('10.0.17.200').'</td><td>DB Simtax Pool Mustika sari</td><td style="text-align:right">10.0.17.200</td><td style="text-align:right">3306</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('10.0.27.200').'</td><td>DB Simtax Pool Pondok Bambu</td><td style="text-align:right">10.0.27.200</td><td style="text-align:right">3306</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('10.0.29.200').'</td><td>DB Simtax Pool Cipendawa</td><td style="text-align:right">10.0.29.200</td><td style="text-align:right">3306</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('10.0.31.200').'</td><td>DB Simtax Pool Bintaro</td><td style="text-align:right">10.0.31.200</td><td style="text-align:right">3306</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('10.0.32.200').'</td><td>DB Simtax Pool Padang</td><td style="text-align:right">10.0.32.200</td><td style="text-align:right">3306</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('10.1.89.30').'</td><td>DB Simtax Pusat</td><td style="text-align:right">10.1.89.30</td><td style="text-align:right">3306</td></tr>';	
	echo '<tr><td style="text-align:center">'.$this->ping('dice.expressgroup.co.id', 5432).'</td><td>DB Dice Eagle</td><td style="text-align:right">'.gethostbyname('dice.expressgroup.co.id').'</td><td style="text-align:right">5432</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('dice.expressgroup.co.id', 8181).'</td><td>App Dice Eagle</td><td style="text-align:right">'.gethostbyname('dice.expressgroup.co.id').'</td><td style="text-align:right">8181</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('dicetiara.expressgroup.co.id', 5432).'</td><td>DB Dice Tiara</td><td style="text-align:right">'.gethostbyname('moce.expressgroup.co.id').'</td><td style="text-align:right">5432</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('dicetiara.expressgroup.co.id', 8181).'</td><td>App Dice Tiara</td><td style="text-align:right">'.gethostbyname('moce.expressgroup.co.id').'</td><td style="text-align:right">8181</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('eagle.expressgroup.co.id', 5432).'</td><td>DB Eagle RDS</td><td style="text-align:right">'.gethostbyname('eagle.expressgroup.co.id').'</td><td style="text-align:right">5432</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('eagle.expressgroup.co.id', 80).'</td><td>App Eagle RDS</td><td style="text-align:right">'.gethostbyname('eagle.expressgroup.co.id').'</td><td style="text-align:right">80</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('tiara.expressgroup.co.id', 5432).'</td><td>DB Tiara RDS</td><td style="text-align:right">'.gethostbyname('tiara.expressgroup.co.id').'</td><td style="text-align:right">5432</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('tiara.expressgroup.co.id', 80).'</td><td>App Tiara RDS</td><td style="text-align:right">'.gethostbyname('tiara.expressgroup.co.id').'</td><td style="text-align:right">80</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('enigmadb.expressgroup.co.id').'</td><td>DB Enigma</td><td style="text-align:right">'.gethostbyname('enigmadb.expressgroup.co.id').'</td><td style="text-align:right">3306</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('enigma.expressgroup.co.id', 80).'</td><td>App Enigma</td><td style="text-align:right">'.gethostbyname('enigma.expressgroup.co.id').'</td><td style="text-align:right">80</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('moce.expressgroup.co.id', 5432).'</td><td>DB Moce Reguler</td><td style="text-align:right">'.gethostbyname('moce.expressgroup.co.id').'</td><td style="text-align:right">5432</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('moce.expressgroup.co.id', 80).'</td><td>App Moce Reguler</td><td style="text-align:right">'.gethostbyname('moce.expressgroup.co.id').'</td><td style="text-align:right">80</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('dice.expressgroup.co.id', 80).'</td><td>DB + App Moce Eagle</td><td style="text-align:right">'.gethostbyname('dice.expressgroup.co.id').'</td><td style="text-align:right">80</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('dicetiara.expressgroup.co.id', 80).'</td><td>DB + App Moce Tiara</td><td style="text-align:right">'.gethostbyname('dicetiara.expressgroup.co.id').'</td><td style="text-align:right">80</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('rental.expressgroup.co.id', 5432).'</td><td>DB Rental</td><td style="text-align:right">'.gethostbyname('rental.expressgroup.co.id').'</td><td style="text-align:right">5432</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('rental.expressgroup.co.id', 8282).'</td><td>App Rental</td><td style="text-align:right">'.gethostbyname('rental.expressgroup.co.id').'</td><td style="text-align:right">8282</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('carhire.expressgroup.co.id', 80).'</td><td>App Carhire</td><td style="text-align:right">'.gethostbyname('carhire.expressgroup.co.id').'</td><td style="text-align:right">80</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('carhiredb.expressgroup.co.id', 1521).'</td><td>DB Carhire</td><td style="text-align:right">'.gethostbyname('carhiredb.expressgroup.co.id').'</td><td style="text-align:right">1521</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('workshop.expressgroup.co.id', 80).'</td><td>App Workshop</td><td style="text-align:right">'.gethostbyname('workshop.expressgroup.co.id').'</td><td style="text-align:right">80</td></tr>';
	echo '<tr><td style="text-align:center">'.$this->ping('workshop.expressgroup.co.id', 5432).'</td><td>DB Workshop</td><td style="text-align:right">'.gethostbyname('workshop.expressgroup.co.id').'</td><td style="text-align:right">5432</td></tr>';
	echo '</table>';

	}
	
	function ping($host, $port = 3306, $timeout = 10) { 
	  $tB = microtime(true); 
	  $fP = @fSockOpen($host, $port, $errno, $errstr, $timeout); 
	  if (!$fP) { return "down"; } 
	  $tA = microtime(true); 
	  return round((($tA - $tB) * 1000), 0)." ms"; 
	}

}
?>