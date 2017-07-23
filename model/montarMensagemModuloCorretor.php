<?php

$mensagemNivel1 = array();
$atividadesFeitasNivel1 = array();


$turmasString = $_GET['turmas'];
$turmas = explode(',', $turmasString);

for($i=0; $i<sizeof($turmas); $i++){

$turma = $turmas[$i]; //Verifica atividades que estao na turma
 $queryTurmasAtividades = mysql_query("SELECT * FROM `atividade_turma` WHERE `ID_turma` = '$turma' ");

 if(mysql_num_rows($queryTurmasAtividades)>0){ //Tem Atividades a verificar


    while($atividades = mysql_fetch_array($queryTurmasAtividades)){

        $atividade = $atividades['ID_atividade'];
        $query1 = mysql_query("SELECT * FROM `atividade` WHERE `ID` = '$atividade'");
        $verificaNivel = mysql_fetch_array($query1);
        if($verificaNivel['Nivel'] == 1){ //Coloca somente atividades do nivel 1

        $queryAtividadeAluno = mysql_query("SELECT * FROM `atividade_aluno` WHERE `ID_Atividade` = '$atividade'  ");

        while($atividades_emTabela = mysql_fetch_array($queryAtividadeAluno)){


          array_push($atividadesFeitasNivel1, $atividades_emTabela['ID_Atividade']);

        }



        }

    }




}




}


$atividadesFeitasNivel1 =  array_unique($atividadesFeitasNivel1);    //Tira duplicações

$atividadesFeitasNivel1 = array_values($atividadesFeitasNivel1);

asort($atividadesFeitasNivel1); //Coloca na ordem dos mais recentes


