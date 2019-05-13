Get Started with the API
========================

After reading through this guide, be sure to check out the `API Reference`_
to see all available API requests, and visit the `Playground`_ to test calls
in real-time with your own data. You can use Postman, of course.

Before You Start
----------------

This getting started guide assumes you're familiarized with most REST API
concepts. If you'd like to learn more about REST APIs, use Google.

About the API
-------------

The API allows consumers to consume API endpoints, usually on behalf of
the final user. Each API endpoint represents an operation over a resource,
or over a collection of resources. All API resources are provided under a
common root or base URL:

.. code-block:: bash

   https://{api.url}

.. note::

   Yes, API is only served over HTTPS.

Versions
--------

APIs are organized in versions. This getting started guide covers the 1.0
version. Check the tagged versions of the package repository for older version
documentation. Each API Version exposes a collection of resources to the
outside. The exposed resources in each version may vary. The root path of
the API version exposes a map of all available resources and their sub-
resources:

.. code-block:: bash

   https://{api.url}/{api.version}/

Consumers
---------

Consumer applications may be implemented server-side or client-side.
Client-side consumer implementations require CORS to be enabled on the
API options. As client-side consumer implementations which consume the
API through CORS requests may introduce a potential security risk of
exposing account API keys, the API can be configured to prevent such
client-consumers.

Authentication
--------------

Consumer implementations should authenticate themselves in order to use
the API and access the exposed resources. Currently the API supports three
authentication options: none (no authentication), HTTP Basic Authentication,
and OAuth2.

Assuming you have curl installed, you can easilly try authenticated API
requests using the following examples. For HTTP Basic Authenticaiton:

.. code-block:: bash

   $ curl --request GET \
          --url 'https:{api.url}/{api.version}/' \
          --user 'anyusername:{api.key}'

To debug OAuth2 request, you should grab a valid token first:

.. code-block:: bash

   $ curl --request GET \
          --url 'https:{api.url}/{api.version}/' \
          --header 'Authorization: Bearer {token}'

Resources
---------

Resources may be attached to database entities or documents, or may represent
anything you want. Collections of resources are available at

.. code-block:: bash

   https://{api.url}/{api.version}/{resource}

and instances of resources are available at

.. code-block:: bash

    https://{api.url}/{api.version}/{resource}/{id}

where ``{id}`` is the resource identifier.

.. note::

   Collections of resources may be pluralized, and the field used
   as resource identifier may also be customized. See API Options.

.. note::

   The links and URLs specified in this documentation have been generated
   using the default URL generator. You can customize the API URLs providing
   your own URLGenerator implementation.


Endpoints
---------

The API allows certain operations to be performed on resources though
endpoints. Each endpoint has an associated resource path and an HTTP
request method. The endopint URL is determined resolving the relative
endpoint path, either a collection or instance resource path, against
the API version URL. The API may support different set of methods:

- The **Basic Support** includes support for basic HTTP request methods
  defined in `RFC 2616`_: DELETE, GET, HEAD, OPTIONS, PATCH, POST, and
  PUT (TRACE is not used).

- The **Extended Support** adds support for extended HTTP request methods
  defined in `RFC 2518`_: COPY, MKCOL, MOVE, PROPFIND, and PROPPATCH.

- Finally, the **Link Support** adds support for LINK and UNLINK methods,
  defined in `HTTP LINK and UNLINK`_ draft.

.. note::

   See ``Can\Rest\MethodSupport`` for a list of constants. Constants in
   ``MethodSupport`` can be OR'ed, e.g, to support basic methods plus
   methods defined in RFC 2518, you can use

   .. code-block:: php

      $support = MethodSupport::BASIC |
                 MethodSupport::EXTENDED |
                 MethodSupport::LINK ;

Method properties and its intended usage are shown in the following
table (in the table, columns marked with * indicate that the request
payload has no defined semantics -- no body):

