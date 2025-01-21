// partie FUTTER mentions legales...

function openModal(modalId) {
  document.getElementById(modalId).style.display = "block";
}

function closeModal(modalId) {
  document.getElementById(modalId).style.display = "none";
}

// Fermer la modale si l'utilisateur clique en dehors de celle-ci
window.addEventListener("click", (event) => {
  const modals = document.getElementsByClassName("modal");
  for (let i = 0; i < modals.length; i++) {
    if (event.target == modals[i]) {
      modals[i].style.display = "none";
    }
  }
});

// Partie Gestion des étoiles REVIEWS
document.querySelectorAll('.modal .rating input[type="radio"]').forEach((input) => {
  input.addEventListener("change", () => {
    const value = parseInt(input.value); // Récupère la valeur de l'étoile sélectionnée
    const labels = Array.from(document.querySelectorAll(".modal .rating label")); // Sélectionne les labels

    // Réinitialise toutes les étoiles
    labels.forEach((label, index) => {
      if (index + 1 <= value) {
        label.classList.add("star-active"); // Ajoute la classe active
        label.classList.remove("star-inactive"); // Supprime la classe inactive
      } else {
        label.classList.add("star-inactive"); // Ajoute la classe inactive
        label.classList.remove("star-active"); // Supprime la classe active
      }
    });
  });
});

// Enregistre la note sélectionnée ds l'input caché
document.querySelectorAll(".modal .rating input").forEach((input) => {
  input.addEventListener("change", function () {
    document.querySelector("#note").value = this.value; // MAJ la valeur cachée
  });
});
