<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Picture\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use League\Flysystem\FileNotFoundException;

class PictureController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $pictures = $request->file('picture');
            if ($pictures) {
                foreach ($pictures as $picture) {
                    $model = new Picture();
                    $model->object_type = $request->input('object_type');
                    $model->object_id = $request->input('object_id');
                    $picture_name = rand(100000, 999999).'_'.time().".".$picture->getClientOriginalExtension();
                    $model->picture_name = $picture_name;
                    $model->physical_name = $picture->getClientOriginalName();
                    $model->created_by = Auth::id();
                    $model->is_default = false;
                    Storage::putFileAs('pictures/'.$model->object_type, $picture, $picture_name);
                    $thumbnail = ImageManagerStatic::make($picture)->resize(150, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->resizeCanvas(150, 150)->stream();
                    $thumbnail = $thumbnail->__toString();
                    Storage::put('pictures/'.$model->object_type.'/thumbnails/'.$picture_name, $thumbnail, 'public');
                    $model->save();
                }
            }
            DB::commit();
        } catch (\Throwable $throwable) {
            DB::rollBack();
            return response($throwable->getMessage(), 500);
        }
        return response('Successfully uploaded', 201);
    }

    public function index(Request $request)
    {
        $object_type = $request->input('object_type');
        $object_id = $request->input('object_id');
        try {
            return Picture::where('object_type', $object_type)->where('object_id', $object_id)->get();
        } catch (\Throwable $throwable) {
            return response($throwable->getMessage(), 500);
        }
    }

    public function update($id)
    {
        $picture = Picture::find($id);

        $old_picture = Picture::where('object_id', $picture->object_id)
            ->where('is_default', true)
            ->first();
        if ($old_picture) {
            $old_picture->is_default = false;
            $old_picture->save();
        }
        $default = Picture::find($id);
        $default->is_default = 1;
        $default->save();
        return response('Successfully saved', 201);
    }

    public function destroy($id)
    {
        $model = Picture::where('id', $id)->first();
        if ($model) {
            if ($model->is_default) {
                $new_default = Picture::where('object_id', $model->object_id)->first();
                if ($new_default) {
                    $new_default->is_default = true;
                    $new_default->save();
                }
            }
            Storage::delete('pictures/'.$model->object_type.'/'.$model->picture_name);
            Storage::delete('pictures/'.$model->object_type.'/thumbnails/'.$model->picture_name);
            $model->delete();
            return response('Successfully deleted', 200);
        } else {
            return response('Not found', 404);
        }
    }

    public function getPicture($id)
    {
        $file = Picture::find($id);
        if ($file) {
            try {
                $path = Storage::path('pictures/'.$file->object_type.'/'.$file->picture_name);
                return response()->file($path);
            } catch (FileNotFoundException $error) {
                return "Error";
            }
        } else {
            return "Error";
        }
    }

    public function getPictureThumbnail($id)
    {
        $file = Picture::find($id);
        if ($file) {
            try {
                $path = Storage::path('pictures/'.$file->object_type.'/thumbnails/'.$file->picture_name);
                return response()->file($path);
            } catch (FileNotFoundException $error) {
                return "Error";
            }
        } else {
            return "Error";
        }
    }

}
