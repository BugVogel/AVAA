<?php

require_once '../view/conexao.php';
session_start();
if(!isset($_SESSION['usuario_session']) && !isset($_SESSION['senha_session']) ){
    echo "<meta http-equiv='refresh' content='0, url=index.php'>";
}



//pego o nome da função que foi passada para o campo hidden

  $funcao = $_REQUEST["action"];




//verifica se a função existe
//http://br2.php.net/manual/pt_BR/function.function-exists.php

if (function_exists($funcao)) {

//call_user_func Chama uma função de usuário dada pelo primeiro parâmetro
//http://br2.php.net/manual/pt_BR/function.call-user-func.php
    call_user_func($funcao);
}


function salvar() {
//	$campo  = $_POST["campo"];
//	$campo2  = $_POST["campo2"];
//	echo "<script>alert('Salvando [$campo] e [$campo2]');</script>";
//	echo "<script>location.href = 'index.html';</script>";

    $email = $_POST['email'];
    $idTurma = $_POST['idTurma'];

    $res = mysql_query("SELECT * FROM `aluno` WHERE `Email`= '$email'");

    $nLinhas = mysql_num_rows($res);

    if ($nLinhas > 0) {
        mysql_query("INSERT INTO `turma_alunos`(`ID_turma`, `ID_aluno`) VALUES ('$idTurma','$email')");
        echo "<meta http-equiv='refresh' content='1, url=../view/cadastroAlunoTurma.php?ID=$idTurma'>";
    } else {
        echo "<meta http-equiv='refresh' content='1, url=../view/cadastroAlunoTurma.php?ID=$idTurma'>";
        echo '<script language="javascript">';
        echo 'alert("Não há aluno cadastrado com este email.")';
        echo '</script>';
    }
}

function editar() {
    echo "<script>alert('Editar turma');</script>";
}

function excluir() {
    $idTurma = $_POST['idTurma'];

    $nAlunos = count($_POST['del']);

    if($nAlunos > 0){

        foreach ($_POST['del'] as $remove_item) {
            mysql_query("DELETE FROM turma_alunos WHERE ID_aluno=\"$remove_item\" and ID_turma=$idTurma");
        }
        echo "<meta http-equiv='refresh' content='1, url=../view/cadastroAlunoTurma.php?ID=$idTurma'>";
    }
    else{
        echo "<script>alert('Nenhum aluno selecionado');</script>";
        echo "<meta http-equiv='refresh' content='1, url=../view/cadastroAlunoTurma.php?ID=$idTurma'>";
    }
}

function excluirTurma(){


    if(isset($_POST['turmas'])){

        foreach ($_POST['turmas'] as $remove_item) {
            mysql_query("DELETE FROM turma_alunos WHERE ID_turma=$remove_item");
            mysql_query("DELETE FROM turma WHERE ID=$remove_item");

        }
        echo "<meta http-equiv='refresh' content='1, url=../view/minhasTurmas.php'>";
    }
    else{
        echo "<script>alert('Você não selecionou nenhuma turma');</script>";
        echo "<meta http-equiv='refresh' content='0, url=../view/minhasTurmas.php'>";
    }
}
function redCadastrarAtividade(){
    $nivel = $_POST['nivel'];
     $turmas = $_POST['turmas'];
    if($nivel == 1){
         echo "<meta http-equiv='refresh' content='0, url=../view/cadastroAtividadeFacil.php?turmas=$turmas'>";
    }
    else if($nivel == 2){
         echo "<meta http-equiv='refresh' content='0, url=../view/cadastroAtividadeMedio.php?turmas=$turmas'>";
    }
    else if($nivel == 3){

      echo "<meta http-equiv='refresh' content='0, url=../view/cadastrarAtividadeDificil.php?turmas=$turmas'>";
    }
}

function cadastrarAtividade(){

 if(isset($_POST['turmas'])){
    $turmas = $_POST['turmas'];
    $str_turmas = implode(",", $turmas);
    echo "<meta http-equiv='refresh' content='0, url=../view/selecaoNivel.php?turmas=$str_turmas'>";
  }
  else{
    echo "<script>alert('Você não selecionou nenhuma turma')</script>";
    echo "<meta http-equiv='refresh' content='0,url=../view/minhasTurmas.php'/>";

  }


}

