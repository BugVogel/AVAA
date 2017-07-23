<!DOCTYPE html>
<?php
require_once 'conexao.php';
session_start();
if(!isset($_SESSION['usuario_session']) && !isset($_SESSION['senha_session']) ){
    echo "<meta http-equiv='refresh' content='0, url=index.php'>";
}

?>
<?php

   $mensagem = array();
   $atividade = $_GET['atividade'];
   $turmasString = $_GET['turmas'];

   $queryAtividade = mysql_query("SELECT * FROM `atividade` WHERE `ID`='$atividade' ");
   $verificaNivel = mysql_fetch_array($queryAtividade);
   $nivel = $verificaNivel['Nivel'];

   $turmas = explode(',', $turmasString); //Só vai ter uma turma

   $query = mysql_query("SELECT * FROM `atividade_aluno` WHERE `ID_Atividade` = '$atividade'");

   while($alunos_atividades = mysql_fetch_array($query)){


              $aluno = $alunos_atividades['ID_Aluno'];
              $resultado = $alunos_atividades['Status'];

               $queryAlunos = mysql_query("SELECT * FROM `aluno` WHERE `Email` ='$aluno'");
               $alunoLine = mysql_fetch_array($queryAlunos);
               $nome = $alunoLine['Nome'];

              switch($resultado){

               case 'Errou' :

               array_push($mensagem,"

               <button style='background-color:#d9534f' class='buttonLesson' name ='botaoExercicio' >'$nome'<br>Este aluno errou a atividade</button><br/>
               <br>


               ");

               break;

               case 'Acertou' :

               array_push($mensagem,"

               <button class='buttonLesson' name ='botaoExercicio' >'$nome'<br>Este aluno acertou a atividade</button><br/>
               <br>


               ");

               break;

               case 'NaoTentou':

               array_push($mensagem,"

               <button style='background-color:#5F9EA0' class='buttonLesson' name ='botaoExercicio' >'$nome'<br>Este aluno ainda não tentou resolver esta atividade</button><br/>
               <br>");

               break;

              }







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

        <title>AVAA</title>

        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/style2.css" rel="stylesheet">

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
                                          <?php echo "<li><a href='ModuloCorretorTurma.php?turmas=$turmasString'>Resultados da Turma</a></li>" ?>
                                          <?php echo "<li class='active'><a href=''>Resultado Nível $nivel</a></li>"; ?>
                                          <li><a href="?go=sair">Logoff</a></li>
                                      </ul>
                                  </nav>
                              </div>
                          </div>

                          </div>

         <br><br>


                          <div  class="inner cover"  >
                            <?php echo "<h2 style='text-align:center'>Resultados Exercícios Nível $nivel</h2>"?>
                            <br>

                            <div class="col-md-4 col-xs-12" >
                             <h3 class="cover-heading" style="font-size:20px;" > Resultado dos alunos</h3>
                             <h6>Abaixo estão os resultados dos alunos</h6>

                            <form name="atividade" method="post" action="">

                           <!-- Imprimi atividades, caso existam e  Atualizar paginação -->
                           <?php


                                   if(!isset($_POST['b'])){

                                     $espaços = 0;
                                     $numElement = sizeof($mensagem);
                                     if($numElement > 0){ //Tem atividade

                                        for( $index =0; $index<3; $index++){

                                           if($index < $numElement){ //Se tiver menos de 3 avisos, é tratado
                                           echo $mensagem[$index];
                                           $espaços++;
                                           }

                                        }

                                        switch($espaços){ //Ajusta espaços para botões de paginação

                                         case 0: break;
                                         case 1: echo "<br><br>"; break;
                                         case 2:  break;
                                         default :

                                        }


                                     }


                              }

                                   if(@$_POST['b']== '1'){

                                   $espaços=0;
                                   $numElement = sizeof($mensagem);
                                   if($numElement > 0){ //Tem aviso para a pagina 1

                                      for( $index =0; $index<3; $index++){

                                         if($index < $numElement){ //Se tiver menos de 3 avisos, é tratado
                                         echo $mensagem[$index];
                                         $espaços++;
                                         }

                                      }

                                      switch($espaços){ //Ajusta espaços para botões de paginação

                                       case 0: break;
                                       case 1: echo "<br><br>"; break;
                                       case 2: break;
                                       default :

                                      }

                                   }
                                   else{ //Não possui avisos suficientes para esta pagina

                                     echo "<div style='text-shadow:none' class='alert alert-danger' role='alert'><h4 class='alert-heading'><strong>Atenção </strong> </h4>Não existem atividades Cadastradas nesta página.</div>
                                     <br><br>";
                                   }
                                 }


                                   if(@$_POST['b']== '2'){

                                   $espaços=0;
                                   $numElement = sizeof($mensagem);
                                   if($numElement > 3){ //Tem aviso para a pagina 2

                                      for( $index = 3; $index<6; $index++){

                                         if($index < $numElement){ //Se tiver menos de 3 avisos, é tratado
                                         echo $mensagem[$index];
                                         $espaços++;
                                          }

                                      }

                                      switch($espaços){ //Ajusta espaços para botões de paginação

                                       case 0: break;
                                       case 1: echo "<br><br>"; break;
                                       case 2: break;
                                       default :

                                      }

                                   }
                                   else{ //Não possui avisos suficientes para esta pagina

                                     echo "<div style='text-shadow:none' class='alert alert-danger' role='alert'><h4 class='alert-heading'><strong>Atenção </strong> </h4>Não existem atividades Cadastradas nesta página.</div>
                                     <br><br>";
                                   }
                                 }


                                   if(@$_POST['b']=='3'){

                                   $espaços=0;
                                   $numElement = sizeof($mensagem);
                                   if($numElement > 6){ //Tem aviso para a pagina 3

                                      for( $index = 6; $index<9; $index++){

                                         if($index < $numElement){ //Se tiver menos de 3 avisos, é tratado
                                         echo $mensagem[$index];
                                         $espaços++;
                                         }

                                      }

                                      switch($espaços){ //Ajusta espaços para botões de paginação

                                       case 0: break;
                                       case 1: echo "<br><br>"; break;
                                       case 2:  break;
                                       default :

                                      }

                                   }
                                   else{ //Não possui avisos suficientes para esta pagina

                                    echo "<div style='text-shadow:none' class='alert alert-danger' role='alert'><h4 class='alert-heading'><strong>Atenção </strong> </h4>Não existem atividades Cadastradas nesta página.</div>
                                     <br><br>";
                                   }
                                 }


                                   if(@$_POST['b'] == '4'){

                                   $espaços;
                                   $numElement = sizeof($mensagem);
                                   if($numElement > 9){ //Tem aviso para a pagina 4

                                      for( $index = 9; $index<12; $index++){

                                         if($index < $numElement){ //Se tiver menos de 3 avisos, é tratado
                                         echo $mensagem[$index];
                                         $espaços++;
                                         }

                                      }

                                      switch($espaços){ //Ajusta espaços para botões de paginação

                                       case 0: break;
                                       case 1: echo "<br><br>"; break;
                                       case 2:  break;
                                       default :

                                      }

                                   }
                                   else{ //Não possui avisos suficientes para esta pagina

                                     echo "<div style='text-shadow:none' class='alert alert-danger' role='alert'><h4 class='alert-heading'><strong>Atenção </strong> </h4>Não existem atividades Cadastradas nesta página.</div>
                                     <br><br>";
                                   }
                                 }





                            ?>


                            <div class="col-md-12 col-xs-12 col-md-offset-4 col-xs-offset-3">

                            </form>
                           <form id="paginacao" name="paginacao" method="POST" action="" >

                              <div  class="btn-toolbar">
                                <div class="btn-group" >
                                  <button id="b1" type="submit" name="b" value ='1' class="btn btn-warning">1</button>
                                  <button type="submit" name="b" value ='2' class="btn btn-warning">2</button>
                                  <button type="submit" name="b" value ='3' class="btn btn-warning">3</button>
                                  <button type="submit" name="b" value ='4' class="btn btn-warning">4</button>
                                </div>
                              </div>

                          </form>
                         </div>
                            </div>






                          <div class="col-md-8 col-xs-12" style="height:400px;border-left:solid 1px LightBlue">
                        <h3 class="cover-heading" style="font-size:20px">Atividade Cadastrada</h3>
                        <h6>Abaixo esta a ordem de blocos cadastrada</h6>

                        <form name="blocos" method="post" action="">

                     <div id="columns">

                       <?php

                       $queryBlocos = mysql_query("SELECT * FROM `bloco_linhas` WHERE `ID_atividade`='$atividade'");
                       $j=1;
                       while($blocos = mysql_fetch_array($queryBlocos)){

                          $bloco = $blocos['texto'];



                         echo   "
                         <div class='col-md-4'>
                             <div    style='text-shadow:none;border-radius:4px' class='panel-primary'>
                               <div style='border-radius:4px'class='panel-heading'>Bloco $j</div>
                               <div id='bloco$j'  style='background-color:black;border-radius:4px'class='panel-body'>$bloco</div>
                             </div>
                          </div>
                                ";

                         $j++;
                       }




                        ?>



                      </div>

                        </form>

                            <br><br><br><br><br><br><br><br><br><br><br><br>





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
        <script src="../js/codeBasic.js"></script>

    </body>
</html>

<?php


if(@$_GET['go'] == "sair"){
    unset($_SESSION['usuario_session']);
    unset($_SESSION['senha_session']);
    echo "<meta http-equiv='refresh' content='0, url=index.php'>";
}
?>
