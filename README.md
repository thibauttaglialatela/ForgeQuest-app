# ForgeQuest

ForgeQuest est une application Web de partage de scénarios de jeux de rôle. Elle permet aux utilisateurs de :
- Découvrir des univers de jeu.
- Découvrir les scénarios proposés.
- Lire les commentaires laissés par les autres utilisateurs connectés sous chaque scénario.
- Se créer un compte afin de pouvoir également proposer des scénarios, mais également de noter et commenter les autres scénarios.
- gérer les scénarios qu'il aura créés, s'il est connecté à son compte.

Le site comprend également une partie Admin accessible uniquement à un administrateur et lui permettant de gérer :
- Les scénarios.
- Les commentaires laissés par les utilisateurs.
- Les univers de jeu.
- Les membres inscrits.
- Les mots-clés
---

## Installation
### Prérequis
- PHP 8.2 ou supérieur
- Composer
- MySQL

### Étapes d'installation
1. Clonez le dépot :

```bash
git clone https://github.com/NomUtilisateur/ForgeQuest-app.git
cd ForgeQuest-app
```
2. Installez les dépendances PHP

```bash
composer install
```

3. Copiez et renommez le fichier .env en .env.local

4. Configurez votre base de données dans le fichier `.env.local` :
```env
DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8.0.32&charset=utf8mb4
```
5. Lancez les commandes pour créer la base de données et exécuter les migrations

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

6. Chargez les fixtures pour générer des données initiales (optionnel) :
```bash
php bin/console doctrine:fixtures:load
```

7. Compilez les fichiers SCSS

```bash
php bin/console sass:build --watch
```
8. Lancez le serveur de développement :
```bash
symfony server:start
```
L'application est accessible sur `http://127.0.0.1:8000`

---
## Création d'un administrateur
Pour créer un administrateur, utilisez la commande Symfony suivante :
```bash
symfony console app:create_admin_user [email] [password]
```
Vous devez fournir un email valide et votre mot de passe doit contenir :
- Au moins 12 caractéres
- Un chiffre
- Une majuscule
- Un caractére spécial

Une fois la commande exécutée, un compte administrateur sera créé, prêt à être utilisé.

---

## Contributions

Les contributions sont les bienvenues !
1. Forkez le dépot.
2. Créez une branche pour votre fonctionnalité ou votre correction :
```bash
git switch -c feat/votre-nouvelle-feature
```
3. Effectuez vos modifications et créez une pull-request.
