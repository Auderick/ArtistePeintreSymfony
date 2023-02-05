# Peinture

Peinture est un site internet permettant à un artiste peintre de publier ses oeuvres.

## Environnement de développement

## Pré-requis

* PHP 8.1
* Composer
* Symfony CLI
* nodejs et npm

Vous pouvez vérifier le pré-requiq (sauf Docker et Docker-compose) avec la commande suivante (de la CLI Symfony) :

```bash
symfony check:requirements
```

### Lancer l'environnement de développement

```bash
comoser install
npm install
npm run build
php -S localhost:8000 -t public
php -S localhost:3000 -t public
```

### Ajouter des données de test

```bash
symfony console doctrine:fixtures:load
```

### Ajouter la pagination

```bash
composer require knplabs/knp-paginator-bundle
```

### Lancer des tests

```bash
./vendor/bin/phpunit --testdox
```
