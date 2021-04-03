<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(10);
        return view('backend.customers.index', compact('customers'));
    }
    public function show($id)
    {
        $customer = Customer::whereId($id)->first();
        return view('backend.customers.show', compact('customer'));
    }

    public function destroy($id)
    {

        $message = Contact::whereId($id)->first();

        if ($message) {
            $message->delete();

            return redirect()->route('dashboard.contacts.index')->with([
                'message' => 'Message deleted successfully',
                'alert-type' => 'success',
            ]);
        }

        return redirect()->route('dashboard.contacts.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }
}
