<?php

declare(strict_types=1);

namespace frontend\search\book;

use common\models\Book;
use yii\data\ActiveDataProvider;
use yii\data\BaseDataProvider;

class Search
{
    public function __construct(
        private readonly Validate $validate,
        private readonly array $params,
    ) {
    }

    public function dataProvider(): BaseDataProvider
    {
        $query = Book::find()->with('authors');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->validate->load($this->params);

        if (!$this->validate->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->validate->id,
            'year_of_publication' => $this->validate->year_of_publication,
        ]);

        $query->andFilterWhere(['like', 'title', $this->validate->title])
            ->andFilterWhere(['like', 'description', $this->validate->description])
            ->andFilterWhere(['like', 'isbn', $this->validate->isbn]);

        return $dataProvider;
    }
}