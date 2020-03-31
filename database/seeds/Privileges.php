<?php

class Privileges {

    var $privileges;

    var $admin_priv = [
        ['role_id' => 1,'priv' => 'create'],
        ['role_id' => 1,'priv' => 'read'],
        ['role_id' => 1,'priv' => 'update'],
        ['role_id' => 1,'priv' => 'delete'],
    ];
    var $user_priv = [
        ['role_id' => 2,'priv' => 'read'],
        ['role_id' => 2,'priv' => 'update'],
    ];

    public function get_privileges() {
        $this->privileges = [
            'admin_priv' => $this->admin_priv,
            'user_priv' => $this->user_priv,
        ];
        return $this->privileges;
    }
}

