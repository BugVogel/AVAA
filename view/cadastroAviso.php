<!DOCTYPE html>
<?php
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
                                    <li><a href="minhasTurmas.php">Minhas turmas</a></li>
                                    <li class="active"><a href="cadastrarAviso.php">Cadastrar Aviso</a></li>
                                    <li><a href="?go=sair">Logoff</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    </div>

        <h2 style="text-align:center"> Cadastro de Avisos</h2>
        <br>


                    <div  class="inner cover">

                      <div class="col-md-6 col-xs-12" style="border-right:solid 1px LightBlue;">

                       <h3 class="cover-heading"style="font-size:20px;"> Avisos Cadastrados</h3>
                         <div class="panel-group">
                           <div class="panel panel-primary">
                             <div class="panel-heading"> Programação e Algoritmos II</div>
                             <div style="color:black;" class="panel-body"> Olá Turma, não haverá aula hoje</div>
                           </div>
                         </div>
                       </div>



                    <div class="col-md-6 col-xs-12">

                    <form name="formulario" id="formulario" class="form-signin" method="POST" action="?go=avisar">

                      <?php

                      if(isset($_GET['turmas'])){

                        $turmas = $_GET['turmas'];

                      echo "<input type='hidden' name='turmas' id='turmas' value='$turmas' >";

                          }

                       ?>
                      <label for="aviso" style="text-align:left;font-size:15px;position:relative;right:95px;">Enviar Aviso</label>
                      <br>
                      <textarea id="aviso" style="color:black;text-align:left;border-radius:10px;" name="aviso" rows="5" cols="50" placeholder="Mensagem"> </textarea>
                      <br>
                      <button id="enviar" style="position:relative;right:110px;" type="submit" class="btn btn-warning" name="enviar">Enviar</button>




                    </form>

             </div>

           </div>


                    <!-- <div class="mastfoot">
                      <div class="inner">
                        <p>Cover template for <a href="http://getbootstrap.com">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
                      </div>
                    </div> -->

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
?>
