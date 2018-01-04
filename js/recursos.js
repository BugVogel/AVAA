function onlyOneCheck(idPressed){

        var inputs = [document.getElementById('check1'), document.getElementById('check2')]
        var idOn = idPressed.id;

        var fileLabel = document.getElementById('fileLabel');
        var fileInput = document.getElementById('fileInput');
        var linkLabel = document.getElementById('linkLabel');
        var linkInput = document.getElementById('linkInput');




        for(var i=0; i<2; i++){ //desmarca um ja marcado
             if(inputs[i].checked && inputs[i].id != idOn ){

                        inputs[i].checked = false;

                        switch(inputs[i].value){

                         case 'arquivo':
                                      fileLabel.style.visibility ='hidden';
                                      fileInput.type = 'hidden';


                                      linkLabel.style.visibility = 'visible';
                                      linkInput.type = 'text';



                         break;
                         case 'link':

                         fileLabel.style.visibility ='visible';
                         fileInput.type = 'file';


                         linkLabel.style.visibility = 'hidden';
                         linkInput.type = 'hidden';



                         break;



                        }

             }
        }






}
