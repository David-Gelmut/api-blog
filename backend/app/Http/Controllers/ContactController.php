<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactFormMailer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class ContactController extends Controller
{
    public function showContactForm(): \Illuminate\View\View
    {
        return view('contact_form');
    }

    public function contact(ContactRequest $request): RedirectResponse
    {
        Mail::to('david-gelmut@rambler.ru')->send(new ContactFormMailer($request->validated()));
        return redirect(route('contacts'));
    }
}
