// Fonction principale : incrémente le compteur de consultations de clic/animal
function incrementViewCount(element, event) {
  event.preventDefault(); 

  // Récup les attributs depuis le bouton cliqué (animal et ID)
  const animalName = element.getAttribute("data-animal"); 
  const animalId = element.getAttribute("data-id"); 

  if (!animalName || !animalId) {
    // Si 1 attribut est manquant on stop le script :
    console.error("Attributs 'data-animal' ou 'data-id' manquants !"); 
    return;
  }

  // Désactive temporairement le button car si user clic + fois repidement ça peux envoyer plusieurs req au serveur
  element.disabled = true;

  // Envoie une req GET avec FETCH au back
  fetch(`/ConsultationsAnimals/increment/${animalName}`)
    .then((response) => response.json()) 
    .then(() => {
      // Réactive le bouton après le success req
      element.disabled = false;
      // Redirige vers la page du rapport
      window.location.href = `/DashReports/showAnimalReports/${animalId}`;
    })
    .catch((error) => {
      console.error("Erreur lors de l’incrémentation :", error);
      element.disabled = false; // Réactive le bouton même en cas d'erreur pour nouvelle tentative
    });
}

// Avant d'ajouter de nouveaux écouteurs, on supp tous les anciens
document.querySelectorAll(".btn.btn-primary").forEach((button) => {
  button.removeEventListener("click", incrementViewCount); 
});

// Add de nouveau un event listener "click" sur chaque bouton des CARDS ANIMALS
document.querySelectorAll(".btn.btn-primary").forEach((button) => {
  button.addEventListener("click", function (event) {
    incrementViewCount(this, event); // Appel la fonction principale lors du clic
  });
});