+--------------+--------+-------+-------------+---------+-------+--------------------------+
| Method       | Basic  | Safe  | Idempotent  | Simple  | Body  | Use                      |
+==============+========+=======+=============+=========+=======+==========================+
| DELETE       | Yes    | No    | Yes         | No      | No    | Delete a resource        |
+--------------+--------+-------+-------------+---------+-------+--------------------------+
| GET          | Yes    | Yes   | Yes         | Yes     | No    | Retrieves a resource or  |
|              |        |       |             |         |       | collection of resources  |
+--------------+--------+-------+-------------+---------+-------+--------------------------+
| HEAD         | Yes    | Yes   | Yes         | No      | No    | Same as get, but the     |
|              |        |       |             |         |       | resource is not returned |
+--------------+--------+-------+-------------+---------+-------+--------------------------+
| OPTIONS      | Yes    | Yes   | Yes         | No      | No    | Request for information  |
+--------------+--------+-------+-------------+---------+-------+--------------------------+
| PATCH        | Yes    | No    | Yes         | No      | No    | Update a resource        |
|              |        |       |             |         |       | (partial update)         |
+--------------+--------+-------+-------------+---------+-------+--------------------------+
| POST         | Yes    | No    | Yes         | No      | No    | Create a resource        |
+--------------+--------+-------+-------------+---------+-------+--------------------------+
| PUT          | Yes    | No    | Yes         | No      | No    | Update a resource        |
|              |        |       |             |         |       | (full update)            |
+--------------+--------+-------+-------------+---------+-------+--------------------------+
| COPY         | No     | No    | No          | No      | No    | Copy a resource (creates |
|              |        |       |             |         |       | a duplicate)             |
+--------------+--------+-------+-------------+---------+-------+--------------------------+
| MOVE         | No     | No    | No          | No      | No    | Move a resource          |
+--------------+--------+-------+-------------+---------+-------+--------------------------+
| MKCOL        | No     | No    | No          | No      | No    | Create a new resource    |
|              |        |       |             |         |       | collection (bulk create) |
+--------------+--------+-------+-------------+---------+-------+--------------------------+
| PROPFIND     | No     | No    | No          | No      | No    | Retrieve a resource      |
|              |        |       |             |         |       | property                 |
+--------------+--------+-------+-------------+---------+-------+--------------------------+
| PROPPATCH    | No     | No    | No          | No      | No    | Patch a resource         |
|              |        |       |             |         |       | property                 |
+--------------+--------+-------+-------------+---------+-------+--------------------------+
| LOCK         | No     | No    | No          | No      | No    | Lock a resource          |
+--------------+--------+-------+-------------+---------+-------+--------------------------+
| UNLOCK       | No     | No    | No          | No      | No    | Unlock a resource        |
+--------------+--------+-------+-------------+---------+-------+--------------------------+
| LINK         | No     | No    | Yes         | No      | No*   | Link a resource to       |
|              |        |       |             |         |       | another                  |
+--------------+--------+-------+-------------+---------+-------+--------------------------+
| UNLINK       | No     | No    | Yes         | No      | No*   | Unlink a resource from   |
|              |        |       |             |         |       | another                  |
+--------------+--------+-------+-------------+---------+-------+--------------------------+

Other methods, as those defined in `RFC 3253`_ (VERSION-CONTROL, REPORT,
CHECKOUT, CHEKIN, UNCHECKOUT, MKWORKSPACE, UPDATE, LABEL, MERGE,
BASELINE-CONTROL), in `RFC 3648`_ (ORDERPATCH), in `RFC 3744`_ (ACL),
and in `Other drafts` (SEARCH) are not used in this API version.

.. note::

   If your ISP doesn't permit HTTP operations other than GET or POST,
   use HTTP Method tunneling: make your call with POST, but include
   the method you intend to use in an X-HTTP-Method-Override header.

.. warning::

   Question--Hey, this is not fully compliant with the REST principles!

   Answer--We know. Fuck you.

Parameters
----------

Parameters may be located on the request URL path, on the request URL
query, on the request headers or on the request body.

Path parameters are part of the

Schema
------

The API is documented using JSON Schema documents. These documents may also
be useful when developing client-side consumer implementations. Check the
root documents at

.. code-block:: bash

   https://{api.url}/schema/{api.version}/schema.json
   https://{api.url}/schema/{api.version}/hateoas.json

Additionally, for each resource in the API version, the following documents
are available:

.. code-block:: bash

   https://{api}/schema/{version}/{resource}/instance.json
   https://{api}/schema/{version}/{resource}/response.json
   https://{api}/schema/{version}/{resource}/collection.json
   https://{api}/schema/{version}/{resource}/collection-response.json

The names on the URL paths are self-explanatory.

Rate limiting
-------------

Authenticated API requests can be rate-limited, e.g., 5000 requests per hour.
Authenticated requests are associated with the authenticated user, regardless
of the authentication method used. This means that all applications authorized
by a user share the same quota of, say, 5000 requests per hour when they
authenticate with different tokens owned by the same user.

For unauthenticated requests, the rate limit allows for up to 60 requests per
hour by default. Unauthenticated requests are associated with the originating
IP address, and not the user making requests.

Note that individual endpoints may have its own custom rate limit rules.

If rate-limiting is enabled, then the returned HTTP headers of any API request
show your current rate limit status:

.. code-block:: bash

   $ curl -i https://{api.url}/{api.version}/{resource}

   HTTP/1.1 200 OK
   Date: Mon, 29 Nov 1980 12:27:06 GMT
   Status: 200 OK
   X-RateLimit-Limit: 60
   X-RateLimit-Remaining: 56
   X-RateLimit-Reset: 1372700873
   X-RateLimit-Window: 3600

+------------------------+--------------------------------------------------------+
| Header                 | Description                                            |
+========================+========================================================+
| X-RateLimit-Limit      | The maximum number of requests you're permitted to     |
|                        | make per time unit.                                    |
+------------------------+--------------------------------------------------------+
| X-RateLimit-Remaining  | The number of requests remaining in the current rate   |
|                        | limit window.                                          |
+------------------------+--------------------------------------------------------+
| X-RateLimit-Reset      | The time at which the current rate limit window        |
|                        | resets in UTC epoch seconds.                           |
+------------------------+--------------------------------------------------------+
| X-RateLimit-Window     | The length of the rate limit time window, in seconds   |
+------------------------+--------------------------------------------------------+

