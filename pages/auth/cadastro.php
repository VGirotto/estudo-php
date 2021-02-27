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
        <form method="post" action="cadastro.php"> 
          <h1>Cadastrar</h1> 
          <h5> Campos com * sao obrigatorios. </h5><br /><br />
          <div>
            <p> 
              <label for="enter_user">Username *</label>
              <input id="enter_user" name="enter_user" required="required" type="text" placeholder="MeuUser"/>
            </p><br />
          </div>

          <div>
            <p> 
              <label for="enter_email">E-mail *</label>
              <input id="enter_email" name="enter_email" required="required" type="email" placeholder="nome@email.com"/>
            </p><br />
          </div>
           
          <div>
            <p> 
              <label for="enter_pass">Senha * (Minimo 6 caracteres)</label>
              <input id="enter_pass" name="enter_pass" required="required" type="password"/> 
            </p><br />
          </div>

          <div>
            <p> 
              <label for="enter_pass2">Confirme a Senha *</label>
              <input id="enter_pass2" name="enter_pass2" required="required" type="password"/> 
            </p><br />
          </div>

          <p> 
            <label for="Sexo">Sexo *</label><br>
            <select name="Sexo" placeholder="Sexo"><option>Masculino<option>Feminino<option>Outro</select><br/>
          </p><br />

           
          <p> 
            <input type="submit" value="Cadastrar" /> 
          </p>

          <p class="link">
            <a href="login.php">Cancelar</a>
          </p>

          <p>
            <h6>Vinicius Girotto @ 2021</h6>
          </p>
        </form>

        <?php
            $user = $_POST['enter_user'];
            $email = $_POST['enter_email'];
            $pass = md5($_POST['enter_pass']);
            $pass2 = md5($_POST['enter_pass2']);
            $sexo = $_POST['Sexo'];

            if($user){
              if ($pass != $pass2){
                echo "SENHA ERRADA! REPITA A OPERACAO.";
  
              } else {
                $stmt = $mysqli->prepare("INSERT INTO users(username, email, pass, sexo) VALUES (?,?,?,?)");      
                $stmt->bind_param('ssss', $user, $email, $pass, $sexo);
                $stmt->execute();
                $mysqli->close();
              ?>
                <meta http-equiv="refresh" content="0.2; URL=login.php" />
              <?php
              }   
            }
              ?>
      

      </div>
    </div>
  </div>  
</body>
</html>