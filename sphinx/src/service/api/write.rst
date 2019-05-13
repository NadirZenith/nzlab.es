Writing data to the API
=======================

To write data to the API (e.g. using PATCH, POST, and PUT requests), you may
need to include a request body in JSON format. The :ref:`reference` shows you
all the available request parameters for each endpoint, including required
fields.

The following example shows you how to write a new resource with an HTTP POST
request using cURL (note the format of the --data option) and HTTP Basic
Authentication:

.. code-block:: bash

   curl --request POST \
        --url 'https://{api.url}/{api.version}/{resource}' \
        --user 'anystring:{api.key}' \
        --header 'Content-Type: application/json' \
        --data '{"name":"Foo","type":"Bar"}' \
        --include