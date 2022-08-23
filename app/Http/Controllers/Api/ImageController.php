<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utility\Util;
use App\Models\Image;

class ImageController extends Controller
{
    public function index()
    {
        $image = Image::get();

        if (count($image) > 0) {
            return Util::response($image, 'All images', 200);
        } else {
            return Util::response(null, 'Image not found', 201);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'img_src' => ['required']
        ]);

        if ($request->hasFile('img_src')) {
            $file = $request->file('img_src', null);
            $ext  = $file->extension();
            $name = time().'.'.$ext;
            $file->move('public/images', $name);

            $imageObj = new Image();
            $imageObj->img_src = $name;
            $res = $imageObj->save();
            if ($res) {
                return Util::response(null, 'File upload successfully', 200);
            } else {
                return Util::response(null, 'File is not uploaded', 201);
            }
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
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
