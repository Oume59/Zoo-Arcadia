// Attendre que la page soit complètement chargée avant d’exécuter le script
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("fetch");
  const successDiv = document.getElementById("success-message");
  const errorDiv = document.getElementById("error-message");

  form.addEventListener("submit", function (e) {
    e.preventDefault(); // Empêche le rechargement de la page

    // Récupère les données du formulaire sous forme d’un objet FormData
    const formData = new FormData(form);

   // Affichage des messages
  successDiv.classList.add("d-none");
  errorDiv.classList.add("d-none");

    // Envoi de la requête fetch vers l’URL spécifiée
    fetch("/Contact/sendContactMail", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (response.ok) {
          return response.json();
        } else {
          return response.json().then((err) => {  // Si la réponse contient une erreur, la convertir en JSON et lever une exception
            throw err;
          });
        }
      })
      .then((jsonResponse) => {
        if (jsonResponse.status === "success") {
          successDiv.classList.remove("d-none"); // Affiche la div de message de succes
          successDiv.textContent = jsonResponse.message; // Affiche le message envoyé par le back
          form.reset(); // reset le formulaire après envoi
        } else {
          errorDiv.classList.remove("d-none"); // Si la réponse contient une erreur (ex. champ vide), affiche la div d’erreur
          errorDiv.textContent = jsonResponse.message; // Affiche le message d'erreur personnalisé depuis le back
        }
      })
      .catch((error) => {
        // Affiche le message d’erreur si une exception a été levée (ex: problème côté serveur, PHPMailer qui bug)
        errorDiv.classList.remove("d-none"); // Affiche la div d’erreur
        errorDiv.textContent = error.message; // Affiche le message d’erreur généré par le catch
      });
  });
});
