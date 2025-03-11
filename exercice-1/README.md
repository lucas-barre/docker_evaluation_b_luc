  1. Qu’est-ce qu’un conteneur ?
Un conteneur est une unité exécutable légère et portable qui contient tout ce qui est nécessaire pour faire fonctionner une application : le code, les bibliothèques, les dépendances et les fichiers de configuration. Il s’exécute de manière isolée du système hôte en partageant le noyau du système d’exploitation.

  2. Est-ce que Docker a inventé les conteneurs Linux ? Qu’a apporté Docker à cette technologie ?
Non, Docker n’a pas inventé les conteneurs. Les technologies comme chroot, LXC (Linux Containers), cgroups et namespaces existaient avant. Docker a apporté :
Une API simple et une expérience utilisateur améliorée.
L'automatisation de la gestion des conteneurs.
Le Docker Hub, facilitant le partage d’images.
Une standardisation du packaging et du déploiement des applications.

  3. Pourquoi Docker est particulièrement adapté aux processus sans état ?
Docker est conçu pour exécuter des conteneurs éphémères, ce qui est parfait pour des applications sans état car :
Les conteneurs peuvent être démarrés ou supprimés rapidement.
Les services sans état sont scalables horizontalement (facile à dupliquer).
Les données persistantes doivent être stockées ailleurs (base de données, stockage externe).

  4. Quel artefact distribue-t-on et déploie-t-on dans le workflow de Docker ? Quelles propriétés doit-il avoir ?
L’artefact principal est une image Docker, qui doit être :
Portable : fonctionnelle sur différentes machines.
Légère : éviter les fichiers inutiles.
Déterministe : produit le même conteneur à chaque exécution.
Sécurisée : minimiser les vulnérabilités.

  5. Différence entre docker run et docker exec ?
docker run crée et exécute un nouveau conteneur.
docker exec exécute une commande dans un conteneur déjà en cours d’exécution.

  6. Peut-on lancer des processus supplémentaires dans un même conteneur Docker en cours d'exécution ?
Oui, avec docker exec. Cependant, Docker est conçu pour exécuter un seul processus principal par conteneur, ce qui est une bonne pratique.

  7. Pourquoi ne pas utiliser latest comme tag d'image Docker ?
Le tag latest n’est pas une version fixe, ce qui peut entraîner des incompatibilités et des comportements inattendus lors du redéploiement.

  8. Résultat de la commande :
docker run -d -p 9001:80 --name my-php -v "$PWD":/var/www/html php:8.2-apache
Démarre un conteneur en arrière-plan (-d).
Mappe le port 80 du conteneur au port 9001 de l’hôte (-p 9001:80).
Monte le répertoire courant ($PWD) sur /var/www/html.
Utilise l’image php:8.2-apache.

  9. Commande pour arrêter tous les conteneurs :

docker stop $(docker ps -q)

  10. Comment garder une image Docker légère ?
Utiliser une image de base minimale (alpine au lieu de ubuntu).
Supprimer les fichiers inutiles (rm -rf /var/lib/apt/lists/*).
Utiliser multi-stage builds.

  11. Les données d’un conteneur sont perdues à son arrêt ?
Oui, sauf si on utilise des volumes Docker.

  12. Une image Docker est-elle modifiable après sa création ?
Non, une image est immuable. Toute modification nécessite la création d’une nouvelle image.

  13. Comment publier et récupérer des images ?
Avec Docker Hub :
docker push utilisateur/image:tag
docker pull utilisateur/image:tag

  14. L’image la plus petite possible ?
L’image scratch, qui ne contient rien.

  15. Comment Docker communique-t-il avec dockerd ?
Via un socket Unix (/var/run/docker.sock) ou une API REST.

  16. CMD ou ENTRYPOINT pour un processus par défaut ?
CMD : Définit une commande par défaut qui peut être remplacée.
ENTRYPOINT : Définit une commande obligatoire.



