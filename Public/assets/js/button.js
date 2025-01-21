function closePage() {
    // Vérifie si la page REPORT ANIMAL peut être fermée
    if (window.history.length > 1) {
        // return à la page précédente (si possible)
        window.history.back();
    } else {
        // Ferme la page si elle a été ouverte dans new onglet/fenêtre
        window.close();
    }
}
