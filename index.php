<?php 
    sleep(1);
    session_start();
    if(isset($_SESSION['DadosLogin_UCP'])) {
        $DadosLogin = $_SESSION['DadosLogin_UCP'];
        $ContaId = $DadosLogin['ContaId'];
    }
    else header("Location:login.php");
    $_SESSION['UCP_Pagina'] = 1;
    require("conexao.php");
    require_once("header.php");

    $sql = "SELECT * FROM `jogadores` WHERE `ContaId` = $ContaId";
    $conta = $conn->query($sql);   

    $color = '#4CAF50';
    $progressPercentage = 100;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>UCP | Home</title>
</head>
<body>
    <?php while($row = mysqli_fetch_assoc($conta)) { 
        if($row["VIP"] == 1) {
            $strvip = "<font color='green'>Sim";
        }    
        else {
            $strvip = "<font color='red'>Não";
        }
    ?>
    <div class="container">
    <div class="conta_container">
        <div class="resto">
        <h2><?php echo $row["Nome"]; ?> [ <?php echo $row["ContaId"]; ?> ]</h2>
        <img src='https://assets.open.mp/assets/images/skins/<?php echo $row["Skin"] ?>.png' alt="Skin" height="200px">
        <div class="informacao"><p class="info">Level:</p> <p class="valor"><?php echo $row["Level"]; ?></p></div></div>
        <div class="pg">
            <div class="progress-bar" style="width: <?php echo ($row["Fome"] / 200) * 100; ?>%; background-color: #19B519;">Fome</div>
            <?php if($row["Fome"] < 200) { ?><div class="c-progress-bar" style="width: <?php echo 100 - (($row["Fome"] / 200) * 100); ?>%;"></div> <?php } ?>
        </div>
        <div class="pg">
            <div class="progress-bar" style="width: <?php echo ($row["Sede"] / 100) * 100; ?>%; background-color: #4169E1;">Sede</div>
            <?php if($row["Sede"] < 100) { ?><div class="c-progress-bar" style="width: <?php echo 100 - (($row["Sede"] / 100) * 100); ?>%;"></div> <?php } ?>
        </div>
        <div class="pg">
            <?php if($row["Sono"] < 300) { ?><div class="progress-bar" style="width: <?php echo ($row["Sono"] / 300) * 100; ?>%; background-color: #ccafaf;">Sono</div>
            <div class="c-progress-bar" style="width: <?php echo 100 - (($row["Sono"] / 300) * 100); ?>%;"></div> <?php } ?>
        </div>
    </div>

    <div class="infos"> 
        <h2>Visão Geral</h2>
        <div class="info_container-main">
            <div class="conteudo-main"><p class="titulo">Dinheiro</p> <p class="valor" style="color: #19B519;">$<?php echo formatNumber($row["Dinheiro"]); ?></p></div>
            <div class="conteudo-main"><p class="titulo">Dinheiro no Banco</p> <p class="valor" style="color: #19B519;">$<?php echo formatNumber($row["DinheiroBanco"]); ?></p></div>
            <div class="conteudo-main"><p class="titulo">Coins</p> <p class="valor" style="color: #daa520;">R$<?php echo formatNumber($row["Coins"]); ?></p></div>
        </div>
        <div class="info_container-main">
            <div class="conteudo-main"><p class="titulo">EXP</p> <p class="valor"><?php echo $row["EXP"]; ?></p></div>
            <div class="conteudo-main"><p class="titulo">Procura</p> <p class="valor"><?php echo $row["Procura"]; ?></p></div>
            <div class="conteudo-main"><p class="titulo">Pontos com a Máfia</p> <p class="valor" style="color: #c93e3e;"><?php echo formatNumber($row["PontosMafia"]); ?></p></div>
        </div>
        <div class="info_container-main">
            <div class="conteudo-main"><p class="titulo">Inibidor de Fome</p> <p class="valor"><?php echo converterSegundos($row["UsandoInibidorFome"]); ?></p></div>
            <div class="conteudo-main"><p class="titulo">Inibidor de Sede</p> <p class="valor"><?php echo converterSegundos($row["UsandoInibidorSede"]); ?></p></div>
            <div class="conteudo-main"><p class="titulo">Conta VIP</p> <p class="valor"><?php echo $strvip; ?></p></div>
        </div>
    </div>
    <?php } ?>
</div>
</body>
</html>
