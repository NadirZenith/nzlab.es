HAProxy
=======

Un servidor proxy y balanceador de carga, que despacha todas las peticiones
a los servicios correspondientes.

Detalles del servicio
---------------------

+----------------------+----------------------------------------------------+
| Parámetro            | Valor                                              |
+======================+====================================================+
| URL                  | | https://localhost:$PROXY_PORT_HTTPS              |
|                      | | https://proxy.nzlab.local                        |
+----------------------+----------------------------------------------------+
| Contenedor           | ``haproxy:1.8-alpine``                             |
+----------------------+----------------------------------------------------+
| Nombre de contenedor | ``nzlab-proxy``                                    |
+----------------------+----------------------------------------------------+
| Variables de entorno | | PROXY_HOST:``$PROXY_HOST``                       |
|                      | | PROXY_SSL_CERT:``$PROXY_SSL_CERT``               |
+----------------------+----------------------------------------------------+
| Puertos expuestos    | | ``$PROXY_PORT_HTTPS``:443                        |
+----------------------+----------------------------------------------------+
| Volúmenes            | | ``haproxy/etc/ssl``:/etc/ssl                     |
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
| PROXY_HOST               | Nombre de host para el servidor proxy                       |
+--------------------------+-------------------------------------------------------------+
| PROXY_PORT_HTTPS         | Número de puerto HTTPS para el servidor proxy               |
+--------------------------+-------------------------------------------------------------+

Configuración particular del servicio
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

El servicio se configura en el fichero ``etc/haproxy/haproxy.cfg``.

.. note::

   Si realizas cambios en la configuración necesitarás re-desplegar el servicio
   para que los cambios tengan efecto. Consulta cómo hacerlo en
   :doc:`/package/install`.

Certificados SSL
~~~~~~~~~~~~~~~~

Los certificados SSL (formato PEM) se encuentran en el directorio ``etc/ssl``.
Estos certificados se instalan en el contenedor de Docker.

.. note::

   Si realizas cambios en los certificados SSL necesitarás re-desplegar el
   servicio para que los cambios tengan efecto. Consulta cómo hacerlo en
   :doc:`/package/install`.