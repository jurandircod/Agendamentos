const form = document.querySelector("#form");
const nameInput = document.querySelector("#name");
const emailInput = document.querySelector("#email");
const passwordInput = document.querySelector("#password");
const setorInput = document.querySelector("#setor");
const telInput = document.querySelector("#tel");

form.addEventListener("submit", (event) =>{
    event.preventDefault();

    // verificar se o nome está vazio
    if(nameInput.value == "") {
        alert('Preencha o campo Nome');
    }
});