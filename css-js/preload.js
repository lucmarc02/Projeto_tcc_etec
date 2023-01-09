//Verifica os input
document.getElementById("nomeLogin").onkeyup = function (e) {
    let nome = document.getElementById("nomeLogin");

    if (nome.value.length < 4 ) {
        nome.classList.remove("is-valid");
        nome.classList.add("is-invalid");
        nome.setAttribute("placeholder", "Informe um nome");
    } else {
        nome.classList.remove("is-invalid");
        nome.classList.add("is-valid");
    }
}

document.getElementById("usuarioLogin").onkeyup = function (e) {
    let nome = document.getElementById("usuarioLogin");

    if (nome.value.length < 4 ) {
        nome.classList.remove("is-valid");
        nome.classList.add("is-invalid");
        nome.setAttribute("placeholder", "Informe um seu nome para o login");
    } else {
        nome.classList.remove("is-invalid");
        nome.classList.add("is-valid");
    }
}

document.getElementById("emailLogin").onkeyup = function (e) {
    let email = document.getElementById("emailLogin");

    if (email.value == "" || 
        email.value.indexOf('@') == -1 || 
        email.value.indexOf('.com') == -1 ) {

        emailVerificar.innerText = "Por favor, um email Válido!.";
        email.classList.remove("is-valid");
        email.classList.add("is-invalid");
    } else if (email.value.length == "" ) {
        emailVerificar.innerText = "Por favor, informe o seu email.";
        email.classList.remove("is-valid");
        email.classList.add("is-invalid");
    } else {
        email.classList.remove("is-invalid");
        email.classList.add("is-valid");
        email.removeAttribute("value");
    }
}

document.getElementById("almoxLogin").onkeyup = function (e) {
    let nome = document.getElementById("almoxLogin");

    if (nome.value.length < 4 ) {
        nome.classList.remove("is-valid");
        nome.classList.add("is-invalid");
        nome.setAttribute("placeholder", "Informe um seu Almoxarifado");
    } else {
        nome.classList.remove("is-invalid");
        nome.classList.add("is-valid");
    }
}
//Pegar date automatico
window.onload = function (e) {
  let hoje = new Date();
  let ano = hoje.getFullYear();
  let mes = hoje.getMonth()+1;
  let dia = hoje.getDate();
  
  let date = ano + "-" + mes + "-" + dia;

  document.getElementById('dataLogin').setAttribute('value', date)

}

//Valida senha nova
document.getElementById("senhaVer").onkeyup = function (e) {
  let senha = document.getElementById("senhaLogin");
  let senhaVer = document.getElementById("senhaVer");
  let btn = document.getElementById("btnRegistrar");

  if (senha.value != senhaVer.value || senhaVer.value == "") {
    senhaVer.classList.remove("is-valid");
    senhaVer.classList.add("is-invalid");
    senhaVer.setAttribute("placeholder", "Informe a mesma senha");
  }

  if (senhaVer.value == senha.value && senhaVer.value.length > 5) {
    senhaVer.classList.remove("is-invalid");
    senhaVer.classList.add("is-valid");
    btn.setAttribute("type", "submis");
  }
};

//Botao de mostra a senha
document.getElementById("btnVisu").onclick = function (e) {
  let senha = document.getElementById("senhaLogin");
  let icon = document.getElementById("icon");
  if (senha.type == "password") {
    senha.type = "text";

    icon.src = "./img/hidden.png";
    icon.src = "./img/view.png";
  } else {
    senha.type = "password";

    icon.src = "./img/view.png";
    icon.src = "./img/hidden.png";
  }
};

//Nivel da senha e verifica tbm
document.getElementById("senhaLogin").onkeyup = function (e) {
  let senha = document.getElementById("senhaLogin");
  let progessBar = document.getElementById("progessBar");
  let btn = document.getElementById("btnRegistrar");

  //Verifica se senha ta certa
  if (senha.value.length < 6) {
    senha.classList.remove("is-valid");
    senha.classList.add("is-invalid");
    senhaInvalida.innerText = "A senha prescisa ter 6 ou mais digitos";
    btn.classList.add("disabled");
  } else {
    senha.classList.add("is-valid");
    senha.classList.remove("is-invalid");
    btn.classList.remove("disabled");
  }

  let numeros = /([0-9])/;
  let minusculas = /([a-z])/;
  let maiusculas = /([A-Z])/;
  let especiais = /([!,@,#,$,%,¨,&,*,(,),´,_,<,>])/;

  let caracteres = senha.length;

  let calculator = 0;
  let resultado = "";

  //Verifca o nivel da senha
  if (caracteres < 6) {
    calculator = 0;
  } else {
    if (senha.value.length >= 6) {
      calculator = calculator + 20;
    }

    if (senha.value.match(numeros) != null) {
      calculator = calculator + 20;
    }

    if (senha.value.match(minusculas) != null) {
      calculator = calculator + 20;
    }

    if (senha.value.match(maiusculas) != null) {
      calculator = calculator + 20;
    }

    if (senha.value.match(especiais) != null) {
      calculator = calculator + 20;
    }

    resultado = "width: " + calculator + "%";
    progessBar.style.cssText = resultado;

    progessBar.classList.remove("bg-sucess");
    progessBar.classList.remove("bg-warning");
    progessBar.classList.remove("bg-danger");

    if (calculator >= 80) {
      progessBar.classList.add("bg-success");
      senha.classList.remove("is-invalid");
      senha.classList.add("is-valid");
    } else if (calculator < 80) {
      progessBar.classList.add("bg-warning");

      if (calculator <= 20) {
        progessBar.classList.add("bg-danger");
      }
    }
  }
};
