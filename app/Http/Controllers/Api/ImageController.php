<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utility\Util;
use App\Models\Image;
use File;

class ImageController extends Controller
{
    public function index()
    {
        $image = Image::get();

        if (count($image) > 0) {
            return Util::response($image, 'All product', 200);
        } else {
            return Util::error(null, 'Product not found', 201);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => ['required'],
            'img_src' => ['required', 'image']
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return Util::error(null, $validator->errors(), 201);
        }


        $name = $request->input('name');

        $imageObj = new Image();

        $imageObj->name = $name;

        if ($request->hasFile('img_src')) {
            $file = $request->file('img_src', null);
            $ext  = $file->extension();
            $name = time().'.'.$ext;
            $file->move('public/images', $name);

            $imageObj->img_src = $name;
        }
        $res = $imageObj->save();
        if ($res) {
            return Util::response(null, 'File upload successfully', 200);
        } else {
            return Util::error(null, 'File is not uploaded', 201);
        }
    }

    public function show($id)
    {
        $data = Image::find($id);
        if ($data) {
            return Util::response($data, 'Single data', 200);
        } else {
            return Util::error(null, 'No data found', 201);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required']
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return Util::error(null, $validator->errors(), 201);
        }
        $name = $request->input('name', null);

        $image = Image::find($id);

        $image->name = $name;
        
        if ($request->hasFile('img_src')) {
            $oldImage = $image->img_src;
            $oldImagePath = 'public/images/'. $oldImage;
            if ($oldImagePath) {
                File::delete($oldImagePath);
            }

            $file = $request->file('img_src', null);
            $ext  = $file->extension();
            $name = time().'.'.$ext;
            $file->move('public/images/', $name);

            $image->img_src = $name;
        }
        $res = $image->save();
        if ($res) {
            return Util::response($image, 'File upated successfully', 200);
        } else {
            return Util::error(null, 'File is not updated', 201);
        }
    }

    public function destroy($id)
    {
        $image = Image::find($id);

        $res = $image->delete();

        if ($res) {
            return Util::response($image, 'Image deleted successfully', 200);
        } else {
            return Util::response(null, 'Image is not delete', 201);
        }
    }
}
