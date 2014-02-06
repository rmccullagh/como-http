Input
========
This is a library that makes it easier to safely retrieve user input. The class provides an abstraction to the superglobals $_GET  and $_POST arrays. It is typically unsafe to operate directly on those arrays as it is easy to forget to do the validation neccessary to prevent unexpected behavior. 

For example if your url is a GET request like this: example.com/index.php?id[]=111, then you would normally access that value from the 'id' subscript of the $_POST array. However, if your application then proceeds to try and pass that value to a method that requires a string type value, you will have trouble because $_POST['id'] is in fact an array and not a string.

The Input class handles these things automatically for you by peforming these checks. It also sanitzes all values subsequently making an input value safe for output on the client such as a web browser.

To Use
========

require __DIR__ . '/vendor/autoload.php';

use \Como\Http\Input;

// this will return the default value if the q request is an array
var_dump(Input::get('q', Input::FILTER_ARRAY, $default = 'default value'));

// this will allow an array
var_dump(Input::get('q', Input::NO_FILTER_ARRAY, $default = 'default value'));



To install via composer:
========================
create a composer.json file with this:

{
    "require": {
        "como/input": "dev-master"
    }
}

then run composer install in the directory of your choice

To install from GitHub
======================

git clone http://github.com/rmccullagh/como-http.git

Then open up the test.php file and take a look at the examples.
