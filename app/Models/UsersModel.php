<?php
namespace App\Models;

use App\Models\BaseModel;

class UsersModel extends BaseModel {
    protected $table = 'users';
    protected $allowedFields = [
        'voorletter',
        'tussenvoegsel',
        'achternaam',
        'land',
        'postcode',
        'huisnr',
        'straat',
        'woonplaats',
        'tel',
        'skype',
        'btw',
        'bedrijfsnaam',
        'email',
        'pass',
        'rights',
        'saldo',
        'voorwaarden',
        'nieuwsbrief',
        'btw_per',
        'btw_status'
    ];

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data) {
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function beforeUpdate(array $data) {
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function passwordHash(array $data) {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}