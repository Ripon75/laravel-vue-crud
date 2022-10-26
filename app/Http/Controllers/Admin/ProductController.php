<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function index()
    {
         if (!Auth::user()->ability(['admin'], ['products-read'])) {
            return back()->with('error', __('auth.unauthorized'));
        }

        $paginate = config('crud.paginate.default');

        $products = Product::paginate($paginate);

        return view('admin.product.index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function productBulkCreate()
    {
        return view('admin.product.bulk-upload');
    }

    public function productBulkStore(Request $request)
    {
        $request->validate([
            'uploaded_file' => ['required', 'file', 'mimes:csv']
        ]);

        $file = $request->file('uploaded_file');

        $filename  = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
        $tempPath  = $file->getRealPath();
        $fileSize  = $file->getSize(); //Get size of uploaded file in bytes
        //Check for file extension and size
        $this->checkUploadedFileProperties($extension, $fileSize);
        //Where uploaded file will be stored on the server
        $location = 'uploads'; //Created an "uploads" folder for that
        // Upload file
        $file->move($location, $filename);
        // In case the uploaded file path is to be stored in the database
        $filepath = public_path($location . "/" . $filename);
        // Reading file
        $file = fopen($filepath, "r");

        $firstline = true;

        while (($data = fgetcsv($file, 500, ",")) !== false) {
            if (!$firstline) {
                // Get All data from csv
                $productName  = trim($data['0']);
                $categoryName = trim($data['1']);
                $brandName    = trim($data['2']);
                $mrp          = trim($data['3']);
                $sellingPrice = trim($data['4']);
                $vat          = trim($data['5']);
                $quantity     = trim($data['6']);
                $status       = trim($data['7']);
                $description  = trim($data['8']);

                $mrp        = (float)$mrp;
                $sellingPrice = (float)$sellingPrice;

                $categoryID = null;
                if ($categoryName) {
                    $category = Category::where('name', $categoryName)->first();
                    if ($category) {
                        $categoryID = $category->id;
                    } else {
                        $slug = Str::slug($categoryName, '-');
                        try {
                            DB::beginTransaction();
                            $categoryObj          = new Category();
                            $categoryObj->slug    = $slug;
                            $categoryObj->name    = $categoryName;
                            $categoryObj->status  = 'active';
                            $categoryObj->popular = 1;
                            $categoryObj->save();
                            $categoryID = $categoryObj->id;
                            DB::commit();
                        } catch (\Exception $e) {
                            info($e);
                            DB::rollBack();
                        }
                    }
                }

                $brandID = null;
                if ($brandName) {
                    $brand = Brand::where('name', $brandName)->first();
                    if ($brand) {
                        $brandID = $brand->id;
                    } else {
                        $slug = Str::slug($brandName, '-');
                        try {
                            DB::beginTransaction();
                            $brandObj          = new Brand();
                            $brandObj->slug    = $slug;
                            $brandObj->name    = $brandName;
                            $brandObj->status  = 'active';
                            $brandObj->popular = 1;
                            $brandObj->save();
                            $brandID = $brandObj->id;
                            DB::commit();
                        } catch (\Exception $e) {
                            info($e);
                            DB::rollBack();
                        }
                    }
                }

                if ($productName && $mrp) {
                    $slug = Str::slug($productName, '-');
                    try {
                        DB::beginTransaction();
                        $productObj                = new Product();
                        $productObj->name          = $productName;
                        $productObj->slug          = $slug;
                        $productObj->category_id   = $categoryID;
                        $productObj->brand_id      = $brandID;
                        $productObj->mrp           = $mrp;
                        $productObj->selling_price = $sellingPrice;
                        $productObj->vat           = $vat ?? 0;
                        $productObj->quantity      = $quantity;
                        $productObj->status        = $status;
                        $productObj->description   = $description ?? null;
                        $productObj->save();
                        DB::commit();
                    } catch (\Exception $e) {
                        info($e);
                        DB::rollBack();
                    }
                }
            }
            $firstline = false;
        }

        fclose($file);

        return back()->with('message', 'File upload succesfully done');
    }

    public function checkUploadedFileProperties($extension, $fileSize)
    {
        $valid_extension = ['csv']; //Only want csv and excel files
        $maxFileSize = 2097152; // Uploaded file size limit is 2mb
        if (in_array(strtolower($extension), $valid_extension)) {
            if ($fileSize <= $maxFileSize) {
            } else {
                throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
            }
        } else {
            throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
        }
    }
}
