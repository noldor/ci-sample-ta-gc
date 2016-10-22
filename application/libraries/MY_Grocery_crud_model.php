<?php

require_once APPPATH . 'third_party/grocery_crud/application/models/Grocery_crud_model.php';

class MY_Grocery_crud_model extends Grocery_crud_model
{
    protected $record_created_at = true;
    protected $record_updated_at = true;
    protected $record_created_by = true;
    protected $record_updated_by = true;

    public function __construct()
    {
        parent::__construct();
        $this->set_basic_table($this->get_table_name());
    }

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

    public function get_rows($where = array())
    {
        return $this->db->where($where)->order_by('id ASC')->get($this->get_table_name())->result();
    }

    public function retrieve_by($where = array())
    {
        return $this->db->where($where)->get($this->get_table_name())->row();
    }

    public function retrieve_by_id($id)
    {
        return $this->retrieve_by(['id' => $id]);
    }

    public function get_table_name()
    {
        return strtolower(substr(get_class($this), 0, strlen(get_class($this)) - 6));
    }
}
