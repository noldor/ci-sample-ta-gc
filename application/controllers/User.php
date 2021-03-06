<?php

class User extends MY_Controller
{
    public function crud($action = null)
    {
        $validation_rules = array(
            ['field' => 'id',                     'label' => 'ID',                           'rules' => ''],
            ['field' => 'password_raw',           'label' => 'パスワード',                   'rules' => ''],
            ['field' => 'email',                  'label' => 'メールアドレス',               'rules' => 'trim|required'],
            ['field' => 'activated',              'label' => '有効状態',                     'rules' => 'in_list[0,1]|required'],
            ['field' => 'banned',                 'label' => 'banフラグ',                    'rules' => 'in_list[0,1]|required'],
            ['field' => 'ban_reason',             'label' => 'ban理由',                      'rules' => 'trim'],
            ['field' => 'new_password_key',       'label' => 'パスワード更新キー',           'rules' => 'trim'],
            ['field' => 'new_password_requested', 'label' => 'パスワード更新リクエスト日時', 'rules' => 'trim'],
            ['field' => 'new_email',              'label' => '更新中仮メールアドレス',       'rules' => 'trim'],
            ['field' => 'new_email_key',          'label' => 'メールアドレス更新キー',       'rules' => 'trim'],
            ['field' => 'last_ip',                'label' => '最終IPアドレス',               'rules' => 'trim'],
            ['field' => 'last_login',             'label' => '最終ログイン日時',             'rules' => ''],
            ['field' => 'created',                'label' => '作成日時',                     'rules' => ''],
            ['field' => 'modified',               'label' => '更新日時',                     'rules' => ''],
        );

        $this->load->model('tables/users_table');
        $this->crud->set_model('tables/users_table');
        $this->crud->set_table('users')
                   ->set_subject('ユーザ')
                   ->columns('id', 'email', 'activated', 'banned', 'last_login', 'created')
                   ->fields('password_raw', 'email', 'activated', 'banned', 'ban_reason', 'new_password_key',
                            'new_password_requested', 'new_email', 'new_email_key', 'last_ip', 'last_login',
                            'created', 'modified')
                   ->field_type('password_raw', 'password')
                   ->field_type('ban_reason', 'text')
                   ->unset_texteditor('ban_reason')
                   ->field_type('last_ip', 'readonly')
                   ->field_type('last_login', 'readonly')
                   ->field_type('created', 'readonly')
                   ->field_type('modified', 'readonly')
                   ;
        foreach ($validation_rules as $rule) {
            $this->crud->display_as($rule['field'], $rule['label']);
        }
        $this->crud->set_rules($validation_rules);

        // 新規作成時のみパスワードを必須にする
        if ($action == 'insert_validation' || $action == 'insert') {
            $this->crud->set_rules('password_raw', 'パスワード', 'required');
        }

        $this->load->view('user/crud.php', $this->crud->render());
    }
}
