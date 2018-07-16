

var linkDiv = document.getElementById('linksNotice');

var init = linkDiv.innerHTML;

function addLink(){

   

   var htmlPage = linkDiv.innerHTML;

   htmlPage += "<br><input name='links[]' type='text' class='form-control'  />";

   linkDiv.innerHTML = htmlPage;


}


function backForOne(){

 linkDiv.innerHTML = init;


}