for($b=0;$b<sizeof($atividadesFeitasNivel1);$b++){ //Busca atividades que tem para fazer
$ID_atividade = $atividadesFeitasNivel1[$b];
$queryAtividade = mysql_query("SELECT * FROM `atividade` WHERE `ID` ='$ID_atividade'");
$atividadeBusca= mysql_fetch_array($queryAtividade);

$queryContador = mysql_query("SELECT * FROM `atividade_aluno` WHERE `ID_atividade`= '$ID_atividade'");
$naoTentou=0;
$tentou=0;
$errou=0;
$acertou=0;

while($verificador = mysql_fetch_array($queryContador)){


  $status = $verificador['Status'];
  switch($status){ //Conta quantidades

  case 'NaoTentou' : $naoTentou++;
  break;

  case 'Tentou'   : $tentou++;
  break;

  case 'Errou'   : $errou++;
  break;

  case 'Acertou' : $acertou++;
  break;

  }



}




array_push($mensagemNivel1, "

        <a href='../view/resultadosAtividadeEspecificaFacilMedio.php?turmas=$turmasString&atividade=$atividadeBusca[ID]'>  <button type='submit'  class='buttonLesson' name ='botaoExercicio' value=".$atividadeBusca['ID']."><div style='text-align:center'>" .$atividadeBusca['Descricao']. " </div><br>
          <div class='col-md-3 atividadesCorrecao' style='color:#008B45'>Acertaram:$acertou</div> <div class='col-md-3 col-md-offset-1 atividadesCorrecao' style='color:#FF4500'>Erraram:$errou</div> <div class='col-md-4 col-md-offset-1 atividadesCorrecao' style='color:#436EEE'>NaoTentaram:$naoTentou</div> </button></a><br/>
          <br>
");

}


//Pega nivel 2


$mensagemNivel2 = array();
$atividadesFeitasNivel2 = array();



for($i=0; $i<sizeof($turmas); $i++){

 $turma = $turmas[$i]; //Verifica atividades que estao na turma
 $queryTurmasAtividades = mysql_query("SELECT * FROM `atividade_turma` WHERE `ID_turma` = '$turma' ");

 if(mysql_num_rows($queryTurmasAtividades)>0){ //Tem Atividades a verificar


    while($atividades = mysql_fetch_array($queryTurmasAtividades)){

        $atividade = $atividades['ID_atividade'];
        $query1 = mysql_query("SELECT * FROM `atividade` WHERE `ID` = '$atividade'");
        $verificaNivel = mysql_fetch_array($query1);
        if($verificaNivel['Nivel'] == 2){ //Coloca somente atividades do nivel 2

        $queryAtividadeAluno = mysql_query("SELECT * FROM `atividade_aluno` WHERE `ID_Atividade` = '$atividade'  ");

        while($atividades_emTabela = mysql_fetch_array($queryAtividadeAluno)){



          array_push($atividadesFeitasNivel2, $atividades_emTabela['ID_Atividade']);

        }



        }

    }




}




}


$atividadesFeitasNivel2 =  array_unique($atividadesFeitasNivel2);    //Tira duplicações
$atividadesFeitasNivel2 = array_values($atividadesFeitasNivel2);


asort($atividadesFeitasNivel2); //Coloca na ordem dos mais recentes


for($b=0;$b<sizeof($atividadesFeitasNivel2);$b++){ //Busca atividades que tem para fazer
$ID_atividade = $atividadesFeitasNivel2[$b];
$queryAtividade = mysql_query("SELECT * FROM `atividade` WHERE `ID` ='$ID_atividade'");
$atividadeBusca= mysql_fetch_array($queryAtividade);

 $queryContador = mysql_query("SELECT * FROM `atividade_aluno` WHERE `ID_atividade`= '$ID_atividade'");
 $naoTentou=0;
 $tentou=0;
 $errou=0;
 $acertou=0;

 while($verificador = mysql_fetch_array($queryContador)){


   $status = $verificador['Status'];
   switch($status){ //Conta quantidades

   case 'NaoTentou' : $naoTentou++;
   break;

   case 'Tentou'   : $tentou++;
   break;

   case 'Errou'   : $errou++;
   break;

   case 'Acertou' : $acertou++;
   break;

   }



 }


array_push($mensagemNivel2, "

        <a href='../view/resultadosAtividadeEspecificaFacilMedio.php?turmas=$turmasString&atividade=$atividadeBusca[ID]' ><button type='submit' class='buttonLesson' name ='botaoExercicio' value=".$atividadeBusca['ID']."><div style='text-align:center'>" .$atividadeBusca['Descricao']. " </div><br>
          <div class='col-md-3 atividadesCorrecao' style='color:#008B45'>Acertaram:$acertou</div> <div class='col-md-3 col-md-offset-1 atividadesCorrecao' style='color:#FF4500'>Erraram:$errou</div> <div class='col-md-4 col-md-offset-1 atividadesCorrecao' style='color:#436EEE'>NaoTentaram:$naoTentou</div> </button></a><br/>
          <br>
");

}


//Atividades nive 3


$mensagemNivel3 = array();
$atividadesFeitasNivel3 = array();


for($i=0; $i<sizeof($turmas); $i++){

$turma = $turmas[$i]; //Verifica atividades que estao na turma
 $queryTurmasAtividades = mysql_query("SELECT * FROM `atividade_turma` WHERE `ID_turma` = '$turma' ");

 if(mysql_num_rows($queryTurmasAtividades)>0){ //Tem Atividades a verificar


    while($atividades = mysql_fetch_array($queryTurmasAtividades)){

        $atividade = $atividades['ID_atividade'];
        $query1 = mysql_query("SELECT * FROM `atividade` WHERE `ID` = '$atividade'");
        $verificaNivel = mysql_fetch_array($query1);
        if($verificaNivel['Nivel'] == 3){ //Coloca somente atividades do nivel 1

        $queryAtividadeAluno = mysql_query("SELECT * FROM `atividade_aluno` WHERE `ID_Atividade` = '$atividade'  ");

        while($atividades_emTabela = mysql_fetch_array($queryAtividadeAluno)){


          array_push($atividadesFeitasNivel3, $atividades_emTabela['ID_Atividade']);

        }



        }

    }




}




}


$atividadesFeitasNivel3 =  array_unique($atividadesFeitasNivel3);    //Tira duplicações

$atividadesFeitasNivel3 = array_values($atividadesFeitasNivel3);

asort($atividadesFeitasNivel3); //Coloca na ordem dos mais recentes


for($b=0;$b<sizeof($atividadesFeitasNivel3);$b++){ //Busca atividades que tem para fazer
$ID_atividade = $atividadesFeitasNivel3[$b];
$queryAtividade = mysql_query("SELECT * FROM `atividade` WHERE `ID` ='$ID_atividade'");
$atividadeBusca= mysql_fetch_array($queryAtividade);

$queryContador = mysql_query("SELECT * FROM `atividade_aluno` WHERE `ID_atividade`= '$ID_atividade'");
$naoTentou=0;
$tentou=0;
$errou=0;
$acertou=0;

while($verificador = mysql_fetch_array($queryContador)){


  $status = $verificador['Status'];
  switch($status){ //Conta quantidades

  case 'NaoTentou' : $naoTentou++;
  break;

  case 'Tentou'   : $tentou++;
  break;

  case 'Errou'   : $errou++;
  break;

  case 'Acertou' : $acertou++;
  break;

  }



}




array_push($mensagemNivel3, "

          <a href='../view/resultadosAtividadeEspecificaDificil.php?turmas=$turmasString&atividade=$atividadeBusca[ID]' ><button type='submit' class='buttonLesson' name ='botaoExercicio' value=".$atividadeBusca['ID']."><div style='text-align:center'>" .$atividadeBusca['Descricao']. " </div><br>
          <div class='col-md-3 atividadesCorrecao' style='color:#008B45'>Acertaram:$acertou</div> <div class='col-md-3 col-md-offset-1 atividadesCorrecao' style='color:#FF4500'>Erraram:$errou</div> <div class='col-md-4 col-md-offset-1 atividadesCorrecao' style='color:#436EEE'>NaoTentaram:$naoTentou</div> </button></a><br/>
          <br>
");

}








 ?>
