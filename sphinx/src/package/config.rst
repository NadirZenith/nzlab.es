Configuración
=============

La configuración global del paquete se configura en el fichero ``.env``
ubicado en la raíz del proyecto.


Configuración global del paquete
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

+--------------------------+-------------------------------------------------------------+
| Name                     | Descripción                                                 |
+==========================+=============================================================+
| PACKAGE_NAME             | Nombre del paquete                                          |
+--------------------------+-------------------------------------------------------------+
| PACKAGE_ENV              | Entorno actual                                              |
+--------------------------+-------------------------------------------------------------+
| PACKAGE_DEBUG            | Modo de depuración                                          |
+--------------------------+-------------------------------------------------------------+

Configuración del servicio de estáticos
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

+--------------------------+-------------------------------------------------------------+
| Name                     | Descripción                                                 |
+==========================+=============================================================+
| FRONTEND_HOST            | Nombre de host para el servicio de assets estáticos         |
+--------------------------+-------------------------------------------------------------+
| FRONTEND_PORT_HTTP       | Número de puerto HTTP para el servicio de assets estáticos  |
+--------------------------+-------------------------------------------------------------+
| FRONTEND_PORT_HTTPS      | Número de puerto HTTPS para el servicio de assets estáticos |
+--------------------------+-------------------------------------------------------------+

Configuración del servicio WWW
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

+--------------------------+-------------------------------------------------------------+
| Name                     | Descripción                                                 |
+==========================+=============================================================+
| WORDPRESS_HOST           | Nombre host para el servicio Wordpress                      |
+--------------------------+-------------------------------------------------------------+
| WORDPRESS_PORT_HTTP      | Número de puerto HTTP para el servicio Wordpress            |
+--------------------------+-------------------------------------------------------------+
| WORDPRESS_PORT_HTTPS     | Número de puerto HTTPS para el servicio Wordpress           |
+--------------------------+-------------------------------------------------------------+

Configuración del servicio MySQL
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

+--------------------------+-------------------------------------------------------------+
| Name                     | Descripción                                                 |
+==========================+=============================================================+
| MYSQL_HOST               | Nombre de host para el servicio de persistencia MySQL       |
+--------------------------+-------------------------------------------------------------+
| MYSQL_PORT               | Número de puerto para el servicio de persistencia MySQL     |
+--------------------------+-------------------------------------------------------------+
| MYSQL_NAME               | Nombre de la base de datos utilizada por Wordpress          |
+--------------------------+-------------------------------------------------------------+
| MYSQL_USER               | Nombre de usuario para acceder a la base de datos MySQL     |
+--------------------------+-------------------------------------------------------------+
| MYSQL_PASS               | Contraseña de usuario para acceder a la base de datos MySQL |
+--------------------------+-------------------------------------------------------------+
| MYSQL_ROOT_DB_PASS       | Contraseña de root para acceder a la base de datos MySQL    |
+--------------------------+-------------------------------------------------------------+

Configuración del servicio monitor
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

+--------------------------+-------------------------------------------------------------+
| Name                     | Descripción                                                 |
+==========================+=============================================================+
| MONITOR_HOST             | Nombre de host para el servicio de monitorización           |
+--------------------------+-------------------------------------------------------------+
| MONITOR_PORT_HTTP        | Número de puerto HTTP para el servicio de monitorización    |
+--------------------------+-------------------------------------------------------------+
| MONITOR_PORT_HTTPS       | Número de puerto HTTPS para el servicio de monitorización   |
+--------------------------+-------------------------------------------------------------+
| MONITOR_SERVER_ROOT      | URL raíz para el servicio de monitorización                 |
+--------------------------+-------------------------------------------------------------+
| MONITOR_ADMIN_PASS       | Contraseña de administrador para el servicio de             |
|                          | monitorización                                              |
+--------------------------+-------------------------------------------------------------+

Configuración del servicio proxy
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

+--------------------------+-------------------------------------------------------------+
| Name                     | Descripción                                                 |
+==========================+=============================================================+
| PROXY_HOST               | Nombre de host para el servidor proxy                       |
+--------------------------+-------------------------------------------------------------+
| PROXY_PORT_HTTPS         | Número de puerto HTTPS para el servidor proxy               |
+--------------------------+-------------------------------------------------------------+

Configuración del servicio de documentación
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

+--------------------------+-------------------------------------------------------------+
| Name                     | Descripción                                                 |
+==========================+=============================================================+
| SPHINX_HOST              | Nombre de host para el servicio de documentación (Sphinx)   |
+--------------------------+-------------------------------------------------------------+
| SPHINX_PORT_HTTP         | Número de puerto HTTP para el servicio de documentación     |
+--------------------------+-------------------------------------------------------------+
| SPHINX_PORT_HTTPS        | Número de puerto HTTPS para el servicio de documentación    | 
+--------------------------+-------------------------------------------------------------+

.. note::

   Cada servicio puede definir opciones de configuración adicionales.
   Consulta la documentación sobre los :doc:`services`.

.. note::

   Si realizas cambios en la configuración necesitarás re-desplegar el servicio
   para que los cambios tengan efecto. Consulta cómo hacerlo en
   :doc:`/package/install`.

