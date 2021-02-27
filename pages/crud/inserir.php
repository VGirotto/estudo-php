<!DOCTYPE html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vinicius Girotto</title>
  <link rel="stylesheet" type="text/css" href="../../style/home.css" />

</head>
<body>
    
    <?php require('../config/db.php'); 
    session_start();?>

    <div class="container" >
        <div class="navbar">
            <a href="../../index.php"> Jogos</a>
            <div class="dropdown">
                <button class="dropbtn">Operacoes</button>
                <div class="dropdown-content">
                    <a class="active" href="inserir.php">Inserir</a>
                    <a href="remover.php">Remover</a>
                    <a href="atualizar.php">Atualizar</a>
                </div>
            </div>
            <a href="../sobre.php"> Sobre</a>

            <?php //login,logout,nome
                if(isset($_SESSION["user"])){
                ?>
                    <a href="../auth/logout.php" style="float: right"> Logout</a>
                    <a style="float: right"> <?= $_SESSION["user"] ?> </a>
                <?php
                } else {
                ?>
                    <a href="../auth/login.php" style="float: right"> Login</a>
                <?php
                }

            ?>
        </div>
    </div> 


    <!--TÃ­tulo-->
    <div class="content1">
        <div>
            <h1 style="color:#1c1586">Insercao de Jogos</h1>
        </div>
    </div>


    <div class="content2">
        <div id="main">

            <?php 
                
                
                if(isset($_SESSION["user"])){
                    
            ?>
                <!-- Operacao de Insert -->
                <form action="inserir.php" method="post">                
                    <label for="itemName">Nome do Jogo:</label><br>
                    <input type="text" id="itemName" name="itemName" value="" maxlength="70"><br>
                    <br>
                    <label for="desc"> Descricao: </label><br>   
                    <input type="text" id="desc" name="desc" value="" maxlength="200"><br>
                    <br>
                    <label for="genero"> Genero: </label><br>   
                    <input type="text" id="genero" name="genero" value="" maxlength="20"><br>
                    <br>
                    <label for="console"> Console: </label><br>   
                    <input type="text" id="console" name="console" value="" maxlength="20"><br>

                    <br><br>
                    <input type="submit" value="Inserir" style="margin-left:10px">
                </form>  

            <?php
                
                $jogo = $_POST['itemName'];
                $desc = $_POST['desc'];
                $gen = $_POST['genero'];
                $cons = $_POST['console'];

                $stmt = $mysqli->prepare("INSERT INTO jogos(nome, descricao, genero, console) VALUES (?,?,?,?)");            
                $stmt->bind_param('ssss', $jogo, $desc, $gen, $cons);
                $stmt->execute();

                $mysqli->close();
                }

                else {
                    echo "Voce precisa logar para inserir jogos.";
                }
            ?>

        </div>
    
    </div> 
</body>
</html>		