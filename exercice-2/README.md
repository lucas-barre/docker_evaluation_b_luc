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
│   ├── .htaccess         # Configuration Apache (optionnel)
│
├── init.sql              # Script d'initialisation de la base de données
├── .env.dev              # Variables d'environnement (Développement)
├── .env.prod             # Variables d'environnement (Production)
├── docker-compose.yml    # Configuration Docker Compose
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

### 2 - Configurer l'environnement

Créer un fichier `.env.dev` pour l’environnement de développement :
```sh
MYSQL_ROOT_PASSWORD=root
MYSQL_USER=db_client
MYSQL_PASSWORD=password
MYSQL_DATABASE=docker_doc_dev
```

Créer un fichier `.env.prod` pour l’environnement de production :
```sh
MYSQL_ROOT_PASSWORD=a-strong-password
MYSQL_USER=db_client
MYSQL_PASSWORD=another-strong-password
MYSQL_DATABASE=docker_doc
```

### 3 - Lancer les services
#### Environnement Développement
```sh
docker compose --env-file .env.dev up -d
```
#### Environnement Production
```sh
docker compose --env-file .env.prod up -d
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
- **http://localhost:8080** (Développement)
- **Configuration spécifique en production**

## Félicitations !
Le projet est maintenant prêt à être utilisé. 🎉
```
