<?php
//require autoloader
require_once __DIR__ . '/vendor/autoload.php';


// Set error display and the type to be displayed.
ini_set('display_errors', true);

use App\controllers\entry;
use App\db\seeder;
//call app configurations
new App\config\config();

$klein= new \Klein\Klein();

$klein->respond('GET', '/?', function ($request, $response,$service){$service->render('app/views/home.phtml');});
$klein->respond('POST', '/entry',function ($request, $response,$service){
   new entry($service);
    //$service->render('app/views/login.phtml',array('error'=>$error));
});
$klein->respond('GET', '/write', function ($request, $response,$service){
   $service->render('app/views/write.phtml');});

$klein->dispatch();
?>
