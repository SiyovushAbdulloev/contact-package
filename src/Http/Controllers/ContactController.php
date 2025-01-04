<?php

namespace Siyovush\Contact\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Siyovush\Contact\Mail\ContactMailable;
use Siyovush\Contact\Models\Contact;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contact::contact');
    }

    public function send(Request $request)
    {
        Mail::to(config('contact.send_email_to'))->send(new ContactMailable($request->get('message')));

        Contact::create($request->all());

        return redirect(route('contact'));
    }
}