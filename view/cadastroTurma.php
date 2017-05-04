<!DOCTYPE html>

<?php
require_once 'conexao.php';
session_start();
if(!isset($_SESSION['usuario_session']) && !isset($_SESSION['senha_session']) ){
    echo "<meta http-equiv='refresh' content='0, url=index.php'>";
}
else{
?>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>AVAA</title>

        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../cover.css" rel="stylesheet">
        <link href="../signin.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="../js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>


        <div class="site-wrapper">

            <div class="site-wrapper-inner">

                <div class="cover-container">

                    <div class="masthead clearfix">
                        <div class="inner">
                            
                            <nav>
                                <ul class="nav masthead-nav">
                                    <li><a href="principalProf.php">Início</a></li>
                                    <li class="active"><a href="minhasTurmas.php">Minhas turmas</a></li>
                                    <li><a href="?go=sair">Logoff</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    
                    
<!--                    <h2 class="cover-heading" style="padding: 2px;">MINHAS TURMAS</h2>-->

                    <div class="inner cover">
                        
                        
                        
                    <form class="" method="POST" action="?go=cadastrarTurma">
                        <label for="edit-output-data" style="font-size: 150%;">Disciplina: </label><br> 
                        <input style="color:black;" type="text" size="60" name="disciplina"><br><br>
                        
                        <label for="edit-output-data" style="font-size: 150%;">Instituição: </label><br> 
                        <input style="color:black;" type="text" size="60" name="escola"><br><br>
                        
                        <button class="btn btn-lg btn-primary " type="submit" style="background-color:#FFC125; width: 28%;" style="margin-top:12px;" value="cadastrar">Cadastrar</button>
                        
                    </form>

                        
                        
                    </div>

                    <!-- <div class="mastfoot">
                      <div class="inner">
                        <p>Cover template for <a href="http://getbootstrap.com">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
                      </div>
                    </div> -->

                </div>

            </div>

        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="../../dist/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>

<?php
}

if(@$_GET['go'] == "sair"){
    unset($_SESSION['usuario_session']);
    unset($_SESSION['senha_session']);
    echo "<meta http-equiv='refresh' content='0, url=index.php'>";
}
else if(@$_GET['go'] == "cadastrarTurma"){
    
    $emailProfessor = $_SESSION['usuario_session'];
    $disciplina = $_POST['disciplina'];
    $escola = $_POST['escola'];
    
    mysql_query("INSERT INTO `turma`(`Disciplina`, `Professor`, `Escola`) VALUES ('$disciplina','$emailProfessor','$escola')");
    echo '<script language="javascript">';
    echo 'alert("Turma cadastrada com sucesso!")';
    echo '</script>';
    echo "<meta http-equiv='refresh' content='0, url=minhasTurmas.php'>";
    
}
?>
