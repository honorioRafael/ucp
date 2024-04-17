<?php 
    session_start();
    if(isset($_SESSION['DadosLogin_UCP'])) {
        $DadosLogin = $_SESSION['DadosLogin_UCP'];
        $ContaId = $DadosLogin['ContaId'];
    }
    else header("Location:login.php");
    $_SESSION['UCP_Pagina'] = 4;
    require("conexao.php");
    require_once("header.php");

    $sql = "SELECT * FROM `jogadores` WHERE `ContaId` = $ContaId";
    $conta = $conn->query($sql);  
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="veiculo.css">
    <title>UCP | Inventário</title>
</head>
<body>
<div class="container">
    <?php while($row = mysqli_fetch_assoc($conta)) { ?>
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
        <?php } ?>
    </div>
    <div class="infos-veh"> 
        <h2>Seus Veículos</h2>
        <div class="info_container-veh">
        <?php 
            $sql2 = "SELECT * FROM `veiculos` WHERE `ContaId` = $ContaId";
            $itens = $conn->query($sql2);
            $num = 0;
            $total = 0;
            while($row = mysqli_fetch_assoc($itens)) { 
                for($n = 0; $n < 10; $n++) {
                    if($row["VeiculoModel_".$n] != 0) { 
                        if($num == 2) {
                            echo "</div><div class='info_container-veh'>";
                            $num = 0;
                        }
                        $num++;
                        $total++;
        ?>
        <div class="conteudo-veh">
            <div class="cbc">
                <?php if(getVehCat($row["VeiculoModel_$n"]) == 1) echo "<img src='imagens/moto2.png' alt='Icone' width='35' height='35'>";
                else if(getVehCat($row["VeiculoModel_$n"]) == 2) echo "<img src='imagens/helicoptero.png' alt='Icone' width='35' height='35'>";
                else if(getVehCat($row["VeiculoModel_$n"]) == 3) echo "<img src='imagens/aviao.png' alt='Icone' width='35' height='35'>";
                else if(getVehCat($row["VeiculoModel_$n"]) == 4) echo "<img src='imagens/caminhao.png' alt='Icone' width='35' height='35'>";
                else if(getVehCat($row["VeiculoModel_$n"]) == 5) echo "<img src='imagens/navio.png' alt='Icone' width='35' height='35'>";
                else echo "<img src='imagens/Index_3.png' alt='Icone' width='35' height='35'>"; ?>
                <p class="titulo-v"><?php echo getVehicleName($row["VeiculoModel_$n"]); ?></p>
            </div>
            <img src="https://assets.open.mp/assets/images/vehiclePictures/Vehicle_<?php echo $row["VeiculoModel_$n"]; ?>.jpg" alt="Imagem do veículo" class="img_veiculo" >
            <div class="cbc2">
                <div class="cbc">
                    <p class="valor" style="color: black;">Primeira cor: <div class="cor-veiculo"><span class="txt"><?php echo $row["Cor1_$n"] ?></span><div class="mostrar-cor" style="background-color: #<?php echo $vehicleColors[$row["Cor1_$n"]]; ?>;"></div></div><p>
                </div>
                <div class="cbc">
                    <p class="valor" style="color: black;">Segunda cor: <div class="cor-veiculo"><span class="txt"><?php echo $row["Cor2_$n"] ?></span><div class="mostrar-cor" style="background-color: #<?php echo $vehicleColors[$row["Cor2_$n"]]; ?>;"></div></div><p>
                </div>
                <p class="valor" style="color: black;">Combustível: <?php echo $row["Combustivel_$n"] ?> L</p>
            </div>
        </div>       
        <?php $row["VeiculoModel_$n"]; } } } ?>
    </div>
    <?php if($total == 0) echo"<h2 style='color: red; font-size: 1em;'>Você não possui veículos!</h2>"; ?>
</div></div>
</body>
</html>