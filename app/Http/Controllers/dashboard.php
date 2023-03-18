<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use App\Http\Controllers\users;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\DB;

use App\Models\images;
use App\Models\taman_wisata;
use App\Models\fasilitas;
use App\Models\simple_location;

class dashboard extends Controller
{
    public function index(Request $request) {
        // $query = @unserialize (file_get_contents('http://ip-api.com/php/'));
        // var_dump($query);
        // echo "<br>";
        // echo $query["lat"];
        $DataUser = Session::get('users');
        if ( $DataUser != NULL ) {
            $DataTamanWisata = DB::table('favourites')->where('user_id', $DataUser->id)
                            ->join('taman_wisata', 'taman_wisata.id', '=', 'favourites.taman_id')
                            ->get();
            if ( $DataUser->type != 'admin' ) {
                return view('dashboard/index', [
                    'data_taman' => $DataTamanWisata,
                ]);
            } else {
                return view('dashboard/admin/index',[
                    'data_taman' => $DataTamanWisata,
                ]);
            }
        } else {
            return redirect('/login');
        }
    }

    public function tamanWisata(Request $request) {
        $DataTamanWisata = taman_wisata::where('users_id', Session::get('users')->id)->get();
        return view('dashboard/taman_wisata', [
            'data_taman' => $DataTamanWisata,
        ]);
    }

    public function tamanWisataCreate(Request $request) {
        $DataUser = Session::get('users');
        $DataSL = simple_location::all();
        if ( $DataUser != NULL ) {
            if ( $DataUser->type == 'admin' ) {
                return view('dashboard/admin/taman_wisata_create', [
                    "DataSL" => $DataSL
                ]);
            } else {
                return redirect('/dashboard');
            }
        } else {
            return redirect('/login');
        }
    }

