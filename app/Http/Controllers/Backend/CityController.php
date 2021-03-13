<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::paginate(10);
        return view('backend.cities.index',compact('cities'));
    }

    public function create()
    {
        return view('backend.cities.create');
    }

    public function store(Request $request)
    {
        $validator =Validator::make($request->all(),[
            'name' => 'required|max:20|unique:cities'
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data['name'] = $request->name;
        City::create($data);
        return redirect()->route('dashboard.cities.index')->with([
            'message' => 'City Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function edit(City $city)
    {
        return view('backend.cities.edit',compact('city'));

    }

    public function update(Request $request,City $city)
    {
        $validator =Validator::make($request->all(),[
            'name' => 'required|max:20|unique:cities'
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data['name'] = $request->name;
        $city->update($data);
        return redirect()->route('dashboard.cities.index')->with([
            'message' => 'City updated successfully',
            'alert-type' => 'success',
        ]);
    }

    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('dashboard.cities.index')->with([
            'message' => 'City deleted successfully',
            'alert-type' => 'success',
        ]);
    }
}
