# Blog Dev

Ce projet est une application web utilisant Vue.js pour le front-end et Symfony pour le back-end. Elle permet aux utilisateurs de lire et de créer des articles de blog.

## Prérequis

Avant de commencer, assurez-vous d'avoir installé :

- [Node.js](https://nodejs.org/) (version 14.x ou supérieure)
- [Composer](https://getcomposer.org/)
- [PHP](https://www.php.net/) (version 8.0 ou supérieure)
- [Symfony CLI](https://symfony.com/download)

## Installation

### Back-end (Symfony)

1. Clonez le projet :
   ```bash
   git clone https://github.com/Belkian/blog_dev.git
   cd blog_dev
   ```

2. Installez les dépendances PHP avec Composer :
   ```bash
   composer install
   ```

3. Configurez la base de données dans le fichier `.env` :
   ```dotenv
   DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
   ```

4. Créez la base de données et exécutez les migrations :
   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

5. Démarrez le serveur Symfony :
   ```bash
   symfony server:start
   ```

### Front-end (Vue.js)

1. Accédez au dossier `frontend` :
   ```bash
   cd frontend
   ```

2. Installez les dépendances Node.js :
   ```bash
   npm install
   ```

3. Démarrez le serveur de développement :
   ```bash
   npm run serve
   ```
