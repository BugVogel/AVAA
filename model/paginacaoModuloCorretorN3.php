<?php


if(isset($_POST['bN3'])){
    if($_POST['bN3'] == '1'){


        $numElement = sizeof($mensagemNivel3);
        if($numElement > 0){ //Tem aviso para a pagina 1

             for( $index =0; $index<3; $index++){

                      if($index < $numElement){ //Se tiver menos de 3 avisos, é tratado
                      echo $mensagemNivel3[$index];

                       }

             }

          }
      else{ //Não possui avisos suficientes para esta pagina

            $turmasString = implode(',',$turmas);
            echo "<div style='text-shadow:none'class='alert alert-danger alert-link' role='alert'><h4 class='alert-heading'><strong>Atenção!</strong></h4><strong>Não</strong> Existem Atividades Cadastradas nesta página&emsp;Cadastre novas atividades nesta turma clicando <strong><a style='color:#a94442'href='cadastroAtividadeDificil.php?turmas=$turmasString'>aqui!</a></strong></div>";
       }
     }

     if($_POST['bN3'] == '2'){


         $numElement = sizeof($mensagemNivel3);
         if($numElement > 3){ //Tem aviso para a pagina 1

              for( $index =3; $index<6; $index++){

                       if($index < $numElement){ //Se tiver menos de 3 avisos, é tratado
                       echo $mensagemNivel3[$index];

                        }

              }

           }
       else{ //Não possui avisos suficientes para esta pagina

             $turmasString = implode(',',$turmas);
             echo "<div style='text-shadow:none'class='alert alert-danger alert-link' role='alert'><h4 class='alert-heading'><strong>Atenção!</strong></h4><strong>Não</strong> Existem Atividades Cadastradas nesta página&emsp;Cadastre novas atividades nesta turma clicando <strong><a style='color:#a94442'href='cadastroAtividadeDificil.php?turmas=$turmasString'>aqui!</a></strong></div>";
        }
      }

      if($_POST['bN3'] == '3'){


          $numElement = sizeof($mensagemNivel3);
          if($numElement > 6){ //Tem aviso para a pagina 1

               for( $index =6; $index<9; $index++){

                        if($index < $numElement){ //Se tiver menos de 3 avisos, é tratado
                        echo $mensagemNivel3[$index];

                         }

               }

            }
        else{ //Não possui avisos suficientes para esta pagina

              $turmasString = implode(',',$turmas);
              echo "<div style='text-shadow:none'class='alert alert-danger alert-link' role='alert'><h4 class='alert-heading'><strong>Atenção!</strong></h4><strong>Não</strong> Existem Atividades Cadastradas nesta página&emsp;Cadastre novas atividades nesta turma clicando <strong><a style='color:#a94442'href='cadastroAtividadeDificil.php?turmas=$turmasString'>aqui!</a></strong></div>";
         }
       }

       if($_POST['bN3'] == '4'){


           $numElement = sizeof($mensagemNivel3);
           if($numElement > 9){ //Tem aviso para a pagina 1

                for( $index =9; $index<12; $index++){

                         if($index < $numElement){ //Se tiver menos de 3 avisos, é tratado
                         echo $mensagemNivel3[$index];

                          }

                }

             }
         else{ //Não possui avisos suficientes para esta pagina

               $turmasString = implode(',',$turmas);
               echo "<div style='text-shadow:none'class='alert alert-danger alert-link' role='alert'><h4 class='alert-heading'><strong>Atenção!</strong></h4><strong>Não</strong> Existem Atividades Cadastradas nesta página&emsp;Cadastre novas atividades nesta turma clicando <strong><a style='color:#a94442'href='cadastroAtividadeDificil.php?turmas=$turmasString'>aqui!</a></strong></div>";
          }
        }

}




 ?>