function salvarAtividadeFacil(){
    $turmas = explode(",",$_POST['turmas']);
    $descricao = $_POST['descricao'];
    $entrada = $_POST['entrada'];
    $processamento = $_POST['processamento'];
    $saida = $_POST['saida'];
    $nivel = 1;
    $blocos = 3;


//    mysql_query("INSERT INTO `atividade`(`Descricao`, `Nível`, `N_Blocos`) VALUES (" . $descricao, 1 , 3 . ")");
//    $res = mysql_query("INSERT INTO `atividade`(`Descricao`, `Nível`, `N_Blocos`) VALUES (\'$descricao\', 1, 3)");
//    mysql_query("INSERT INTO `atividade`(`Descricao`, `Nível`, `N_Blocos`) VALUES ('$descricao', '$nivel', '$blocos')");
    $res = mysql_query("INSERT INTO `atividade` (`Descricao`, `Nivel`, `N_Blocos`) VALUES ('".$descricao."', '$nivel', '$blocos')");
    $ID = mysql_insert_id();

    $res = mysql_query("INSERT INTO `bloco_linhas` (`ID_atividade`, `Bloco`, `texto`) VALUES ('$ID', '1', '".$entrada."')");
    $res = mysql_query("INSERT INTO `bloco_linhas` (`ID_atividade`, `Bloco`, `texto`) VALUES ('$ID', '2', '".$processamento."')");
    $res = mysql_query("INSERT INTO `bloco_linhas` (`ID_atividade`, `Bloco`, `texto`) VALUES ('$ID', '3', '".$saida."')");


    for($i = 0; $i<sizeof($turmas); $i++)
    {
        $idTurma = $turmas[$i];
        $res = mysql_query("INSERT INTO `atividade_turma` (`ID_atividade`, `ID_turma`) VALUES ('$ID', '$idTurma')");

        $procura = mysql_query("SELECT * FROM `turma_alunos` WHERE `ID_turma` = $idTurma");

        while($alunos = mysql_fetch_array($procura)){

             $aluno = $alunos['ID_aluno'];

             $res = mysql_query("INSERT INTO `atividade_aluno` (`ID_atividade`,`ID_Aluno`,`Status`) VALUES ('$ID', '$aluno', 'NaoTentou')");

        }


    }

    echo "<meta http-equiv='refresh' content='1, url=../view/minhasTurmas.php'>";
    echo '<script language="javascript">';
    echo 'alert("Atividade cadastrada com sucesso!")';
    echo '</script>';
}


