// Fonction pour incrémenter le compteur de consultations
function incrementViewCount(element, event) {
    event.preventDefault(); // Empêche la redirection du lien

    // Récupérer les DATA nécessaires
    const animalName = element.getAttribute('data-animal'); // Nom de l'animal
    const animalId = element.getAttribute('data-id'); // son ID
    console.log("Animal cliqué :", animalName);

    // Vérifier que les attributs nécessaires qui existent
    if (!animalName || !animalId) {
        console.error("Attribut 'data-animal' ou 'data-id' manquant !");
        return;
    }

    // Envoyer la req FETCH pour + (incrémenter) le compteur
    fetch(`/ConsultationsAnimals/increment/${animalName}`)
        .then(response => response.json())
        .then(data => {
            console.log(data.message); // Afficher le message de succès dans la console
            // Redirection après succès
            window.location.href = `/Reports/showAnimalReports/${animalId}`;
        })
        .catch(error => {
            console.error('Erreur lors de l’incrémentation :', error);
        });
}

// détecter les clics sur les buttons des cards
document.querySelectorAll('.btn.btn-primary').forEach(button => {
    // Vérifie si l'événement a déjà été attaché
    if (!button.dataset.listenerAdded) {
        button.addEventListener('click', function (event) {
            incrementViewCount(this, event);
        });
        button.dataset.listenerAdded = true; // Marque le bouton pour éviter de réattacher l'événement
    }
});
