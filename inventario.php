<?php 
    session_start();
    if(isset($_SESSION['DadosLogin_UCP'])) {
        $DadosLogin = $_SESSION['DadosLogin_UCP'];
        $ContaId = $DadosLogin['ContaId'];
    }
    else header("Location:login.php");
    $_SESSION['UCP_Pagina'] = 2;
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
        <span>Cor do veículo de inventário</span>
        <div class="cbc-inv">
            <p class="valor">Primeira cor: <div class="cor-veiculo"><span class="txt"><?php echo $row["Cor1_vinv"] ?></span><div class="mostrar-cor" style="background-color: #<?php echo $vehicleColors[$row["Cor1_vinv"]]; ?>;"></div></div><p>
        </div>
        <div class="cbc-inv">
            <p class="valor">Segunda cor: <div class="cor-veiculo"><span class="txt"><?php echo $row["Cor2_vinv"] ?></span><div class="mostrar-cor" style="background-color: #<?php echo $vehicleColors[$row["Cor2_vinv"]]; ?>;"></div></div><p>
        </div>
        <?php } ?>
    </div>
    <div class="infos"> 
        <h2>Inventário</h2>
        <div class="info_container">
        <?php 
            $sql2 = "SELECT * FROM `inventarios` WHERE `ContaId` = $ContaId";
            $itens = $conn->query($sql2);
            $num = 0;
            $total = 0; 
            while($row = mysqli_fetch_assoc($itens)) { 
                for($n = 0; $n < 60; $n++) {
                    if($row["Item_Index_".$n] != 0) { 
                        if($num == 4) {
                            echo "</div><div class='info_container'>";
                            $num = 0;
                        }
                        $num++;
                        $total++;
        ?>
        <div class="conteudo">
            <div class="cbc">
                <img src="imagens/Index_<?php echo $row["Item_Index_".$n] ?>.png" alt="Icone" width="25" height="25">
                <p class="titulo"><?php echo $row["Item_Nome_".$n]; ?></p>
            </div>
            <p class="valor"><?php echo formatNumber($row["Item_Quant_".$n]).' unidades'; ?></p>
        </div>       
        <?php } } } ?>
    </div>
    <?php if($total == 0) echo"<h2 style='color: red; font-size: 1em;'>Seu inventário está vazio!</h2>"; ?>
</div></div>
</body>
</html>