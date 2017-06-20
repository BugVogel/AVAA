


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


                  acc2[b].style.content = '\\02795'; //Muda sinal para +
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


  dragSrcEl.innerHTML = this.innerHTML;
  dragSrcEl.style.opacity = 1;
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
