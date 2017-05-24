<!DOCTYPE html>
<?php

require_once 'conexao.php'; //Puxa o banco de dados
session_start();
if(!isset($_SESSION['usuario_session']) && !isset($_SESSION['senha_session']) ){
    echo "<meta http-equiv='refresh' content='0, url=index.php'>";
}

?>

<!-- Atualiza tela com avisos-->
<?php

  $mensagem = array();
  $cont2=0;

  if(isset($_GET['turmas'])){



         $turmas = explode(",",$_GET['turmas']);
         $achou = FALSE;


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

          while($info2 = mysql_fetch_array($query2)){
            //Conseguiu achar algum aviso
            $achou = TRUE;
            $data = $info2['Data'];

            //Mensagem para utilizar no lugar correto
            array_push($mensagem,"


                 <button class='scrollAvisosButton '>". $info2['Titulo']."</button>
                <div class='avisoBox'style='border-radius:4px;background-color:#79BD9A;color:white;max-height:0;overflow:hidden;transition:max-height 0.2s ease-out;' >
                  ". $info2['Texto']. "<br><p style='position:relative;right:10px;top:5px;font-size:10px;color:black; text-align:right'>".$disciplina."<br>".$emailContato."<br>". $professor ."<br>". $data ."
                </div><br>


            ");


          }

          }



         }


          // Não achou aviso
         if(!$achou){

          array_push($mensagem,"

          <h4>Não existem avisos Cadastrados</h4>


          ");

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
                                    <li><a href="principalProf.php">Início</a></li>
                                    <li><a href="minhasTurmas.php">Minhas turmas</a></li>
                                    <li class="active"><a href="cadastrarAviso.php">Cadastrar Aviso</a></li>
                                    <li><a href="?go=sair">Logoff</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    </div>

        <h2 style="text-align:center"> Cadastro de Avisos</h2>
        <br>


                    <div  class="inner cover" >

                      <div class="col-md-6 col-xs-12" >
                       <h3 class="cover-heading" style="font-size:20px;" > Avisos Cadastrados</h3>


                     <!-- Imprimi avisos, caso existam-->
                     <?php


                          for( $i=0; $i<sizeof($mensagem); $i++){

                              echo $mensagem[$i];
                              if($i == 2){
                                break;
                              }

                            }
                          

                      ?>


                      <div class="col-md-12 col-xs-12 col-md-offset-4 col-xs-offset-3">
                     <form name="paginacao" method="get" action="">

                        <div  class="btn-toolbar">
                          <div class="btn-group" >
                            <button type="button" name="b1" onlick="javascript:setPag(1,'pagination')" class="btn btn-warning">1</button>
                            <button type="button" name="b2" onlick="javascript:setPag(2, 'pagination')" class="btn btn-warning">2</button>
                            <button type="button" name="b3" onlick="javascript:setPag(3,'pagination')" class="btn btn-warning">3</button>
                            <button type="submit" name="b4" value = "4" class="btn btn-warning">4</button>
                          </div>
                        </div>
                      </div>
                    </form>

                      </div>






                    <div class="col-md-6 col-xs-12" style="border-left:solid 1px LightBlue">

                    <form name="formulario2" id="formulario2" class="form-signin" method="post" action="../model/action.php">
                     <input type='hidden' id='action2' name='action'  />
                      <?php

                      if(isset($_GET['turmas'])){

                        $turmas = $_GET['turmas'];

                      echo "<input type='hidden' name='turmas' id='turmas' value='$turmas' >";


                          }

                       ?>
                      <label for="titulo" style="text-align:left;font-size:15px;position:relative;right:95px;">Título do aviso</label>
                      <br>
                      <input type="text" class="form-control" name="titulo" id="titulo" required placeholder="Título" maxlength="20" style="color:black;text-align:left;border-radius:10px;position:relative;right:3px;"></input>
                      <br>
                      <br>
                      <label for="aviso" style="text-align:left;font-size:15px;position:relative;right:95px;">Texto do Aviso</label>
                      <br>
                      <textarea id="aviso" class="form-control" style="color:black;text-align:left;border-radius:10px;" required name="aviso" rows="5" cols="50" placeholder="Mensagem"> </textarea>
                      <br>
                      <a type="button" class="btn btn-warning" value="Cadastrar aviso" onclick="javascript:doPostForm2('formulario2', 'cadastrarAviso');">Cadastrar aviso</a>




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
        <script src="../js/codeBasic.js"  type="text/javascript"></script>

<!-- Uso temporário Não consigo importar o funcoes.js-->



    </body>
</html>

<!-- Atualizar paginação-->


<?php


if(@$_GET['go'] == "sair"){
    unset($_SESSION['usuario_session']);
    unset($_SESSION['senha_session']);
    echo "<meta http-equiv='refresh' content='0, url=index.php'>";
}
?>
