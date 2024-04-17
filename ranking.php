<?php 
    session_start();
    if(isset($_SESSION['DadosLogin_UCP'])) {
        $DadosLogin = $_SESSION['DadosLogin_UCP'];
        $ContaId = $DadosLogin['ContaId'];
    }
    else header("Location:login.php");
    $_SESSION['UCP_Pagina'] = 5;
    require("conexao.php");
    require_once("header.php");

    function CalcularPos($pos) {
        if($pos == 1) return "style='color: #daa520; font-weight: bold;'";
        if($pos == 2) return "style='color: #A9A9A9; font-weight: bold;'";
        if($pos == 3) return "style='color: #CD7F32; font-weight: bold;'";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="ranking.css">
    <title>UCP | Ranking</title>
</head>
<body>
    <main>
        <div class="tabelas">
            <div class="tabela">
                <h2>Mais ricos</h2>
                <?php 
                    $conta = $conn->query("SELECT `Nome`, `Dinheiro`+`DinheiroBanco` FROM jogadores ORDER BY `Dinheiro`+`DinheiroBanco` DESC LIMIT 10;");

                $pos = 0;
                while($row = mysqli_fetch_assoc($conta)) { $pos ++; ?>
                    <div class="linha"><span class="pos" <?php if($pos < 4) { echo CalcularPos($pos); } ?>><?php echo $pos; ?>º</span><span title="<?php echo $row["Nome"]; ?>"><?php echo $row["Nome"]; ?></span><span style="color: #19B519; font-weight: bold;">$<?php echo formatNumber($row["`Dinheiro`+`DinheiroBanco`"]); ?></span></div>
                <?php } ?>
            </div>
            <div class="tabela">
                <h2>Mais leveis</h2>
                <?php 
                    $conta = $conn->query("SELECT `Nome`, `Level` FROM jogadores ORDER BY `Level` DESC LIMIT 10;");

                $pos = 0;
                while($row = mysqli_fetch_assoc($conta)) { $pos ++; ?>
                    <div class="linha"><span class="pos" <?php if($pos < 4) { echo CalcularPos($pos); } ?>><?php echo $pos; ?>º</span><span title="<?php echo $row["Nome"]; ?>"><?php echo $row["Nome"]; ?></span><span><?php echo formatNumber($row["Level"]); ?> leveis</span></div>
                <?php } ?>
            </div>
        </div>

        <div class="tabelas">
            <div class="tabela">
                <h2>Mais idiotas</h2>
                <?php 
                    $conta = $conn->query("SELECT `Nome`, `Coins` FROM jogadores ORDER BY `Coins` DESC LIMIT 10;");

                $pos = 0;
                while($row = mysqli_fetch_assoc($conta)) { $pos ++; ?>
                    <div class="linha"><span class="pos" <?php if($pos < 4) { echo CalcularPos($pos); } ?>><?php echo $pos; ?>º</span><span title="<?php echo $row["Nome"]; ?>"><?php echo $row["Nome"]; ?></span><span style="color: #daa520; font-weight: bold;">R$<?php echo formatNumber($row["Coins"]); ?> coins</span></div>
                <?php } ?>
            </div>
            <div class="tabela">
                <h2>Mais procurados</h2>
                <?php 
                    $conta = $conn->query("SELECT `Nome`, `Procura` FROM jogadores ORDER BY `Procura` DESC LIMIT 10;");

                $pos = 0;
                while($row = mysqli_fetch_assoc($conta)) { $pos ++; ?>
                    <div class="linha"><span class="pos" <?php if($pos < 4) { echo CalcularPos($pos); } ?>><?php echo $pos; ?>º</span><span title="<?php echo $row["Nome"]; ?>"><?php echo $row["Nome"]; ?></span><span><?php echo formatNumber($row["Procura"]); ?> estrelas</span></div>
                <?php } ?>
            </div>
        </div>

        <div class="tabelas">
            <div class="tabela">
                <h2>Mais mafiosos</h2>
                <?php 
                    $conta = $conn->query("SELECT `Nome`, `PontosMafia` FROM jogadores ORDER BY `PontosMafia` DESC LIMIT 10;");

                $pos = 0;
                while($row = mysqli_fetch_assoc($conta)) { $pos ++; ?>
                    <div class="linha"><span class="pos" <?php if($pos < 4) { echo CalcularPos($pos); } ?>><?php echo $pos; ?>º</span><span title="<?php echo $row["Nome"]; ?>"><?php echo $row["Nome"]; ?></span><span><?php echo formatNumber($row["PontosMafia"]); ?> pontos</span></div>
                <?php } ?>
            </div>
            
        </div>
    </main>
</body>
</html>