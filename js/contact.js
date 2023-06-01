const form = document.querySelector('form');
form.addEventListener('submit', (e) => {
  e.preventDefault();
  const nom = form.nom.value;
  const prenom = form.prenom.value;
  const email = form.email.value;
  const telephone = form.telephone.value;
  const message = form.message.value;
  const data = {
    nom,
    prenom,
    email,
    telephone,
    message
  };
  // Envoyer les données à l'API ou au backend ici
  console.log(data);
  alert("Le message a été envoyé avec succès !");
  form.reset();
});
