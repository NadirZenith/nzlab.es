MySQL
=====

Servicio de persistencia para el Wordpress 5.

Detalles del servicio
---------------------

+----------------------+----------------------------------------------------+
| Parámetro            | Valor                                              |
+======================+====================================================+
| URL                  | | https://localhost:$MYSQL_PORT                    |
|                      | | https://mysql.nzlab.local                        |
+----------------------+----------------------------------------------------+
| Contenedor           | ``mysql:5.7``                                      |
+----------------------+----------------------------------------------------+
| Nombre de contenedor | ``nzlab-mysql``                                    |
+----------------------+----------------------------------------------------+
| Variables de entorno | | MYSQL_HOST:``$MYSQL_HOST``                       |
|                      | | MYSQL_PORT:``$MYSQL_PORT``                       |
|                      | | MYSQL_NAME:``$MYSQL_NAME``                       |
|                      | | MYSQL_USER:``$MYSQL_USER``                       |
|                      | | MYSQL_PASS:``$MYSQL_PASS``                       |
|                      | | MYSQL_DATABASE:``$MYSQL_NAME``                   |
|                      | | MYSQL_PASSWORD:``$MYSQL_PASS``                   |
|                      | | MYSQL_ROOT_PASSWORD:``$MYSQL_ROOT_DB_PASS``      |
+----------------------+----------------------------------------------------+
| Puertos expuestos    | | ``$MYSQL_PORT``:3306                             |
+----------------------+----------------------------------------------------+
| Volúmenes            | | ``vol_mysql_data``:/var/lib/mysql                |
|                      | | ``vol_mysql_logs``:/var/log/mysql                |
+----------------------+----------------------------------------------------+

Requisitos
----------

Este servicio no tiene ningún requisito previo.

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

Configuración particular del servicio
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

+-----------------------------------------+---------------------------------------------------+
| Fichero                                 | Descripción                                       |
+=========================================+===================================================+
| etc/logrotate.d/mysql                   | Histórico y rotación de los ficheros de log MySQL |
+-----------------------------------------+---------------------------------------------------+
| etc/mysql/conf.d/00-binding             | La IP a la que se asocia el MySQL                 |
+-----------------------------------------+---------------------------------------------------+
| etc/mysql/conf.d/00-charset             | Charset y collation por defecto para MySQL        |
+-----------------------------------------+---------------------------------------------------+
| etc/mysql/conf.d/00-logging             | Configuración de los logs de MySQL                |
+-----------------------------------------+---------------------------------------------------+
| etc/mysql/conf.d/00-mysqld_safe_syslog  | Configuración del syslog para MySQL               |
+-----------------------------------------+---------------------------------------------------+
| etc/mysql/conf.d/00-net                 | Configuración de red para MySQL                   |
+-----------------------------------------+---------------------------------------------------+
| etc/mysql/conf.d/00-slow-query-log      | Registro de slow queries                          |
+-----------------------------------------+---------------------------------------------------+
| etc/mysql/conf.d/00-unindexed-query-log | Registro de consultas no indexadas                |
+-----------------------------------------+---------------------------------------------------+
| etc/mysql/conf.d/00-tuning              | Tuning                                            |
+-----------------------------------------+---------------------------------------------------+
| etc/mysql/conf.d/99-extra               | Tu configuración personalizada                    |
+-----------------------------------------+---------------------------------------------------+

.. note::

   Si realizas cambios en la configuración necesitarás re-desplegar el servicio
   para que los cambios tengan efecto. Consulta cómo hacerlo en
   :doc:`/package/install`.