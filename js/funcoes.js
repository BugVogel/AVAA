/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function doPost(formName, actionName)
{
	var hiddenControl = document.getElementById('action');
	var theForm = document.getElementById(formName);
	
	hiddenControl.value = actionName;
	theForm.submit();
}


