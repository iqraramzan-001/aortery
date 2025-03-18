<?php

namespace App\Http\Services;

use App\Http\Interfaces\ProductInterface;
use App\Models\Category;
use App\Models\CompanyDocument;
use App\Models\Product;
use App\Models\UserDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\throwException;
use App\Enums\ProductClassification;

class ProductService implements ProductInterface
{


    public function __construct(Product $product)
    {
        $this->model = $product;

    }

    public function index(){

        $query=$this->model::with('images','supplier','category');

        $category=request()->query('category');

        if ($category) {
            $categoryId = Category::where('slug', $category)->first();
            if ($categoryId) {
                $query->whereHas('category', function ($query) use ($categoryId) {
                    $query->where('id', $categoryId->id); // Direct ID filter
                });
            }
        }





        return $query->paginate(9);
    }

    public function store($data)
    {
        try {

            DB::beginTransaction();
            $categoryId = $data['subsubcategory_id'] ?? $data['subcategory_id'] ?? $data['category_id'];
            $supplierId = getLoggedUserId();
            $files = $data['files'] ?? [];

            $product = $this->model->create([
                'name' => $data['name'],
                'sku' => $data['sku'],
                'supplier_id' => $supplierId,
                'category_id' => $data['category_id'] ?? null,
                'subcategory_id'=>$data['subcategory_id']?? null,
                'subsubcategory_id'=>$data['subsubcategory_id'] ?? null,
                'price' => $data['price'],
                'discount_price'=>$data['discount_price'],
                'manufacturer' => $data['manufacturer'],
                'classification' => $data['classification'],
                'warehouse_id'=>$data['warehouse_id'],
                'country' => $data['country'],
                'model_no' => $data['model_no'],
                'mdma_no' => $data['mdma_no'],
                'length' => $data['length'],
                'width' => $data['width'],
                'height' => $data['height'],
                'description' => $data['description'],
                'type' => $data['type'] ?? 'product',
            ]);

            foreach ($files as $file) {
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    \Log::info('Uploading file: ', ['file' => $file->getClientOriginalName()]);

                    $destinationPath = public_path('docs');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true); // Ensure directory exists
                    }

                    $fileName = $file->getClientOriginalName();
                    $file->move($destinationPath, $fileName);

                    $filePath = $fileName;
                    \Log::info('Saving file path:', ['path' => $filePath]);

                    DB::table('product_images')->insert([
                        'file' => $filePath,
                        'product_id' => $product->id,
                        'type'=>'internal',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            DB::commit();
            return $product;

        } catch (\Exception $e) {
            DB::rollBack();

            dd($e);
            throw new \Exception($e->getMessage());
        }
    }
    public function update($data, $id)
    {
        try {
            DB::beginTransaction();

            \Log::info("Received update data:", ['data' => $data, 'id' => $id]);

            $supplierId = getLoggedUserId();
            $files = $data['files'] ?? [];

            // Check if product exists
            $product = $this->model::find($id);
            if (!$product) {
                \Log::error("Product not found", ['id' => $id]);
                return response()->json(['error' => 'Product not found'], 404);
            }

            // Update product
            $isUpdated = $product->update([
                'name' => $data['name'],
                'sku' => $data['sku'],
                'supplier_id' => $supplierId,
                'category_id' => $data['category_id'] ?? null,
                'subcategory_id' => $data['subcategory_id'] ?? null,
                'subsubcategory_id' => $data['subsubcategory_id'] ?? null,
                'price' => (float) $data['price'],
                'discount_price' => $data['discount_price'] !== null ? (float) $data['discount_price'] : null,
                'manufacturer' => $data['manufacturer'],
                'classification' => $data['classification'],
                'warehouse_id' => $data['warehouse_id'],
                'country' => $data['country'],
                'model_no' => $data['model_no'],
                'mdma_no' => $data['mdma_no'],
                'length' => $data['length'],
                'width' => $data['width'],
                'height' => $data['height'],
                'description' => $data['description'],
                'type' => $data['type'] ?? 'product',
            ]);

            if (!$isUpdated) {
                \Log::error('Product update failed', ['id' => $id]);
                return response()->json(['error' => 'Product update failed'], 500);
            }
            if($files){
                foreach ($files as $file) {
                    if ($file instanceof \Illuminate\Http\UploadedFile) {
                        \Log::info('Uploading file: ', ['file' => $file->getClientOriginalName()]);

                        $destinationPath = public_path('docs');
                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 0777, true); // Ensure directory exists
                        }

                        $fileName = $file->getClientOriginalName();
                        $file->move($destinationPath, $fileName);

                        $filePath = $fileName;
                        \Log::info('Saving file path:', ['path' => $filePath]);

                        DB::table('product_images')->insert([
                            'file' => $filePath,
                            'product_id' => $id,
                            'type'=>'internal',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }

            // Commit transaction
            DB::commit();
            return response()->json(['message' => 'Product updated successfully', 'product' => $product], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Exception in updating product", ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



//    public function update($data, $id)
//    {
//        try {
//            DB::beginTransaction();
//            dd("Updated dataaaa........",$data, $id);
//
//            $supplierId = getLoggedUserId();
//            $files = $data['files'] ?? [];
//
//            $product = $this->model::where('id', $id)->update([
//                'name' => $data['name'],
//                'sku' => $data['sku'],
//                'supplier_id' => $supplierId,
//                'category_id' => $data['category_id'] ?? null,
//                'subcategory_id'=>$data['subcategory_id']?? null,
//                'subsubcategory_id'=>$data['subsubcategory_id'] ?? null,
//                'price' => $data['price'],
//                'discount_price'=>$data['discount_price'],
//                'manufacturer' => $data['manufacturer'],
//                'classification' => $data['classification'],
//                'warehouse_id'=>$data['warehouse_id'],
//                'country' => $data['country'],
//                'model_no' => $data['model_no'],
//                'mdma_no' => $data['mdma_no'],
//                'length' => $data['length'],
//                'width' => $data['width'],
//                'height' => $data['height'],
//                'description' => $data['description'],
//                'type' => $data['type'] ?? 'product',
//            ]);
//
//            foreach ($files as $file) {
//                if ($file instanceof \Illuminate\Http\UploadedFile) {
//                    \Log::info('Uploading file: ', ['file' => $file->getClientOriginalName()]);
//
//                    $destinationPath = public_path('docs');
//                    if (!file_exists($destinationPath)) {
//                        mkdir($destinationPath, 0777, true); // Ensure directory exists
//                    }
//
//                    $fileName = $file->getClientOriginalName();
//                    $file->move($destinationPath, $fileName);
//
//                    $filePath = $fileName;
//                    \Log::info('Saving file path:', ['path' => $filePath]);
//
//                    DB::table('product_images')->insert([
//                        'file' => $filePath,
//                        'product_id' => $id,
//                        'type'=>'internal',
//                        'created_at' => now(),
//                        'updated_at' => now(),
//                    ]);
//                }
//            }
//
//            return $product;
//
//        } catch (\Exception $e) {
//            DB::rollBack();
//            dd($e);
//            return throwException($e);
//        }
//    }

    public function show($id)
    {

        return $this->model::with('images','supplier','category','subCategory','subSubCategory','warehouse')->where('id',$id)->first();

    }

    public function delete($id){

         return $this->model->where('id',$id)->delete();


    }

    public function uploads($data){

        $files= $data['files'] ?? null;
        $image=$data['image'] ?? null;
         if($files){
            foreach ($files as $file) {
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    \Log::info('Uploading file: ', ['file' => $file->getClientOriginalName()]);

                    $destinationPath = public_path('docs');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true); // Ensure directory exists
                    }

                    $fileName = $file->getClientOriginalName();
                    $file->move($destinationPath, $fileName);

                    $filePath = $fileName;
                    \Log::info('Saving file path:', ['path' => $filePath]);

                    DB::table('product_images')->insert([
                        'file' => $filePath,
                        'product_id' =>$data['product_id'],
                        'type'=>'internal',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
        if ($image) {
            $imageLinks = explode('|', $image); // Split by "|"

            $insertData = [];
            foreach ($imageLinks as $link) {
                $trimmedLink = trim($link);

                if (!empty($trimmedLink)) {
                    $insertData[] = [
                        'file' => $trimmedLink,
                        'product_id' => $data['product_id'],
                        'type' => 'external',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
            if (!empty($insertData)) {
                DB::table('product_images')->insert($insertData);
            }
        }



    }


}
