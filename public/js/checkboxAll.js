const chkbxAll = document.querySelector("#chkbxAll");
const chkbxOptions = document.querySelectorAll(".select-option");
chkbxAll.addEventListener("change",()=>{
    Array.from(chkbxOptions).map((chkbx)=>{
        chkbx.checked = chkbxAll.checked;
    });
});
