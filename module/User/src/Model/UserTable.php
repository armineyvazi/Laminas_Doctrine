<?php
namespace User\Model;

use User\Model\User;
use RuntimeException;
use Laminas\Crypt\Password\Bcrypt;
use Laminas\Db\TableGateway\TableGatewayInterface;

class UserTable
{
    protected $tableGateway;
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    public function fetchAll()
    {
        return $this->tableGateway->select();
    }
    public function getUser($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }
        return $row;
    }
    public function saveUser(User $user)
    {
        $bcrypt = new Bcrypt();
        $data = [
            'firstname' => $user->firstname,
            'lastname'  => $user->lastname,
            'email'=>$user->email,
            'password'=>$bcrypt->create($user->password),
        ];

        $id = (int) $user->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }
        try {
            $this->getUser($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update album with identifier %d; does not exist',
                $id
            ));
        }
        $this->tableGateway->update($data, ['id' => $id]);
    }
    public function deleteUser($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}