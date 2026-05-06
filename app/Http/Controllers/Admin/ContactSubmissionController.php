<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;

class ContactSubmissionController extends Controller
{
    public function index()
    {
        return view('admin.cms.contact.index', [
            'submissions' => ContactSubmission::latest()->paginate(20),
        ]);
    }

    public function show(ContactSubmission $contact)
    {
        $contact->markRead();

        return view('admin.cms.contact.show', compact('contact'));
    }

    public function destroy(ContactSubmission $contact)
    {
        $contact->delete();

        return to_route('admin.contact.index');
    }
}
