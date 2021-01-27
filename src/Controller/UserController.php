<?php

namespace Php7Scafold\Controller;

use Php7Scafold\Controller\BaseController;
use Php7Scafold\Model\User;

class UserController extends BaseController
{
    public $allowed_fields = array("username", "password", "ip_address", "reg_date", "reg_time");

    public function login()
    {
        if (isset($this->body['username']) && isset($this->body['password'])) {
            $user = new User();
            $count = $user->login($this->body['username'], $this->body['password']);

            if ($count > 0) {
                echo json_encode(['success' => true]);
            } else {
                http_response_code(401);
                echo json_encode(['success' => false]);
            }
        } else {
            http_response_code(400);
            echo json_encode(['success' => false]);
        }
    }

    public function find()
    {
        $user = new User();

        echo json_encode($user->find($this->params));
    }

    public function findById()
    {
        $user = new User();

        echo json_encode($user->findById($this->params['id']));
    }

    public function update()
    {   
        if (empty($this->body) || empty($this->params['id'])) {
            http_response_code(400);
            echo json_encode(array('success' =>  false));
        }

        $user = new User();
        $succeed = $user->update($this->params['id'], $this->body);

        if (!$succeed) http_response_code(400);
        echo json_encode(array('success' =>  $succeed));
    }

    public function delete() {
        if (empty($this->params['id'])) {
            http_response_code(400);
            echo json_encode(array('success' =>  false));
        }

        $user = new User();
        $succeed = $user->delete($this->params['id'], $this->body);
        
        if (!$succeed) http_response_code(400);
        echo json_encode(array('success' =>  $succeed));
    }
}
