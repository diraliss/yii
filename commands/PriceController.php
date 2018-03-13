<?php
/**
 * Created by PhpStorm.
 * User: diral
 * Date: 13.03.2018
 * Time: 16:36
 */

namespace app\commands;


use app\models\Product;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;

class PriceController extends Controller
{
    public $path = '@app/web/prices.csv';

    public function options($actionID)
    {
        return [
            'path',
        ];
    }

    public function optionAliases()
    {
        return [
            'p' => 'path',
        ];
    }


    public function actionIndex()
    {
        if (file_exists(Yii::getAlias($this->path))) {
            $csv = array_map('str_getcsv', file(Yii::getAlias($this->path)));
            Console::startProgress(0, count($csv));
            $num = 0;
            foreach ($csv as $data) {
                if ($product = Product::findOne($data[0])) {
                    $product->price = $data[1];
                    $product->save();
                }
                Console::updateProgress(++$num, count($csv));
            }
            Console::endProgress();

            return 0;
        } else {
            $this->stdout('File not found!', Console::BG_RED);

            return 1;
        }
    }
}