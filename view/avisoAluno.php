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
        <link href="../css/style2.css" rel="stylesheet">
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
                                    <li><a href="principalAluno.php">Início</a></li>
                                    <li><a href="minhasTurmasAluno.php">Minhas turmas</a></li>
                                    <li class="active"><a href="#">Avisos</a></li>
                                    <li><a href="?go=sair">Logoff</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div class="inner cover">
                        <h2 class="cover-heading" style="padding: 2px;">Avisos Cadastrados</h2>
                      <?php
                           $email = $_SESSION['usuario_session'];
                           $turmasQuery = mysql_query("SELECT * FROM  `turma_alunos` WHERE `ID_aluno` = '$email'");
                           $achou = FALSE;
                           if(mysql_num_rows($turmasQuery)>0){ //Esta ou não cadastrado em uma turma

                              while($turma = mysql_fetch_array($turmasQuery)){

                                    $ID = $turma['ID_turma'];
                                    $avisoQuery = mysql_query("SELECT * FROM `aviso` WHERE `ID_Turma` = '$ID'");

                                    if(mysql_num_rows($avisoQuery)>0){//Existe aviso ou não
                                      $achou = TRUE;
                                      while($aviso = mysql_fetch_array($avisoQuery)){


                                        $turmasTable = mysql_query("SELECT * FROM `turma` WHERE `ID` = '$ID'");
                                        $turmaInfo = mysql_fetch_array($turmasTable);

                                        echo "<button class='scrollAvisosButton '>". $aviso['Titulo']."</button>
                                       <div class='avisoBox'style='border-radius:4px;background-color:#79BD9A;color:white;max-height:0;overflow:hidden;transition:max-height 0.2s ease-out;' >
                                         ". $aviso['Texto']. "<br><p style='position:relative;right:10px;top:5px;font-size:10px;color:black; text-align:right'>".$turmaInfo['Disciplina']."<br>".$turmaInfo['Professor']."<br>". $aviso['Nome_Professor'] ."<br>". $aviso['Data'] ."
                                       </div><br>";


                                      }


                                    }
                                    if(!$achou)
                                      echo "<h3>Não existem avisos cadastrados</h3>";


                              }

                           }
                           else{

                             echo "<h3>Você não esta cadastrado em nenhuma turma</h3>";
                           }



                       ?>
                    </div>

                    <form class="form-signin" method="POST" action="?go=logar">


                    </form>


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
        <script src="../js/codeBasic.js"  type="text/javascript"></script>
    </body>
</html>

<?php
}

if(@$_GET['go'] == "sair"){
    unset($_SESSION['usuario_session']);
    unset($_SESSION['senha_session']);
    echo "<meta http-equiv='refresh' content='0, url=index.php'>";
}
?>
