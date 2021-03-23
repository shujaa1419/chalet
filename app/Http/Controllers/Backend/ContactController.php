<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $messages = Contact::paginate(10);
        return view('backend.contacts.index',compact('messages'));
    }

    public function show($id)
    {
        $message = Contact::whereId($id)->first();
        return view('backend.contacts.show', compact('message'));
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
