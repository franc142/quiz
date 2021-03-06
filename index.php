<?php
ini_set('display_errors', true);
//require autoloader
require_once __DIR__ . '/vendor/autoload.php';


// Set error display and the type to be displayed.
ini_set('display_errors', true);

use App\controllers\entry;
use App\db\seeder;
use App\controllers\write;
use App\controllers\watch;
//call app configurations
new App\config\config();

$klein= new \Klein\Klein();

$klein->respond('GET', '/?', function ($request, $response,$service){$service->render('app/views/home.phtml');});
$klein->respond('POST', '/entry',function ($request, $response,$service){
   new entry($service);
    //$service->render('app/views/login.phtml',array('error'=>$error));
});
$klein->respond('GET','/write/[:course]',function($request, $response, $service){
   $write= new write;
   $result=$write->proceed($_SESSION['student_id'],$request->course);
   $service->render('app/views/write.phtml',array('result'=> $result,'course'=>$request->course));
});
$klein->respond('POST', '/write', function ($request, $response,$service){
   $write= new write();
   });
$klein->respond('GET','/watch/[:course]',function ($request, $response,$service){
   $watch = new watch();
   $result=$watch->get($request->course);
   $service->render('app/views/watch.phtml', array('result'=>$result,'course'=>$request->course));
});
$klein->respond('DELETE', '/watch/[:course]', function ($request, $response,$service){
   $watch = new watch();
   $watch->stopExam($request->course);
});
$klein->dispatch();
?>
