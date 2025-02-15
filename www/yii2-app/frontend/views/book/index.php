<?php

use common\domain\access\UserRole;
use common\models\Author;
use common\models\Book;
use frontend\search\book\Validate;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var Validate $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Каталог книг';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if (
            (new UserRole())
                ->isUser()
        ) {
            echo Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']);
        }
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'title',
            'year_of_publication',
            'description:ntext',
            'isbn',
            [
                'attribute' => 'authors',
                'label' => 'Авторы',
                'value' => fn(Book $model) => implode(
                    ', ',
                    array_map(
                        fn(Author $author) => $author->fio,
                        $model->authors
                    )
                ),
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Book $model, $key, $index, $column) {
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
