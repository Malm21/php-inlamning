<?php
// Anslut till DB
// Hämta artiikelnfo ur DB-tabell

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
    <p id="slogan">Always be prepared!</p>
    <h1 id="rubrik">Victor.se</h1>
    </div>
    
    <div class="category">
    <h1 id="rubrik2">Victor.se</h1>

    <p id="sökformulär">
       <input type="search" placeholder="Sök efter artikel" name="s" />
       <input type="submit" value="Sök" />
    </p>
    
    <p class="kategorier">
        Accessoarer
    </p>
     <p class="kategorier">
        Byxor
    </p>
    <p class="kategorier">
        Skjortor
    </p>
    <p class="kategorier">
        Tröjor
    </p>
    <p class="kategorier">
        Övrigt
    </p>
     
    </div>

    <div class="main">
      <?php echo $artinfo; ?>
      <div id="bild"><h1>BILD</h1>
      </div>
      
    </div>

    <div class="annons">
    </div>
</body>
</html>
