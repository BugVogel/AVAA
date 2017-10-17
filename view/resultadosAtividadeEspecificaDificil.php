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
               $email = $alunoLine['Email'];


              switch($resultado){

               case 'Errou' :

               array_push($mensagem,"

               <button style='background-color:#d9534f' class='buttonLesson' name ='botaoExercicio' value='Errou,$email' >'$nome'<br>Este aluno errou a atividade</button><br/>
               <br>


               ");

               break;

               case 'Acertou' :

               array_push($mensagem,"

               <button class='buttonLesson' name ='botaoExercicio' value='Acertou,$email'>'$nome'<br>Este aluno acertou a atividade</button><br/>
               <br>


               ");

               break;

               case 'NaoTentou':

               array_push($mensagem,"

               <button style='background-color:#fbb22a' class='buttonLesson' name ='botaoExercicio' value='NaoTentou,$email'>'$nome'<br>Este aluno ainda não tentou resolver esta atividade</button><br/>
               <br>");

               break;

               case 'Tentou':
               array_push($mensagem,"

               <button style='background-color:#5F9EA0' class='buttonLesson' name ='botaoExercicio' value='Tentou,$email'>'$nome'<br>Este aluno aguarda correção da atividade</button><br/>
               <br>");
               break;

              }







   }






 ?>

<?php

 $blocoAluno="";
 $form="";


                        if(isset($_POST['botaoExercicio'])){


                            $resultado = $_POST['botaoExercicio'];
                            $resultado = explode(',',$resultado);
                            $email = $resultado[1];
                            $resultado = $resultado[0];

                            $queryAtividades_Alunos = mysql_query("SELECT * FROM `atividade_aluno` WHERE `ID_Aluno`= '$email' AND `ID_Atividade` ='$atividade' ");
                            $respostaLine = mysql_fetch_array($queryAtividades_Alunos);
                            $resposta = $respostaLine['Resposta_Nivel_3'];

                            if($resultado == 'Tentou'){ //Precisa ser corrigido


                              $linhas = explode("\n",$resposta);
                              $linhas = sizeof($linhas);


                              $blocoAluno =  "
                        <form name='formulario' method='POST' action=''>
                        <input type='hidden' name='emailAluno' value='$email' />
                              <div class='col-md-5 col-md-offset-1'>
                                  <div    style='text-shadow:none;border-radius:4px' class='panel-primary'>
                                    <div style='border-radius:4px'class='panel-heading'>Bloco Único de Resposta do Aluno</div>
                                    <textarea id='bloco1' cols='46' rows='$linhas' name='correcao'  style='background-color:black;border-radius:4px'class='panel-body'>$resposta</textarea>
                                  </div>
                               </div>";

                             $form = "
                             <label for='buttons'> Enviar Resposta</label>
                             <div name='buttons'>
                                 <button type='submit' name='resultado'class='btn btn-success' value='Acertou'>Acertou</button>
                                  <button type='submit' name='resultado' class='btn btn-danger' value='Errou'>Errou</button>
                             </div>
                                </form>

                              ";



                            }
                            elseif($resultado == 'NaoTentou'){
                            $blocoAluno=
                            "<div class='col-md-5 col-md-offset-1'>
                              <h5>O Aluno ainda não respondeu esta atividade</h5>
                              <img width='200'src='../images/interrogacao.png'   />
                              </div>";
                            }
                            elseif($resultado == 'Acertou'){


                              $resposta = explode("\n",$resposta);
                              $resposta = implode("<br>",$resposta);

                                $blocoAluno =
                                "<form name='formulario' method='POST' action=''>
                                      <div class='col-md-5 col-md-offset-1'>
                                          <div    style='text-shadow:none;border-radius:4px' class='panel-primary'>
                                            <div style='border-radius:4px'class='panel-heading'>Bloco Único de Resposta do Aluno</div>
                                            <div id='bloco1'  name='correcao'  style='background-color:black;border-radius:4px'class='panel-body'>$resposta</div>
                                          </div>
                                       </div>
                                  <h5>O Aluno acertou a resposta desta atividade</h5>
                                    <img width='50'src='../images/check.png'   />

                                       ";




                            }
                            elseif($resultado == 'Errou'){

                            $resposta = explode("\n",$resposta);
                            $resposta = implode("<br>",$resposta);

                              $blocoAluno =
                              "<form name='formulario' method='POST' action=''>
                                    <div class='col-md-5 col-md-offset-1'>
                                        <div    style='text-shadow:none;border-radius:4px' class='panel-primary'>
                                          <div style='border-radius:4px'class='panel-heading'>Bloco Único de Resposta do Aluno</div>
                                          <div id='bloco1'  name='correcao'  style='background-color:black;border-radius:4px'class='panel-body'>$resposta</div>
                                        </div>
                                     </div>
                                <h5>O Aluno errou a resposta desta atividade</h5>
                                  <img width='50'src='../images/negativo.png'   />

                                     ";



                            }





                      }



//Resposta da correção -----------------------------------------
                      if(isset($_POST['resultado'])){


                             if($_POST['resultado'] == 'Acertou' ){

                                     $codigo_corrigido = $_POST['correcao'];
                                     $email = $_POST['emailAluno'];

                                     mysql_query("UPDATE `atividade_aluno` SET `Correcao_Nivel_3`='$codigo_corrigido' , `Status`='Acertou' WHERE `ID_Atividade`='$atividade' AND `ID_Aluno`='$email'");

                                     echo "<script>alert('Resposta enviada com sucesso!')</script>";


                             }
                             else{


                               $codigo_corrigido = $_POST['correcao'];
                               $email = $_POST['emailAluno'];

                               mysql_query("UPDATE `atividade_aluno` SET `Correcao_Nivel_3`='$codigo_corrigido' , `Status`='Errou' WHERE `ID_Atividade`='$atividade' AND `ID_Aluno`='$email'");

                               echo "<script>alert('Resposta enviada com sucesso!')</script>";




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
                             <h6>Abaixo estão os resultados dos alunos ou atividades que precisam ser corrigidas, selecione-as para corrigir</h6>

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
                        <h6>Abaixo está o bloco cadastrado e a resposta do aluno, você pode editar a resposta se estiver errada ou certa, caso necessário</h6>



                     <div id="columns">

                       <?php


                       $queryBloco = mysql_query("SELECT * FROM `bloco_linhas` WHERE `ID_atividade`='$atividade'");
                       $blocos = mysql_fetch_array($queryBloco);
                       $bloco = $blocos['texto'];
                       $bloco = explode("\n", $bloco);
                       $bloco = implode("<br>",$bloco);



                         echo   "
                         <div class='col-md-5 col-md-offset-1'>
                             <div    style='text-shadow:none;border-radius:4px' class='panel-primary'>
                               <div style='border-radius:4px'class='panel-heading'>Bloco Único Cadastrado</div>
                               <div id='bloco1'  style='background-color:black;border-radius:4px'class='panel-body'>$bloco</div>
                             </div>
                          </div>
                                ";


                          echo $blocoAluno;
                          echo $form;


                        ?>
                      </div>






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