    public function tamanWisataCreatePost(Request $request) {
        // var_dump($_POST["rating"]);
        $UserId = Session::get('users')->id;
        $status_images = false;
        $status_images_link = false;

        var_dump(floatval($_POST["jarak"]));

        // Checking The Images Status
        foreach($_POST as $key => $value) {
            if ( $key == 'imageslink') {
                $status_images_link = true;
            } 
            
            if ( $key == 'images' ) {
                $status_images = true;
            }
        }

        if($request->images) {
            $status_images = true;
        }
        
        if($request->imageslink) {
            $status_images_link = true;
        }
        
        if ( $request->thumbnail ) {
            $newNameThumbnail = $this->generateRandomString(20) . '.' . $request->thumbnail->getClientOriginalExtension();
        }

        if ( $request->thumbnail ) {
            $model = new taman_wisata;
            $model->users_id = $UserId;
            $model->title = $_POST["title"];
            $model->thumbnail = $newNameThumbnail;
            $model->rating = (int)$_POST['rating'];
            $model->jarak = floatval($_POST["jarak"]);
            $model->price = ($_POST["price"] !== '' && $_POST["price"] !== null && $_POST["price"] > 0 ) ? $_POST["price"] : 0;
            $model->simple_location = $_POST["simple_location"];
            $model->excerpt = $_POST["excerpt"];
            $model->latitude = $_POST["latitude"];
            $model->longitude = $_POST["longitude"];
            $model->description = $_POST["description"];
            $model->maps = $_POST["maps"];
        } else {
            $model = new taman_wisata;
            $model->users_id = $UserId;
            $model->title = $_POST["title"];
            $model->thumbnail = null;
            $model->rating = (int)$_POST['rating'];
            $model->jarak = floatval($_POST["jarak"]);
            $model->price = ($_POST["price"] !== '' && $_POST["price"] !== null && $_POST["price"] > 0 ) ? $_POST["price"] : 0;
            $model->simple_location = $_POST["simple_location"];
            $model->excerpt = $_POST["excerpt"];
            $model->latitude = $_POST["latitude"];
            $model->longitude = $_POST["longitude"];
            $model->description = $_POST["description"];
            $model->maps = $_POST["maps"];
        }

        if ( $request->thumbnail ) {
            $request->thumbnail->storeAs('public/images', $newNameThumbnail);
        }

        if ( !$status_images && !$status_images_link ) {
            if ( $model->save() ) {
                for( $i = 0; $i < count($request->fasilitas_text); $i++ ) {
                    $fasilitas = new fasilitas;
                    $fasilitas->taman_id = $model->id;
                    $fasilitas->name_icon = $request->fasilitas_icon[$i];
                    $fasilitas->title_fasilitas = $request->fasilitas_text[$i];
                    $fasilitas->save();
                }
                return redirect('/dashboard/taman-wisata');
            } else {
                return redirect('/dashboard/taman-wisata/create');
            }
        } else { 
            if ( $status_images && !$status_images_link ) {
                if ( $model->save() ) {
                    for( $i = 0; $i < count($request->fasilitas_text); $i++ ) {
                        $fasilitas = new fasilitas;
                        $fasilitas->taman_id = $model->id;
                        $fasilitas->name_icon = $request->fasilitas_icon[$i];
                        $fasilitas->title_fasilitas = $request->fasilitas_text[$i];
                        $fasilitas->save();
                    }

                    $counted = 0;
                    for( $i = 0; $i < count($request->images); $i++ ) {
                        $newNameArr = $this->generateRandomString(20) . '.' . $request->thumbnail->getClientOriginalExtension();
                        $model_images = new images;
                        $model_images->name_image = $newNameArr;
                        $model_images->type_table = 'taman_wisata';
                        $model_images->type = 'images';
                        $model_images->relation_id = $model->id;
                        $model_images->save();
                        $request->images[$i]->storeAs('public/images', $newNameArr);
                        $counted += 1; 
                    }
                    
                    if ( $counted == count($request->images) ) {
                        return redirect('/dashboard/taman-wisata');
                    }
                } else {
                    return redirect('/dashboard/taman-wisata/create');
                }
            } else if ( $status_images_link && !$status_images ){
                if ( $model->save() ) {
                    for( $i = 0; $i < count($request->fasilitas_text); $i++ ) {
                        $fasilitas = new fasilitas;
                        $fasilitas->taman_id = $model->id;
                        $fasilitas->name_icon = $request->fasilitas_icon[$i];
                        $fasilitas->title_fasilitas = $request->fasilitas_text[$i];
                        $fasilitas->save();
                    }

                    $counted = 0;
                    for( $i = 0; $i < count($request->imageslink); $i++ ) {
                        $model_images = new images;
                        $model_images->name_image = $request->imageslink[$i];
                        $model_images->type_table = 'taman_wisata';
                        $model_images->type = 'imageslink';
                        $model_images->relation_id = $model->id;
                        $model_images->save();
                        $counted += 1; 
                    }
                    
                    if ( $counted == count($request->imageslink) ) {
                        return redirect('/dashboard/taman-wisata');
                    }
                } else {
                    return redirect('/dashboard/taman-wisata/create');
                }
            } else {
                if ( $model->save() ) {
                    for( $i = 0; $i < count($request->fasilitas_text); $i++ ) {
                        $fasilitas = new fasilitas;
                        $fasilitas->taman_id = $model->id;
                        $fasilitas->name_icon = $request->fasilitas_icon[$i];
                        $fasilitas->title_fasilitas = $request->fasilitas_text[$i];
                        $fasilitas->save();
                    }

                    $counted = 0;
                    for( $i = 0; $i < count($request->images); $i++ ) {
                        $newNameArr = $this->generateRandomString(20) . '.' . $request->thumbnail->getClientOriginalExtension();
                        $model_images = new images;
                        $model_images->name_image = $newNameArr;
                        $model_images->type_table = 'taman_wisata';
                        $model_images->type = 'images';
                        $model_images->relation_id = $model->id;
                        $model_images->save();
                        $request->images[$i]->storeAs('public/images', $newNameArr);
                        $counted += 1; 
                    }

                    for( $i = 0; $i < count($request->imageslink); $i++ ) {
                        $model_images = new images;
                        $model_images->name_image = $request->imageslink[$i];
                        $model_images->type_table = 'taman_wisata';
                        $model_images->type = 'imageslink';
                        $model_images->relation_id = $model->id;
                        $model_images->save();
                        $counted += 1; 
                    }
                    
                    if ( $counted == ( count($request->images) + count($request->imageslink) ) ) {
                        return redirect('/dashboard/taman-wisata');
                    }
                } else {
                    return redirect('/dashboard/taman-wisata/create');
                }
            }
        }
    }

