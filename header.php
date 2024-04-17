<?php
    if(isset($_SESSION['UCP_Pagina'])) {
        $Pagina = $_SESSION['UCP_Pagina'];
    }
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="header.css">
</head>
<body>
<header>
<a href="index.php" class="none"><h1>The Relaxing Place</h1></a>
<ul>
    <li><a href="index.php"<?php if($Pagina == 1) echo "class='sel'"; ?>>Visão Geral</a></li>
    <li><a href="inventario.php"<?php if($Pagina == 2) echo "class='sel'"; ?>>Inventário</a></li>
    <li><a href="veiculos.php"<?php if($Pagina == 4) echo "class='sel'"; ?>>Veiculos</a></li>
    <li><a href="ranking.php"<?php if($Pagina == 5) echo "class='sel'"; ?>>Ranking</a></li>
<?php
    if(isset($_SESSION['DadosLogin_UCP'])) {
        $DadosLogin = $_SESSION['DadosLogin_UCP']; ?>
        <li><a href="deslogar.php">Logado: <b><?php echo $DadosLogin["Nome"]; ?></b></a></li>
    <?php }     
    else {
       if($Pagina == 3) echo "<li><a href='login.php' class='sel'>LOGIN</a></li>";
       else echo "<li><a href='login.php'>LOGIN</a></li>";
    }    
?>
</ul>
</header>
</body>
</html>
