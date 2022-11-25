var checkboxes = document.querySelectorAll('.checkbox');
for(var i of checkboxes){
    i.addEventListener('click',function(){
        if(this.checked == true){
            document.getElementById(this.value).style.display ='block';
        }
        else{
            document.getElementById(this.value).style.display ='none';
        }
    })
}