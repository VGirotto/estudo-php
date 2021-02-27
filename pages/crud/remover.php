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
                    <a href="inserir.php">Inserir</a>
                    <a class="active" href="remover.php">Remover</a>
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
            <h1 style="color:#1c1586">Remocao de Jogos</h1>
        </div>
    </div>


    <div class="content2">
        <div id="main">

            <?php 
                
                
                if(isset($_SESSION["user"])){
                    
            ?>
                <!-- Operacao de remover -->
                <form action="remover.php" method="post">    
                    Qual jogo voce deseja deletar?<br><br>            
                    <select id="remove" name="remove" width="100">
                        <?php
                            $results = $mysqli->query("SELECT * FROM jogos");
                            while ($row = $results->fetch_row()){ 
                                echo "<option value='{$row[1]}'>{$row[1]}</option>";
                            }
                        ?>
                        
                    </select>
                    <br>
                    <input type="submit" value="Remover" style="margin-left:10px">
                </form>  

            <?php
                
                $jogo = $_POST['remove'];

                $stmt = $mysqli->prepare("DELETE FROM jogos WHERE nome = ?");            
                $stmt->bind_param('s', $jogo);
                $stmt->execute();

                $mysqli->close();
                }

                else {
                    echo "Voce precisa logar para remover jogos.";
                }
            ?>

        </div>
    
    </div> 
</body>
</html>		