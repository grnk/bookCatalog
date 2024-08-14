<?php

declare(strict_types=1);

namespace frontend\search\book;

use yii\base\Model;

class Validate extends Model
{
    public string $id = '';
    public string $title = '';
    public string $year_of_publication = '';
    public string $description = '';
    public string $isbn = '';

    public function rules(): array
    {
        return [
            [['id', 'title', 'year_of_publication', 'description', 'isbn'], 'trim'],
            [['id', 'year_of_publication'], 'integer'],
            [['title', 'description', 'isbn'], 'string'],
        ];
    }
}
