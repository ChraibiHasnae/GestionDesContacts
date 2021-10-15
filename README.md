# GestionDesContacts
Nous supposons que vous avez installé Symfony 5 sur votre machine

Maintenant, la première chose est de configurer Symfony pour accéder à votre base de données MySQL, allez-y et ouvrez votre parameters.yml situé sous l’application
Configurez le port de votre base de données sur 3306, l’utilisateur de la base de données et le mot de passe de la base de données sur vos valeurs d’installation MySQL, laissez le reste inchangé.

# php bin/console doctrine:database:create

Vous devriez voir que la base de données est créée si vous vous connectez à votre console MySQL.

pour créer un projet
# composer create-project symfony/website-skeleton nom-projet

# php bin/console server:run

le projet se lance sur l'adresse suivante:
# http://127.0.0.1:8000

Pour basculer entre les pages réalisées:

http://127.0.0.1:8000/contacts/all

http://127.0.0.1:8000/login

http://127.0.0.1:8000/register


