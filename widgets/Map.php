<?php
/**
 * Created by PhpStorm.
 * User: diral
 * Date: 01.03.2018
 * Time: 15:56
 */

namespace app\widgets;


class Map extends \yii\bootstrap\Widget
{
    public $latitude = '39.9473463';
    public $longitude = '57.6578903';
    public $width = 400;
    public $height = 400;
    public $allowfullscreen = true;

    public function run()
    {
        return $this->render('map', [
            'allowfullscreen' => $this->allowfullscreen,
            'latitude' => $this->latitude,
            'width' => $this->width,
            'longitude' => $this->longitude,
            'height' => $this->height
        ]);
    }
}