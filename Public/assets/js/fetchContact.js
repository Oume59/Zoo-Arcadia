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
        
      // Envoi de la requête fetch vers l’URL spécifiée
      fetch("/Contact/sendContactMail", {

        method: "POST", 
        body: formData, 
      })
        .then(function (response) {
          
          if (response.ok) {
           
            return response.json().then((jsonResponse) => jsonResponse); 
          } else {
            return response.json().then((err) => {
              // Si la réponse contient une erreur, la convertir en JSON et lever une exception
              throw err;
            });
          }
        })
        .then(function (jsonResponse) {
          //  Traitement des données reçues du serveur
          divMessage.style.display = "none"; // Masque le message d’erreur par défaut
          if (jsonResponse.status === "success") {
            // Vérifie si la réponse indique un succès
            divMessage.style.display = "block"; // il s affiche contrairement au none (le message)
            divMessage.textContent = jsonResponse.message; // Affiche le message de succès du serveur
          }
        })
        .catch(function (error) {
          divMessage.style.display = "block"; // Affiche le message d’erreur si une exception a été levée (ex: problème côté serveur)
          divMessage.textContent = error.message;
        });
    });
  });
  