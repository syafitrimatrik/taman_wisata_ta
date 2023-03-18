<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Profile;

class users extends Controller
{
    public function login(Request $request) {
        if ( Session::get('users') ) {
            return redirect()->back();
        } else {
            return view('users/login');
        }
    }

    public function register() {
        if ( Session::get('users') ) {
            return redirect()->back();
        } else {
            return view('users/register');
        }
    }

    public function logout(Request $request) {
        if ( Session::get('users') ) {
            $request->session()->forget('users');
            $request->session()->forget('profile');

            return redirect('/');
        } else {
            return redirect()->back();
        }
    }

    public function registerPost(Request $request) {
        $UserData = User::where('username', $_POST['username'])->get();
        if ( count($UserData) != 0 ) {
            return redirect('/register');
        } else {
            $model = new User;
            $model->username = $_POST["username"];
            $model->password = $_POST["password"];
            $model->email = $_POST["email"];

            if ( $model->save() ) {
                $model2 = new profile;
                $model2->users_id = $model->id;
                $model2->fullname = $_POST['fullname'];
                $model2->description = '';

                if ( $model2->save() ) {
                    return redirect('/login');
                } else {
                    return redirect('/register');
                }
            } else {
                return redirect('/register');
            }
        }
    }

    public function loginPost(Request $request) {
        $UserData = User::where('username', $_POST['username'])->get()->first();
        $ProfileData = profile::where('users_id', $UserData->id)->get()->first();
        if ( $UserData->password != $_POST['password'] ) {
            return redirect('/login');
        } else {
            $request->session()->put('users', $UserData);
            $request->session()->put('profile', $ProfileData);
            return redirect('/');
        }
    }

    public function profile(Request $request) {
        $UserData = Session::get('users');
        if ( $UserData != NULL ) {
            if ( $UserData->type != 'admin' ) {
                return view('users/profile');
            } else {
                return view('users/admin/profile');
            }
            
        } else {
            return redirect('/login');
        }
    }

    public function edit(Request $request, $id) {
        $UserData = Session::get('users');
        if ( $UserData != NULL ) {
            $UserDataNew = User::where('id', $id)->get()->first();
            if ( $UserData->type != 'admin' ) {
                return view('users/edit', [
                    'user_data' => $UserDataNew,
                ]);
            } else {
                return view('users/admin/edit', [
                    'user_data' => $UserDataNew,
                ]);
            }
        } else {
            return redirect('/login');
        }
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function editPost(Request $request) {
        $UserData = Session::get('users');
        $model = User::where('id', $_POST['user_id'])->first();
        $modelProfile = profile::where('users_id', $_POST['user_id'])->first();
        if ( $request->images_profile ) {
            $newNameThumbnail = $this->generateRandomString(20) . '.' . $request->images_profile->getClientOriginalExtension();
            $model->email = $_POST['email'];
            $modelProfile->fullname = $_POST['fullname'];
            $modelProfile->images_profile = $newNameThumbnail;
            $modelProfile->description = $_POST['description'];
            $modelProfile->location = $_POST['location'];
            $request->images_profile->storeAs('public/profile', $newNameThumbnail);
        } else {
            $model->email = $_POST['email'];
            $modelProfile->fullname = $_POST['fullname'];
            $modelProfile->images_profile = $_POST['image_default'] !== '' ? $_POST['image_default'] : null;
            $modelProfile->description = $_POST['description'];
            $modelProfile->location = $_POST['location'];
        }

        if ( $model->save() && $modelProfile->save() ) {
            $request->session()->forget('users');
            $request->session()->forget('profile');
            $request->session()->put('users', User::where('id', $_POST['user_id'])->get()->first());
            $request->session()->put('profile', profile::where('users_id', $_POST['user_id'])->get()->first());
            
            return redirect('/dashboard/profile');
        } else {
            return redirect('/dashboard/profile/edit/' . $_POST['user_id']);
        }
    }
}
