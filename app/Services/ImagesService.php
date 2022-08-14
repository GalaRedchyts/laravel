<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class ImagesService implements Contracts\ImagesServiceContract
{
    //метод либо выведет сообщение об ошибке либо загрузит картинку
    public static function attach(Model $model, string $methodName, array $images = [])
    {
        // если метод не существует, то мы выводим сообщение об ошибке
        if (!method_exists($model, $methodName)) {
            throw new \Exception($model::class . " doesn't have {$methodName}");
        }

        //проверяем есть ли у нас картинки, после проганяем их форичем
        if (!empty($images)) {
            foreach ($images as $image) {
              call_user_func([$model, $methodName])->create(['path' => $image]);
            }
        }
    }
}
