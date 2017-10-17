<?php
require_once 'conexao.php';
session_start();
if(!isset($_SESSION['usuario_session']) && !isset($_SESSION['senha_session']) ){
    echo "<meta http-equiv='refresh' content='0, url=index.php'>";
}

?>
<?php

    $mensagem = array();
    $atividadesParaFazer = array();


   $turmas = $_GET['turmas'];
   $turmas = explode(',', $turmas);

   for($i=0; $i<sizeof($turmas); $i++){

    $turma = $turmas[$i]; //Verifica atividades que estao na turma
     $queryTurmasAtividades = mysql_query("SELECT * FROM `atividade_turma` WHERE `ID_turma` = '$turma' ");

     if(mysql_num_rows($queryTurmasAtividades)>0){ //Tem Atividades a verificar


        while($atividades = mysql_fetch_array($queryTurmasAtividades)){

            $atividade = $atividades['ID_atividade'];
            $query1 = mysql_query("SELECT * FROM `atividade` WHERE `ID` = '$atividade'");
            $verificaNivel = mysql_fetch_array($query1);
            if($verificaNivel['Nivel'] == 2){ //Coloca somente atividades do nivel 1

            $queryAtividadeAluno = mysql_query("SELECT * FROM `atividade_aluno` WHERE `ID_atividade` = '$atividade' AND `Status` = 'NaoTentou' AND `ID_Aluno` = '$_SESSION[usuario_session]' ");

          if(mysql_num_rows($queryAtividadeAluno)>0){ //Tem atividades nao feitas
            while($atividadeNaoFeita = mysql_fetch_array($queryAtividadeAluno)){

              array_push($atividadesParaFazer, $atividadeNaoFeita['ID_Atividade']);
            }

           }

            }

        }




   }




}


