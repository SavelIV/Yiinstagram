<?php

use yii\db\Migration;
use backend\models\User;

/**
 * Class m201204_194607_create_rbac_data
 */
class m201204_194607_create_rbac_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // Define permissions

        $viewComplaintsListPermission = $auth->createPermission('viewComplaintsList');
        $auth->add($viewComplaintsListPermission);

        $viewPostPermission = $auth->createPermission('viewPost');
        $auth->add($viewPostPermission);

        $deletePostPermission = $auth->createPermission('deletePost');
        $auth->add($deletePostPermission);

        $approvePostPermission = $auth->createPermission('approvePost');
        $auth->add($approvePostPermission);

        $viewUsersListPermission = $auth->createPermission('viewUsersList');
        $auth->add($viewUsersListPermission);

        $viewUserPermission = $auth->createPermission('viewUser');
        $auth->add($viewUserPermission);

        $deleteUserPermission = $auth->createPermission('deleteUser');
        $auth->add($deleteUserPermission);

        $updateUserPermission = $auth->createPermission('updateUser');
        $auth->add($updateUserPermission);

        // Define roles

        $moderatorRole = $auth->createRole('Moderator');
        $auth->add($moderatorRole);

        $adminRole = $auth->createRole('Admin');
        $auth->add($adminRole);

        // Define roles - permissions relations

        $auth->addChild($moderatorRole, $viewComplaintsListPermission);
        $auth->addChild($moderatorRole, $viewPostPermission);
        $auth->addChild($moderatorRole, $deletePostPermission);
        $auth->addChild($moderatorRole, $approvePostPermission);
        $auth->addChild($moderatorRole, $viewUsersListPermission);
        $auth->addChild($moderatorRole, $viewUserPermission);

        $auth->addChild($adminRole, $moderatorRole);
        $auth->addChild($adminRole, $deleteUserPermission);
        $auth->addChild($adminRole, $updateUserPermission);

        // Create admin user
        $user = new User([
            'email' => 'admin@admin.com',
            'username' => 'Admin',
            'password_hash' => '$2y$13$OVSGm2OE2GBnTVSIkGsRC.zmIjHy6hRaQVL0yQSZouZabKOlSYY9q',
        ]);
        $user->generateAuthKey();
        $user->save();

        // Add admin role to user
        $auth->assign($adminRole, $user->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m171021_141923_create_rbac_data cannot be reverted.\n";

        return false;
    }

}
