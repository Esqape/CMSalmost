<?php

use yii\db\Migration;

/**
 * Class m181230_182712_make_roles
 */
class m181230_182712_make_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // add "createUser" permission
        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Create a user';
        $auth->add($createUser);

        // add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // add "deletetePost" permission
        $deletePost = $auth->createPermission('deletePost');
        $deletePost->description = 'Delete a post';
        $auth->add($deletePost);

        // add "creator" role and give this role the "createPost" permission
        $creator = $auth->createRole('contentCreator');
        $auth->add($creator);
        $auth->addChild($creator, $createPost);

        // add "admin" role and give this role the "updatePost" permission,
        //"deletePost" permission
        // as well as the permissions of the "creator" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $deletePost);
        $auth->addChild($admin, $creator);

        // add "superAdmin" role and give this role the "createUser" permission
        // as well as the permissions of the "admin" role
        $superAdmin = $auth->createRole('superAdmin');
        $auth->add($superAdmin);
        $auth->addChild($superAdmin, $createUser);
        $auth->addChild($superAdmin, $admin);

         // add the rule
         $rule = new \app\rbac\AuthorRule;
         $auth->add($rule);
 
         // add the "updateOwnPost" permission and associate the rule with it.
         $updateOwnPost = $auth->createPermission('updateOwnPost');
         $updateOwnPost->description = 'Update own post';
         $updateOwnPost->ruleName = $rule->name;
         $auth->add($updateOwnPost);
 
         // "updateOwnPost" will be used from "updatePost"
         $auth->addChild($updateOwnPost, $updatePost);
 
         // allow "creator" to update their own posts
         $auth->addChild($creator, $updateOwnPost);
 
         // add the "deleteOwnPost" permission and associate the rule with it.
         $deleteOwnPost = $auth->createPermission('deleteOwnPost');
         $deletePost->description = 'Delete own post';
         $deleteOwnPost->ruleName = $rule->name;
         $auth->add($deleteOwnPost);
 
         // "deleteOwnPost" will be used from "deletePost"
         $auth->addChild($deleteOwnPost, $deletePost);
 
         // allow "creator" to delete their own posts
         $auth->addChild($creator, $deleteOwnPost);
 

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        // assign superadmin to user 1
        //$auth->assign($author, 2);
        $auth->assign($superAdmin, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181230_180426_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}