<?php

use common\domain\access\UserRole;
use common\models\Author;
use frontend\search\author\Validate;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var Validate $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Авторы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if (
        (new UserRole())
            ->isUser()
        ) {
            echo Html::a('Добавить автора', ['create'], ['class' => 'btn btn-success']);
        }
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'fio',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Author $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'visibleButtons' => [
                    'update' => (new UserRole)->isUser(),
                    'delete' => (new UserRole)->isUser(),
                ],
            ],
        ],
    ]); ?>


</div>
