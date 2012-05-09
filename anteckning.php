// Lista enskild vara i sökresultat eller lista
<?php
<a href="http://localhost/php-inlamning/webbshop.php?a=00002">Loafer i brunt skinn</a>

<?php echo '<a href="//' . $_SERVER['SERVER_NAME'] . '/' . dirname($_SERVER['PHP_SELF']) .
      '/webbshop.php?a=' . $från_db['artikelnummer'] .'">' . $från_db['varunamn'] . '</a>';
