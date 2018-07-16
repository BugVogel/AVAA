


function buildSections(location){



   var body = document.getElementById('bodyRegister');
   var inputSectionsNumber = document.getElementById('sectionsNumber');
   var num = inputSectionsNumber.value;

if(num == 0 ){

alert('Insira um número de sessões');
  return;
}


   var newBody;

   newBody = "<form method='POST' action='' enctype='multipart/form-data'>";
   newBody += "    <div class='form-group'>"+
                 "<label>Nome da Página</label>"+
                 "<input maxlength='22'required='true'  name='namePage'type='text' class='form-control' >"+
                 "<input type='hidden' name='location' value='"+location.value+"' >"+
                 "<input type='hidden' name='numSections' value='"+num+"' />"+
               "</div>";

   for(var i=0; i<num; i++){

      newBody += "<hr>"+
              "<div class='form-group'>"+
                "<label>Título da Sessão </label>"+
                "<input required='true' name='titleSection"+i+"'type='text' class='form-control' id='descricao'>"+
              "</div>"+
              "<div class='form-group'>"+
                "<label>Texto</label>"+
                "<textarea rows='10' required='true' name='Text"+i+"' class='form-control' id='data'></textarea>"+
              "</div>"+
              "<div id='links"+i+"' class='form-group'>"+
                "<label>Links </label>"+
                "<input name='links"+i+"[]' type='text' class='form-control'  />"+
              "</div>"+
              "<div id='files"+i+"' class='form-group'>"+
                "<label>Arquivos </label>"+
                "<input  name='fileSection"+i+"[]'type='file' >"+
                "<span class='custom-file-control'></span>"+
              "</div>"
              +"<button onclick='putLink(this)'type='button' value='"+i+"' class='btn btn-success'>Adicionar Link</button>&nbsp&nbsp"
              +"<button onclick='putFile(this)'type='button' value='"+i+"' class='btn btn-success'>Adicionar Arquivo</button>"+
               "<hr>";

   }

   newBody += "<button name='createPage'type='submit' class='btn btn-primary'>Enviar</button>"+
              "</form>";

  body.innerHTML = newBody;




}



function unBuildSections(location){


 var body = document.getElementById('bodyRegister');



  newBody = "<label for='sectionsNumber'>Número de Sessões (apenas números)</label>"+
  "<input  name='sectionsNumber' onkeypress='return onlyNumbers(event)' id='sectionsNumber' class='form-control' />"+
  "<br>"+
  "<button class='btn btn-primary' onclick='buildSections(this)' value='"+location+"''>Enviar</button>";

 body.innerHTML = newBody;




}

function onlyNumbers(e){		
  var chr = String.fromCharCode(e.which);
 
	if ("1234567890\b".indexOf(chr) < 0)
  return false;
  
  return true;
}

function putFile(b){

 var filesDiv = document.getElementById('files'+b.value);
 var sectionId = b.value;

   var text = filesDiv.innerHTML;

    text += "<br><input  name='fileSection"+sectionId+"[]'type='file' >"+
    "<span class='custom-file-control'></span><br>";

    filesDiv.innerHTML = text;


}


function putLink(b){

var linkDiv = document.getElementById('links'+b.value);
var sectionId = b.value;

 var text = linkDiv.innerHTML;

 text += "<br><input required='true' name='links"+sectionId+"[]' type='text' class='form-control'  />";

 linkDiv.innerHTML = text;

}
