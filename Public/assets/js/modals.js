// partie FUTTER mentions legales + rgpd
function openModal(modalId) { // ouvrir une modale ou fermer avec close
  document.getElementById(modalId).style.display = "block";
}

function closeModal(modalId) {
  document.getElementById(modalId).style.display = "none";
}

// Fermer la modale si l'utilisateur clique en dehors de la fenetre
window.addEventListener("click", (event) => {
  const modals = document.getElementsByClassName("modal"); // List des modales parcourus ac boucle for sur tte les modales et se ferme au clic exterieur
  for (let i = 0; i < modals.length; i++) {
    if (event.target == modals[i]) {
      modals[i].style.display = "none";
    }
  }
});

// Partie Gestion des étoiles REVIEWS
document.querySelectorAll('.modal .rating input[type="radio"]').forEach((input) => { // Sélect touts les buttons radio
  input.addEventListener("change", () => {
    const value = parseInt(input.value); // Récupère la valeur de l'étoile sélectionnée
    const labels = Array.from(document.querySelectorAll(".modal .rating label")); // Sélectionne les labels

    // MAJ affichage avec étoiles pleines ou vides
    labels.forEach((label, index) => {
      if (index + 1 <= value) {
        label.classList.add("star-active");
        label.classList.remove("star-inactive"); 
      } else {
        label.classList.add("star-inactive"); 
        label.classList.remove("star-active"); 
      }
    });
  });
});

// Enregistre la note sélectionnée ds l'input caché pour la recup au submit
document.querySelectorAll(".modal .rating input").forEach((input) => {
  input.addEventListener("change", function () {
    document.querySelector("#note").value = this.value;
  });
});
