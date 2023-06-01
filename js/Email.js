$(document).ready(function() {
    $('#emailForm').submit(function(event) {
      event.preventDefault(); // Empêcher le comportement par défaut du formulaire
  
      var form = $(this);
      var url = form.attr('action');
      var formData = form.serialize();
  
      // Envoyer les données du formulaire via une requête AJAX
      $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        success: function(response) {
          // Le formulaire a été soumis avec succès, vous pouvez afficher un message de succès ou effectuer d'autres actions
          console.log('E-mail envoyé avec succès');
        },
        error: function(error) {
          // Une erreur s'est produite lors de l'envoi du formulaire, vous pouvez afficher un message d'erreur ou effectuer d'autres actions
          console.error('Erreur lors de l\'envoi de l\'e-mail', error);
        }
      });
    });
});
  