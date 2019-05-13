Reading data from the API
=========================

Pagination
----------

Read requests to collection endpoints support pagination parameters **offset**
and **limit**. For example, the following GET request will fetch the first page
of 10 resources from the API:

.. code-block:: bash

   https://{api.url}/{api.version}/{resource}?offset=0&limit=10

The default offset is zero and the default limit is 20 results per page. You
can change the defaults in the :ref:`options`.

Sorting
-------

Read requests to collection endpoints support sorting parameter **sort**.
For example, the following GET request will fetch a collection of resources
sorted by name in ascent order and then by score in descent order:

.. code-block:: bash

   https://{api.url}/{api.version}/{resource}?sort[name]=asc,sort[score]=desc

The API will throw an error if a field isn't valid in your request.

Partial responses
-----------------

Read requests to collection and instance endpoints support partial responses
and field selection parameters **fields** and **exclude_fields**. Consumers
are encouraged to request only the fields they need to optimize bandwidth
and alleviate the API load.

To fetch the response data for read requests the API may require to execute
some heavy queries to the persistence layer. If you only need a few attributes
from each resource instance, you can specify which fields should be queried
(or which fields should be excluded from the query) using the **fields** and
**exclude_fields** API parameters.

For example, the following request can be used to fetch a collection of resources
from the API, querying only the type and size fields for each resource instance
(the resource identifier field is *always* returned):

.. code-block:: bash

   https://{api.url}/{api.version}/{resource}?fields=type,size

The following request to the API will return all fields but the path and createdAt
ones from a resource instance:

.. code-block:: bash

   https://{api.url}/{api.version}/{resource}/{id}?exclude=path,createdAt

The parameters **fields** and **exclude_fields** are mutually exclusive and
the API will throw an error if a request contains both or if a field isn't
valid in your request.

If you use partial responses frequently, you may consider using *Resource Views*.
See next sections for details.

Filtering
---------

Read requests to collection endpoints support filtering parameter **filters**.
For example, the following GET request will return a collection of resources
with identifiers in the [2510, 2911] range:

.. code-block:: bash

   https://{api.url}/{api.version}/{resource}?filters=[id,in,[2510,2911]]

The API will throw an error if a field isn't valid in your request. See the
table of Operators posted below for a full list of supported operators.

Multiple filtering criteria may be grouped and combined using logic operators
to perform complex queries. For example, the following GET request will fetch
a collection of resources with type A or B:

.. code-block:: bash

   https://{api.url}/{api.version}/{resource}?filters=[or,[type,eq,A],[type,eq,B]]

See the table of Logic Operators posted below for a full list of supported
operators.

By default the API uses the conventional infix notation for filtering
expressions (in the form *<operand> <operator> <operand>*. This notation
improves readability, but requires more parsing work. You can configure the
API to use other notations, like prefix notation (*<operator> <operand> <operand>*)
and postfix notation (*<operand> <operand> <operator>*). These notation
conventions are hard to read, but are easier to parse using a simple stack.

Field paths
-----------

The API allows querying fields from resource relations using dot notation.
For example, assuming you have a ``post`` resource which may have one or many
related ``comments`` resources, you can use the following request to fetch
posts with recent comments, and the API will automatically add the appropriate
criteria to the fetch query:

.. code-block:: bash

   https://{api.url}/{api.version}/{resource}?filters=[comments.createdAt,gt,now]

Field paths may be used both when specifying sorting, filtering or partial field
selection parameters. The API will throw an error if a field isn't valid in your
request. Virtual fields can also be queried.

Resource Views
--------------

Read requests to collection endpoints support resource view parameter **view**.
API resources can be configured to be serialized in several ways, according
to different *resource views*. If resources are attached to database entities
or documents, these views may match your DTOs (Data Transfer Objects).

For example, suppose the API exposes a resource
``media`` with fields path, type, size, but you don't wan't to expose the
internal path field to the public. You can configure a media resource view
named "public" to expose only the type and size fields, but exclude the path
field. The following GET request to the API will fetch a collection of media
resources using the configured view:

.. code-block:: bash

   https://{api.url}/{api.version}/{resource}?view=public

The API will throw an error if a view isn't valid in your request.

Reference of Filtering Operators
--------------------------------

Filtering Operators
~~~~~~~~~~~~~~~~~~~

**Basic Operators** may be used with general fields:

+-----------+---------+----------------------------+
| Operator  | Symbol  | Operator                   |
+===========+=========+============================+
| eq        | =       | Equal To                   |
+-----------+---------+----------------------------+
| neq       | !=      | Not Equal To               |
+-----------+---------+----------------------------+
| gt        | >       | Greater Than               |
+-----------+---------+----------------------------+
| gte       | >=      | Greater Than or Equal To   |
+-----------+---------+----------------------------+
| lt        | <       | Less Than                  |
+-----------+---------+----------------------------+
| lte       | <=      | Less Than or Equal To      |
+-----------+---------+----------------------------+

**Text Operators** work on text fields:

+-----------+---------+----------------------------+
| Operator  | Symbol  | Operator                   |
+===========+=========+============================+
| lk        | @=      | Like                       |
+-----------+---------+----------------------------+
| nlk       | !@      | Not Like                   |
+-----------+---------+----------------------------+
| sw        | ^=      | Starts With                |
+-----------+---------+----------------------------+
| ew        | $=      | Ends With                  |
+-----------+---------+----------------------------+
| mt        | *=      | Matches                    |
+-----------+---------+----------------------------+
| dnm       | !*      | Does Not Matches           |
+-----------+---------+----------------------------+

**Other Operators** are used to test whether a field is blank or not, or to
use range criteria:

+-----------+---------+----------------------------+
| Operator  | Symbol  | Operator                   |
+===========+=========+============================+
| is        | ~       | Is Null                    |
+-----------+---------+----------------------------+
| isn       | !~      | Is Not Null                |
+-----------+---------+----------------------------+
| in        | @       | In Range                   |
+-----------+---------+----------------------------+
| btw       | @-      | Between Range              |
+-----------+---------+----------------------------+

Logic Operators
~~~~~~~~~~~~~~~
+-----------+---------+----------------------------+
| Operator  | Symbol  | Logic Operator             |
+===========+=========+============================+
| not       | !       | Logical NOT                |
+-----------+---------+----------------------------+
| and       | &       | Logical AND                |
+-----------+---------+----------------------------+
| or        | |       | Logical OR                 |
+-----------+---------+----------------------------+
| xor       | ^       | Logical XOR (exclusive-OR) |
+-----------+---------+----------------------------+
| andnot    | &!      | Logical AND NOT            |
+-----------+---------+----------------------------+