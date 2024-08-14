<?php

declare(strict_types=1);

namespace common\domain\access;

use common\domain\dictionary\UserType;
use Yii;
use yii\web\ForbiddenHttpException;

class UserRole
{
    /**
     * @throws ForbiddenHttpException
     */
    public function isUser(): bool
    {
        if (Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException();
        }

        return Yii::$app->user->identity->type === UserType::user->name;
    }
}