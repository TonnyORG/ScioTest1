# ScioTest1

Prueba #1 de PHP para Scio Consulting: usuarios y comentarios. De entrada quiero mencionar que es la primera vez que me toca configurar *Slim Framework* desde cero (previamente trabajé con el sobre algo ya pre-configurado) y también es la primera vez que toco *Propel ORM*, no ha sido muy difícil.

El objetivo es pasar una evaluación y aprovechar el reto para aprender cosas nuevas (por esta razón utilicé dichas herramientas). Hasta el momento, creo que al menos uno de estos dos objetivos ha sido cumplido.


#### Requerimientos

- Conocimientos intermedios en Linux (consola), Apache/Nginx (saber configurar VirtualHost), MySQL y PHP.
- Tener instalado y configurado un *LAMP/LEMP Stack*, preferentemente utilizando versiones recientes para evitar problemas inesperados.
- Un poco de paciencia.


### Configuración

Si bien no hay mucho que configurar, es necesario hacer ligeros cambios en algunos archivos como los de la base de datos. Si deseas omitir los cambios en el nombre de la base de datos, entonces crea una base de datos denominada `propel_scio1`; considera que si has creado esta base de datos entonces omite toda instrucción que te indique cambiar el nombre de la base de datos (únicamente nombre de la base de datos).

1. Cambiar el nombre de la base de datos en el archivo `schema.xml`. Si necesitas ayuda para ubicarlo, lee [ésta sección](http://propelorm.org/documentation/02-buildtime.html#database-connection-name).
2. Cambiar el usuario, contraseña, host y nombre de la base de datos en el archivo `config/propel.php`. Si necesitas ayuda para ubicar estos datos, lee [ésta sección](http://propelorm.org/documentation/02-buildtime.html#setting-up-configuration).
3. Ubicate en el directorio principal del proyecto y ejecuta el comando `./propel sql:import` para crear las tablas necesarias en la base de datos.
4. Revisa tu base de datos entrando a la consola de *MySQL*y verifica que se han creado las tablas; si esto no funciona entonces deberás hacer un import manual del archivo `generated-sql/propel_scio1.sql` en tu base de datos.


## Componentes

- **[Slim Framework](https://github.com/codeguy/Slim)**: Mini-framework de PHP, muy básico solo provee herramientas de enrutamiento, vistas, sesiones y algunas cosas más.
- **[Propel2](https://github.com/propelorm/Propel2)**: Propel es un ORM que funciona en PHP.
- Algunas horas de fin de semana y lógica humana.
- **[Monolog](https://github.com/Seldaek/monolog)**: Básicamente con fines de *debuggeo*, es una herramienta para almacenar logs de errores.
- **[SASS](http://sass-lang.com)**: Una herramienta para crear hojas de estilo más elegantes.


## Contribuye

Si consideras que puedes mejorar el proyecto, agregarle valor con nuevas funcionalidades o simplemente has encontrado un error y deseas corregirlo, siéntete libre de proponer tus cambios. Para hacerlo solo debes seguir unos pasos:

1. Haz un *fork* de este proyecto.
2. Reliza los cambios que consideres pertinentes.
3. Haz el clásico *pull-request* con los comentarios apropiados para identificar tu aporte y subirlo al proyecto principal.


### Contribuyentes

- N/A