<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comments;

class comment extends Controller
{
    public function create(Request $request, $id) {
        $model =  new comments;
        $model->users_id = $_POST["users_id"];
        $model->comment = $_POST["comment"];
        $model->taman_wisata_id = $_POST["taman_wisata_id"];

        if ( $model->save() ) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