$atividadesParaFazer =  array_unique($atividadesParaFazer);    //Tira duplicações



  asort($atividadesParaFazer); //Coloca na ordem dos mais recentes
  for($b=0;$b<sizeof($atividadesParaFazer);$b++){ //Busca atividades que tem para fazer
  $ID_atividade = $atividadesParaFazer[$b];
  $queryAtividade = mysql_query("SELECT * FROM `atividade` WHERE `ID` ='$ID_atividade'");

  $atividadeBusca= mysql_fetch_array($queryAtividade);

  array_push($mensagem, "

              <button type='submit' class='buttonLesson' name ='botaoExercicio' value=".$atividadeBusca['ID'].",".$atividadeBusca['Descricao']. ">" .$atividadeBusca['Descricao']. "</button><br/>
              <br>
  ");

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
                                          <li><a href="principalAluno.php">Início</a></li>
                                          <li><a href="minhasTurmasAluno.php">Minhas turmas</a></li>
                                          <li class="active"><a href="resolverExerciciosNivel2.php">Exercícios Nível 2</a></li>
                                          <li><a href="?go=sair">Logoff</a></li>
                                      </ul>
                                  </nav>
                              </div>
                          </div>

                          </div>

         <br><br>


                          <div  class="inner cover"  >
                            <h2 style="text-align:center">Resolver Exercícios Nível 2</h2>
                            <br>

                            <div class="col-md-4 col-xs-12" >
                             <h3 class="cover-heading" style="font-size:20px;" > Atividades Cadastradas</h3>
                             <h6>Escolha a atividade a ser resolvida</h6>

                            <form name="atividade" method="post" action="">

                           <!-- Imprimi atividades, caso existam e  Atualizar paginação -->
                           <?php

                                   if(empty($mensagem)){
                                   echo "<div style='text-shadow:none'class='alert alert-danger alert-link' role='alert'><h4 class='alert-heading'><strong>Atenção!</strong></h4><strong>Não</strong> Existem Atividades Cadastradas&emsp;Entre em contato com o seu <strong>professor</strong>!</div>";
                                   }
                                   else{

                                   if(!isset($_POST['b'])){

                                     $espaços = 0;
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
                                         case 2:  break;
                                         default :

                                        }

                                        $_SESSION['atualiza'] = 0;
                                     }
                                     else{ //Não possui avisos suficientes para esta pagina

                                       echo "<div style='text-shadow:none' class='alert alert-danger' role='alert'><h4 class='alert-heading'><strong>Atenção </strong> </h4>Não existem atividades Cadastradas.&emsp;Entre em contato com o seu professor</div>
                                       <br><br><br><br><br><br><br><br><br><br>";
                                       $_SESSION['atualiza'] = 0;
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

                                     echo "<div style='text-shadow:none' class='alert alert-danger' role='alert'><h4 class='alert-heading'><strong>Atenção </strong> </h4>Não existem atividades Cadastradas.&emsp;Entre em contato com o seu professor</div>
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

                                     echo "<div style='text-shadow:none' class='alert alert-danger' role='alert'><h4 class='alert-heading'><strong>Atenção </strong> </h4>Não existem atividades Cadastradas.&emsp;Entre em contato com o seu professor</div>
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

                                     echo "<div style='text-shadow:none' class='alert alert-danger' role='alert'><h4 class='alert-heading'><strong>Atenção </strong> </h4>Não existem atividades Cadastradas.&emsp;Entre em contato com o seu professor</div>
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

                                     echo "<div style='text-shadow:none' class='alert alert-danger' role='alert'><h4 class='alert-heading'><strong>Atenção </strong> </h4>Não existem atividades Cadastradas.&emsp;Entre em contato com o seu professor</div>
                                     <br><br>";
                                   }
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
                        <h3 class="cover-heading" style="font-size:20px">Atividade</h3>
                        <h6>Ajuste os blocos abaixo para que a  ordem de execução do algoritmo esteja correta</h6>

                        <form name="blocos" method="post" action="">

                     <div id="columns">

                       <?php
                   $ordemBlocos = array();
                           if(@$_POST['botaoExercicio'] ){

                               if(!empty($ordemBlocos)){
                                 $ordemBlocos = array();
                               }

                               $value =explode( ',',$_POST['botaoExercicio']); //Pega informações da atividade
                               $atividade = $value[0];
                               $titulo = $value[1];

                               $queryBlocos = mysql_query("SELECT * FROM `bloco_linhas` WHERE `ID_atividade` = '$atividade'");
                               $blocos = array();

                              ;
                               while($busca = mysql_fetch_array($queryBlocos)){ //Coloca em array os blocos, Sempre serão 3
                               $bloco = $busca['texto'];

                               array_push($blocos, "

                                <div  draggable='true'  style='text-shadow:none;border-radius:4px' class='panel-primary column'>
                                  <div style='border-radius:4px'class='panel-heading'>".$titulo."</div>
                                  <div id='bloco".$busca['Bloco']."'  style='background-color:black;border-radius:4px'class='panel-body'>".$bloco."</div>
                                  <input type='hidden'name='idAtividade' value='".$atividade."'/>
                                </div>

                                   ");


                               }

                               for($i=0; $i<sizeof($blocos); $i++){ //Monta ordem aleatória dos blocos
                                   $num;
                                  do{ //Procura numero aleatorio
                                    $num = rand(0,sizeof($blocos)-1);

                                    if(!in_array($num, $ordemBlocos,false)){

                                         array_push($ordemBlocos, $num);  //Adiciona na ordem

                                    }

                                   }
                                  while(sizeof($ordemBlocos)<sizeof($blocos));



                               }


                               for($i=0; $i<sizeof($ordemBlocos); $i++){ //Imprime blocos na ordem gerada
                                 $a = $i+1;

                                 echo "<div class='col-md-4 col-xs-4'>";
                                 echo "<label for='bloco' >Posição $a</label>";
                                 echo "<div id='coluna".$a."'name='bloco' >";
                                 echo $blocos[$ordemBlocos[$i]];
                                 echo "</div>";
                                 echo "<input id='posicao'type='hidden' value='".$a."' name='posicao' >";
                                 echo "</div>";


                               }


                           }






                        ?>



                      </div>

                        </form>

                            <br><br><br><br><br><br><br><br><br><br><br><br><br><br>


                          <button class="btn btn-info"  onclick="javascript:verificarResposta();">Enviar Resposta</button>
                          <button class="btn btn-danger" onclick="javascript:cancelarAtividade();">Cancelar</button>
                          <br><br>

                          <form style="visibility:hidden"method="POST" action="../model/action.php">
                            <?php
                                   $turmasString = implode(',' , $turmas);
                                   echo "<input type='hidden' name='turmas' value=$turmasString/>";

                             ?>
                            <input id="atividade"type="hidden" name="atividade" value="">
                            <input name="action" value="gerarResultado" />
                            <input id="acertou" name="resultado" type="submit" value="acertou,2" />
                            <input id="errou" name="resultado" type="submit" value="errou,2" />
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
