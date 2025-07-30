<?php

namespace App\Http\Requests;

class PromoCatalogRequest extends CatalogRequest {

    /**
     * С какой сущностью сейчас работаем (товар каталога)
     * @var array
     */
    protected $entity = [
        'name' => 'product',
        'table' => 'promos'
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return parent::authorize();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return parent::rules();
    }

    /**
     * Объединяет дефолтные правила и правила, специфичные для товара
     * для проверки данных при добавлении нового товара
     */
    protected function createItem() {
        return array_merge(parent::createItem());
    }

    /**
     * Объединяет дефолтные правила и правила, специфичные для товара
     * для проверки данных при обновлении существующего товара
     */
    protected function updateItem() {
        return array_merge(parent::updateItem());
    }
}