function salvarAtividadeNivel2(){

       //Pega informações necessárias
       $turmas = $_POST['turmas'];
       $texto = explode("\n", $_SESSION['codigo']); //Existe problema no '<' quando usado no código
       $linhas = $_POST['linhas'];
       $blocos = array();
       $b=0;
       $prox=0;
       $quantidade_blocos = sizeof($linhas);

       if( !($texto[$linhas[0]-1] == $texto[0]) ){  //Não selecionou a primeira linha
         $quantidade_blocos++;
       }


            for($i=0; $i<$quantidade_blocos;$i++){
              for($j=$b; $j<sizeof($texto);$j++){


                     if(isset($linhas[$prox])){

                       if($texto[$linhas[$prox]-1] == $texto[$j]){ //Para quando acha linha

                              if(empty($blocos[$i])){ //Primeira linha do bloco
                                $blocos[$i] = $texto[$j];
                                $prox +=1;
                                goto end; //Finaliza essa etapa do loop
                              }
                              else{ //Achou a linha selecionada do bloco seguinte

                                $b = $j; //Salva lugar que parou
                                break;
                              }


                       }

                     }
                     if(strpos($texto[$j],"}")){ //Para em fechamento de bloco
                          if(!isset($blocos[$i])){ //Faz o index existir
                            $blocos[$i] = "";
                           }
                           $lineCode =  $blocos[$i]. "<br>". $texto[$j] ;  //Adicionar
                           $blocos[$i] = $lineCode;
                           $b = $j+1;
                           break;
                     }
                     else{ //Adiciona ao bloco

                               if(!isset($blocos[$i])){ //Faz o index existir
                                 $blocos[$i] = "";
                               }


                              $lineCode =  $blocos[$i]. "<br>". $texto[$j] ;  //Adicionar
                              $blocos[$i] = $lineCode;



                       }

                      end: //Ponto de ida, do goto

              }
            }

           $descricao = $_SESSION['descricao_nivel2'];
           $nivel = $_SESSION['nivel'];
           $num_Blocos = sizeof($blocos);
           //Coloca em tabela atividade
           mysql_query("INSERT INTO `atividade` (`Descricao`, `Nivel`, `N_Blocos`) VALUES ('$descricao', '$nivel', '$num_Blocos')");
           $ID = mysql_insert_id();

           for($i = 0; $i<sizeof($blocos); $i++){ //Insere blocos em tabela bloco_linhas

               $num = $i+1;
               //Coloca blocos em tabela
               mysql_query("INSERT INTO `bloco_linhas`(`ID_atividade`,`Bloco`,`texto`) VALUES ('$ID', '$num','$blocos[$i]') ");

           }

           for($i = 0; $i<sizeof($turmas); $i++) //Adiciona atividades em turmas e em cada aluno
           {
               $idTurma = $turmas[$i];
               $res = mysql_query("INSERT INTO `atividade_turma` (`ID_atividade`, `ID_turma`) VALUES ('$ID', '$idTurma')");

               $procura = mysql_query("SELECT * FROM `turma_alunos` WHERE `ID_turma` = $idTurma");

               while($alunos = mysql_fetch_array($procura)){

                    $aluno = $alunos['ID_aluno'];

                    $res = mysql_query("INSERT INTO `atividade_aluno` (`ID_atividade`,`ID_Aluno`,`Status`) VALUES ('$ID', '$aluno', 'NaoTentou')");

               }


           }

            echo "<meta http-equiv='refresh' content='0, url=../view/minhasTurmas.php'>";
            echo "<script>alert('Atividade cadastrada com sucesso!')</script>";

     }


     function salvarAtividadeDificil(){


               $turmas = $_POST['turmas'];
               $descricao = $_POST['descricao'];
               $codigo = $_POST['codigo'];
               $nivel = 3;
               $blocos = 1;


               mysql_query("INSERT INTO `atividade` (`Descricao`, `Nivel`, `N_Blocos`) VALUES ('$descricao','$nivel', '$blocos')");
               $ID = mysql_insert_id();


               $res = mysql_query("INSERT INTO `bloco_linhas` (`ID_atividade`, `Bloco`, `texto`) VALUES ('$ID', '1', '".$codigo."')");


               for($i = 0; $i<sizeof($turmas); $i++)
               {
                   $idTurma = $turmas[$i];
                   $res = mysql_query("INSERT INTO `atividade_turma` (`ID_atividade`, `ID_turma`) VALUES ('$ID', '$idTurma')");

                   $procura = mysql_query("SELECT * FROM `turma_alunos` WHERE `ID_turma` = $idTurma");

                   while($alunos = mysql_fetch_array($procura)){

                        $aluno = $alunos['ID_aluno'];

                        $res = mysql_query("INSERT INTO `atividade_aluno` (`ID_atividade`,`ID_Aluno`,`Status`) VALUES ('$ID', '$aluno', 'NaoTentou')");

                   }


                  echo "<meta http-equiv='refresh' content='0, url=../view/minhasTurmas.php'>";
                  echo "<script>alert('Atividade Cadastrada com sucesso!')</script>";




     }

   }







function editarAtividade(){
    session_start();
    $_SESSION['codigo'] = $_POST['codigo'];
    $_SESSION['nivel'] = 2;
    $_SESSION['descricao_nivel2'] = $_POST['descricao'];
    $turmas = $_POST['turmas'];
    echo "<meta http-equiv='refresh' content='0, url=../view/editarAtividade.php?turmas=$turmas'>";

}