    public function tamanWisataDelete(Request $request, $id) {
        taman_wisata::find($id)->delete();
        $dataImages = images::where('relation_id', $id)->where('type', 'images')->where('type_table', 'taman_wisata')->get();
        for($i = 0; $i < count($dataImages); $i++) {
            $dataImages[$i]->delete();
        }

        return redirect('/dashboard/taman-wisata');
    }

    public function tamanWisataEdit(Request $request, $id) {
        $DataUser = Session::get('users');
        if ( $DataUser != NULL ) {
            if ( $DataUser->type == 'admin' ) {
                $GetData = DB::table('taman_wisata')->where('id', $id)->get()->first();
                $Fasilitas = DB::table('fasilitas')->where('taman_id', $id)->get();
                $Images = DB::table('images')->where('type_table', 'taman_wisata')
                        ->where('relation_id', $id)->get();
                return view('/dashboard/admin/taman_wisata_edit', [
                    "data_taman" => $GetData,
                    "data_fasilitas" => $Fasilitas,
                    "data_images" => $Images
                ]);
            } else {
                return redirect('/dashboard');
            }
        } else {
            return redirect('/login');
        }
    }

    public function tamanWisataEditPost(Request $request) {
        $UserId = Session::get('users')->id;
        $status_images = false;
        $status_images_link = false;

        // Checking The Images Status
        foreach($_POST as $key => $value) {
            if ( $key == 'imageslink') {
                $status_images_link = true;
            } 
            
            if ( $key == 'images' ) {
                $status_images = true;
            }
        }

        $model = taman_wisata::where('id', $_POST['taman_id'])->get()->first();
        
        $model->title = $_POST["title"];
        $model->rating = (int)$_POST["rating"];
        $model->jarak = (float)$_POST["jarak"];
        $model->excerpt = $_POST["excerpt"];
        $model->simple_location = $_POST["simple_location"];
        $model->latitude = $_POST["latitude"];
        $model->longitude = $_POST["longitude"];
        $model->description = $_POST["description"];
        $model->maps = $_POST["maps"];
        $model->price = ($_POST["price"] !== '' && $_POST["price"] !== null && $_POST["price"] > 0 ) ? $_POST["price"] : 0;

        $status_images = false;
        $status_images_link = false;
        $status_images_post = false;
        $status_fasilitas = false;
        
        foreach($_POST as $key => $value) {
            if ( $key === 'imageslink' ) { $status_images_link = true; }
            if ( $key === 'fasilitas_id' ) { $status_fasilitas = true; }
            if ( $key === 'exist_images' ) { $status_images_post = true; }
        }

        // Jika Thumbnail Tidak Ada
        if ( $request->thumbnail === NULL ) {
            $model->thumbnail = $_POST['exist_thumbnail'];
            fasilitas::where('taman_id', $_POST['taman_id'])->delete();
            for( $i = 0; $i < count($request->fasilitas_text); $i++ ) {
                $fasilitas = new fasilitas;
                $fasilitas->taman_id = $model->id;
                $fasilitas->name_icon = $request->fasilitas_icon[$i];
                $fasilitas->title_fasilitas = $request->fasilitas_text[$i];
                $fasilitas->save();
            }

            $counted = 0;
            
            if ( $model->save() ) {
                images::where('relation_id', $_POST['taman_id'])->where('type', 'images')
                        ->where('type_table', 'taman_wisata')->delete();
                images::where('relation_id', $_POST['taman_id'])->where('type_table', 'taman_wisata')
                        ->where('type', 'imageslink')->delete();

                if ( $status_images_post ) {
                    for( $i = 0; $i < count($_POST['exist_images']); $i++ ) {
                        $model_images = new images;
                        $model_images->name_image = $_POST['exist_images'][$i];
                        $model_images->type_table = 'taman_wisata';
                        $model_images->type = 'images';
                        $model_images->relation_id = $model->id;
                        $model_images->save();
                    }
                }
    
                if ( $request->imageslink ) {
                    for( $i = 0; $i < count($request->imageslink); $i++ ) {
                        $model_images = new images;
                        $model_images->name_image = $request->imageslink[$i];
                        $model_images->type_table = 'taman_wisata';
                        $model_images->type = 'imageslink';
                        $model_images->relation_id = $model->id;
                        $model_images->save();
                        $counted += 1; 
                    }
                }
    
                if ( $request->images ) {
                    foreach($request->images as $value) {
                        $newNameArr = $this->generateRandomString(20) . '.' . $value->getClientOriginalExtension();
                        $model_images = new images;
                        $model_images->name_image = $newNameArr;
                        $model_images->type_table = 'taman_wisata';
                        $model_images->type = 'images';
                        $model_images->relation_id = $model->id;
                        $model_images->save();
                        $value->storeAs('public/images', $newNameArr);
                        $counted += 1; 
                    }
                }

                return redirect('/dashboard/taman-wisata');
            } else {
                return redirect()->back();
            }
        } else {
            // Jika Thumbnail Ada
            $newNameThumbnail = $this->generateRandomString(20) . '.' . $request->thumbnail->getClientOriginalExtension();
            $model->thumbnail = $newNameThumbnail;
            $request->thumbnail->storeAs('public/images', $newNameThumbnail);
            
            fasilitas::where('taman_id', $_POST['taman_id'])->delete();
            for( $i = 0; $i < count($request->fasilitas_text); $i++ ) {
                $fasilitas = new fasilitas;
                $fasilitas->taman_id = $model->id;
                $fasilitas->name_icon = $request->fasilitas_icon[$i];
                $fasilitas->title_fasilitas = $request->fasilitas_text[$i];
                $fasilitas->save();
            }

            $counted = 0;
            
            if ( $model->save() ) {

                images::where('relation_id', $_POST['taman_id'])->where('type', 'images')
                        ->where('type_table', 'taman_wisata')->delete();
                images::where('relation_id', $_POST['taman_id'])->where('type_table', 'taman_wisata')
                        ->where('type', 'imageslink')->delete();

                if ( $status_images_post ) {
                    for( $i = 0; $i < count($_POST['exist_images']); $i++ ) {
                        $model_images = new images;
                        $model_images->name_image = $_POST['exist_images'][$i];
                        $model_images->type_table = 'taman_wisata';
                        $model_images->type = 'images';
                        $model_images->relation_id = $model->id;
                        $model_images->save();
                    }
                }
    
                if ( $request->imageslink ) {
                    for( $i = 0; $i < count($request->imageslink); $i++ ) {
                        $model_images = new images;
                        $model_images->name_image = $request->imageslink[$i];
                        $model_images->type_table = 'taman_wisata';
                        $model_images->type = 'imageslink';
                        $model_images->relation_id = $model->id;
                        $model_images->save();
                        $counted += 1; 
                    }
                }
    
                if ( $request->images ) {
                    foreach($request->images as $value) {
                        $newNameArr = $this->generateRandomString(20) . '.' . $value->getClientOriginalExtension();
                        $model_images = new images;
                        $model_images->name_image = $newNameArr;
                        $model_images->type_table = 'taman_wisata';
                        $model_images->type = 'images';
                        $model_images->relation_id = $model->id;
                        $model_images->save();
                        $value->storeAs('public/images', $newNameArr);
                        $counted += 1; 
                    }
                }

                return redirect('/dashboard/taman-wisata');
            } else {
                return redirect()->back();
            }
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
}
