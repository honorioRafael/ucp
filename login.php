<?php 
    session_start();
    $_SESSION['UCP_Pagina'] = 3;
    require("conexao.php");
    $mensagem = 0;

    if(isset($_SESSION['DadosLogin_UCP'])) {
        header("Location:index.php");
    }

    if(isset($_POST["nick"])) {
        global $ip, $username, $senha, $db;
        $con =  new mysqli($ip, $username, $senha, $db);

        $nick = mysqli_real_escape_string($con, $_POST["nick"]); 
        $query = "SELECT Nome FROM jogadores WHERE Nome = '$nick'";
        $consulta = mysqli_query($con, $query);
        if($consulta){
            $num_rows = mysqli_num_rows($consulta); 
            $consulta->close();   
            if ($num_rows > 0) {
                $sql = mysqli_query($con, "SELECT Senha FROM jogadores WHERE Nome = '$nick';");     
                $senha = mysqli_fetch_object($sql)->Senha;
                if($_POST["senha"] == $senha) {
                    $result = mysqli_query($con, "SELECT `ContaId`, `Nome` FROM `jogadores` WHERE `Nome` = '$nick'");   
                    $_SESSION['DadosLogin_UCP'] = mysqli_fetch_assoc($result);
                    header("Location:index.php");
                    ?><script>window.location.href = "index.php";</script><?php
                }
                else $mensagem = 1;
            }
            else $mensagem = 2;
        } 
        else echo "Erro na consulta: " . mysqli_error($con);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>UCP | Login</title>
</head>
<body>
    <div class="centro">
        <div class="login">
            <?php if(isset($_GET['pr'])) { echo"Conta registrada com sucesso!"; } ?>
            <h1>LOGIN</h1>
            <form action="login.php" method="post" name="LOGIN">
                <?php if(isset($_POST['nick'])) { ?> 
                    <input type="text" name="nick" placeholder="Nick" size="60" autocomplete="on" value=<?php echo $_POST['nick'] ?> required>
                    <input type="password" name="senha" placeholder="Senha" size="60" autocomplete="on" value=<?php echo $_POST['senha'] ?> required>
                <?php } else { ?>
                    <input type="text" name="nick" placeholder="Nick" size="60" autocomplete="on" required>
                    <input type="password" name="senha" placeholder="Senha" size="60" autocomplete="on" required>
                <?php } ?>
                <input type="hidden" name="acao" value="A_LOGAR">
                <input type="submit" value="LOGIN" name="Login">
            </form>
            <?php 
            if($mensagem == 1) { echo"<h2>Senha incorreta!</h2>"; }
            if($mensagem == 2) { echo"<h2>Essa conta não existe!</h2>"; }?>
        </div>
    </div>
</body>
</html>