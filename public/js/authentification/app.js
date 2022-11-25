const authen_btn = document.querySelector("#authen-btn");
const creat_btn = document.querySelector("#creat-btn");
const container = document.querySelector(".container");
const authen_btn2 = document.querySelector("#authen-btn2");
const creat_btn2 = document.querySelector("#creat-btn2");

creat_btn.addEventListener("click", () => {
    container.classList.add("creat-mode");
});

authen_btn.addEventListener("click", () => {
    container.classList.remove("creat-mode");
});

creat_btn2.addEventListener("click", () => {
    container.classList.add("creat-mode2");
});

authen_btn2.addEventListener("click", () => {
    container.classList.remove("creat-mode2");
});