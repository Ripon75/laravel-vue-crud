<?php

namespace App\Http\Controllers\Api;

use File;
use App\Models\Image;
use Illuminate\Http\Request;
use App\UtilClasses\CommonUtils;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function index(Request $request)
    {
        $searchKey = $request->input('search_key', null);
        $paginate  = config('crud.paginate.default');

        $imageObj = new Image();

        if ($searchKey) {
            $imageObj = Image::where('name', $searchKey);
        }

        $imageObj = $imageObj->paginate($paginate);

        if (count($imageObj) > 0) {
            return CommonUtils::response($imageObj, 'All product', 200);
        } else {
            return CommonUtils::error(null, 'Product not found', 201);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => ['required'],
            'img_src' => ['required', 'image']
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return CommonUtils::error(null, $validator->errors(), 201);
        }


        $name = $request->input('name');

        $imageObj = new Image();

        $imageObj->name = $name;

        if ($request->hasFile('img_src')) {
            $file = $request->file('img_src', null);
            $ext  = $file->extension();
            $name = time().'.'.$ext;
            $file->move('uploadImages/products', $name);

            $imageObj->img_src = $name;
        }
        $res = $imageObj->save();
        if ($res) {
            return CommonUtils::response(null, 'File upload successfully', 200);
        } else {
            return CommonUtils::error(null, 'File is not uploaded', 201);
        }
    }

    public function show($id)
    {
        $data = Image::find($id);
        if ($data) {
            return CommonUtils::response($data, 'Single data', 200);
        } else {
            return CommonUtils::error(null, 'No data found', 201);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required']
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return CommonUtils::error(null, $validator->errors(), 201);
        }
        $name = $request->input('name', null);

        $image = Image::find($id);

        $image->name = $name;
        
        if ($request->hasFile('img_src')) {
            $oldImage = $image->img_src;
            $oldImagePath = 'uploadImages/products'. $oldImage;
            if ($oldImagePath) {
                File::delete($oldImagePath);
            }

            $file = $request->file('img_src', null);
            $ext  = $file->extension();
            $name = time().'.'.$ext;
            $file->move('uploadImages/products', $name);

            $image->img_src = $name;
        }
        $res = $image->save();
        if ($res) {
            return CommonUtils::response($image, 'File upated successfully', 200);
        } else {
            return CommonUtils::error(null, 'File is not updated', 201);
        }
    }

    public function destroy($id)
    {
        $image = Image::find($id);

        $res = $image->delete();

        if ($res) {
            return CommonUtils::response($image, 'Image deleted successfully', 200);
        } else {
            return CommonUtils::response(null, 'Image is not delete', 201);
        }
    }
}
