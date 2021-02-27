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
            <h1 style="color:#1c1586">Atualizar os Jogos</h1>
        </div>
    </div>


    <div class="content2">
        <div id="main">

            <?php 
                
                
                if(isset($_SESSION["user"])){
                    
            ?>
                <!-- Operacao de Atualizar -->
                <form action="atualizar.php" method="post">    
                    Escolha o jogo que você seja atualizar as informações.<br>
                    Deixe o campo em branco para nao alterar.<br>            
                    <select id="update" name="update" width="100">
                        <?php
                            $results = $mysqli->query("SELECT * FROM jogos");
                            while ($row = $results->fetch_row()){ 
                                echo "<option value='{$row[1]}'>{$row[1]}</option>";
                            }
                        ?>
                        
                    </select>
                    <br><br>
                    <label for="desc"> Descricao: </label><br>   
                    <input type="text" id="desc" name="desc" value="" maxlength="100"><br>
                    <br>
                    <label for="genero"> Genero: </label><br>   
                    <input type="text" id="genero" name="genero" value="" maxlength="20"><br>
                    <br>
                    <label for="console"> Console: </label><br>   
                    <input type="text" id="console" name="console" value="" maxlength="20"><br>

                    <br><br>
                    <input type="submit" value="Atualizar" style="margin-left:10px">
                </form>  

            <?php
                
                $jogo = $_POST['update'];
                $desc = $_POST['desc'];
                $gen = $_POST['genero'];
                $cons = $_POST['console'];

                if ($desc && $gen && $cons){
                    $stmt = $mysqli->prepare("UPDATE jogos SET descricao = ?, genero = ?, console = ? WHERE nome = '$jogo'"); 
                    $stmt->bind_param('sss', $desc, $gen, $cons);
                    $stmt->execute();
                    echo "Atualizado com sucesso!";
                } elseif($desc && $gen){
                    $stmt = $mysqli->prepare("UPDATE jogos SET descricao = ?, genero = ? WHERE nome = '$jogo'"); 
                    $stmt->bind_param('ss', $desc, $gen);
                    $stmt->execute();
                    echo "Atualizado com sucesso!";
                } elseif($desc && $cons){
                    $stmt = $mysqli->prepare("UPDATE jogos SET descricao = ?, console = ? WHERE nome = '$jogo'"); 
                    $stmt->bind_param('ss', $desc, $cons);
                    $stmt->execute();
                    echo "Atualizado com sucesso!";
                } elseif($gen && $cons){
                    $stmt = $mysqli->prepare("UPDATE jogos SET genero = ?, console = ? WHERE nome = '$jogo'"); 
                    $stmt->bind_param('ss', $gen, $cons);
                    $stmt->execute();
                    echo "Atualizado com sucesso!";
                } elseif($desc){
                    $stmt = $mysqli->prepare("UPDATE jogos SET descricao = ? WHERE nome = '$jogo'"); 
                    $stmt->bind_param('s', $desc);
                    $stmt->execute();
                    echo "Atualizado com sucesso!";
                } elseif($gen){
                    $stmt = $mysqli->prepare("UPDATE jogos SET genero = ? WHERE nome = '$jogo'"); 
                    $stmt->bind_param('s', $gen);
                    $stmt->execute();
                    echo "Atualizado com sucesso!";
                } elseif($cons){
                    $stmt = $mysqli->prepare("UPDATE jogos SET console = ? WHERE nome = '$jogo'"); 
                    $stmt->bind_param('s', $cons);
                    $stmt->execute();
                    echo "Atualizado com sucesso!";
                }

                

                $mysqli->close();
                }

                else {
                    echo "Voce precisa logar para atualizar os jogos.";
                }
            ?>

        </div>
    
    </div> 
</body>
</html>		