<?php

namespace App\Http\Controllers;

use App\Imports\ImportUser;
use App\Jobs\SendMessageJob;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function importView(Request $request){
        return view('import');
    }

    public function import(Request $request)
    {
        $file = $request->file('file')->store('temp');

        Excel::import(new ImportUser, $file);

        $users = User::all();

        foreach ($users as $user) {
            SendMessageJob::dispatch($user, 'Your message goes here');
        }

        return redirect()->back()->with('success', 'File imported and messages sent successfully.');
    }
}
