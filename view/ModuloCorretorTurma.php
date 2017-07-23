<!DOCTYPE html>
<?php

require_once 'conexao.php'; //Puxa o banco de dados
session_start();
if(!isset($_SESSION['usuario_session']) && !isset($_SESSION['senha_session']) ){
    echo "<meta http-equiv='refresh' content='0, url=index.php'>";
}
?>

<!-- Atualiza array para imprimir avisos na tela-->
<?php

 require_once '../model/montarMensagemModuloCorretor.php';




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
                                    <li><a href="principalProf.php">Início</a></li>
                                    <li><a href="minhasTurmas.php">Minhas turmas</a></li>
                                    <li class="active"><a href="">Resultado Atividades</a></li>
                                    <li><a href="?go=sair">Logoff</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    </div>

   <br><br>


                    <div  class="inner cover"  >
                      <h2 style="text-align:center"> Resultado de Atividades</h2>
                      <h5>Selecione a atividade para verificar o resultado de cada aluno nas turmas cadastradas</h5>
                      <br>

                      <div style="border-right: solid 1px LigthBlue" class="col-md-4 col-xs-12" >
                       <h3 class="cover-heading" style="font-size:20px;" > Resultados de Atividades Nível 1</h3>
                     <!-- Imprimi atividades, caso existam e  Atualizar paginação -->
                     <?php

                        if(!isset($_POST['bN1'])){
                            if(!empty($mensagemNivel1)){ //Tem atividades cadastradas
                               for($i=0;$i<sizeof($mensagemNivel1);$i++){

                                 echo $mensagemNivel1[$i];
                               }
                             }
                             else{
                                $turmasString = implode(',',$turmas);
                                echo "<div style='text-shadow:none'class='alert alert-danger alert-link' role='alert'><h4 class='alert-heading'><strong>Atenção!</strong></h4><strong>Não</strong> Existem Atividades Cadastradas nesta página&emsp;Cadastre novas atividades nesta turma clicando <strong><a style='color:#a94442'href='cadastroAtividadeFacil.php?turmas=$turmasString'>aqui!</a></strong></div>";
                             }
                           }

                          require_once '../model/paginacaoModuloCorretorN1.php';




                      ?>

                      <div class="col-md-12 col-xs-12 col-md-offset-4 col-xs-offset-3">
                     <form name="paginacao" method="POST" action="" >

                        <div  class="btn-toolbar">
                          <div class="btn-group" >
                            <button type="submit" name="bN1" value ='1' class="btn btn-warning">1</button>
                            <button type="submit" name="bN1" value ='2' class="btn btn-warning">2</button>
                            <button type="submit" name="bN1" value ='3' class="btn btn-warning">3</button>
                            <button type="submit" name="bN1" value ='4' class="btn btn-warning">4</button>
                          </div>
                        </div>

                    </form>
                   </div>
                  </div>

               <!--Atividades do nível 2 -->
               <div class="col-md-4 col-xs-12" >
                <h3 class="cover-heading" style="font-size:20px;" > Resultado de Atividades Nível 2</h3>
              <!-- Imprimi atividades, caso existam e  Atualizar paginação -->
              <?php

              if(!isset($_POST['bN2'])){
                  if(!empty($mensagemNivel2)){ //Tem atividades cadastradas
                     for($i=0;$i<sizeof($mensagemNivel2);$i++){

                       echo $mensagemNivel2[$i];
                     }
                   }
                   else{
                      $turmasString = implode(',',$turmas);
                      echo "<div style='text-shadow:none'class='alert alert-danger alert-link' role='alert'><h4 class='alert-heading'><strong>Atenção!</strong></h4><strong>Não</strong> Existem Atividades Cadastradas nesta página&emsp;Cadastre novas atividades nesta turma clicando <strong><a style='color:#a94442'href='cadastroAtividadeMedio.php?turmas=$turmasString'>aqui!</a></strong></div>";
                   }
                 }

                require_once '../model/paginacaoModuloCorretorN2.php';

               ?>

               <div class="col-md-12 col-xs-12 col-md-offset-4 col-xs-offset-3">
              <form name="paginacao" method="POST" action="" >

                 <div  class="btn-toolbar">
                   <div class="btn-group" >
                     <button type="submit" name="bN2" value ='1' class="btn btn-warning">1</button>
                     <button type="submit" name="bN2" value ='2' class="btn btn-warning">2</button>
                     <button type="submit" name="bN2" value ='3' class="btn btn-warning">3</button>
                     <button type="submit" name="bN2" value ='4' class="btn btn-warning">4</button>
                   </div>
                 </div>

             </form>
            </div>
           </div>

           <!--Atividades do nível 2 -->
           <div class="col-md-4 col-xs-12" >
            <h3 class="cover-heading" style="font-size:20px;" > Resultado de Atividades Nível 3</h3>
          <!-- Imprimi atividades, caso existam e  Atualizar paginação -->
          <?php

          if(!isset($_POST['bN3'])){
              if(!empty($mensagemNivel3)){ //Tem atividades cadastradas
                 for($i=0;$i<sizeof($mensagemNivel3);$i++){

                   echo $mensagemNivel3[$i];
                 }
               }
               else{
                  $turmasString = implode(',',$turmas);
                  echo "<div style='text-shadow:none'class='alert alert-danger alert-link' role='alert'><h4 class='alert-heading'><strong>Atenção!</strong></h4><strong>Não</strong> Existem Atividades Cadastradas nesta página&emsp;Cadastre novas atividades nesta turma clicando <strong><a style='color:#a94442'href='cadastrarAtividadeDificil.php?turmas=$turmasString'>aqui!</a></strong></div>";
               }
             }

            require_once '../model/paginacaoModuloCorretorN3.php';

           ?>

           <div class="col-md-12 col-xs-12 col-md-offset-4 col-xs-offset-3">
          <form name="paginacao" method="POST" action="" >

             <div  class="btn-toolbar">
               <div class="btn-group" >
                 <button type="submit" name="bN3" value ='1' class="btn btn-warning">1</button>
                 <button type="submit" name="bN3" value ='2' class="btn btn-warning">2</button>
                 <button type="submit" name="bN3" value ='3' class="btn btn-warning">3</button>
                 <button type="submit" name="bN3" value ='4' class="btn btn-warning">4</button>
               </div>
             </div>

         </form>
        </div>
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
        <script src="../js/codeBasic.js"  type="text/javascript"></script>
        <script src ="../js/funcoes.js" type="text/javascript"></script>
<!-- Uso temporário Não consigo importar o funcoes.js-->



    </body>
</html>




<?php


if(@$_GET['go'] == "sair"){
    unset($_SESSION['usuario_session']);
    unset($_SESSION['senha_session']);
    echo "<meta http-equiv='refresh' content='0, url=index.php'>";
}
?>
