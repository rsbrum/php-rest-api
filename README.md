# PHP REST api

This is a micro-framework for developing RESTful APIs, it is based on the MVC design pattern so it should look familiar to php developers. Authentication implementation and unit testing is up to you. 

It follows the same URL routing architecture as in MVC based systems, each controller abstracts the business logic of a particular resource, a "view" would be a method inside the controller. Each endpoint can only create, update or retrieve a resource. 

# URL structure 

Manipulation of resources are done through endpoints. Example:

apiurl/controller/method/param1/param2...  

# Controllers

When creating a new controller the filename must be the same as the class name, this makes autoloading easier.  Example:

class Users{}
filename: Users.php
