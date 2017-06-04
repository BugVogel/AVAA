<?php
require_once 'conexao.php';
session_start();
$_SESSION['atualiza'] = 1;
if (!isset($_SESSION['usuario_session']) && !isset($_SESSION['senha_session'])) {
    echo "<meta http-equiv='refresh' content='0, url=index.php'>";
} else {
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


            <div class="site-wrapper">

                <div class="site-wrapper-inner">

                    <div class="cover-container">

                        <div class="masthead clearfix">
                            <div class="inner">

                                <nav>
                                    <ul class="nav masthead-nav">
                                        <li><a href="principalAluno.php">Início</a></li>
                                        <li class="active"><a href="minhasTurmasAluno.php">Minhas turmas</a></li>
                                        <li><a href="?go=sair">Logoff</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>


                        <!--                    <h2 class="cover-heading" style="padding: 2px;">MINHAS TURMAS</h2>-->

                        <div class="inner cover">


                            <div align="center" style="font-size:20px;">
                                <form class="" method="post" action="../model/action.php" name="formulario"  id="formulario3">
                                    <input type="hidden" id="action3" name="action" />


                                    <br>
                                    <br>
                                    <?php
                                    $email = $_SESSION['usuario_session'];
                                    $res = mysql_query("select * from turma_alunos WHERE `ID_aluno` = '$email'");
                                    $nLinhas = mysql_num_rows($res);
                                    if ($nLinhas > 0) {
                                        echo "<h3 style='text-align:center'> Turmas Cadastradas</h3><br>";
                                        echo "<table class='table'align='center' border=2 cellspacing=3 cellpadding=2><tr><td><b>&emsp; DISCIPLINA &emsp;</b></td><td><b>&emsp; PROFESSOR &emsp;</b></td><td></td></tr>";

                                        /* Enquanto houver dados na tabela para serem mostrados será executado tudo que esta dentro do while */


                                       while($coletaIds = mysql_fetch_array($res)){
                                       $ID = $coletaIds['ID_turma'];

                                       $turmas = mysql_query("SELECT * FROM `turma` WHERE `ID` = '$ID' ");

                                       while($escreve = mysql_fetch_array($turmas)){

                                         echo "<tr><td>"."<b>" . $escreve['Disciplina'] . "&emsp;" ."</b>"."</td><td>" . "" . $escreve['Professor'] . "</td><td>" .
                                        "<input name=\"turmas[]\" type=\"checkbox\" id=\"turmas[]\" value=" . $escreve['ID'] . "></td></tr>";
                                         /* Escreve cada linha da tabela */

                                       }/* Fim do while interno*/


                                     } /* Fim do While externo*/


                                        echo "</table>"; /* fecha a tabela apos termino de impressão das linhas */
                                        echo "<br>";
                                        echo "<a type=\"button\" value=\"Resolver Exercicios\" class=\"btn btn-success\" onclick=\"javascript:doPostForm3('formulario3', 'chamaResolverExercicios);\">Resolver Exercício(s)</a>";
                                        echo "&emsp;";
                                        echo "<a type=\"button\" class=\"btn btn-warning\" value=\"Avisos Aluno\" onclick=\"javascript:doPostForm3('formulario3', 'chamaAvisos')\">Avisos</a>";




                                    }
                                    else{
                                        echo "<h3 class=cover-heading style=padding: 2px;>" . "Não há turmas cadastradas!" . "</h3>";
                                    }
                                    ?>
                            </div>



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

if (@$_GET['go'] == "sair") {
    unset($_SESSION['usuario_session']);
    unset($_SESSION['senha_session']);
    echo "<meta http-equiv='refresh' content='0, url=index.php'>";
}
?>
