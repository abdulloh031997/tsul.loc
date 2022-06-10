<?php
namespace app\widgets;
use yii\base\Widget;

class Navbar extends Widget{

    public function run(){
        return $this->render('navbar');
    }
}