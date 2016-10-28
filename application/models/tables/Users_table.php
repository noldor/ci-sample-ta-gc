<?php

require_once APPPATH . 'libraries/MY_Grocery_crud_model.php';

class Users_table extends MY_Grocery_crud_model
{
    protected $record_created_at = false;
    protected $record_updated_at = false;
    protected $record_created_by = false;
    protected $record_updated_by = false;
}
