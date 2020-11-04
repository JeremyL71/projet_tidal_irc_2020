# projet_tidal_irc_2020

# Projet TIDAL (CPE)  
*(english version below)*  

## Présentation du projet TIDAL CPE 4IRC 2020  
  
 - ### Installation  
L'installation du projet s'exécute de la façon suivante:  
  
-- Installation de **PHP**: Pour les utilisateurs Windows: https://windows.php.net/download/ (n'oubliez de modifier la variable    PATH pour que le langage PHP soit interprété par Windows (tuto ici: https://www.grafikart.fr/tutoriels/path-windows-1309)  
Tester le bon fonctionnement de PHP avec la commande:  
  
 php --version  
-- Installation de MySQL; https://dev.mysql.com/downloads/installer/  
(N'oubliez pas de modifier la variable d'environnement afin d'ajouter le dossier MySQL au PATH de Windows  
Tester le bon fonctionnement de MySQL avec la commande et le mot de passe root:  
  
 mysql -u root -p  
-- installation de **composer**: Tuto ici: https://www.grafikart.fr/tutoriels/composer-480  
  
 -- Installation de **PhpStorm** (pour les développeurs): https://www.jetbrains.com/fr-fr/phpstorm/  
  
-- Installation de **Xampp**: https://www.numelion.com/installer-xampp.html  
  
  
En cas de doutes, cette vidéo résume tout: https://www.grafikart.fr/tutoriels/windows-php-mysql-9017

## Carnet de bord (dernière mise à jour 24/10/2020):

- 04/11/2020: Réalisation du nouveau dépôt github, début de programmation du site.

- 30/10/2020: Révélation de la faisabilité du projet: La réalisation du projet en vueJs posait quelques problèmes niveau développement (maitrise des technologies insuffisante). Nous avons relancer le projet changeant totalement les technologies --> site full HTML, CSS, PHP et MySQL. Nous avons concervé néanmoins la même structure de base de donnée.

- 24/10/2020: Création du backlog product (création des EPICs, users stories dans l'onglet "projet" du repository). Création de la documentation dans l'onglet 'wiki'

 - 14/10/2020: Mise au point de diverses questions:
	 - Gestion de l'authentification ([https://blog.sqreen.com/authentication-best-practices-vue/](https://blog.sqreen.com/authentication-best-practices-vue/?fbclid=IwAR3fHHxSo2XBU6nAU_Os8qsdxV8nsod1nCJZwrjASk-FrU7SgPpoXbrmgCM)
	 - Début de création de la base de donnée

 - 10/10/2020:  Choix des technologies, le front sera géré par VueJS et Vuetify. Le site interrogera une API REST codé en PHP qui effectuera des requêtes sur une base de donnée MySQL 
	 - Création du site, mise en place des principaux composants du front end:
		 - Création de la page d'accueil
		 - Création de la page comportant la liste des produits
		 - Début de la création du panier mis à jour hors connexion

- 01/10/2020: Création du dépôt, mise à jour de la procédure d'installation des différents outils et environnement de programmation
