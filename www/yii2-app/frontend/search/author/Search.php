<?php

declare(strict_types=1);

namespace frontend\search\author;

use common\models\Author;
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
        $query = Author::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->validate->load($this->params);

        if (!$this->validate->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->validate->id,
        ]);

        $query->andFilterWhere(['like', 'fio', $this->validate->fio]);

        return $dataProvider;
    }
}
