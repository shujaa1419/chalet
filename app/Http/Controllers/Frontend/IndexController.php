<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Chalet;
use App\Models\City;
use App\Models\Contact;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    public function index()
    {
        $all_chalets = Chalet::with(['category', 'city', 'media'])
            ->whereStatus(1)->orderBy('id', 'desc')->paginate(5);
        $all_categories = Category::all();
        $all_cities = City::all();

        return view('frontend.index', compact('all_chalets', 'all_categories', 'all_cities'));
    }

    public function search(Request $request)
    {
        $keyword = isset($request->keyword) && $request->keyword != '' ? $request->keyword : null;
        $all_chalets = Chalet::with(['category', 'city', 'media']);
        $all_categories = Category::all();
        $all_cities = City::all();

        if ($keyword != null) {
            $all_chalets = $all_chalets->search($keyword, null, true);
        }


        $all_chalets = $all_chalets->whereStatus(1)->orderBy('id', 'desc')->paginate(5);
        return view('frontend.index', compact('all_chalets', 'all_cities', 'all_categories'));


    }


    public function category($id)
    {
        $category = Category::whereId($id)->first()->id;
        $all_cities = City::all();

        $all_chalets = Chalet::with(['category', 'city', 'media'])
            ->whereCategoryId($id)
            ->whereStatus(1)->orderBy('id', 'desc')->paginate(5);
        $all_categories = Category::all();
        if ($category) {
            $chalets = Chalet::with(['category', 'city', 'media'])
                ->withCount('approved_comments')
                ->whereCategoryId($category)
                ->whereStatus(1)
                ->orderBy('id', 'desc')
                ->paginate(5);
            return view('frontend.index', compact('chalets', 'all_chalets', 'all_categories', 'all_cities'));
        }
        return redirect()->route('frontend.index');
    }


    public function city($id)
    {
        $city = City::whereId($id)->first()->id;
        $all_cities = City::all();

        $all_chalets = Chalet::with(['category', 'city', 'media'])
            ->whereCategoryId($id)
            ->whereStatus(1)->orderBy('id', 'desc')->paginate(5);
        $all_categories = Category::all();
        if ($city) {
            $chalets = Chalet::with(['category', 'city', 'media'])
                ->withCount('approved_comments')
                ->whereCityId($city)
                ->whereStatus(1)
                ->orderBy('id', 'desc')
                ->paginate(5);
            return view('frontend.index', compact('chalets', 'all_chalets', 'all_categories', 'all_cities'));
        }
        return redirect()->route('frontend.index');
    }


    public function chalet_show($id)
    {
        $chalet = Chalet::with(['category', 'city', 'media',
            'approved_comments' => function ($query) {
                $query->orderBy('id', 'desc');
            }
        ]);
        $all_categories = Category::all();
        $all_cities = City::all();
        $chalet = $chalet->whereId($id);
        $chalet = $chalet->whereStatus(1)->first();

        if ($chalet) {
            return view('frontend.chalet', compact('chalet', 'all_categories', 'all_cities'));
        } else {
            return redirect()->route('frontend.index');
        }
    }

    public function store_comment(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required|min:10'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $chalet = Chalet::whereId($id)->whereStatus(1)->first();
        if ($chalet) {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['comment'] = $request->comment;
            $data['chalet_id'] = $chalet->id;


            $chalet->comments()->create($data);
            return redirect()->back()->with([
                'message' => 'Comment Added Successfully',
                'alert-type' => 'success'
            ]);

        }
        return redirect()->back()->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger'
        ]);
    }

    public function contact()
    {
        $all_cities = City::all();
        $all_categories = Category::all();
        return view('frontend.contact', compact('all_cities', 'all_categories'));
    }

    public function do_contact(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'nullable|numeric',
            'title' => 'required|min:5',
            'message' => 'required|min:10'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['mobile'] = $request->mobile;
        $data['title'] = $request->title;
        $data['message'] = $request->message;

        Contact::create($data);
        return redirect()->route('frontend.index')->with([
            'message' => 'Message Sent Successfully',
            'alert-type' => 'success'
        ]);


    }

    public function customer()
    {
        $chalets = Chalet::all()->pluck('title', 'id');
        $all_cities = City::all();
        $all_categories = Category::all();
        return view('frontend.customer', compact('all_cities', 'all_categories', 'chalets'));
    }

    public function store_customer(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'chalet_id' => 'required',
            'cin' => 'required',
            'cout' => 'required'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['mobile'] = $request->mobile;
        $data['chalet_id'] = $request->chalet_id;
        $data['cin'] = Carbon::parse($request->cin);
        $data['cout'] = Carbon::parse($request->cout);

        Customer::create($data);
        return redirect()->route('frontend.index')->with([
            'message' => 'Reserved Successfully',
            'alert-type' => 'success'
        ]);


    }

    public function about()
    {
        $all_categories = Category::all();
        $all_cities = City::all();
        return view('frontend.about', compact('all_categories', 'all_cities'));
    }
}
