<?php

    require_once "../vendor/autoload.php";

    use Kleber\App as App;
    use Kleber\Helpers as Helpers;
    use Kleber\Controllers\MainController as MainController;
    use Kleber\core\routing\Router as Router;

    $app = App::get_instance();

    $router = new Router( $app );

    //$app->registerService( $router );

    //Helpers::log( "Index.php file" );
    
    // shows main page
    $app->get( "index",  [ "Method" => "index", "Controller" => MainController::class ] );

    // shows login page
    $app->get( "login",  [ "Method" => "showLogin", "Controller" => MainController::class ] );

    // handles a login request by a user
    $app->post( "login", [ "Method" => "login", "Controller" => MainController::class ] );

    // shows the user profile - if logged in!
    $app->get("profile", [ "Method" => "profile", "Controller" => MainController::class ] );

    
    $app->get("test", [ "Method" => "test", "Controller" => MainController::Class ] );



    $app->makeCustomDefaultRoute( App::NotFound, [ "Method" => "notFound", "Controller" => MainController::class ] );

    $app->start(); 


  /* 
class Router {
    private $method, $pattern, $action;
    
    public function get( String $pattern )
    {
        $this->pattern = $pattern;
        return $this;
    }

    public function setController( $controller, $action )
    {
        $this->action = $action;
        $this->controller = new $controller;
        return $this;
    }

    public function registerRouteGroup( $method, $routes )
    {
        $routeGroup = new RouteGroup( $routes );
        return $routeGroup;
    }

}

class routeGroup {
    private $registry = [];
    public function __constructor( $routes )
    {
        foreach ( $routes as $route )
        {
            $this->registry[] = $route;
        }
    }
}


Router->get( "/account", [controller::class, "index" ], $options );
Router->registerRouteGroup( 
    "GET",
    [
        [ "/",         $action ],
        [ "/account",  $action ],
        [ "/profile",  $action ],
        [ "/messages", $action ]
    ]
)->setMiddleware( "Authentication" );
*/

/*
class Neuron {

    private $epoch = 0;
    private $inputSize;
    private $weights;
    private $bias;
    private $learningRate;

    public function __construct($inputSize) {


        //echo "initializing neuron!<br />";
        $this->inputSize = $inputSize;
        $this->weights = array();
        $this->bias = 0;
        $this->learningRate = 0.1;

        // Initialize weights and biases with random values between -1 and 1.
        for ($i = 0; $i < $inputSize; $i++) {
            $this->weights[] = rand(-100, 100) / 100;
        }
    }

    public function feedForward($inputs) {
        // Perform the dot product of inputs and weights and add the bias.
        $weightedSum = 0;

        for ($i = 0; $i < $this->inputSize; $i++) {
            echo "Loop: " . $i . "<br />";
            echo "input: " . $inputs[$i] . " * ";
            echo "weight: " . $this->weights[$i ] . "<br />";

            $weightedSum += $inputs[$i] * $this->weights[$i];

            echo "weightedSum: " . $weightedSum . "<br /><br />";
        }

        echo "<br />At end of loops WeightedSum: " . $weightedSum . "<br />";
        echo "<br /><br />";

        return $this->activate($weightedSum);
    }

    private function activate($weightedSum) {
        // Using the sigmoid activation function.
        $simoid = 1 / (1 + exp(-$weightedSum));
        //echo "Epoch: " . ++$this->epoch . " Sigmoid = " . $simoid . "<br />";
        return $simoid;
    }

    public function train($inputs, $target) {
        // Perform one iteration of stochastic gradient descent (SGD) to update weights and bias.
        //echo "Training: <br />";
        $predicted = $this->feedForward($inputs);
        $error = $target - $predicted;
        
        // Update weights based on error and learning rate.
        for ($i = 0; $i < $this->inputSize; $i++) 
        {
            $this->weights[$i] += $this->learningRate * $error * $inputs[$i];
            //echo " weight: " . $this->weights[$i] . "<br />";
        }

        //echo "<br />"; 

        // Update bias based on error and learning rate.
        $this->bias += $this->learningRate * $error;
    }
}

// Example usage:
$neuron = new Neuron(2); // Neuron with 2 inputs.

// Training data: XOR gate inputs and corresponding outputs.
$trainingData = array(
    array(array(0, 0), 0),
    array(array(0, 1), 1),
    array(array(1, 0), 1),
    array(array(1, 1), 0)
);

// Training the neuron for 1000 epochs.
$epochs = 100;

for ($epoch = 0; $epoch < $epochs; $epoch++) {
    foreach ($trainingData as $data) {
        $neuron->train($data[0], $data[1]);
    }
}

// Testing the trained neuron:
$testData = array(
    array(0, 0),
    array(0, 1),
    array(1, 0),
    array(1, 1)
);

echo "Predicting:<br />";
foreach ($testData as $data) {
    $output = $neuron->feedForward($data);
}
*/