function cadastroAviso(){

if(isset($_POST['turmas'])){

$turmas = $_POST['turmas'];

$str_turmas = implode(",", $turmas);

echo "<meta http-equiv='refresh'  content='0, url=../view/cadastroAviso.php?turmas=$str_turmas'  />";

}
else{
echo "<script>alert('Você não selecionou nenhuma turma')</script>";
echo "<meta http-equiv='refresh' content='0,url=../view/minhasTurmas.php'/>";


}

}


 function gerarIDAviso($aviso,$avisoQuery,$ID){
//Sempre gera o próximo número em ordem crescente de acordo com a tabela, para cada professor

 //Se existir um próximo aviso desse professor, desce ainda mais na tabela
 if($aviso = mysql_fetch_array($avisoQuery)){


 $ID = gerarIDAviso($aviso, $avisoQuery, $aviso['ID']);

 }else{

//Chegou no ultimo
 return $ID+1;

}

//repete
return $ID;





 }


function cadastrarAviso(){


          //Pega informações
          $titulo = $_POST['titulo'];
          $texto = $_POST['aviso'];
          $data = date('d/m/Y');
          $turmas = explode(',', $_POST['turmas']);
          $email = $_SESSION['usuario_session'];

          //Pega nome do professor
          $queryProfessor = mysql_query("SELECT * FROM `professor` WHERE `Email` = '$email'");
          $professorDb = mysql_fetch_array($queryProfessor);
          $nome = $professorDb['Nome'];

          //Insere o aviso em todas as turmas
          for($i = 0; $i<sizeof($turmas); $i++){

          $turma =$turmas[$i];
          $avisoQuery = mysql_query("SELECT * FROM `aviso` WHERE `Nome_Professor` = '$nome'");
          $aviso =null;

          //Recursiva, percorre a tabela até o ultimo ID gerado
          $ID = gerarIDAviso($aviso, $avisoQuery,0);

          mysql_query("INSERT INTO `aviso` (`ID`, `Titulo`, `Texto`, `Data`, `ID_Turma`, `Nome_Professor`) VALUES ('$ID', '$titulo', '$texto', '$data','$turma','$nome')");
          $numTurma = $_POST['turmas'];

          $_SESSION['atualiza']=1;
          echo "<meta http-equiv='refresh' content='0, url=../view/cadastroAviso.php?turmas=$numTurma' />";


          }







}


function chamaAvisos(){

      if(isset($_POST['turmas'])){

          $turmas = implode(',',$_POST['turmas']);

          echo "<meta http-equiv='refresh' content='0, url=../view/avisoAluno.php?turmas=$turmas'/>";


      }
      else{

        echo "<script>alert('Você não selecionou nenhuma turma')</script>";
        echo "<meta http-equiv='refresh' content='0,url=../view/minhasTurmasAluno.php'/>";



      }







}


function chamaResolverExercicios(){

       if(isset($_POST['turmas'])){

                 $turmas=implode(',',$_POST['turmas']);

                 echo "<meta http-equiv='refresh' content='0, url=../view/selecaoNivelAluno.php?turmas=$turmas'/>";


       }
       else{

           echo "<script>alert('Você não selecionou nenhuma turma')</script>";
           echo "<meta  http-equiv='refresh' content='0, url=../view/minhasTurmasAluno.php'/>";

       }



}


function resolverExercicio(){

     $turmas = $_POST['turmas'];
     $nivel = $_POST['nivel'];

     if($nivel ==1 ){

           echo "<meta http-equiv='refresh' content='0, url=../view/resolverExerciciosNivel1.php?turmas=$turmas '/>";

     }
     else if($nivel ==2){

       echo "<meta http-equiv='refresh' content='0, url=../view/resolverExerciciosNivel2.php?turmas=$turmas'/>";

     }
     else if($nivel ==3){

       echo "<meta http-equiv='refresh' content='0, url=../view/resolverExerciciosNivel3.php?turmas=$turmas'>";

     }





}

