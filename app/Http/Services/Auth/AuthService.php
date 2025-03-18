<?php

namespace App\Http\Services\Auth;

use App\Http\Interfaces\Auth\AuthInterface;

use App\Models\DeliveryLocation;
use App\Models\User;
use App\Models\Company;
use App\Models\Supplier;
use App\Models\Buyer;
use App\Models\WareHouse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use function PHPUnit\Framework\throwException;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthInterface{

    public function __construct(User $user, Company $company,Supplier $supplier,Buyer $buyer){
        $this->model = $user;
        $this->company=$company;
        $this->supplier=$supplier;
        $this->buyer=$buyer;
    }


    public function register($data)
    {
        try {
            DB::beginTransaction();

            $user = $this->model->create([
                'type' => $data['type'],
                'name' => $data['company_name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);


            $company = $this->company->create([
                'name' => $data['company_name'],
                 'user_id'=>$user->id,
                'registration_number' => $data['register_number'],
            ]);



            if ($user && $data['type'] === User::TYPE_SUPPLIER) {

                $supplier = $this->supplier->create([
                    'user_id' => $user->id,
                    'email' => $data['email'],
                ]);

                $warehouse=WareHouse::create([
                    'company_id'=>$company->id,
                ]);

            }

            if ($user && $data['type'] === User::TYPE_BUYER) {
               $buyer= $this->buyer->create([
                    'user_id' => $user->id,
                    'email' => $data['email'],
                ]);
               $location=DeliveryLocation::create([
                   'buyer_id'=>$buyer->id
               ]);

            }

            session(['auth_email' => $data['email']]);

            Auth::user($user);

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            return throwException($e);
        }
    }

}
