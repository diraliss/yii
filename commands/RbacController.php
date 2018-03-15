<?php
/**
 * Created by PhpStorm.
 * User: diral
 * Date: 15.03.2018
 * Time: 15:24
 */

namespace app\commands;


use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    /**
     * @throws \Exception
     */
    public function actionFixture()
    {
        $authManager = Yii::$app->authManager;
        if (empty($authManager) || !isset($authManager)) {
            return 1;
        }

        $admin = $authManager->createRole('admin');
        $manager = $authManager->createRole('manager');

        $createPerm = $authManager->createPermission('createProduct');
        $deletePerm = $authManager->createPermission('deleteProduct');

        $authManager->add($admin);
        $authManager->add($manager);
        $authManager->add($createPerm);
        $authManager->add($deletePerm);

        $authManager->addChild($admin, $createPerm);
        $authManager->addChild($admin, $deletePerm);

        $authManager->addChild($manager, $createPerm);

        $authManager->assign($admin, 12);
        $authManager->assign($manager, 13);

        return 0;
    }

}