<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        ContactSubmission::create($request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'max:255'],
            'phone'        => ['required', 'string', 'max:50'],
            'project_type' => ['nullable', 'string', 'max:100'],
            'message'      => ['required', 'string', 'max:5000'],
        ]));

        return back()->with('contact_submitted', true);
    }
}
