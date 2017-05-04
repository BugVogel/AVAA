<!DOCTYPE html>
<?php
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
                                        <li class="active"> <a href="#">Cadastrar atividade</a></li>
                                        <li><a href="?go=sair">Logoff</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>



                        <form class="" method="post" action="../model/action.php" name="formulario" id="formulario">
    <!--                        <input type="hidden" id="action" name="action" />
                                <br><br><br>
                                <label for="edit-output-data" style="font-size: 150%;">Descrição do algoritmo: </label><br> 
                                <textarea style="color:black;" rows="3" cols="60" id="descricao" name="descricao"></textarea>
                                <br>
                                <label for="edit-output-data" style="font-size: 150%;">Código-fonte: </label><br> 
                                <textarea style="color:black;" rows="7" cols="60" id="codigo" name="codigo"></textarea>

                                <label for="edit-output-data" style="font-size: 150%;">Em qual nível deseja cadastrar? </label><br> 
                                <div class="">
                                    <input  TYPE="RADIO" name="nivel" id="n1" value="1"><label for="n1"> FÁCIL</label> &emsp;
                                    <input  TYPE="RADIO" name="nivel" id="n2" value="2"><label for="n2"> INTERMEDIÁRIO</label>  &emsp;
                                    <input  TYPE="RADIO" name="nivel" id="n3" value="3"><label for="n3"> DIFÍCIL</label>   
                                </div>

                                <br>


                                <input type="button" value="Avançar" class="btn btn-success" onclick="javascript:doPost('formulario', 'salvarAtividade');">	
                            -->

                            <?php
                            if (isset($_SESSION['codigo'])){
                                if ($_SESSION['codigo'] != NULL) {
                                    //echo $_SESSION['codigo'];
                                    if($_SESSION['nivel'] == 1){
                                        echo "<font size=\"6\" style=\"text-decoration: underline;\"> Nível fácil</font> <br>";
                                        echo "<font size=\"3\"> Você deve selecionar no máximo 3 linhas que determinam o início dos blocos.</font> <br><br>";
                                    }
                                    else if($_SESSION['nivel'] == 2){
                                        echo "<font size=\"6\" style=\"text-decoration: underline;\"> Nível 2</font> <br>";
                                        echo "<font size=\"3\"> Você deve selecionar as linhas que determinam o início dos blocos condicionais ou de repetição.</font> <br><br>";
                                    }
                                    else if($_SESSION['nivel'] == 3){
                                        echo "<font size=\"6\" style=\"text-decoration: underline;\"> Nível difícil</font> <br>";
                                        echo "<font size=\"3\"> O algoritmos cadastrado será dividido em linhas.</font> <br><br>";
                                    }
                                    
                                    $texto = explode("\n", $_SESSION['codigo']);
                                    $id = 1;
                                    echo "<table align='center' border=2 cellspacing=3 cellpadding=2 style=\"font-size: 110%;\">";
                                    foreach($texto as $nome){
                                        
                                        echo "<tr><td>&emsp;$id&emsp;</td><td>&emsp;$nome&emsp;</td>"
                                            . "<td>&emsp;<input name=\"linhas[]\" type=\"checkbox\" id=\"linhas[]\" value=" . $id . "> &emsp;</td></tr>";
                                        $id++;
                                    }
                                    echo "</table>";
                                }
                            }   
                        
                            ?>
                            <br>
                            <br>
                            <input type="button" value="Salvar" class="btn btn-success" onclick="javascript:doPost('formulario', 'salvarAtividade');">	


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
}
?>
