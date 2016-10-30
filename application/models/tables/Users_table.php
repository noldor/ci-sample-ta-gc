<?php

require_once APPPATH . 'libraries/MY_Grocery_crud_model.php';

class Users_table extends MY_Grocery_crud_model
{
    public function db_insert($post_array)
    {
        $post_array['created'] = $this->clock->format('Y-m-d H:i:s');
        $post_array['modified'] = $this->clock->format('Y-m-d H:i:s');

        $post_array['password'] = $this->hash_password($post_array['password_raw']);
        unset($post_array['password_raw']);

        return parent::db_insert($post_array);
    }

    public function db_update($post_array, $primary_key_value)
    {
        $post_array['modified'] = $this->clock->format('Y-m-d H:i:s');

        if (strlen($post_array['password_raw']) > 0) {
            $post_array['password'] = $this->hash_password($post_array['password_raw']);
        }
        unset($post_array['password_raw']);

        return parent::db_update($post_array, $primary_key_value);
    }

    private function hash_password($password)
    {
        $hasher = new PasswordHash(
                $this->config->item('phpass_hash_strength', 'tank_auth'),
                $this->config->item('phpass_hash_portable', 'tank_auth'));
        return $hasher->HashPassword($password);
   }
}
