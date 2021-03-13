<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Chalet;
use App\Models\ChaletMedia;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;

class ChaletController extends Controller
{
    public function index()
    {
        $chalets = Chalet::with(['media', 'category'])
            ->withCount('comments')->orderBy('id', 'desc')->paginate(10);
        return view('backend.chalets.index', compact('chalets'));
    }

    public function create()
    {
        $categories = Category::all()->pluck('name', 'id');
        $cities = City::all()->pluck('name', 'id');
        return view('backend.chalets.create', compact('categories', 'cities'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required|min:50',
            'status' => 'required',
            'category_id' => 'required',
            'city_id' => 'required',
            'images.*' => 'nullable|mimes:jpg,jpeg,png,gif|max:20000',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['title'] = $request->title;
        $data['description'] = Purify::clean($request->description);
        $data['status'] = $request->status;
        $data['category_id'] = $request->category_id;
        $data['city_id'] = $request->city_id;

        $chalet = Chalet::create($data);

        if ($request->images && count($request->images) > 0) {
            $i = 1;
            foreach ($request->images as $file) {
                $filename = $chalet->title . '-' . time() . '-' . $i . '.' . $file->getClientOriginalExtension();
                $file_size = $file->getSize();
                $file_type = $file->getMimeType();
                $path = public_path('assets/chalets/' . $filename);
                Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);

                $chalet->media()->create([
                    'file_name' => $filename,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                ]);
                $i++;
            }
        }
        return redirect()->route('dashboard.chalets.index')->with([
            'message' => 'Chalet created successfully',
            'alert-type' => 'success',
        ]);


    }

    public function show($id)
    {
        $chalet = Chalet::with(['media', 'category', 'city', 'comments'])->whereId($id)->first();
        return view('backend.chalets.show', compact('chalet'));
    }

    public function edit($id)
    {

        $categories = Category::orderBy('id', 'desc')->pluck('name', 'id');
        $cities = City::orderBy('id', 'desc')->pluck('name', 'id');
        $chalet = Chalet::with(['media'])->whereId($id)->first();

        return view('backend.chalets.edit', compact('categories', 'cities','chalet'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'description'   => 'required|min:50',
            'status'        => 'required',
            'category_id'   => 'required',
            'city_id'   => 'required',
            'images.*'      => 'nullable|mimes:jpg,jpeg,png,gif|max:20000',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $chalet = Chalet::whereId($id)->first();

        if ($chalet) {
            $data['title']              = $request->title;
            $data['description']        = Purify::clean($request->description);
            $data['status']             = $request->status;
            $data['category_id']        = $request->category_id;
            $data['city_id']            = $request->city_id;

            $chalet->update($data);

            if ($request->images && count($request->images) > 0) {
                $i = 1;
                foreach ($request->images as $file) {
                    $filename = $chalet->title . '-' . time() . '-' . $i . '.' . $file->getClientOriginalExtension();
                    $file_size = $file->getSize();
                    $file_type = $file->getMimeType();
                    $path = public_path('assets/chalets/' . $filename);
                    Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path, 100);

                    $chalet->media()->create([
                        'file_name' => $filename,
                        'file_size' => $file_size,
                        'file_type' => $file_type,
                    ]);
                    $i++;
                }
            }


            return redirect()->route('dashboard.chalets.index')->with([
                'message' => 'Chalet updated successfully',
                'alert-type' => 'success',
            ]);

        }
        return redirect()->route('dashboard.chalets.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }

    public function destroy_chalet_media($media_id)
    {
        $media = ChaletMedia::whereId($media_id)->first();
        if ($media) {
            if (File::exists('assets/chalets/' . $media->file_name)) {
                unlink('assets/chalets/' . $media->file_name);
            }
            $media->delete();
            return true;
        }
        return false;

    }

    public function destroy()
    {
        
    }
}
