<?php
namespace App\controllers;
use eftec\bladeone\BladeOne;
class BaseController{
    protected function render($viewFile, $data = []){
        $viewDir = "./app/views";
        $storageDir = "./storage";
        $blade = new BladeOne($viewDir,$storageDir, BladeOne::MODE_DEBUG);
        echo $blade->run($viewFile, $data);
    }
}
?>
