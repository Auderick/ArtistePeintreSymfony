# Peinture

Peinture est un site internet permettant à un artiste peintre de publier ses oeuvres.

## Environnement de développement

## Pré-requis

* PHP 8.1
* Composer
* Symfony CLI
* Docker
* Docker-compose
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
docker-compose up -d
symfony server:start
```
### Ajouter des données de test

```bash
symfony console doctrine:fixtures:load
```

### Lancer des tests

```bash
php bin/ppunit --testdox
```
