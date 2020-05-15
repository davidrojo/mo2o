# Resolución ejercicio 

Este proyecto es una resoloución del ejercicio de entrevista técnica.

## Instalación

Clonar el repositorio

```
git clone git@github.com:davidrojo/mo2o.git
```

Ejecutar los contenedores de docker

```
cd docker && docker-compose up -d
```

## Ejecución

La aplicación ofrece 2 urls para acceder a los servicios desarrollados.

### Búsqueda

```
curl http://localhost/api/beers/search?query=gruilled+chicken
```