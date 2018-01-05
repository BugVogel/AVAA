<!DOCTYPE html>

<?php
require_once 'conexao.php';
session_start();
$_SESSION['atualiza'] = 1;
if (!isset($_SESSION['usuario_session']) && !isset($_SESSION['senha_session'])) {
    echo "<meta http-equiv='refresh' content='0, url=index.php'>";
} else {

   $turmas;
   if(isset($_GET['turmas'])){

     $turmas = $_GET['turmas'];
     $turmas = explode(',',$turmas);

   }



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

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
            <script src="../js/funcoes.js" type="text/javascript"></script>

            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
            <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
        </head>

        <body>




                    <div class="cover-container">

                        <div >
                            <div class="inner">

                                <nav>
                                    <ul class="nav masthead-nav">
                                        <li><a href="principalAluno.php">Início</a></li>
                                        <li ><a href="minhasTurmasAluno.php">Minhas turmas</a></li>
                                        <li class="active"><a href="">Recursos</a></li>
                                        <li><a href="?go=sair">Logoff</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>


                        <!--                    <h2 class="cover-heading" style="padding: 2px;">MINHAS TURMAS</h2>-->
<br> <br> <br> <br>
                        <div class="row">
                              <div class="col-md-12">
                                <h3>Recursos</h3>
                              </div>
                          </div>
           <div class="row">
                          <div class="col-md-12">
                          <?php

                             $turma = explode(',', $_GET['turmas']); //sempre será uma


                                         $query = mysql_query("SELECT*FROM `recursos` WHERE `Turma` = '$turma[0]'");

                                         if(mysql_num_rows($query)>0){


                                                    echo "


                                                           <table class='table' style='border-radius:10px;'>
                                                           <thead>
                                                           <tr>
                                                           <td>Descrição</td>
                                                           <td>Download</td>
                                                           </tr>
                                                           </thead>
                                                           <tbody>
                                                    ";


                                                  while($recursos = mysql_fetch_array($query)){

                                                          if($turma[0] == $recursos['Turma']){

                                                                    $descricao = $recursos['Descricao'];
                                                                    $link = $recursos['Caminho'];


                                                                    echo "

                                                                                <tr>
                                                                                <td>$descricao</td>
                                                                                <td><a target='_blank'class='btn btn-default' role='button' href='$link'>Download</a></td>
                                                                                </tr>

                                                                    ";

                                                          }


                                                  }


                                                  echo "</tbody>";
                                                  echo"</table";





                                         }
                                         else{


                                           echo "<div style='text-shadow:none' class='alert alert-danger' role='alert'><h4 class='alert-heading'><strong>Atenção </strong> </h4>Não existem recursos cadastrados nesta turma.&emsp;</div>";



                                         }


                           ?>
              </div>
          </div>




                        <!-- <div class="mastfoot">
                          <div class="inner">
                            <p>Cover template for <a href="http://getbootstrap.com">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
                          </div>
                        </div> -->

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

if (@$_GET['go'] == "sair") {
    unset($_SESSION['usuario_session']);
    unset($_SESSION['senha_session']);
    echo "<meta http-equiv='refresh' content='0, url=index.php'>";
}
?>
