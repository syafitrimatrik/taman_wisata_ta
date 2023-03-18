<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\users;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\DB;

use App\Models\favourites as FavouritesModels;

class favourites extends Controller
{
    public function add(Request $request, $id) {
        $UserData = Session::get('users');
        $TamanData = DB::table('taman_wisata')->where('id', $id)->get();
        // var_dump($TamanData);
        if ( $TamanData == NULL ) {
            return redirect('/tempat-wisata');
        } else {
            $DataExist = FavouritesModels::where('taman_id', $id)->get()->first();
            if ( $DataExist != NULL ) {
                return redirect()->back();
            } else {
                $model = new FavouritesModels;
                $model->user_id = $UserData->id;
                $model->taman_id = $id;
                
                if ( $model->save() ) {
                    return redirect()->back();
                } else {
                    return redirect()->back();
                }
            }
        }
    }

    public function remove(Request $request, $id) {
        $UserData = Session::get('users');
        $models = FavouritesModels::where('taman_id', (int)$id)->where('user_id', (int)$UserData->id);
        if ( $models->delete() ) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
