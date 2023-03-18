<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use App\Http\Controllers\users;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\DB;

use App\Models\simple_location as SLModels;

class simple_location extends Controller
{
    public function Index() {
        $DataSL = SLModels::all();
        return view('dashboard/simple_location/simple_location', [
            "DataSL" => $DataSL
        ]);
    }

    public function Create() {
        return view('dashboard/simple_location/simple_location_create');
    }

    public function CreatePost(Request $request) {
        $model = new SLModels;
        $model->name_location = $_POST["name_location"];
        if ( $model->save() ) {
            return redirect('/dashboard/manage-location');
        } else {
            return redirect()->back();
        }
    }

    public function Edit(Request $request, $id) {
        $DataSL = SLModels::where('id', $id)->get();
        return view('dashboard/simple_location/simple_location_edit', [
            "DataSL" => $DataSL
        ]);
    }

    public function EditPost(Request $request, $id) {
        $model = SLModels::find($id);
        $model->name_location = $_POST["name_location"];
        
        if ( $model->save() ) {
            return redirect('/dashboard/manage-location');
        } else {
            return redirect()->back();
        }
    }

    public function Delete(Request $request, $id) {
        $model = SLModels::find($id);
        
        if ( $model->delete() ) {
            return redirect('/dashboard/manage-location');
        } else {
            return redirect()->back();
        }
    }
}
