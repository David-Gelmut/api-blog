<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactFormMailer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class ContactController extends Controller
{
    public function contact(ContactRequest $request)
    {
        Mail::to('david-gelmut@rambler.ru')->send(new ContactFormMailer($request->validated()));
        return response()->json([
            'success'=>  'Cообщение отправлено'
        ]);
    }
}
