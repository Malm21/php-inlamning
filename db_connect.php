<?php
/**
 * Hur man ansluter till en databas
 *
 * Följande SQL har körts som förberedelse:
 * GRANT ALL ON 'blogg'.* TO 'php_demo_user'@'localhost'IDENTIFIED BY 'bad_pw;
 */

$mysqldb   = 'te-12-victormalm';
$mysqluser = 'te-12-victormalm';
$mysqlpass = '89f0739c4c';

$dbh = new PDO('mysql:host=localhost;dbname=' . $mysqldb, $mysqluser, $mysqlpass);

 // Drakonisk felhantering är bra för nybörjare (kan undvikas med try-catch)
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Om vi jobbar med UTF-8 i databasen, så måste detta också gälla för uppkopplingen
$dbh->query("SET NAMES 'utf8' COLLATE 'utf8_swedish_ci'");


