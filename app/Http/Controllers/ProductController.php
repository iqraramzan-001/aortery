<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Auth\AuthInterface;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\WareHouse;
use Illuminate\Http\Request;
use App\Http\Interfaces\ProductInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{

    protected $product;
    public function __construct(ProductInterface $product){
        $this->product = $product;
    }

    public function index()
    {
        $products=$this->product->index();

        $categories=Category::where('parent_id',null)->get();
        $category=request()->query('category');

        if ($category) {
            $categoryId = Category::where('slug', $category)->first();
            $productCategory = Category::where('parent_id', $categoryId->id)->limit(12)->get();
        }
        else{
            $productCategory=Category::whereHas('products')->limit(12)->get();
        }

            return view('product.index',compact('products','categories','productCategory'));
    }

     public function create(){

        $category=Category::where('parent_id',null)->get();
        $company=Auth::user()->supplier->company->id;

         $warehouse=WareHouse::where('company_id',$company)->get();
        return view('product.create',compact('category','warehouse'));

     }
      public function store(ProductRequest $request){

        $product=$this->product->store($request->all());
        if($product){
            return redirect()->route('supplier.product');
        }
        return redirect()->back();

      }

       public function edit($id){
           $product=$this->product->show($id);
           if($product){
               $company=Auth::user()->supplier->company->id;
               $category=Category::where('parent_id',null)->get();
               $warehouse=WareHouse::where('company_id',$company)->get();
               return view('product.edit', compact('product','warehouse','category'));
           }

       }

       public function update(Request $request, $id){

        $product=$this->product->update($request->all(), $id);
        if($product){
            return redirect()->route("supplier.product");
        }

       }

       public function show($id){

           $product=$this->product->show($id);
           $productCategory=Category::whereHas('products')->get();

           return view('product.detail',compact('product','productCategory'));

       }

       public function delete($id){

        $product=$this->product->delete($id);
        if($product){
            return response()->json(['message' => 'Product Deleted  Successfully'], 200);
        }


       }
    public function getSubCategories($parent_id)
    {
        $subcategories = Category::where('parent_id', $parent_id)->get();
        return response()->json($subcategories);
    }

    public function uploads(Request $request){

        $result=$this->product->uploads($request->all());
        if($result){
            return response()->json("success" ,"IMage Uploaded Successfully");
        }

    }

    public function downloadCSV()
    {
        $csvFileName = 'products.csv';
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');


            fputcsv($file, ['Sku', 'Name', 'Category','SubCategory','SubSubCategory',  'Product Price',"Product Discount","Product Model","Product MDMA","Product Images","Warehouse", "Product Length", "Product Height", "Product Width","Manufacturer", "Country","Product Description",'Classification']);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function uploadCSV(Request $request)
    {

        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);


        $file = fopen($request->file('csv_file')->getPathname(), 'r');


        fgetcsv($file);
        $supplierId = getLoggedUserId();

        while (($row = fgetcsv($file)) !== false) {

            $category=$this->getCategoryId($row[2]);
            $subcategory=$this->getCategoryId($row[3]);
            $subsubcategory=$this->getCategoryId($row[4]);
            $house=$this->getWareHouseId($row[10]);

            $product = Product::create([
                'sku'                 => $row[0],
                'name'                => $row[1],
                'supplier_id' => $supplierId,
                'category_id'         => $category,
                'subcategory_id'     => $subcategory,
                'subsubcategory_id' => $subsubcategory,
                'price'               => $row[5],
                'discount_price'            => $row[6],
                'model_no'               => $row[7],
                'mdma_no'                => $row[8],
                'warehouse_id'           =>$house,
                'length'              => $row[11],
                'height'              => $row[12],
                'width'               => $row[13],
                'manufacturer'        => $row[14],
                'country'             => $row[15],
                'description'          =>$row[16],
                'classification'       =>$row[17],
            ]);


            $images = explode('|', $row[9]);

            foreach ($images as $image) {
                ProductImage::create([
                    'file'        => trim($image), // Trim space
                    'product_id'  => $product->id,
                    'type'        => 'external',
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }

        fclose($file);
        return response()->json(['message' => 'CSV uploaded successfully'], 200); // ✅ CORRECT

    }


    private function getCategoryId($name)
    {
         $category=Category::where('name', $name)->value('id') ?? null;
        return $category;
    }
    private function getWareHouseId($name){
        $house=WareHouse::where('name')->value('id') ?? null;
        return $house;
    }
    public function filter(Request $request)
    {
        $userId = getLoggedUserId();
        $query = Product::with('category')->where('supplier_id', $userId);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('sku', 'like', "%{$request->search}%");
            });
        }

        // Sorting
        if (!empty($request->sort)) {
            switch ($request->sort) {
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'price_low_high':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high_low':
                    $query->orderBy('price', 'desc');
                    break;
            }
        }

        $products = $query->paginate(50);

        return response()->json([
            'status' => 'success',
            'html' => view('supplier.partials.product_table', compact('products'))->render()
        ]);
    }

    public function search(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                    ->orWhere('description', 'LIKE', "%$search%");
            });
        }

        if ($request->has('filter')) {
            $filter = $request->filter;
            if ($filter == 'oldest') {
                $query->orderBy('created_at', 'asc');
            } elseif ($filter == 'latest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($filter == 'price_low_high') {
                $query->orderBy('price', 'asc');
            } elseif ($filter == 'price_high_low') {
                $query->orderBy('price', 'desc');
            }
        }
        if ($request->has('min_price') && $request->has('max_price')) {
            $minPrice = (float) $request->min_price;
            $maxPrice = (float) $request->max_price;

            $query->whereNotNull('price')
                ->whereBetween('price', [$minPrice, $maxPrice]);


//            dd([
//                'Min Price' => $minPrice,
//                'Max Price' => $maxPrice,
//                'SQL Query' => $query->toSql(),
//                'Bindings' => $query->getBindings(),
//                'Results' => $query->get(),
//            ]);
        }



        $products = $query->paginate(9);

        return response()->json([
            'gridView' => view('product.partials.grid-view', compact('products'))->render(),
            'listView' => view('product.partials.list-view', compact('products'))->render(),
        ]);
    }





}