If you need the time, e.g. as a PHP DateTime instance or a JavaScript Date object:

.. code-block:: php

   new DateTime(1372700873);
   // => Mon Jul 01 2013 13:47:53 GMT-0400 (EDT)

.. code-block:: javascript

   new Date(1372700873 * 1000)
   // => Mon Jul 01 2013 13:47:53 GMT-0400 (EDT)

If you exceed the rate limit, an error response returns:

.. code-block:: bash

   $ curl -i https://{api.url}/{api.version}/{resource}

   HTTP/1.1 403 Forbidden
   Date: Mon, 29 Nov 1980 12:27:06 GMT
   Status: 403 Forbidden
   X-RateLimit-Limit: 60
   X-RateLimit-Remaining: 0
   X-RateLimit-Reset: 1377013266
   X-RateLimit-Window: 3600

   {
      "status": 403,
      "message": "API rate limit exceeded for xxx.xxx.xxx.xxx",
      "details": "Unauthenticated API requests have a lower limit than authenticated ones (Check out the documentation for more details.)",
      "link": "https://doc.{api.url}/service/api/rate-limit"
   }

You can check your rate limit status without incurring an API hit.

Increasing the unauthenticated rate limit
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

If your consumer application needs to make unauthenticated calls with a higher
rate limit, you can pass your app's client ID and secret as part of the query
string.

.. code-block:: bash

   $ curl -i 'https://{api.url}/{api.version}/{resource}?client_id={client.id}&client_secret={client.secret}'

   HTTP/1.1 200 OK
   Date: Mon, 29 Nov 1980 12:27:06 GMT
   Status: 200 OK
   X-RateLimit-Limit: 5000
   X-RateLimit-Remaining: 4966
   X-RateLimit-Reset: 1372700873

.. warning::

   Never share your client secret with anyone or include it in client-side
   browser code. Use the method shown here only for server-side consumer
   calls.

Staying within the rate limit
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

If you exceed your authenticated rate limit, you can likely fix the issue by
caching API responses and using conditional requests.

Abuse rate limits
~~~~~~~~~~~~~~~~~

In order to provide quality service, additional rate limits may apply to some
actions and certain API endpoints. For example, using the API to rapidly create
content, poll aggressively, make multiple concurrent requests, or repeatedly
request data that is computationally expensive may result in abuse rate limiting.

Abuse rate limits are not intended to interfere with legitimate use of the API.
Your normal rate limits should be the only limit you target. To ensure you're
acting as a good API citizen, check out our Best Practices guidelines.

If your application triggers this rate limit, you'll receive an informative
response:

.. code-block:: bash

   HTTP/1.1 403 Forbidden
   Content-Type: application/json; charset=utf-8
   Connection: close

   {
      "status": 403,
      "message": "Rate Limit Abuse",
      "message": "You have triggered an abuse detection mechanism and have been temporarily blocked from content creation. Please retry your request again later.",
      "link": "https://doc.package.com/service/api/rate-limits"
   }

Options
-------

API supports a number of options:

:allow_client_consumer:

   Client-side consumer implementation may consume the API using CORS
   requests, but sometimes applications don't allow this, as it introduces
   a potential security risk of exposing account API keys.

:allow_http_method_tunneling:

   If your ISP doesn't permit HTTP operations other than GET or POST,
   use HTTP Method tunneling: make your call with POST, but include the
   method you intend to use in an X-HTTP-Method-Override header.

:authentication:

   The authentication method. Each authentication method will require
   additional options.

:method_support:

   This determines the set of supported HTTP request methods (operations).
   This should be one of the ``MethodSupport`` class constants, e.g.
   ``MethodSupport::BASIC``.

:pluralize:

   Whether to pluralize resource names. Aesthetic only.
   You can also override the default Inflector used to
   return the pluralization you want.

:public_schema:

   Whether the API schema is public or private. If private, the schema
   documents will require authentication.

:user_agent_required:

   All API requests SHOULD include a valid User-Agent header. If this option
   is set, all Requests with no User-Agent header will be rejected. We request
   that you use your name, the name of your application, or any other arbitrary
   value for the User-Agent header value. This allows us to contact you if
   there are problems.


.. _`API Reference`: https://api.local
.. _`Basic HTTP Methods`: https://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html
.. _`HTTP LINK and UNLINK`: http://tools.ietf.org/html/draft-snell-link-method
.. _`HTTP PATCH`: https://datatracker.ietf.org/drafts/draft-dusseault-http-patch/
.. _`Other drafts`: https://datatracker.ietf.org/drafts/draft-reschke-webdav-search/
.. _`Playground`: https://api.local
.. _`RFC 2616`: https://tools.ietf.org/html/rfc2616
.. _`RFC 2815`: https://tools.ietf.org/html/rfc2815
.. _`RFC 3253`: https://tools.ietf.org/html/rfc3253
.. _`RFC 3648`: https://tools.ietf.org/html/rfc3648
.. _`RFC 3744`: https://tools.ietf.org/html/rfc3744
