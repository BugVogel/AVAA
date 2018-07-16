<!DOCTYPE html>

<?php
require_once 'conexao.php';
session_start();
$_SESSION['atualiza'] = 1;
if (!isset($_SESSION['usuario_session']) && !isset($_SESSION['senha_session'])) {
    echo "<meta http-equiv='refresh' content='0, url=index.php'>";
} else {


//remover Recurso

if(isset($_POST['removerRecurso'])){

 $id = $_POST['removerRecurso'];

    $query = mysql_query("SELECT*FROM `recursos` WHERE `ID` = '$id'");

    $recurso = mysql_fetch_array($query);
    $arquivo = $recurso['Caminho'];
    @unlink($arquivo);


    mysql_query("DELETE FROM `recursos` WHERE `ID` = $id");



}



//cadastro de Recurso
if(isset($_POST['enviarRecurso'])){

   $turma = $_GET['turmas'];


if($_POST['descricao'] != ""){
   $descricao = $_POST['descricao'];


  
   if(isset($_FILES['arquivo'])) {
     
      echo "<script>alert('teste')</script>";
          if($_FILES['arquivo']['name'] != ""){
                $src = $_FILES['arquivo'];

                 $arquivo = $src['tmp_name'];
                 
               

                

                mysql_query("INSERT INTO `recursos` (`Descricao`, `Turma`) VALUES ('$descricao',$turma)");
                $ID = mysql_insert_id();
                 
                $nomeArquivo = "Arquivo". $ID ."." .pathinfo($src['name'], PATHINFO_EXTENSION) ;
                $caminho = '../data/'. $nomeArquivo;

                mysql_query("UPDATE `recursos` SET `Caminho`='$caminho'");

                
                
                move_uploaded_file($arquivo,$caminho);
               

              }
              else{
                echo "<script>alert('Selecione o recurso')</script>";
              }
              
   }
   else if(isset($_POST['link']) ){

    if($_POST['link'] != ""){
        $link = $_POST['link'];

        mysql_query("INSERT INTO `recursos` (`Descricao`, `Turma`,`Caminho`) VALUES ('$descricao','$turma','$link')");
      }
   }
   else{


     echo "<script>alert('Selecione o recurso')</script>";
   }







 }
 else{

         echo "<script>alert('Adicione uma  descrição')</script>";

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
            <!-- Recursos JS-->
            <script src='../js/recursos.js' type="text/javascript"></script>

            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
            <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
        </head>

        <body>




<div class="cover-container">

                        <div class="masthead clearfix">
                            <div class="inner">

                                <nav>
                                    <ul class="nav masthead-nav">
                                        <li><a href="principalProf.php">Início</a></li>
                                        <li><a href="minhasTurmas.php">Minhas turmas</a></li>
                                        <li class="active"><a href="">Recursos</a></li>
                                        <li><a href="ModuloCorretor.php">Módulo corretor</a></li>
                                        <li><a href="?go=sair">Logoff</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

 <br> <br> <br> <br> <br> <br>

                  <div class='row'>
                    <div  class='col-md-12'>
                    <h3>Recursos Cadastrados</h3>
                  </div>
                  </div>
                  <div  class='row'>
                    <div class='col-md-12'>
                         <form name='remover'method='POST' action='' >
                      <?php

                         $turma = explode(',', $_GET['turmas']); //sempre será uma


                                     $query = mysql_query("SELECT*FROM `recursos` WHERE `Turma` = '$turma[0]'");

                                     if(mysql_num_rows($query)>0){


                                                echo "


                                                       <table class='table' style='border-radius:10px;'>
                                                       <thead>
                                                       <tr>
                                                       <td>Descrição</td>
                                                       <td>Download</td>
                                                       <td>Remover</td>
                                                       </tr>
                                                       </thead>
                                                       <tbody>
                                                ";


                                              while($recursos = mysql_fetch_array($query)){

                                                      if($turma[0] == $recursos['Turma']){

                                                                $descricao = $recursos['Descricao'];
                                                                $link = $recursos['Caminho'];
                                                                $id = $recursos['ID'];


                                                                echo "

                                                                            <tr>
                                                                            <td>$descricao</td>
                                                                            <td><a target='_blank'class='btn btn-default' role='button' href='$link'>Download</a></td>
                                                                            <td><button name='removerRecurso' type='submit' class='btn btn-default' value='$id'>Remover</button></td>
                                                                            </tr>

                                                                ";

                                                      }


                                              }


                                              echo "</tbody>";
                                              echo"</table";





                                     }
                                     else{


                                       echo "<div style='text-shadow:none' class='alert alert-danger' role='alert'><h4 class='alert-heading'><strong>Atenção </strong> </h4>Não existem recursos cadastrados nesta turma.&emsp;</div>";



                                     }


                       ?>

                     </form>
                   </div>
                  </div>
<br><br>

  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Adicionar</button>

  <!-- Modal -->
  <form name='cadastro'method='post' action='' enctype="multipart/form-data">
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style='color:#04395b;text-shadow:none'class="modal-title">Cadastrar Novo Recurso para esta Turma</h4>
        </div>
        <div class="modal-body">

          <label style='color:#04395b;text-shadow:none' for='descricao'>Descrição</label><br>
          <input class='form-control'  type='text' name='descricao'   /><br>
          <label style='color:#04395b;text-shadow:none'class='checkbox-inline'><input name='check' id='check1' onclick='onlyOneCheck(this)' checked type='checkbox' value='arquivo'>Arquivo</label>
          <label style='color:#04395b;text-shadow:none'class='checkbox-inline'><input name='check' id='check2' onclick='onlyOneCheck(this)' type='checkbox' value='link'>Link</label><br><br>
          <label id='fileLabel' for='arquivo' style='color:#04395b;text-shadow:none'>Adicionar Arquivo</label><br>
          <input id='fileInput' type='file' name='arquivo' /><br>
          <label id='linkLabel'style='color:#04395b;text-shadow:none;visibility:hidden;' type='hidden' for='link' >Adicionar Link</label>
          <input id='linkInput' class='form-control' type='hidden' name='link' /><br>
          <button name='enviarRecurso' class='btn btn-success' type='submit'>Enviar</button>

        </div>
      </div>

    </div>
  </div>
  </form>






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
