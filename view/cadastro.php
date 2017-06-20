<!DOCTYPE html>
<?php
require_once 'conexao.php';
?>
<html lang="en">
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
        <script src="js/ie-emulation-modes-warning.js"></script>

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
                            <h3 class="masthead-brand">AVAA</h3>
                            <nav>
                                <ul class="nav masthead-nav">
                                    <li><a href="index.php">Início</a></li>
                                    <li class="active"><a href="#">Cadastro</a></li>
                                    <li><a href="#">Sobre</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div class="inner cover">
                        <h2 class="cover-heading" style="padding: 2px;">Cadastro de estudante</h2>
                        <!-- <p class="lead"> <h4>Este é um ambiente para auxiliar no processo de aprendizagem de algoritmos, possibilitando a resolução de problemas com feedbacks instântaneos, além de permitir a comunicação com o professor da disciplina. </h4></p>
                        <p class="lead">
                          <a href="#" class="btn btn-lg btn-default">Saiba mais</a>
                        </p> -->
                    </div>

                    <form style="width:100%;" method="POST" action="?go=cadastrar">
                        <!-- <h2 class="form-signin-heading">Please sign in</h2> -->
                        <input type="name" id="nome" name="nome" class="form-control" placeholder="Nome completo" required autofocus style="margin-top:25px;" maxlength="50">
                        <div class="row" style="margin-top:12px;">
                            <div class="form-group col-md-8">
                                <input type="text" class="form-control" id="curso" name="curso" placeholder="Curso" maxlength="50">
                            </div>

                            <div class="form-group col-md-4">
                              <input type="text" class="form-control" id="semestre" name="semestre" placeholder="Semestre" maxlength="2">
                            </div>
                        </div>
                        <input type="email" id="email" name="email" class="form-control" placeholder="E-mail" required autofocus style="" maxlength="50">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="password" id="senha" name="senha"  class="form-control" placeholder="Senha (máximo: 20 caracteres)" required style="margin-top:12px;" maxlength="20">
                            </div>

                            <div class="form-group col-md-6">
                                <input type="password" id="inputPassword"  class="form-control" placeholder="Confirme sua senha (máximo: 20 caracteres)" required style="margin-top:12px;" maxlength="20">
                            </div>
                        </div>

                        <button class="btn btn-lg btn-primary " type="submit" style="background-color:#FFC125; width: 50%;" style="margin-top:12px;" value="cadastrar">Cadastrar</button>

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
    if (@$_GET['go'] == 'cadastrar') {
        $nome = $_POST['nome'];
        $curso = $_POST['curso'];
        $semestre = $_POST['semestre'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $hashCode = hash("md5",$email, true );

        if (empty($nome)) {
            echo "<script> alert{'Preencha todos os campos!'}; history.back(); <\script>";
        } elseif (empty($curso)) {
            echo "<script> alert{'Preencha todos os campos!'}; history.back(); <\script>";
        } elseif (empty($semestre)) {
            echo "<script> alert{'Preencha todos os campos!'}; history.back(); <\script>";
        } elseif (empty($email)) {
            echo "<script> alert{'Preencha todos os campos!'}; history.back(); <\script>";
        } elseif (empty($senha)) {
            echo "<script> alert{'Preencha todos os campos!'}; history.back(); <\script>";
        } else {
            $query1 = mysql_num_rows(mysql_query("SELECT * FROM `aluno` WHERE `Email` = '$email'"));
            if ($query1 == 1) {
                echo '<script language="javascript">';
                echo 'alert("Email já cadastrado!")';
                echo '</script>';
                echo 'history.back();';
            } else {



             if(filter_var($email, FILTER_VALIDATE_EMAIL)){

                mysql_query("INSERT INTO `aluno` (`Nome`, `Curso`, `Semestre`, `Email`, `Senha`, `HashCode`, `Email Confirmado`) VALUES ('$nome', '$curso', '$semestre', '$email', '$senha', '$hashCode', '0')");
                echo '<script language="javascript">';
                echo 'alert("Cadastro realizado com sucesso!")';
                echo '</script>';
                echo "<meta http-equiv='refresh' content='0, url=index.php'>";

              }
              else{

                  echo '<script language="javascript"> alert("E-mail fornecido não é válido") </script>';


              }
            }
        }
    }



?>
