// var checkboxes = document.querySelectorAll('.checkbox');
// for(var i of checkboxes){
//     i.addEventListener('click',function(){
//         if(this.checked == true){
//             document.getElementById(this.value).style.display ='block';
//         }
//         else{
//             document.getElementById(this.value).style.display ='none';
//         }
//     })
// }
/********************cause***********************/
function Validite(x){
    if (x==0){
        document.getElementById("nonValide").style.display ='block';
        document.getElementById("valide").style.display ='none';
    }
    else
    {
        document.getElementById("nonValide").style.display ='none';
        document.getElementById("valide").style.display ='block';
    }
    return;
}
//************************************************contrôle sur capabilité************************************************* -->
function verifCap()
        {
			var cap=document.getElementById("capabilite").value;
           if(cap<4)
           {
               document.getElementById("capabilite").style.borderColor="red";
               document.getElementById("alert").style.display='block';
               document.getElementById("titleadd").disabled=true;
              
           }
           else{
            document.getElementById("capabilite").style.borderColor="rgb(80, 79, 79)";
            document.getElementById("alert").style.display='none';
            document.getElementById("titleadd").disabled=false;
           }
           
		}

