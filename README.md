The PaypalService is responsible for handling PayPal API requests and responses within your Laravel application. It provides methods to create orders, handle payments, and capture payment approvals.

## Dependencies:
### Traits:
ConsumeAPIServices: A custom trait used to make API requests.
### Packages:
Illuminate\Http\Request: Used for handling HTTP requests within the Laravel framework.
Properties: 
$baseUri (string): The base URI for the PayPal API, retrieved from the application configuration.
$clientId (string): The PayPal client ID, retrieved from the application configuration.
$clientSecret (string): The PayPal client secret, retrieved from the application configuration.

### What are Traits?
PHP only supports single inheritance: a child class can inherit only from one single parent.

So, what if a class needs to inherit multiple behaviors? OOP traits solve this problem.

Traits are used to declare methods that can be used in multiple classes. Traits can have methods and abstract methods that can be used in multiple classes, and the methods can have any access modifier (public, private, or protected).

Traits are declared with the trait keyword.

## What are Abstract Classes and Methods?
Abstract classes and methods are when the parent class has a named method, but need its child class(es) to fill out the tasks.

An abstract class is a class that contains at least one abstract method. An abstract method is a method that is declared, but not implemented in the code.

An abstract class or method is defined with the abstract keyword.

## What are Interfaces?
Interfaces allow you to specify what methods a class should implement.

Interfaces make it easy to use a variety of different classes in the same way. When one or more classes use the same interface, it is referred to as "polymorphism".

Interfaces are declared with the interface keyword

## Static Methods
Static methods can be called directly - without creating an instance of the class first.

Static methods are declared with the static keyword.

## ConsumeAPIServices Trait
Namespace: App\Traits

The ConsumeAPIServices trait provides a reusable method to make API requests within your Laravel application. It is designed to be used by service classes that interact with external APIs.

Dependencies:
1. Packages:
GuzzleHttp\Client: A PHP HTTP client used to send HTTP requests.
### Methods
makeRequest($method, $requestUrl, $queryParams = [], $formParams = [], $headers = [], $isJsonRequest = false)

Description: This method sends an HTTP request to a specified API endpoint. It handles authorization, encoding of request data, and parsing of the API response.

Parameters:

* $method (string): The HTTP method to be used for the request (e.g., GET, POST, PUT, DELETE).
* $requestUrl (string): The URL path of the API endpoint (relative to the base URI).
* $queryParams (array, optional): An associative array of query parameters to be included in the request URL. Default is an empty array.
* $formParams (array, optional): An associative array of form parameters to be included in the request body. Default is an empty array.
* $headers (array, optional): An associative array of HTTP headers to be sent with the request. Default is an empty array.
* $isJsonRequest (bool, optional): A boolean indicating whether the request body should be sent as JSON. Default is false.
Returns:

The decoded response from the API, typically as an object or array.

Detailed Behavior:

### HTTP Client Setup:
Initializes a new GuzzleHttp\Client instance using the baseUri property of the class that uses this trait.
### Authorization Handling:
If the consuming class has a resolveAuthorization method, it is called to resolve and add any necessary authorization headers.
### Sending Request:
Sends the HTTP request to the specified URL with the given method, query parameters, form parameters, headers, and body format (JSON or form data).
### Response Handling:
Retrieves the response body, and if the consuming class has a decodeResponse method, the response is decoded accordingly.
### Return Value:
The method returns the decoded API response, making it easier to work with the data.
