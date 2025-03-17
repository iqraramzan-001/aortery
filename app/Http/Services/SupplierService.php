<?php

namespace App\Http\Services;

use App\Http\Interfaces\SupplierInterface;
use App\Models\CompanyDocument;
use App\Models\Supplier;
use App\Models\Company;
use App\Models\UserDocument;
use App\Models\WareHouse;
use App\Traits\FileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\throwException;
use App\Models\Product;

class SupplierService implements SupplierInterface
{
    use FileUploads;

    public function __construct(Supplier $supplier, Company $company){
        $this->model = $supplier;
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
                'registration_number' => $data['register_number'],
                'name' => $data['name'],
                'unified_number' => $data['unified_number'],
                'vat_number' => $data['vat_number'],
                'reg_expire_date' => date('Y-m-d', strtotime($data['reg_expire_date'])),
                'address' => $data['address'],
            ]);
            $company = $this->company->where('user_id',$id)->first();

            $warehouses = json_decode($data['warehouses'], true);

            if($warehouses){
                WareHouse::where('company_id',$company->id)->delete();
            }

            foreach ($warehouses as $warehouse) {
                Warehouse::create([
                    'name' => $warehouse['name'],
                    'company_id'=>$company->id,
                    'location' => $warehouse['location'],
                    'latitude' => $warehouse['latitude'],
                    'longitude' => $warehouse['longitude'],
                    'open_from' => $warehouse['open_from'],
                    'open_to' => $warehouse['open_to']
                ]);
            }



            $this->model->where('user_id', $id)->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
//                'email' => $data['email'],
                'phone' => $data['phone']
            ]);
            $supplier = $this->model->where('user_id',$id)->first();


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
            return $supplier;

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return throwException($e);
        }
    }

    public function products()
    {
        $userId=getLoggedUserId();
        $products=Product::with('category')->where('supplier_id',$userId)->paginate(10);
        return $products;

    }


}
