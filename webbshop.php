<?php
// Anslut till DB
require "db_connect.php";

// Välj SQL-fråga beroende på om det är sökresultat, kategori eller enskild vara som visas


if ( isset($_GET['k']) ) {
    // Lista med en kategori ska visas
    $sql = 'SELECT * FROM varor WHERE kategori = :kategori';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':kategori', $_GET['k']);
    $stmt->execute();
    $varulista = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif ( isset($_GET['s']) ) {
    // Sökning har skett

    // Ska sluta meed att variabeln varulista skapas
} else {
    if ( isset($_GET['a']) && preg_match('/^[0-9]{5}$/', $_GET['a']) ) {
        // vald vara ska visas
        // Hämta artikelnfo ur DB-tabell
        $artikelnummer = $_GET['a'];
    } else {
        // Default sida ska visas
        // Hämta artikelnfo ur DB-tabell
        $artikelnummer = "00001"; // Ev byt till slumpmässigt vald vara
    }
    $sql = 'SELECT * FROM varor WHERE artikelnummer = :artikelnummer';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':artikelnummer', $artikelnummer);
    $stmt->execute();
    $vara = $stmt->fetch(PDO::FETCH_ASSOC);
    // Hämta alla ev storlekar för enskild vara - återanvänder variabelnamn
    $sql = 'SELECT storleken FROM storlekar WHERE artikelnummer = :artikelnummer';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':artikelnummer', $artikelnummer);
    $stmt->execute();
    $storlekar = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Om $storlekar[0] är false så saknade varan storlekar
    // Om inte ska vi lägga på resten av dem
    if ( count($storlekar) ) {
        $varans_storlekar = array(); // Tag bort en nivå
        foreach ($storlekar as $st ) {
            $varans_storlekar[] = $st['storleken'];
        }
        // Gör om array till sträng
        $varans_storlekar = join(", ", $varans_storlekar);
    } else {
        $varans_storlekar = "Finns bara i en storlek";
    }
}

?>
<!DOCTYPE html >
<html lang="sv">
<head>
  <meta charset="utf-8">
  <title>{$}webbshop</title>
  <link href="webbshop.css" rel="stylesheet" type="text/css" />
  <style>	
  </style>
</head>
<body>
    
    <div class="banner">
    <p id="slogan">Always prepared!</p>
    <h1 id="rubrik">Victor.se</h1>
    </div>
    
    <div class="category">
    <h1 id="rubrik2">Victor.se</h1>

    <p id="sökformulär">
       <input type="search" placeholder="Sök efter artikel" name="s" />
       <input type="submit" value="Sök" />
    </p>
    
    <p class="kategorier">
        <a href="webbshop.php?k=accessoarer">Accessoarer</a>
    </p>
     <p class="kategorier">
        <a href="webbshop.php?k=byxor">Byxor</a>
    </p>
    <p class="kategorier">
        <a href="webbshop.php?k=skjortor">Skjortor/T-tröjor</a> 
    </p>
    <p class="kategorier">
        <a href="webbshop.php?k=skor">Skor</a>
    </p>
    <p class="kategorier">
        <a href="webbshop.php?k=tröjor">Tröjor</a>
    </p>
     
    </div>
<?php if (!empty($vara) ): ?>
    <div class="main">
      <div class="bild">
        <img src="<?php echo 'bilder/' . $vara['artikelnummer'] . '.jpg'; ?>" alt="" width="301" height="276" />
      </div>
      
      <div class="beskrivning">
        <h1><?php echo $vara['varunamn']; ?></h1>
        <p><?php echo $vara['beskrivning']; ?></p>
         <!-- Storlekar. // FRÅN DB // S, M, L, XL -->
        <h2 class="artikelnummer">Artikelnummer: <?php echo $vara['artikelnummer']; ?></h2>
      </div>

      <div class="laggtill">Lägg till
      </div>

      <div class="storlek">Välj storlek: <p><?php echo $varans_storlekar; ?></p>
      </div>
      
      <div class="recensioner"><h1>recensioner</h1>
      </div>
      
      <div class="postcomment"><h1>lägg kommentar</h1>
      </div>
      
    </div>
<?php else: // Om en lista ska visas ?>
<pre>
<?php
// Loopa igenom varulista och förvandla till HTML (tabell....?)
print_r($varulista); ?>
</pre>
<?php endif; ?>
    <div class="annons">
        <div class="kundvagn"><h1>kundvagn</h1>
        </div>

        <div class="popular"><h1>popular</h1>
        </div>

    
    </div>
</body>
</html>
