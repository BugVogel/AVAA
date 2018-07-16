


function onlyOneCheck(idPressed){

        var inputs = [document.getElementById('check1'), document.getElementById('check2'), document.getElementById('check3')]
        var idOn = idPressed.id;
        var busca = document.getElementById('nomeBusca');

        switch(idPressed.value){ //Seta placeholder da busca

        case 'titulo': busca.placeholder = 'Título do TCC';
        break;
        case 'orientador': busca.placeholder = 'Nome do Orientador';
        break;
        case 'chaves' :  busca.placeholder = 'Palavras-Chaves';

        }


        for(var i=0; i<3; i++){ //desmarca um ja marcado
             if(inputs[i].checked && inputs[i].id != idOn ){

                        inputs[i].checked = false;

             }
        }






}
