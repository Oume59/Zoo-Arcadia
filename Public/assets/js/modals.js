function openModal(modalId) {
  document.getElementById(modalId).style.display = "block";
}

function closeModal(modalId) {
  document.getElementById(modalId).style.display = "none";
}

// Fermer la modale si l'utilisateur clique en dehors de celle-ci
window.onclick = function (event) {
  const modals = document.getElementsByClassName("modal");
  for (let i = 0; i < modals.length; i++) {
    if (event.target == modals[i]) {
      modals[i].style.display = "none";
    }
  }
};

// Gestion  des étoiles REVIEWS
const ratingStars = document.querySelectorAll('.rating input');
const hiddenNoteInput = document.getElementById('note');

ratingStars.forEach((star) => {
    star.addEventListener('change', () => {
        hiddenNoteInput.value = star.value;
    });
});
