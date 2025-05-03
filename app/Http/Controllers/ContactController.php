<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        Mail::raw($validated['message'], function ($msg) use ($validated) {
            $msg->to('comotlangsungthrift@gmail.com') // email tujuan
                ->subject($validated['subject'])
                ->from($validated['email']); // pengirim
        });

        return back()->with('success', 'Pesan berhasil dikirim!');
    }
}
