<!DOCTYPE html>
<head>
  <meta charset="UTF-8" />
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <link rel="stylesheet" type="text/css" href="../../style/login.css" />
   <script src="main.js"></script>
</head>
<body>
  <?php require('../config/db.php'); ?>
  <div class="container" >   
    <div class="content">   
      <div id="login">  
      <!--Se estiver logado-->

      <!--FORMULÁRIO DE LOGIN-->
      
        <form method="post" action="login.php"> 
          <h1>Login</h1> 

          <div>
            <p> 
              <label for="enter_user">Username</label>
              <input id="enter_user" name="enter_user" required="required" type="text" placeholder="MeuUser"/>
            </p>
          </div>
           
          <div>
            <p> 
              <label for="Senha">Senha</label>
              <input id="Senha" name="Senha" required="required" type="password"/> 
            </p>
          </div>
           
          <p> 
            <input type="submit" value="Entrar" /> 
          </p>

          
          <p class="link2">
            <a href="cadastro.php">Cadastrar novo usuario</a>
          </p>

          <p class="link">
            <a href="../../index.php">Voltar</a>
          </p>


          <p>
            <h6>Vinicius Girotto @ 2021</h6>
          </p>
        </form>

        <?php 
          $user = $_POST['enter_user'];
          $pass = md5($_POST['Senha']);
      
          if($user){
            $results = $mysqli->query("SELECT * FROM users WHERE username = '$user' and pass = '$pass'");
            if($row = $results->fetch_assoc()){
              session_start();
              
              $_SESSION["user"] = $user;

              echo "Sucesso no login!";
            ?>
              <meta http-equiv="refresh" content="0.5; URL=../crud/inserir.php" />
            <?php
            } else {
              echo "LOGIN OU SENHA INCORRETOS";
            }
          }
          ?>
          


        
      </div>
    </div>
  </div>  
</body>
</html>