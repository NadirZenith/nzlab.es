Sphinx
======

Servicio de documentación del paquete. Lo estás consultando ahora mismo!

Detalles del servicio
---------------------

+----------------------+----------------------------------------------------+
| Parámetro            | Valor                                              |
+======================+====================================================+
| URL                  | | https://localhost:$SPHINX_PORT_HTTP              |
|                      | | https://sphinx.nzlab.local                       |
+----------------------+----------------------------------------------------+
| Contenedor           | ``ubuntu:18.04``                                   |
+----------------------+----------------------------------------------------+
| Nombre de contenedor | ``nzlab-sphinx``                                   |
+----------------------+----------------------------------------------------+
| Variables de entorno | | SPHINX_HOST:``$SPHINX_HOST``                     |
|                      | | SPHINX_PORT_HTTP:``$SPHINX_PORT_HTTP``           |
|                      | | SPHINX_PORT_HTTPS:``$SPHINX_PORT_HTTPS``         |
+----------------------+----------------------------------------------------+
| Puertos expuestos    | | ``$SPHINX_PORT_HTTP``:80                         |
|                      | | ``$SPHINX_PORT_HTTPS``:443                       |
+----------------------+----------------------------------------------------+
| Volúmenes            | | ``sphinx/build/html``:/var/www/html              |
+----------------------+----------------------------------------------------+

Requisitos
----------

Este servicio requiere Python 3+, Python-PIP y Sphinx. El servicio utiliza
el tema Read The Docs.

Instalación
-----------

Este servicio no requiere de una instalación dedicada.

Configuración
-------------

Configuración global
~~~~~~~~~~~~~~~~~~~~

Los siguientes parámetros se configuran a nivel de paquete, en el fichero
``.env`` ubicado en la raíz del proyecto.

+--------------------------+-------------------------------------------------------------+
| Name                     | Descripción                                                 |
+==========================+=============================================================+
| SPHINX_HOST              | Nombre de host para el servicio de documentación            |
+--------------------------+-------------------------------------------------------------+
| SPHINX_PORT_HTTP         | Número de puerto HTTP para el servicio de documentación     |
+--------------------------+-------------------------------------------------------------+
| SPHINX_PORT_HTTPS        | Número de puerto HTTPS para el servicio de documentación    |
+--------------------------+-------------------------------------------------------------+

Configuración particular del servicio
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

El servidor web Nginx se configura en los ficheros dentro de la carpeta
``etc/nginx``:

+-----------------------------------------+---------------------------------------------------+
| Fichero                                 | Descripción                                       |
+=========================================+===================================================+
| etc/nginx/nginx.conf                    | Configuración básica del servicio nginx           |
+-----------------------------------------+---------------------------------------------------+
| etc/nginx/mime.types                    | Mapa de media types y extensions soportados       |
+-----------------------------------------+---------------------------------------------------+
| etc/nginx/sites-available/default.conf  | Configuración del sitio web por defecto           |
+-----------------------------------------+---------------------------------------------------+

.. note::

   Si realizas cambios en la configuración necesitarás re-desplegar el servicio
   para que los cambios tengan efecto. Consulta cómo hacerlo en
   :doc:`/package/install`.

Proceso de construcción de la documentación
-------------------------------------------

Se proporciona un ``Makefile`` con el servicio de documentación, que soporta las
operaciones más habituales:

Generar el sitio de documentación
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Desde la raíz del servicio (directorio ``sphinx``):

.. code-block:: bash

   $ make html

El sitio generado se encuentra en el directorio ``build/html``, que se monta como
el volumen ``/var/www/html`` en el contenedor Docker, correspondiente a la raíz del
servidor web Nginx.

.. note::

   La carpeta ``build/html`` es un volumen montado en la raíz del servidor
   web nginx, de modo que cada vez que se re-genera el sitio de documentación
   los ficheros generados están automáticamente disponibles para el servidor
   web, sin necesidad de reinicializar el contenedor Docker.

Generar un PDF con toda la documentación
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Desde la raíz del servicio (directorio ``sphinx``):

.. code-block:: bash

   $ make latexpdf

El fichero PDF generado se encuentra en el directorio ``build/latex``.