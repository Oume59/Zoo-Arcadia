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
document.querySelectorAll('.star').forEach(star => {
    star.addEventListener('click', function () {
        const stars = Array.from(this.parentNode.children);
        const index = stars.indexOf(this);

        stars.forEach((s, i) => {
            s.style.color = i <= index ? 'gold' : 'lightgray'; 
        });

        document.querySelector('#note').value = index + 1; // Enregistre la note sélectionnée
    });
});