function gerarResultado(){



     $atividade = $_POST['atividade'];
     $resultado =  explode(',', $_POST['resultado']);
     $nivel = $resultado[1];
     $resultado = $resultado[0];

     if(!isset($_SESSION['errou'.$atividade]) ) //conta quantas errou
     $_SESSION['errou'.$atividade] = 0;

     if($resultado == 'acertou'){ //Acertou a ordem

       unset($_SESSION['errou'.$atividade]);
       $usuario = $_SESSION['usuario_session'];
       $queryAtividade = mysql_query("UPDATE `atividade_aluno` SET `Status` ='Acertou' WHERE `ID_Aluno` = '$usuario' AND `ID_Atividade`= '$atividade' ");


       $turmas = $_POST['turmas'];

       echo "<meta http-equiv='refresh' content='0, url=../view/resolverExerciciosNivel$nivel.php?turmas=$turmas' />";



     }
     else{



          $_SESSION['errou'.$atividade] += 1;

     if( $resultado == 'errou' && $_SESSION['errou'.$atividade] == 2){ //Errou a ordem

       unset($_SESSION['errou'.$atividade]);
       $usuario = $_SESSION['usuario_session'];
       $queryAtividade = mysql_query("UPDATE `atividade_aluno` SET `Status` ='Errou' WHERE `ID_Aluno` = '$usuario' AND `ID_Atividade`= '$atividade' ");


       $turmas = $_POST['turmas'];

       echo "<meta http-equiv='refresh' content='0, url=../view/resolverExerciciosNivel$nivel.php?turmas=$turmas' />";



     }
     else{
            $turmas = $_POST['turmas'];
            echo "<script>alert('Ordem incorreta, tente mais uma vez.')</script>";
            echo "<meta http-equiv='refresh' content='0, url=../view/resolverExerciciosNivel$nivel.php?turmas=$turmas' />";


     }





   }



}

function gerarResultadoNivel3(){

          $turmas = $_POST['turmas'];
          $idAtividade = $_POST['atividade'];
          $usuario = $_SESSION['usuario_session'];
          $codigo = $_POST['texto'];

        $query = mysql_query("UPDATE `atividade_aluno` SET `Resposta_Nivel_3`='$codigo', `Status`='Tentou' WHERE `ID_Aluno`='$usuario' AND `ID_Atividade`='$idAtividade'  ");

        echo"<script>alert('Resposta enviada com sucesso')</script>";
        echo "<meta  http-equiv='refresh' content='0, url=../view/resolverExerciciosNivel3.php?turmas=$turmas' />";






}


function cadastrarRecurso(){

  if(isset($_POST['turmas'])){
         if(sizeof($_POST['turmas']) < 2){


            $turmas=implode(',',$_POST['turmas']);
            echo "<meta http-equiv='refresh' content='0, url=../view/cadastrarRecurso.php?turmas=$turmas'/>";

          }
          else{
                  echo "<script>alert('Selecione apenas uma turma')</script>";
                  echo "<meta http-equiv='refresh' content='0, url=../view/minhasTurmas.php'/>";

          }
  }
  else{

      echo "<script>alert('Você não selecionou nenhuma turma')</script>";
      echo "<meta  http-equiv='refresh' content='0, url=../view/minhasTurmas.php'/>";

  }



}


function chamaRecursos(){

  if(isset($_POST['turmas'])){
       if(sizeof($_POST['turmas']) < 2){


            $turmas=implode(',',$_POST['turmas']);
            echo "<meta http-equiv='refresh' content='0, url=../view/recursosAluno.php?turmas=$turmas'/>";
            }
            else{
                echo "<script>alert('Selecione apenas uma turma')</script>";
                echo "<meta http-equiv='refresh' content='0, url=../view/minhasTurmasAluno.php'/>";
            }

  }
  else{

      echo "<script>alert('Você não selecionou nenhuma turma')</script>";
      echo "<meta  http-equiv='refresh' content='0, url=../view/minhasTurmas.php'/>";

  }




}











?>
