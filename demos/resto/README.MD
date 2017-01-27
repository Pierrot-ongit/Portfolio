POUR RAPPEL (notamment le point 5) :
Voici le portfolio de Pierre NOEL, réalisé dans le cadre de la formation à la 3w academy
Afin de pouvoir tester et parcourir le site, quelques petites consignes sont à prendre en compte.

1*/ A la racine du dossier Portfolio, il y a 2 fichiers MYSQL,que vous pouvez importer dans votre base de données afin de faire fonctionner les sites de démonstration du blog et du restaurant.

2*/ A la racine du dossier Portfolio, se trouve un fichier connection.php. Il gère la connection à la base de données pour l'ensemble du site (à une exception près). Editer le pour rentrer vos propres paramètres pour vous connecter à votre BDD.

3*/ L'exception mentionnée plus haut est le fichier qui gère la connection à la BDD pour le site de démonstration du restaurant. Le chemin pour y arriver est : Portfolio\demos\resto\application\config\database.php
Configurer de la même manière que le précédent fichier connection.php

4*/ Pour que le site fonctionne correctement, il doit être placer dans un sous-dossier Portfolio, par rapport au dossier racine du serveur. La raison tient au paramètrage et l'utilisation du fichier rooter.php (qui est situé à la base du dossier Portfolio).

5*/ J'ai apporté des modifications au site du restaurant, en incorporant un petit backoffice. Connecter vous avec le compte admin comme mentionné sur la page de connection du site du resto, et vous pourrez accéder au back-office.

6*/ Une version live est accessible à l'url : http://www.pierrenoel.pro

