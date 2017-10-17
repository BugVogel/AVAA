


  var acc = document.getElementsByClassName("scrollAvisosButton");
	var i;


	for (i = 0; i < acc.length; i++) {
		acc[i].onclick = function() {
			this.classList.toggle("active");

			var panel = this.nextElementSibling;
			if (panel.style.maxHeight == "0px"){

       //Antes de abrir, vai fechar o anterior

				var panel2 = document.getElementsByClassName("avisoBox");
				for(var a = 0; a<panel2.length; a++){

            if(panel2[a].style.maxHeight != "0px"){ //Achou um aberto

							panel2[a].style.maxHeight = "0px"; //Fecha
              var acc2 = document.getElementsByClassName("scrollAvisosButton");

              for(var b = 0; b< acc2.length; b++){ //Procura o button desse panel que estava aberto

                if(acc2[b].nextElementSibling == panel2[a]){


                  acc2[b].className = 'scrollAvisosButton' //Muda sinal para +
                }


              }



						}

				}
       //Abre o selecionado
				panel.style.maxHeight = panel.scrollHeight + "px";




			} else { //Fecha o selecionado
				panel.style.maxHeight ="0px";


			}
		}
	}


	function setPag(pagina, formName){

   var input = document.getElementById('pag');
   var theForm = document.getElementById('formName');

	 input.value = pagina;
	 theForm.submit();




	}















//Efeito de blocos do exercicio nivel 1

var cols = document.querySelectorAll("#columns .column");
var dragSrcEl = null;


 function handleDragStart(e){

  this.style.opacity ='0.4';

  dragSrcEl = this;
  e.dataTransfer.effectAllowed = 'move';
  e.dataTransfer.setData('text/html',this.innerHTML);


 }

function handleDragOver(e){

 if(e.preventDefault){
   e.preventDefault();
 }

 e.dataTransfer.dropEffect = 'move';

 return false;

}

function handleDragEnter(e){

  this.style.border = 'dashed 3px #000';
}

function handleDragLeave(e){

  this.style.border = 'none';
}

function handleDrop(e){

 if(e.stopPropagation){
   e.stopPropagation();
 }

 if(dragSrcEl != this){

  var valueOrigem = dragSrcEl.value;
  var valueDestino = this.value;
  var idOrigem = dragSrcEl.id;
  var idDestino = this.id;

  dragSrcEl.innerHTML = this.innerHTML;
  dragSrcEl.style.opacity = 1;
  dragSrcEl.value = valueDestino;
  this.value = valueOrigem;
  dragSrcEl.id =  idDestino;
  this.id = idOrigem;
  this.innerHTML = e.dataTransfer.getData('text/html');




 }

 return false;
}

function handleDragEnd(e){

  [].forEach.call(cols, function(col){

     col.classList.remove('over');
  });


}




[].forEach.call(cols, function(col){

      col.addEventListener('dragstart',handleDragStart,false);
      col.addEventListener('dragenter',handleDragEnter,false);
      col.addEventListener('dragover',handleDragOver,false);
      col.addEventListener('dragleave',handleDragLeave,false);
      col.addEventListener('drop', handleDrop,false);
      col.addEventListener('dragend',handleDragEnd,false);

});


//Pegar resposta da atividade de Nível 1


function verificarResposta(){
 var pontos =0;
 var atividade;

 for(var i =0; i<3; i++){ //Verifica as 3 colunas de código
  var a = i+1;
  var bloco = document.getElementById('coluna' + a);
  if(bloco != null){

  var children = bloco.children; //Desce uma tag
  children = children[0].children; //Desce mais uma tag

  var tagDiv = children[1]; //Pega a segunda div
  atividade = tagDiv.nextElementSibling;
  atividade = atividade.value;
  var id = tagDiv.id;
  id = id.split('bloco');
  var posicaoCorreta = id[1];    //Pega posicao do bloco

  var posicaoAtual = bloco.nextElementSibling;
  posicaoAtual = posicaoAtual.value;

  if(posicaoAtual == posicaoCorreta ){ //Acertou, conta um ponto

   pontos++;

  }


   }
   else{
     alert("Atividade não selecionada!")
     return;
   }



}

    if(pontos == 3){ //Acertou os três blocos
       var identificadorAtividade = document.getElementById('atividade');
       var acertouButton = document.getElementById('acertou');
       identificadorAtividade.value = atividade;
       alert("Parabéns! Resposta correta!");

       acertouButton.click(); //Da Post




    }
    else{ //Errou a ordem

      var identificadorAtividade = document.getElementById('atividade');
      var errouButton = document.getElementById('errou');
      identificadorAtividade.value = atividade;
      alert("A resposta esta incorreta");

      errouButton.click(); //Da Post

    }



}


function cancelarAtividade(){


   var pagina1 = document.getElementById('b1');

   pagina1.click();

}


function verificaLinhaNivel2(){

  var linha = document.getElementById('linha1');

  for(var i=1; linha = document.getElementById('linha'+i); i++){


      if( !(linha.content.indexOf("(") || linha.content.indexOf("{")) ){
        alert("Seleção Incorreta");
        linhas[i].checked = false;
      }


  }

 }

  function enviarAtividadeNivel3(){

    var idAtividade = document.getElementById('idAtividade');
    if( idAtividade != null){ //Existe
    idAtividade = idAtividade.value;

    var inputParaId = document.getElementById('atividade');
    inputParaId.value = idAtividade;
    var botaoParaEnviar = document.getElementById('enviar');
    botaoParaEnviar.click();

   }
   else{

     alert("Não selecionou nenhuma atividade");
     return;
   }





  }
