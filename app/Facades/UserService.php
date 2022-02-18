<?php

namespace App\Facades;

use App\Helper;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->helper = new Helper();
    }

    public function insertDefaultUser()
    {
        $formInput = [
            'role_id' => 1,
            'status_id' => 2,
            'username' => 'admin',
            'password' => Hash::make('12345', ['rounds' => 10]),
            'name' => 'Administrator',
            'phone_number' => '088976685446',
            'email' => null,
            'address' => null,
            'image' => null,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $this->userRepository->insert($formInput);
    }

    public function getAllWithoutUserLogin($username)
    {
        return $this->userRepository->getAll()->where('users.username', '!=', $username)->get();;
    }

    public function getOne(String $username = "")
    {
        $params = [ 'username' => $username ];
        return $this->userRepository->get($params)->first();
    }

    public function insert()
    {
        $data = [
            'role_id' => request()->input('role'),
            'status_id' => 2,
            'username' => request()->input('username'),
            'password' => Hash::make(request()->input('password'), ['rounds' => 10]),
            'name' => request()->input('name'),
            'phone_number' => request()->input('phone_number'),
            'email' => request()->input('email'),
            'address' => request()->input('address'),
            'created_at' => now(),
            'updated_at' => now()
        ];

        // Kalau ada gambar yang di-upload
        if (request()->image) {
            $data['image'] = $this->helper->createImageName();
            $this->helper->uploadFile($data['image']);
        }

        $this->userRepository->insert($data);
    }

    public function update(String $username = "", $user)
    {
        $params = [ 'username' => $username ];
        $update = [
            'role_id' => request()->input('role_id') != null ? request()->input('role_id') : $user->role_id,
            'username' => request()->input('username') != null ? request()->input('username') : $user->username,
            'name' => request()->input('name') != null ? request()->input('name') : $user->name,
            'phone_number' => request()->input('phone_number') != null ? request()->input('phone_number') : $user->phone_number,
            'email' => request()->input('email') != null ? request()->input('email') : $user->email,
            'address' => request()->input('address') != null ? request()->input('address') : $user->address,
            'updated_at' => now()
        ];

        // Kalau ada gambar yang di-upload
        if (request()->image) {
            $update['image'] = $this->helper->createImageName();
            $this->helper->uploadFile($update['image']);
        }

        $this->userRepository->update($params, $update);
    }

    public function updatePassword(String $username = "")
    {
        $params = [ 'username' => $username ];
        $update = [
            'password' => Hash::make(request()->input('password'), ['rounds' => 10]),
            'updated_at' => now()
        ];

        $this->userRepository->update($params, $update);
    }

    public function changeStatus($username, $statusId)
    {
        $params = [ 'username' => $username ];
        $update = [ 'status_id' => $statusId ];
        $this->userRepository->update($params, $update);
    }

    public function delete($username)
    {
        $params = [ 'username' => $username ];
        $this->userRepository->delete($params);
    }
}