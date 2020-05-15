# Resolución ejercicio 

Este proyecto es una resoloución del ejercicio de entrevista técnica.

## Instalación

Clonar el repositorio

```
git clone git@github.com:davidrojo/mo2o.git
```

Ejecutar los contenedores de docker

```
cd docker && docker-compose build && docker-compose up -d
```

Instalar las dependencias

```
docker exec php composer install
```

## Ejecución

La aplicación ofrece 2 urls para acceder a los servicios desarrollados.

### Búsqueda

Acceder a la ruta `/api/beers/search` pasándo como variable query para realizar la búsqueda.
 
```
curl http://localhost/api/beers/search?query=chicken
```

La API retornará un máximo de 25 resultados. Añadir la variable `page` (1..N) para paginar los resultados.

```
curl http://localhost/api/beers/search?query=chicken&page=2
```

### Detalle

Acceder a la ruta `/api/beers/[id]` sustituyendo `[id]` por el id de la cerveza a consultar

```
curl http://localhost/api/beers/5
```

## Consideraciones

- Se ha utilizado FOSRestBundle para el desarrollo de la API RESTful
- Se ha utilizado JMSSerializer para la serialización de entidades
- Existen unos tests unitarios basicos. Ejecutar `docker exec php bin/phpunit`