<div class="navbar">
    <div>
        <h1><?php echo $_SESSION['entreprise_marque'] ?></h1>
    </div>
    <nav class="div-grid" id="div_active">
        <a href="espace-marque.php" class="items">Mon espace</a>
        <a href="profile-marque.php" class="items">Mon profile</a>
        <a href="messanger-marque.php" class="items">Messanger</a>
        <a href="contrat-marque.php" class="items">Mes contrats</a>
        <a href="deconnexion.php" class="items">Déconnexion</a>
    </nav>
</div>
<script>
    const activePage = window.location.pathname;
    const navLinks = document.querySelectorAll('nav a').forEach(link => {
        if(link.href.includes(`${activePage}`)){
            link.classList.add('active');
        }
    })
</script>