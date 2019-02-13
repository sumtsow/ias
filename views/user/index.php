<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->registerCssFile('https://use.fontawesome.com/releases/v5.5.0/css/all.css', [
    'integrity' => 'sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU',
    'crossorigin' => 'anonymous',
    'rel' => 'stylesheet',
    ]);
$this->title = 'Users List';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
?>

<div class="table-responsive">
<table class="table table-striped">
    <thead class="thead text-center">
        <tr>
            <th colspan="3" scope="col">action</th>       
            <th scope="col">id</th>
            <th scope="col">lastname</th>
            <th scope="col">firstname</th>
            <th scope="col">email</th>
            <th scope="col">role</th>
            <th scope="col">password</th>
            <th scope="col">enabled</th>
            <th scope="col">auth_key</th>
            <th scope="col">access_token</th>
            <th scope="col">created_at</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
        <tr>
            <td><a href="<?= Url::to(['/user/'.$user->id]); ?>" class="badge" title="View"><span class="fa fa-eye"></span></a></td>
            <td><a href="<?= Url::to(['/user/update', 'id' => $user->id]); ?>" class="badge" title="Edit"><span class="fa fa-edit"></span></a></td>
            <td><a href="<?= Url::to(['/user/delete', 'id' => $user->id]); ?>" class="badge" title="Delete"><span class="fa fa-trash-alt"></span></a></td>
            <td><?= $user->id; ?></td>
            <td><?= $user->lastname; ?></td>
            <td><?= $user->firstname; ?></td>
            <td><?= $user->email; ?></td>
            <td><?php $form = ActiveForm::begin([
                'id' => 'userRole-form',
                'action' => '/user/role?id='.$user->id,
                'options' => [
                    'class' => 'form'.(($user->role === 'admin') ? ' text-danger' : null),
                    ],
            ]); ?>
            <?= $form->field($user, 'role')
                    ->checkbox([
                        'onChange' => 'this.form.submit();',
                        'checked' => ($user->role === 'admin') ? 'checked' : null,                        
                        'label' => ($user->role === 'admin') ? 'admin' : 'user',
                    ]); ?>
            <?php ActiveForm::end(); ?></td>
            <td><?= ($user->password) ? 'set' : 'empty' ?></td>
            <td><?php $form = ActiveForm::begin([
                'id' => 'userSwitch-form',
                'action' => '/user/switch?id='.$user->id,
                'options' => [
                    'class' => 'form',
                    ],
            ]); ?>
            <?= $form->field($user, 'enabled')
                    ->checkbox([
                        'onChange' => 'this.form.submit();',
                        'label'=> ($user->enabled) ? 'true' : 'false',
                    ]); ?>
            <?php ActiveForm::end(); ?></td>
            <td><?= ($user->auth_key) ? 'set' : 'empty' ?></td>
            <td><?= ($user->access_token) ? 'set' : 'empty' ?></td>
            <td><?= $user->created_at; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<a class="btn btn-primary" href="/user/create">Create New User</a>