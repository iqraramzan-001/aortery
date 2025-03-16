<?php

namespace App\Http\Services;

use App\Http\Interfaces\BuyerInterface;
use App\Http\Interfaces\SupplierInterface;

use App\Models\Buyer;
use App\Models\Company;
use App\Models\CompanyDocument;
use App\Models\UserDocument;
use App\Models\WareHouse;
use App\Traits\FileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\throwException;

class BuyerService implements BuyerInterface
{
    use FileUploads;

    public function __construct(Buyer $buyer,Company $company){
        $this->model = $buyer;
        $this->company=$company;

    }
    public function profile(array $data)
    {
        try {
            DB::beginTransaction();
            $id = Auth::id();
            $letter = $data['letters'] ?? [];
            $register = $data['register_doc'] ?? [];
            $certificate = $data['certificate'] ?? [];

            $this->company->where('user_id', $id)->update([
                'address' => $data['address'],
                'registration_number' => $data['register_number'],
                'name' => $data['name'],
                'unified_number' => $data['unified_number'],
                'vat_number' => $data['vat_number'],
                'reg_expire_date' => date('Y-m-d', strtotime($data['reg_expire_date'])),

            ]);
            $company = $this->company->where('user_id',$id)->first();

            $warehouse=WareHouse::create([
                'company_id'=>$company->id,
                'name'=>$data['house_name'],
                'location'=>$data['location'],
                'open_from'=>$data['open_from'],
                'open_to'=>$data['open_to']
            ]);

            $this->model->where('user_id', $id)->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
//                'email' => $data['email'],
                'phone' => $data['phone']
            ]);
            $buyer = $this->model->where('user_id',$id)->first();


            if ($letter) {
                $this->saveFile($letter, new UserDocument());
            }

            if ($register) {
                $this->saveFile($register, new CompanyDocument(), $company->id, 'registration');
            }

            if ($certificate) {
                $this->saveFile($certificate, new CompanyDocument(), $company->id, 'certificate');
            }

            DB::commit();
            return $buyer;

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return throwException($e);
        }
    }
}
