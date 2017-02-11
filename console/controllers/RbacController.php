<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use console\rbac\UserGroupRule;
class RbacController extends Controller
{
    public function actionInit()
    {
        $authManager = \Yii::$app->authManager;

        // Create roles
        $guest  = $authManager->createRole('guest');
        $user  = $authManager->createRole('user');
        $admin  = $authManager->createRole('admin');

        // Create simple, based on action{$NAME} permissions
        $login  = $authManager->createPermission('login');
        $logout = $authManager->createPermission('logout');
        $error  = $authManager->createPermission('error');
        $signUp = $authManager->createPermission('sign-up');
        $index  = $authManager->createPermission('index');
        $view   = $authManager->createPermission('view');
        $update = $authManager->createPermission('update');
        $delete = $authManager->createPermission('delete');

        $calendarC = $authManager->createPermission('calendar/*');
        $siteC = $authManager->createPermission('site/*');
        $courseC = $authManager->createPermission('course/*');
        $taskC = $authManager->createPermission('task/*');
        $userC = $authManager->createPermission('user/*');
        // Add permissions in Yii::$app->authManager
        $authManager->add($login);
        $authManager->add($logout);
        $authManager->add($error);
        $authManager->add($signUp);
        $authManager->add($index);
        $authManager->add($view);
        $authManager->add($update);
        $authManager->add($delete);
        $authManager->add($calendarC);
        $authManager->add($siteC);
        $authManager->add($courseC);
        $authManager->add($taskC);
        $authManager->add($userC);


        // Add rule, based on UserExt->group === $user->group
        $userGroupRule = new UserGroupRule();
        $authManager->add($userGroupRule);

        // Add rule "UserGroupRule" in roles
        $guest->ruleName  = $userGroupRule->name;
        $user->ruleName  = $userGroupRule->name;
        $admin->ruleName  = $userGroupRule->name;

        // Add roles in Yii::$app->authManager
        $authManager->add($guest);
        $authManager->add($user);
        $authManager->add($admin);

        // Add permission-per-role in Yii::$app->authManager
        // Guest
        $authManager->addChild($guest, $login);
        $authManager->addChild($guest, $error);

        // User
        $authManager->addChild($user, $update);
        $authManager->addChild($user, $logout);
        $authManager->addChild($user, $signUp);
        $authManager->addChild($user, $index);
        $authManager->addChild($user, $view);
        $authManager->addChild($user, $guest);
        $authManager->addChild($user, $calendarC);
        $authManager->addChild($user, $siteC);
        $authManager->addChild($user, $courseC);
        $authManager->addChild($user, $taskC);
        $authManager->addChild($user, $userC);

        // Admin
        $authManager->addChild($admin, $delete);
        $authManager->addChild($admin, $user);

    }
}