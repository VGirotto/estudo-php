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


        <?php 

          session_start();
          session_destroy();
          session_register_shutdown();
          echo "Sucesso no logout!";
        ?>

        <p class="link2">
          <a href="../../index.php">Pagina Inicial</a>
        </p>


        
      </div>
    </div>
  </div>  
</body>
</html>