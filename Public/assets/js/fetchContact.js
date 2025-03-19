// Attendre que la page soit complètement chargée avant d’exécuter le script
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("fetch");

  form.addEventListener("submit", function (e) {
    e.preventDefault(); // Empêche le rechargement de la page

    // Récupère les données du formulaire sous forme d’un objet FormData
    const formData = new FormData(form);

    // Sélectionne l’élément où afficher les messages de réponse du serveur
    let divMessage = document.querySelector(".msg");

    // Vérification que l'élément existe
    if (!divMessage) {
      console.error("L'élément .msg est introuvable.");
      return;
    }

    // Réinitialise l'affichage du message
    divMessage.classList.remove("d-none");
    divMessage.classList.remove("error-message", "success-message");

    // Envoi de la requête fetch vers l’URL spécifiée
    fetch("/Contact/sendContactMail", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (response.ok) {
          return response.json();
        } else {
          return response.json().then((err) => {
            throw err;
          });
        }
      })
      .then((jsonResponse) => {
        divMessage.style.display = "block";
        divMessage.textContent = jsonResponse.message;

        if (jsonResponse.status === "success") {
          divMessage.classList.add("success-message"); // Ajoute la classe succès
          form.reset(); // reset le formulaire après envoi
        } else {
          divMessage.classList.add("error-message"); // Ajoute la classe erreur
        }
      })
      .catch((error) => {
        divMessage.style.display = "block";
        divMessage.textContent = error.message;
        divMessage.classList.add("error-message"); // Ajoute une classe erreur si une exception est levée
      });
  });
});
