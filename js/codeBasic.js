


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
