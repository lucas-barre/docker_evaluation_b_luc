# Projet Docker - Application Web avec MySQL et PHP

## Description
Ce projet permet de déployer une application web contenant :
- Une base de données **MySQL**
- Un serveur web **PHP avec Apache**
- Une configuration adaptable pour **développement et production**

## Structure du projet
```
/
├── client/               # Dossier contenant le code du client PHP
│   ├── Dockerfile        # Dockerfile du service client
│   ├── index.php         # Fichier PHP pour interroger MySQL
│
├── sql/init.sql          # Script d'initialisation de la base de données
├── data/                 # Dossier de stockage des données MySQL
├── backup/               # Dossier pour sauvegarde des dumps de base de données
├── .env.dev              # Variables d'environnement pour le développement
├── .env.prod             # Variables d'environnement pour la production
├── docker-compose.yml    # Configuration principale de Docker Compose
├── docker-compose.override.yml # Fichier pour surcharger les paramètres en mode dev
├── docker-compose.prod.yml # Configuration Docker Compose pour la production
└── README.md             # Documentation du projet
```

## Prérequis
Avant de commencer, assurez-vous d'avoir installé :
- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Installation

### 1 - Cloner le projet
```sh
git clone <repo-url>
cd <repo-name>
```

### 2 - Configuration de l'environnement
Créer un fichier `.env.dev` pour l’environnement de développement :
```sh
MYSQL_ROOT_PASSWORD=<root_password>
MYSQL_USER=db_client
MYSQL_PASSWORD=<password>
MYSQL_DATABASE=docker_doc_dev
ENV=dev
DEBUG=true
```

Créer un fichier `.env.prod` pour l’environnement de production :
```sh
MYSQL_ROOT_PASSWORD=<strong_password>
MYSQL_USER=db_client
MYSQL_PASSWORD=<secure_password>
MYSQL_DATABASE=docker_doc
ENV=prod
DEBUG=false
```

### 3 - Lancer les services
#### Environnement Développement
```sh
docker compose --env-file .env.dev up -d
```
#### Environnement Production
```sh
docker compose --env-file .env.prod -f docker-compose.prod.yml up -d
```

## Vérifications
### Voir les conteneurs actifs
```sh
docker ps
```

### Accéder à MySQL dans le conteneur
```sh
docker exec -it database mysql -u db_client -p
```
(Entrer le mot de passe défini dans `.env` : `password` en dev, `another-strong-password` en prod.)

### Vérifier que la base et la table `article` existent
```sh
SHOW DATABASES;
USE docker_doc_dev;
SHOW TABLES;
SELECT * FROM article;
```

## Développement sans reconstruire l'image
```sh
docker compose up -d --build
```

## Arrêter et supprimer les conteneurs
```sh
docker compose down
```

## Générer un dump SQL
```sh
docker compose exec database mysqldump -u db_client -p${MYSQL_PASSWORD} ${MYSQL_DATABASE} > dump.sql
```

## Accès au site Web
Le service client est accessible sur :
- **http://localhost:8088** (Développement et Production)

## Félicitations !
Votre projet est maintenant prêt à être utilisé.


## Sécurité des variables d'environnement
Réponses aux questions posées : 
 -> Privilégier les Docker Secrets pour la production parce que c'est dangereux pour l'intégrité & la sécurité du projet de laisser des variables d'environnements publiques.
