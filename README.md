# Symfony Films Test By Elías Nacher

Se han creado 3 entidades.
 - Film
 - Actor
 - Director

Film tiene relaciones N/N tanto en Actor como en Director, para de esta forma prevenir que pueda haber varios de cada relacionados
con la misma Film.

Se solicita una pantalla de consulta para Film, y CRUDs para Actor y Director. Para ello se crea un CRUD para cada una,
pero se deshabilita la creación/edición/eliminacion en Film.

Para montar la base de datos de prueba, se ha dejado un fichero docker-compose.yml en la raíz del proyecto con la configuración.

Hay habilitado el comando `symfony console app:import:csv "rutaDelFichero"` para importar el csv solicitado. Este valida
cada línea, y en el caso de encontrar alguna incongruencia la ignora.

Mejoras a implementar que no se han solicitado:
 - Sistema de login y permisos.
 - Dockerizar el servidor web.
 - Crear pruebas unitarias.
 - Al csv le faltan datos tanto del director como de los actores.
 
 Comandos para instalación
 
 `git clone https://github.com/eliasnacher/symfony-films-test` 
 
 `cd symfony-films-test`
 
 `composer install`
 
 `docker-compose up -d`
 
 `php bin/console doctrine:schema:create`
 
 `symfony serve` o `php -S 127.0.0.1:8000 -t public`
