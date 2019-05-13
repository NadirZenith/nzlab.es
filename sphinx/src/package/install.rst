Instalación
===========

Instalación del paquete
-----------------------

Clona el proyecto en el directorio actual, e inicia los submódulos Git:

.. code-block:: bash

   $ git clone git@github.com:nadirzenith/nzlabes.git ./nzlabes
   $ git submodule init
   $ git submodule update

O, si lo prefieres, todo en un comando:

.. code-block:: bash

    $ git clone --recurse-submodules git@github.com:nadirzenith/nzlabes.git ./nzlabes


Creación de los ficheros de configuración
-----------------------------------------

Copia la plantilla para los ficheros ``docker-compose`` y ``.env`` distribuida
con el paquete, eliminando la extensión ``.dist``, y edítala de acuerdo a tu
entorno local.

Primero crea el fichero ``docker-compose.yml``:

.. code-block:: bash

   $ cd nzlabes
   $ cp docker-compose.yml.dist docker-compose.yml

Luego crea el fichero ``.env`` y configúralo. Consulta la :doc:`config`
para más detalles sobre cómo configurar el paquete.

.. code-block:: bash

   $ cp .env.dist .env
   $ vi .env

Construir los contenedores y desplegar el paquete
-------------------------------------------------

Finalmente, construye los contenedores y despliégalos utilizando Docker:

.. code-block:: bash

   $ docker-compose up --build

Felicidades! Ya tienes el paquete montado. Puedes comprobar el estado de los
contenedores activos actualmente mediante el siguiente comando:

.. code-block:: bash

   $ docker ps

Si necesitas detener los servicios, puedes ejecutar el siguiente comando:

.. code-block:: bash

   $ docker-compose down

También puedes detener TODOS los contenedores de un viaje:

.. code-block:: bash

   $ docker rm -f $(docker ps -a -q)

Si necesitas entrar a cualquiera de los contenedores, puedes utilizar el
siguiente comando:

.. code-block:: bash

   $ docker exec -it <container> bash

donde ``<container>`` es uno de los contenedores enumerados en la salida del
comando ``docker ps``.

¿Qué hago ahora?
----------------

Si quieres conocer con detalle los servicios que proporciona el paquete, puedes
consultar la documentación sobre los :doc:`services`.

Si quieres saber cómo contribuir al desarrollo del paquete, puedes consultar la
sección :doc:`contrib`. Puedes contribuir de varias formas: desarrollando código,
escribiendo o probando funcionalidades, o bien escribiendo documentación.