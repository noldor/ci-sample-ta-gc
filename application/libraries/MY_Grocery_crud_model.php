<?php

require_once APPPATH . 'third_party/grocery_crud/application/models/Grocery_crud_model.php';

class MY_Grocery_crud_model extends Grocery_crud_model
{
    public function __construct()
    {
        parent::__construct();
        $this->set_basic_table($this->get_table_name());
    }

    public function get_table_name()
    {
        return strtolower(substr(get_class($this), 0, strlen(get_class($this)) - 6));
    }
}
