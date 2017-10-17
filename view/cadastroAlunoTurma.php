<!DOCTYPE html>
<?php
require_once 'conexao.php';
session_start();
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

            <title>AVAA</title>

            <!-- Bootstrap core CSS -->
            <link href="../css/bootstrap.min.css" rel="stylesheet">

            <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
            <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

            <!-- Custom styles for this template -->
            <link href="../cover.css" rel="stylesheet">
            <link href="../signin.css" rel="stylesheet">

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
                                        <li><a href="?go=sair">Logoff</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>



                        <form class="" method="post" action="../model/action.php" name="formulario" id="formulario">
                            <input type="hidden" id="action" name="action" />
                            <?php
                            $ID = $_GET['ID'];
                            $res = mysql_query("select * from turma WHERE `ID` = '$ID'");
                            $escrever = mysql_fetch_array($res);

                            echo "<h2 class=cover-heading style=padding: 2px;>" . $escrever['Disciplina'] . " - " . $escrever['Escola'] . "</h2>";
                            echo "<input type=hidden value='$ID' name='idTurma' />";

                            $res = mysql_query("SELECT `ID_aluno` FROM `turma_alunos` WHERE `ID_turma`= '$ID'");

                            $nLinhas = mysql_num_rows($res);
                            if ($nLinhas > 0) {
                                echo "<h3>Alunos cadastrados:</h3>";
                                echo "<table align='center' border=2 cellspacing=3 cellpadding=2 width=85%><tr><td><b>&emsp; ALUNO &emsp;</b></td><td><b>&emsp; CURSO &emsp;</b></td><td></td></tr>";
                                while ($escrever = mysql_fetch_array($res)) {

                                    $res2 = mysql_query("SELECT * FROM aluno WHERE Email = '$escrever[ID_aluno]'");

                                    while ($escrever2 = mysql_fetch_array($res2)) {



                                        echo "<tr><td><h4>&emsp;" . $escrever2['Nome'] . "&emsp;</h4></td><td><h4>&emsp;" . "" . $escrever2['Curso'] . "&emsp;</h4></td><td>&emsp;"
                                        . "<input name=\"del[]\" type=\"checkbox\" id=\"del[]\" value=" . $escrever2['Email'] . ">"
                                        . "&emsp;</td></tr>";
                                    }
                                }/* Fim do while */

                                echo "</table>"; /* fecha a tabela apos termino de impressão das linhas */

                                echo "<br><input type=\"button\" value=\"Remover aluno(s) selecionado(s)\" class=\"btn btn-danger\" onclick=\"javascript:doPost('formulario', 'excluir');\" />	";
                            } else {
                                echo "<h3 class=cover-heading style=padding: 2px;>" . "Não há alunos cadastrados na turma!" . "</h3>";
                            }
                            ?>

                            <br>
                            <hr width=100%>


                            <input size="60" class='form-control'style="color:black;" type="email" id="email" name="email" placeholder="Digite o endereço de e-mail do aluno" required autofocus><br>

                            <br>
                            <!--<button type="submit" class="btn btn-success" role="button" value="cadastrarAluno">Adicionar aluno</button>-->

                            <input type="button" value="Adicionar aluno" class="btn btn-success" onclick="javascript:doPost('formulario', 'salvar');">


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

if (@$_GET['go'] == "sair") {
    unset($_SESSION['usuario_session']);
    unset($_SESSION['senha_session']);
    echo "<meta http-equiv='refresh' content='0, url=index.php'>";
} else if (@$_GET['go'] == "cadastrarAluno") {
    $email = $_POST['email'];
    $idTurma = $_POST['ID'];

    $res = mysql_query("SELECT * FROM `aluno` WHERE `Email`= '$email'");

    $nLinhas = mysql_num_rows($res);

    if ($nLinhas > 0) {
        mysql_query("INSERT INTO `turma_alunos`(`ID_turma`, `ID_aluno`) VALUES ('$idTurma','$email')");
        echo "<meta http-equiv='refresh' content='1, url=cadastroAlunoTurma.php?ID=$idTurma'>";
    } else {
        echo "<meta http-equiv='refresh' content='1, url=cadastroAlunoTurma.php?ID=$idTurma'>";
        echo '<script language="javascript">';
        echo 'alert("Não há aluno cadastrado com este email.")';
        echo '</script>';
    }
} else if (@$_GET['go'] == "removerAluno") {
    $idAluno = $POST['idAluno'];
    $res = mysql_query("SELECT 'Nome' FROM `aluno` WHERE `Email`= '$idAluno'");
    while ($escrever = mysql_fetch_array($res)) {
        echo '<script language="javascript">';
        echo 'alert("Tem certeza que deseja remover ' . $escrever[Nome] . ' ?.")';
        echo '</script>';
    }
}
?>
