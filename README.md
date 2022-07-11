# Application CRUD automobile

## Créer la BDD

```
CREATE DATABASE automobile_db;
use automobile_db;
```

## Créer la table autos

```
CREATE TABLE autos (
autos_id INTEGER NOT NULL KEY AUTO_INCREMENT,
make VARCHAR(255),
model VARCHAR(255),
year INTEGER,
mileage INTEGER
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
