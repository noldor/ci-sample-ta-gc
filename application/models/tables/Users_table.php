<?php

require_once APPPATH . 'libraries/MY_Grocery_crud_model.php';

class Users_table extends MY_Grocery_crud_model
{
    public function db_insert($post_array)
    {
        $ci = get_instance();
        if ($this->record_created_at) {
            $post_array['created_at'] = $this->clock->format('Y-m-d H:i:s');
        }
        if ($this->record_created_by) {
            $post_array['created_by'] = isset($ci->auth) ? $ci->auth->get_username() : '';
        }
        if ($this->record_updated_at) {
            $post_array['updated_at'] = $this->clock->format('Y-m-d H:i:s');
        }
        if ($this->record_updated_by) {
            $post_array['updated_by'] = isset($ci->auth) ? $ci->auth->get_username() : '';
        }

        return parent::db_insert($post_array);
    }

    public function db_update($post_array, $primary_key_value)
    {
        $ci = get_instance();
        if ($this->record_updated_at) {
            $post_array['updated_at'] = $this->clock->format('Y-m-d H:i:s');
        }
        if ($this->record_updated_by) {
            $post_array['updated_by'] = isset($ci->auth) ? $ci->auth->get_username() : '';
        }

        return parent::db_update($post_array, $primary_key_value);
    }
}
