const inputField = document.getElementById('myInput');

inputField.addEventListener('focus', () => {
  inputField.classList.add('placeholder-move');
});

inputField.addEventListener('blur', () => {
  if (!inputField.value) {
    inputField.classList.remove('placeholder-move');
  }
});

const inputFielde = document.getElementById('myInpute');

inputFielde.addEventListener('focus', () => {
  inputFielde.classList.add('placeholder-move');
});

inputFielde.addEventListener('blur', () => {
  if (!inputFielde.value) {
    inputFielde.classList.remove('placeholder-move');
  }
});

var email= document.forms['form']['email'];
var password= document.forms['form']['password'];
var email_error= document.getElementById('email_error');
var pass_error= document.getElementById('pass_error');
function validated(){
    if(email.value.lenght< 9){
        email.style.border= "1px solid red";
        email_error.style.display= "block";
        email.focus();
        return false;
    }
    if(password.value.lenght< 9){
        password.style.border= "1px solid red";
        pass_error.style.display= "block";
        password.focus();
        return false;
    }
}

const form = document.querySelector('.questionnaire form');

form.addEventListener('submit', (e) => {
  e.preventDefault();
  const nom = form.nom.value;
  const email = form.email.value;
  const tel = form.tel.value;
  const budget = form.budget.value;
  const type = form.type.value;
  const ville = form.ville.value;

  // Envoyer les données à un serveur ou une API
});

// Afficher le bouton "Retour en haut de page" lorsqu'on descend la page
window.addEventListener('scroll', () => {
  const backToTopButton = document.getElementById('back-to-top');
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    backToTopButton.style.display = 'block';
  } else {
    backToTopButton.style.display = 'none';
  }
});

// Retourner en haut de page lorsqu'on clique sur le bouton "Retour en haut de page"

const scrollToTopButton = document.getElementById("scroll-to-top");

scrollToTopButton.addEventListener("click", function() {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
});

