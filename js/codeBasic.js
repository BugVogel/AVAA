




function doPostForm2(formName, actionName)
{


	var hiddenControl = document.getElementById('action2');
	var theForm = document.getElementById(formName);

	hiddenControl.value = actionName;
	theForm.submit();
}


var acc = document.getElementsByClassName("scrollAvisosButton");
	var i;


	for (i = 0; i < acc.length; i++) {
		acc[i].onclick = function() {
			this.classList.toggle("active");

			var panel = this.nextElementSibling;
			if (panel.style.maxHeight == "0px"){

				panel.style.maxHeight = panel.scrollHeight + "px";


			} else {
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
