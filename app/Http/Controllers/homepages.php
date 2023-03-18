<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class homepages extends Controller
{
    public function index(Request $request) {
        $DataTaman = DB::table('taman_wisata')->get();
        return view('homepages/index', [
            'data_taman' => $DataTaman
        ]);
    }
}
