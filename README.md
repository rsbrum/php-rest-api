# PHP REST api

This is a simple server-side application that has not been tested in production, it is based on the MVC design pattern so it should look familiar to php developers. It does not make use of any kind of authentication.

It follows the same URL routing architecture and uses controllers to separate the business logic and each "view" is a method inside the controller that creates/updates or retrieves a resource. It returns a json object when retrieving a resource and when creating/updating it makes use of HTTP status codes. 

# URL structure 

Manipulation of resources is done through endpoints, each endpoint does only one thing. Example:

apiurl/controler/method/param1/param2... (You can have no params!) 

# Controllers

When creating a new controller the filename must be the same as the class name. Example:

class Users{}
filename: Users.php
