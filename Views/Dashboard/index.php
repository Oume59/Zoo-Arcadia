<!-- Section Ajout Utilisateur VOIR SI BESOIN CSRF TOKEN-->
<section class="section-container">
    <h2>Ajouter un Utilisateur</h2>
    <form action="/Dashboard" method="post">
        <input type="hidden" name="add_user">
        <label>Nom d'utilisateur</label>
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <label>Email</label>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Ajouter</button>
    </form>
</section>


<!-- Section: Ajout Animal VOIR SI BESOIN CSRF TOKEN-->
<section class="section-container">
    <h2>Ajouter un Animal</h2>
    <form action="/Dashboard" method="post">
        <input type="hidden" name="add_animal">
        <label>Nom de l'animal</label>
        <input type="text" name="name" placeholder="Nom de l'animal" required>
        <label>Espèce</label>
        <input type="text" name="species" placeholder="Espèce" required> <!-- A FAIRE : MA RELATION ENTRE LA TABLE SPECIES ET ANIMALS -->
        <label>Âge</label>
        <input type="number" name="health_state" placeholder="État de santé" required>
        <button type="submit">Ajouter</button>
    </form>
</section>