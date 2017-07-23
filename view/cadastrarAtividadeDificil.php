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
        <script src="../js/funcoes.js" type="text/javascript"></script>


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
                                    <li class="active"> <a href="">Cadastrar atividade</a></li>
                                    <li><a href="?go=sair">Logoff</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>


               <br><br><br>
                    <form class="" method="post" action="../model/action.php" name="formulario" id="formulario">
                        <input type="hidden" id="action" name="action" />

                            <?php
                                $turmas = $_GET['turmas']; // String com IDS das turmas que deve ser convertida em array
                                echo "<input type=\"hidden\" id=\"turmas\" name=\"turmas\" value=\"$turmas\" />";
                            ?>

                            <label for="edit-output-data" style="font-size: 150%;">Descrição do algoritmo: </label><br>
                            <textarea style="color:black;border-radius:10px" rows="3" cols="58" id="descricao" name="descricao"></textarea>
                            <br>
                            <label for="edit-output-data" style="font-size: 150%;">Código-fonte: </label><br>

                            <textarea style="color:black;border-radius:10px" rows="15" cols="58" id="codigo" name="codigo" placeholder="Informe o trecho de código a ser modificado pelo aluno"></textarea>
                            <br>

                            <button type="submit" class="btn btn-success" onclick="javascript:doPost('formulario', 'salvarAtividadeDificil');">Salvar</button> <br>
                            <!--<input type="button" value="Avançar" class="btn btn-success" onclick="javascript:doPost('formulario', 'salvarAtividadeFacil');">	;-->

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
