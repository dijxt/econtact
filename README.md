# Création d'un service de connexion avec Symfony

## Objectif du projet
Pouvoir se connecter avec un identifiant et un numéro afin de pouvoir accéder à ses contacts. 

## Etapes du projet :

### Environement de développement
Nous avons utiliser Laragon afin de réaliser notre service de connexion, cela facilite la tâche car le projet est créé automatiquement. Il ne nous reste qu'à modifier le fichier **.env** afin de connecter la base de données.

### Initialisation des controllers
Nous avons pu facilement génerer les controllers de **Login** et **Contacts** via la commande :
```shell
php bin/console make:controller Login
```
Nous ajoutons ensuite la route que nous voulons :
```php
#[Route('')]
```
C'est dans le controller login que nous générons le form et l'affetons à un un fichier twig afin de récupérer les informations entées par l'utilisateur.
Les informations récupérées sont comparées avec celles présentent dans la base de données.
Si elles sont valides nous enregistrons l'id de l'utilisateur dans une variable de session et faisons une redirection vers le controller de contacts :
```php
return $this->forward('App\Controller\ContactsController::index');
``` 

### Création des entitées
Nous générons des entiltés **Utilisateur** et **Contact** via la commande :
```shell
php bin/console make:entity Utilisateur
```
Cela nous crée une entitée doctrine, il nous reste juste à remplir les champs que nous voulons et faire la migration sur la base de données avec la commande :
```shell
php bin/console doctrine:scheme:create
```
Il nous reste juste à remplir les données.

### Création du formulaire
Nous créons une classe de formulaire via la commande :
```shell
php bin/console make:form Login
```
Il nous reste juste à préciser les champs que nous voulons récupérer. Il est très facile de mettre en place le fomulaire avec twig.