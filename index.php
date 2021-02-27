<!DOCTYPE html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vinicius Girotto</title>
  <link rel="stylesheet" type="text/css" href="style/home.css" />

</head>
<body>
    
    <?php require('pages/config/db.php'); 
    session_start();?>

    <div class="container" >
        <div class="navbar">
            <a class="active" href="index.php"> Jogos</a>
            <div class="dropdown">
                <button class="dropbtn">Operacoes</button>
                <div class="dropdown-content">
                    <a href="pages/crud/inserir.php">Inserir</a>
                    <a href="pages/crud/remover.php">Remover</a>
                    <a href="pages/crud/atualizar.php">Atualizar</a>
                </div>
            </div>
            <a href="pages/sobre.php"> Sobre</a>
            <?php //login,logout,nome
                if(isset($_SESSION["user"])){
                ?>
                    <a href="pages/auth/logout.php" style="float: right"> Logout</a>
                    <a style="float: right"> <?= $_SESSION["user"] ?> </a>
                <?php
                } else {
                ?>
                    <a href="pages/auth/login.php" style="float: right"> Login</a>
                <?php
                }

            ?>
        </div>
    </div> 


    <!--TÃ­tulo-->
    <div class="content1">
        <div>
            <h1 style="color:#1c1586">Jogos</h1>
        </div>
    </div>


    <div class="content2">
        <div id="main">

            <!-- pesquisa e filtro -->
            <form action="index.php" method="post">
                Busque pelo exato nome do jogo ou filtre por um dos criterios apresentados. <br><br>
                
                <label for="itemName">Nome do Jogo:</label>
                <input type="text" id="itemName" name="itemName" value="">
                <input type="submit" value="Pesquisar" style="margin-left:10px">
            </form>
            <br>
            <form action="index.php" method="post">
                <label for="select"> Filtro: </label>
                <select id="select" name="select" width="100">
                    <option value="idFilme">Ordem de Insercao</option>
                    <optgroup label="Genero">
                        <?php
                            $results = $mysqli->query("SELECT * FROM jogos");
                            $gens = [];
                            while ($row = $results->fetch_row()){ 
                                //echo "<option value='{$row[3]}'>{$row[3]}</option>";
                                $igual = FALSE;
                                foreach($gens as $value){
                                    if($value == $row[3]){
                                        $igual = TRUE;
                                        break; //sai do foreach
                                    }
                                }
                                if ($igual == FALSE){
                                    $gens[] = $row[3];
                                    echo "<option value='g{$row[3]}'>{$row[3]}</option>";
                                }
                            }
                        ?>
                    </optgroup>
                    <optgroup label="Console">
                        <?php
                            $results = $mysqli->query("SELECT * FROM jogos");
                            $cons = [];
                            while ($row = $results->fetch_row()){ 
                                $igual = FALSE;
                                foreach($cons as $value){
                                    if($value == $row[4]){
                                        $igual = TRUE;
                                        break; //sai do foreach
                                    }
                                }
                                if ($igual == FALSE){
                                    $cons[] = $row[4];
                                    echo "<option value='c{$row[4]}'>{$row[4]}</option>";
                                }
                            }
                        ?>
                    </optgroup>
                </select>
                <input type="submit" value="Filtrar" style="margin-left:10px">
            </form>


            <div class="btn-group">
                <section class="container grid grid-template-columns"> 
                    <?php 

                        $jogo = $_POST['itemName'];
                        $filter = $_POST['select'];
                        $get_char = substr($filter, 0, 1);
                        $get_filter = substr($filter, 1);

                        if($jogo == NULL){
                            if($filter == 'idFilme'){
                                $results = $mysqli->query("SELECT * FROM jogos");
                            } elseif ($get_char == 'g') {
                                $results = $mysqli->query("SELECT * FROM jogos WHERE genero = '$get_filter'");
                            } elseif ($get_char == 'c'){
                                $results = $mysqli->query("SELECT * FROM jogos WHERE console = '$get_filter'");
                            } else {
                                $results = $mysqli->query("SELECT * FROM jogos");
                            }
                        } else {
                            $results = $mysqli->query("SELECT * FROM jogos WHERE nome = '$jogo'");
                        }

                        while($row = $results->fetch_assoc()){
                    ?>
                            <div class="item">
                                <?php
                                    echo '<b>' . $row['nome'] . '</b><br>';
                                    echo $row['descricao'] . '<br>';
                                    echo $row['genero'] . '<br>';
                                    echo $row['console'] . '<br>';
                                ?>
                            </div>     
                    <?php
                        }

                        $results->free();
                        $mysqli->close();

                    ?>
                    

                </section>
            </div>     
        </div>
    
    </div> 
</body>
</html>		