// Fonction principale : incrémente le compteur de consultations de clic/animal
function incrementViewCount(element, event) {
  event.preventDefault(); // Empêche le comportement par défaut du lien (a href) (pas de redirection automatique) sinon ça interrompt le code JS

  // Récupère les attributs nécessaires depuis le bouton cliqué (animal et son ID)
  const animalName = element.getAttribute("data-animal"); // Récupère le nom de l'animal
  const animalId = element.getAttribute("data-id"); // Récupère son ID

  // Affiche dans la console ce qui a été cliqué pour vérif
  console.log("Animal cliqué :", animalName, "ID :", animalId);

  // Vérifie que les attributs nécessaires sont bien présents
  if (!animalName || !animalId) {
    // Si l'un des attributs est manquant...
    console.error("Attributs 'data-animal' ou 'data-id' manquants !"); // Affiche une erreur dans la console
    return; // Stop l'exécution de function
  }

  // Désactive temporairement le button car si user clic plusieurs fois repidement ça peux envoyer plusieurs req au serveur
  element.disabled = true;

  // Envoie une req http avec FETCH au backend pour incrémenter le compteur
  fetch(`/ConsultationsAnimals/increment/${animalName}`)
    .then((response) => response.json()) // Convertit la réponse en JSON
    .then((data) => {
      console.log(data.message); // Affiche le message de confirmation dans la console

      // Réactive le bouton après le success req
      element.disabled = false;

      // Redirige user vers la page du rapport de l'animal
      window.location.href = `/DashReports/showAnimalReports/${animalId}`;
    })
    .catch((error) => {
      // Si une erreur se produit...
      console.error("Erreur lors de l’incrémentation :", error); // Affiche l'erreur dans la console
      element.disabled = false; // Réactive le bouton même en cas d'erreur
    });
}

// Avant d'ajouter de nouveaux détecteurs d'interactions, on supp tous les anciens
document.querySelectorAll(".btn.btn-primary").forEach((button) => {
  button.removeEventListener("click", incrementViewCount); // Supprime tous les anciens écouteurs liés
});

// Ajoute un event listener "click" sur chaque bouton des CARDS ANIMALS
document.querySelectorAll(".btn.btn-primary").forEach((button) => {
  button.addEventListener("click", function (event) {
    incrementViewCount(this, event); // Appel la fonction principale lors du clic
  });
});
