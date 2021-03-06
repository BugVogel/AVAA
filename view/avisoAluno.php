<!DOCTYPE html>
<?php
require_once 'conexao.php';
session_start();
if(!isset($_SESSION['usuario_session']) && !isset($_SESSION['senha_session']) ){
    echo "<meta http-equiv='refresh' content='0, url=index.php'>";
}
else{
?>

<!-- Atualiza array para imprimir avisos na tela-->
<?php

//Função para recolher avisos (deve vim antes)
function pegarAvisos($query2, $info2, &$mensagem, $disciplina, $emailContato, $professor){

   if( $info2 = mysql_fetch_array($query2)){

      pegarAvisos($query2, $info2, $mensagem, $disciplina, $emailContato, $professor);

   }
   else{ //Fim da tabela no banco de dados
     return;
   }

  $data = $info2['Data'];
  //Mensagem para utilizar no lugar correto
   array_push($mensagem,"


        <button class='scrollAvisosButton '>". $info2['Titulo']."</button>
       <div class='avisoBox'style='border-radius:4px;background-color:#79BD9A;color:white;max-height:0;overflow:hidden;transition:max-height 0.2s ease-out;' >
         ". $info2['Texto']. "<br><p style='position:relative;right:10px;top:5px;font-size:10px;color:black; text-align:right'>".$disciplina."<br>".$emailContato."<br>". $professor ."<br>". $data ."
       </div><br>


   ");



}




  $mensagem = array();


  if(isset($_GET['turmas'])){



         $turmas = explode(",",$_GET['turmas']);



      //Procura avisos das turmas selecionadas
        for($i =0; $i<sizeof($turmas); $i++){


           //Pega nome da disciplina e dados do professor
           $query1 = mysql_query("SELECT * FROM `turma` WHERE `ID` ='$turmas[$i]'");
           $info1 = mysql_fetch_array($query1);
           $emailContato = $info1['Professor'];
           $professorQuery = mysql_query("SELECT * FROM `professor` WHERE `Email` = '$emailContato'");
           $professorDB = mysql_fetch_array($professorQuery);
           $disciplina = $info1['Disciplina'];
           $professor = $professorDB['Nome'];


           $ID = $turmas[$i];
           //Pega avisos cadastrados
           $query2 = mysql_query("SELECT * FROM `aviso` WHERE `ID_Turma` = '$ID' ");

           //Verifica se tem aviso
           if(mysql_num_rows($query2) > 0){


            //Conseguiu achar algum aviso

            $info2 = array();

            pegarAvisos($query2, $info2, $mensagem, $disciplina, $emailContato, $professor);



        }



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

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../cover.css" rel="stylesheet">
        <link href="../signin.css" rel="stylesheet">
        <link href="../css/style2.css" rel="stylesheet">
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
                                    <li class="active"><a href="#">Avisos</a></li>
                                    <li><a href="?go=sair">Logoff</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div class="inner cover">
                        <h2 class="cover-heading" style="padding: 2px;">Avisos Cadastrados</h2>

                        <!-- Imprimi avisos, caso existam e  Atualizar paginação -->
                      <?php
                      //Seta avisos iniciais sem POST
                     if($_SESSION['atualiza'] != 0){
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
                           case 1: echo "<br><br><br><br><br><br><br><br>"; break;
                           case 2: echo "<br><br><br><br>"; break;
                           default :

                          }

                          $_SESSION['atualiza'] = 0;
                       }
                       else{ //Não possui avisos suficientes para esta pagina

                         echo "<h4>Não existem avisos Cadastrados</h4>
                         <br><br><br><br><br><br><br><br><br><br>";
                         $_SESSION['atualiza'] = 0;
                       }


                     }



                     if(@$_POST['b'] == '1'){

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
                         case 1: echo "<br><br><br><br><br><br><br><br>"; break;
                         case 2: echo "<br><br><br><br>"; break;
                         default :

                        }

                     }
                     else{ //Não possui avisos suficientes para esta pagina

                       echo "<h4>Não existem avisos Cadastrados</h4>
                       <br><br><br><br><br><br><br><br><br><br>";
                     }




                     }
                     if(@$_POST['b'] == '2'){

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
                           case 1: echo "<br><br><br><br><br><br><br><br>"; break;
                           case 2: echo "<br><br><br><br>"; break;
                           default :

                          }

                       }
                       else{ //Não possui avisos suficientes para esta pagina

                         echo "<h4>Não existem avisos Cadastrados</h4>
                         <br><br><br><br><br><br><br><br><br><br>";
                       }




                     }
                     if(@$_POST['b'] == '3'){


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
                           case 1: echo "<br><br><br><br><br><br><br><br>"; break;
                           case 2: echo "<br><br><br><br>"; break;
                           default :

                          }

                       }
                       else{ //Não possui avisos suficientes para esta pagina

                         echo "<h4>Não existem avisos Cadastrados</h4>
                         <br><br><br><br><br><br><br><br><br><br>";
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
                           case 1: echo "<br><br><br><br><br><br><br><br>"; break;
                           case 2: echo "<br><br><br><br>"; break;
                           default :

                          }

                       }
                       else{ //Não possui avisos suficientes para esta pagina

                         echo "<h4>Não existem avisos Cadastrados</h4>
                         <br><br><br><br><br><br><br><br><br><br>";
                       }



                     }



                       ?>
                    </div>
              <div class="col-md-12 col-xs-12  col-md-offset-1">
                    <form class="form-signin" method="POST" action="">
                      <div  class="btn-toolbar">
                        <div class="btn-group" >
                          <button type="submit" name="b" value ='1' class="btn btn-warning">1</button>
                          <button type="submit" name="b" value ='2' class="btn btn-warning">2</button>
                          <button type="submit" name="b" value ='3' class="btn btn-warning">3</button>
                          <button type="submit" name="b" value ='4' class="btn btn-warning">4</button>
                        </div>
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
        <script src="../js/codeBasic.js"  type="text/javascript"></script>
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
