function ValideNom() {
  let nom = document.getElementById("nom");
  let NomVerf = document.getElementById("NomVerf");
  let nomV = new RegExp("[^a-zA-Z]", "g");
  if (nomV.test(nom.value)) {
    NomVerf.innerHTML = "un nom ne contient pas les chiffres et les symbôles";
  } else if (nom.value.length < 3) {
    NomVerf.innerHTML = "un nom doit à voir plus que deux lettres";
  } else {
    NomVerf.innerHTML = "";
  }
}
function ValideTel() {
  let tel = document.getElementById("tel");
  let TelVerf = document.getElementById("TelVerf");
  let telV = new RegExp("[^0-9]", "g");
  TelVerf.innerHTML = "dfd";
  if (telV.test(tel.value)) {
    TelVerf.innerHTML = "un numéro de téléphone contient que des chiffres";
  } else if (tel.value.length != 10) {
    TelVerf.innerHTML = "un numéro de téléphone doit à voir 10 chiffres";
  } else {
    TelVerf.innerHTML = "";
  }
}
function ValideCin() {
  let cin = document.getElementById("cin");
  let CinVerf = document.getElementById("CinVerf");
  let cinV = new RegExp("[^0-9 a-zA-Z]", "g");

  if (cinV.test(cin.value)) {
    CinVerf.innerHTML = "un cin inccorcte";
  } else if (cin.value.length < 4) {
    CinVerf.innerHTML = "Cin doit avoir au minimum 4";
  } else {
    CinVerf.innerHTML = "";
  }
}
function ValideAdd() {
  let add = document.getElementById("add");
  let AddVerf = document.getElementById("AddVerf");
  if (add.value.length < 3) {
    AddVerf.innerHTML = "un addresse doit à voir plus que deux lettres";
  } else {
    AddVerf.innerHTML = "";
  }
}

function dateN() {
  let datenais = document.getElementById("datenais");
  datenais.type = "date";
}

function ValideDateN() {
  let datenais = new Date(document.getElementById("datenais").value);
  let DateNVerf = document.getElementById("DateNVerf");
  annee = datenais.getFullYear();
  anneeAuj = new Date().getFullYear();
  let min = anneeAuj - annee;

  if (annee == anneeAuj || min < 12) {
    DateNVerf.innerHTML = "Veuillez selectionnez vôtre date de naissance";
  } else DateNVerf.innerHTML = "";
}

function ValideConfPass() {
  let confpass = document.getElementById("confpass").value;
  let pass = document.getElementById("pass").value;
  let ConfVerf = document.getElementById("ConfVerf");

  if (pass != confpass) {
    ConfVerf.innerHTML = "Mot de passe inccorecte";
  } else {
    ConfVerf.innerHTML = "";
  }
}

function ValideEmail() {
  //!!!
  let email = document.getElementById("email");
  let EmailVerf = document.getElementById("EmailVerf");
  let emailRegExp = /^\w+([.-]?\w+)@\w+([.-]?\w+)(.\w{2,3})+$/;
  if (email.value.match(emailRegExp)) {
    EmailVerf.innerHTML = "";
  } else {
    EmailVerf.innerHTML = "un email inccorcte";
  }
}

// function ValideSurnom() {
//   let surnom = document.getElementById("surnom");
//   alert(surnom.value);
// }

// function ValidePass() {
// }

