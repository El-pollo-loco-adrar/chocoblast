# chocoblast
## projet Chocoblast
### 1 Clone du repository ou un fork
```bash
git clone https://github.com/evaluationWeb/projet-chocoblast.git # ou le votre si fork
cd projet-chocoblast
```
### 2 Editer le fichier composer.json (avec vos propres valeurs)
### 3 installer les dépendances
```bash
composer install
```
### 4 créer un fichier .env avec les entrées suivantes :
```env
DATABASE_HOST=localhost
DATABASE_NAME="nom BDD"
DATABASE_USERNAME="Login de BDD" 
DATABASE_PASSWORD="Password de la BDD"
```
### 5 démarrer le projet :
```bash
php -S 127.0.0.1:8000 -t public
```

### 6 ajoute les dépendances :
```bash
composer require --dev symfony/var-dumper
composer require vlucas/phpdotenv
```