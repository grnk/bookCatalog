<?php

declare(strict_types=1);

namespace frontend\search\author;

use yii\base\Model;

class Validate extends Model
{
    public string $id = '';
    public string $fio = '';

    public function rules(): array
    {
        return [
            [['id', 'fio'], 'trim'],
            [['id'], 'integer'],
            [['fio'], 'string'],
        ];
    }
}
