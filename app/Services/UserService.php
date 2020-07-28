<?php

namespace App\Services;

use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\UserInformationRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{

    /** @var $userRepository */
    protected $userRepository;
    
    /** @var $userInformationRepository */
    protected $userInformationRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     * @param UserInformationRepository $userInformationRepository
     */
    public function __construct(
        UserRepository $userRepository,
        UserInformationRepository $userInformationRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userInformationRepository = $userInformationRepository;
    }

    /**
     * create user
     *
     * @param $data
     * @throws \Exception
     */
    public function create($data)
    {
        $data['password'] = Hash::make($data['password']);
                
        $this->userRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    public function update($data)
    {
        try {
            return DB::transaction(function () use ($data) {
                
                $id = $data['id'];

                $user = [
                    'name' => $data['name'],
                    'email' => $data['email'],
                ]; 

                $this->userRepository->update($user, $id);

                $detail = $this->userInformationRepository->where('user_id', $id)->first();
                $detail->update([
                    'mobile' => $data['mobile'],
                    'gender' => $data['gender'],
                    'birthdate' => $data['birthdate'],
                    'address' => $data['address'],
                    'age' => $data['age']
                ]);
            });
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param $email
     * @param $password
     * @return mixed|null
     */
    public function userLogin($email, $password)
    {
        $user = $this->userRepository
                    ->where('email', $email)
                    ->first();
        
        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }

        return null;
    }
}
