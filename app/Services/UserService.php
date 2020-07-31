<?php

namespace App\Services;

use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\UserInformationRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;

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
                
                $this->userRepository->update([
                    'name' => $data['name'],
                ], Auth::user()->id);
                
                $this->userInformationRepository
                    ->updateOrCreate(
                        [
                            'user_id' => Auth::user()->id,
                        ],
                        [
                            'mobile' => $data['mobile'],
                            'gender' => $data['gender'],
                            'birthdate' => $data['birthdate'],
                            'address' => $data['address'],
                            'age' => $data['age']
                        ]
                    );
                
                return true;
            });
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

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

    public function getInformation()
    {
        return $this->userRepository->with(['information'])->find(Auth::user()->id);
    }
}
