#  - WEB DEVELOPMENT EXAM PROJECT -

 ---
## A - A propos du projet:
Bienvenue dans ce projet élaboré avec Laravel 10, développé dans le cadre d'un examen en webmaster. <br><br>
Ce que vous y découvrirez :

- Gestion des utilisateurs : Inscription, connexion, réinitialisation de mot de passe, etc.<br>
- Base de données : Stockage et gestion sécurisée des informations des utilisateurs.<br>
- Gestion des messages d'erreur: Des messages d'erreur adaptés aux besoins pour guider les utilisateurs lorsqu'ils rencontrent des problèmes.<br>
- ect ect..<br><br>
    Ce projet est une démonstration des compétences acquises en matière de développement web et met en œuvre 
les concepts les plus récents du framework Laravel.


 ---
## B - Comment l'installer et le tester:

>> Assurez-vous que votre machine dispose des éléments suivants :
- PHP installé (https://www.php.net/)
- Composer installé (https://getcomposer.org/)
- Un serveur de base de données (par exemple, MySQL) installé et configuré.


### 1. Cloner le projet depuis Github
```bash
git clone https://github.com/jennifer-90/Dynamic_web_project_exam.git 
```
*--> Récupère une copie du projet depuis GitHub sur votre machine locale.*

### 2. Accéder au répertoire du projet
```bash
cd mingleparent 
```
*--> Vous place dans le répertoire du projet fraîchement cloné.*
### 3. Installer les dépendances avec Composer
```bash 
composer install 
```
*--> Composer est un gestionnaire de dépendances pour PHP. Cette commande installe toutes les bibliothèques 
nécessaires au projet.*
### 4. Copier le fichier .env.example et renommer le ".env"
```bash
cp .env.example .env
```
*--> Créé une copie du fichier de configuration par défaut .env.example sous le nom .env.*
### 5. Générer la clé d'application
```bash
php artisan key:generate 
```
*--> Laravel utilise une clé d'application pour la sécurité. Cette commande génère une nouvelle clé dans le fichier .
env.*
### 6. Configurer la db
``` 
DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD  
```

### 7. Démarrer le serveur de développement laravel
```bash
php artisan serve 
```
*--> Lance un serveur de développement Laravel local*
### 8. Effectuer la migration db
```bash
php artisan migrate 
```
*--> La migration crée les tables nécessaires dans la base de données.*

 ---

## C - Utilisation de l'Interface
>> Le serveur sera accessible à l'adresse indiquée dans la console (par défaut : http://127.0.0.1:8000/).

    Ouvrez votre navigateur web et accédez à l'URL du serveur de développement.
    Suivez les instructions pour créer un nouvel utilisateur et explorer les fonctionnalités de l'interface.
