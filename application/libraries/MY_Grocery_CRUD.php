<?php

require_once APPPATH . 'third_party/grocery_crud/application/libraries/Grocery_CRUD.php';

class MY_Grocery_CRUD extends Grocery_CRUD
{
    /**
     * groceryCRUD 不具合回避用メソッド。
     *
     * set_relation()とcallbackを同時に設定できない不具合があるため、内部コード名を取得する。
     *
     * @see: http://www.grocerycrud.com/forums/topic/254-set-relation-breaks-processing-of-field-with-same-name-returned/#entry982
     */
    public function unique_field_name($field_name)
    {
        return $this->_unique_field_name($field_name);
    }
}
