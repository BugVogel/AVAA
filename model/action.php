<?php

require_once '../view/conexao.php';
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
    $nTurmas = count($_POST['turmas']);
    if($nTurmas > 0){

        foreach ($_POST['turmas'] as $remove_item) {
            mysql_query("DELETE FROM turma_alunos WHERE ID_turma=$remove_item");
            mysql_query("DELETE FROM turma WHERE ID=$remove_item");

        }
        echo "<meta http-equiv='refresh' content='1, url=../view/minhasTurmas.php'>";
    }
    else{
        echo "<script>alert('Nenhuma turma selecionada');</script>";
        echo "<meta http-equiv='refresh' content='1, url=../view/minhasTurmas.php'>";
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
}

function cadastrarAtividade(){
    $turmas = $_POST['turmas'];
    $str_turmas = implode(",", $turmas);
    echo "<meta http-equiv='refresh' content='0, url=../view/selecaoNivel.php?turmas=$str_turmas'>";
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
    }

    echo "<meta http-equiv='refresh' content='1, url=../view/minhasTurmas.php'>";
    echo '<script language="javascript">';
    echo 'alert("Atividade cadastrada com sucesso!")';
    echo '</script>';
}

function editarAtividade(){
    session_start();
    $_SESSION['codigo'] = $_POST['codigo'];
    $_SESSION['nivel'] = 2;
    echo "<meta http-equiv='refresh' content='0, url=../view/editarAtividade.php'>";

}

function cadastroAviso(){

$turmas = $_POST['turmas'];

$str_turmas = implode(",", $turmas);

echo "<meta http-equiv='refresh'  content='0, url=../view/cadastroAviso.php?turmas=$str_turmas'  />";



}




?>
