<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;

use App\Models\simple_location;
use App\Models\taman_wisata as TamanModels;

class taman_wisata extends Controller
{
    public function index(Request $request) {
        $DataSL = simple_location::all();
        $LowPrice = TamanModels::min('price');
        $HighPrice = TamanModels::max('price');
        $Query = ($request->input('query') != NULL) || ($request->input('query') != '') ? $request->input('query') : '';
        $Rating = ($request->input('rating') != NULL) || ($request->input('rating') != '') != NULL ? $request->input('rating') : 5;
        $Location = ($request->input('location') != NULL) || ($request->input('location') != '') ? $request->input('location') : '';
        $PriceMin = ($request->input('price-min') != NULL) || ($request->input('price-min') != '') ? (int) $request->input('price-min') : 0;
        $PriceMax = ($request->input('price-max') != NULL) || ($request->input('price-max') != '') ? (int) $request->input('price-max') : 10000000;
        $SortBy = ($request->input('sort-by') != NULL) || ($request->input('sort-by') != '') ? $request->input('sort-by') : '';
        $Sort = ($request->input('sort') != NULL) || ($request->input('sort') != '') ? $request->input('sort') : '';
        $JarakFrom = ($request->input('jarak-from') != NULL) || ($request->input('jarak-from') != '') ? $request->input('jarak-from') : 0;
        $JarakTo = ($request->input('jarak-to') != NULL) || ($request->input('jarak-to') != '') ? $request->input('jarak-to') : 10000000;
        $TypeButton = null;
        foreach ($_GET as $value => $key) {
            if ( $key === 'normal-search' ) $TypeButton = $key;
            if ( $key === 'preverence' ) $TypeButton = $key;
        }

        // var_dump($Location);

        // $QueryDataTaman = DB::select("
        //     SELECT * FROM taman_wisata tw1
        //         WHERE ( 
        //             tw1.title LIKE '%". $Query ."%'
        //             OR tw1.excerpt LIKE '%". $Query ."%'
        //             OR tw1.description LIKE '%". $Query ."%'
        //         )
        //         AND tw1.rating <= ". (int)$Rating ."
        //         AND tw1.jarak >= ". (int)$JarakFrom ."
        //         AND tw1.jarak <= ". (int)$JarakTo ."
        //         AND tw1.simple_location LIKE '%". $Location ."%'
        //         AND tw1.latitude LIKE '%%'
        //         AND tw1.longitude LIKE '%%'
        //         AND tw1.price >= ". (int)$PriceMin ."
        //         AND tw1.price <= ". (int)$PriceMax ."
        //         AND NOT EXISTS (
        //             SELECT  * FROM taman_wisata tw2
        //             WHERE (
        //                 tw2.title LIKE '%". $Query ."%'
        //                 OR tw2.excerpt LIKE '%". $Query ."%'
        //                 OR tw2.description LIKE '%". $Query ."%'
        //             )
        //             AND tw2.rating <= tw1.rating
        //             AND tw2.jarak >= tw1.jarak
        //             AND tw2.jarak <= tw1.jarak
        //             AND tw2.simple_location LIKE '%". $Location ."%'
        //             AND tw2.latitude LIKE '%%'
        //             AND tw2.longitude LIKE '%%'
        //             AND tw2.price >= tw1.price
        //             AND tw2.price <= tw1.price
        //             AND ( 
        //                 tw2.price < tw1.price 
        //                 OR tw2.price > tw1.price
        //                 OR tw2.jarak < tw1.jarak
        //                 OR tw2.jarak > tw1.jarak
        //             )
        //         )
        // ");

        if ( $TypeButton === 'normal-search' ) {
            $QueryDataTaman = DB::select("
                SELECT * FROM taman_wisata tw1
                    WHERE ( 
                        tw1.title LIKE '%". $Query ."%'
                        OR tw1.excerpt LIKE '%". $Query ."%'
                        OR tw1.description LIKE '%". $Query ."%'
                    )
                    AND tw1.rating <= ". (float)$Rating ."
                    AND tw1.jarak >= ". (int)$JarakFrom ."
                    AND tw1.jarak <= ". (int)$JarakTo ."
                    AND tw1.simple_location LIKE '%". $Location ."%'
                    AND tw1.latitude LIKE '%%'
                    AND tw1.longitude LIKE '%%'
                    AND tw1.price >= ". (int)$PriceMin ."
                    AND tw1.price <= ". (int)$PriceMax ."
                    AND NOT EXISTS (
                        SELECT  * FROM taman_wisata tw2
                        WHERE (
                            tw2.title LIKE '%". $Query ."%'
                            OR tw2.excerpt LIKE '%". $Query ."%'
                            OR tw2.description LIKE '%". $Query ."%'
                        )
                        AND tw2.rating <= tw1.rating
                        AND tw2.jarak >= tw1.jarak
                        AND tw2.jarak <= tw1.jarak
                        AND tw2.simple_location LIKE '%". $Location ."%'
                        AND tw2.latitude LIKE '%%'
                        AND tw2.longitude LIKE '%%'
                        AND tw2.price >= tw1.price
                        AND tw2.price <= tw1.price
                        AND ( 
                            tw2.price < tw1.price 
                            OR tw2.price > tw1.price
                            OR tw2.jarak < tw1.jarak
                            OR tw2.jarak > tw1.jarak
                        )
                    )
            ");
        } else {
            // $QueryDataTaman = DB::select("
            //     SELECT * FROM taman_wisata tw1
            //         WHERE ( 
            //             tw1.title LIKE '%". $Query ."%'
            //             OR tw1.excerpt LIKE '%". $Query ."%'
            //             OR tw1.description LIKE '%". $Query ."%'
            //         )
            //         AND tw1.rating <= ". (int)$Rating ."
            //         AND tw1.jarak >= ". (int)$JarakFrom ."
            //         AND tw1.jarak <= ". (int)$JarakTo ."
            //         AND tw1.simple_location LIKE '%". $Location ."%'
            //         AND tw1.latitude LIKE '%%'
            //         AND tw1.longitude LIKE '%%'
            //         AND tw1.price >= ". (int)$PriceMin ."
            //         AND tw1.price <= ". (int)$PriceMax ."
            //         AND NOT EXISTS (
            //             SELECT  * FROM taman_wisata tw2
            //             WHERE (
            //                 tw2.title LIKE '%". $Query ."%'
            //                 OR tw2.excerpt LIKE '%". $Query ."%'
            //                 OR tw2.description LIKE '%". $Query ."%'
            //             )
            //             AND tw2.rating <= tw1.rating
            //             AND tw2.jarak >= tw1.jarak
            //             AND tw2.jarak <= tw1.jarak
            //             AND tw2.simple_location LIKE '%". $Location ."%'
            //             AND tw2.latitude LIKE '%%'
            //             AND tw2.longitude LIKE '%%'
            //             AND tw2.price >= tw1.price
            //             AND tw2.price <= tw1.price
            //             AND ( 
            //                 tw2.price < tw1.price 
            //                 OR tw2.price > tw1.price
            //                 OR tw2.jarak < tw1.jarak
            //                 OR tw2.jarak > tw1.jarak
            //             )
            //         )
            // ");

            // $QueryDataTaman = DB::select("
            //     SELECT * FROM taman_wisata c
            //     WHERE c.simple_location = 'Pancoran Mas' AND NOT EXISTS
            //     (SELECT * FROM taman_wisata c1
            //     WHERE c1.simple_location='Pancoran Mas' AND
            //     c1.price <= c.price and c1.rating
            //     <= c.rating AND (c1.price <
            //     c.price OR c1.rating <
            //     c.rating));
            // ");

            $QueryDataTaman = DB::select("
                SELECT * FROM taman_wisata c WHERE c.simple_location = '". $Location  ."' AND NOT EXISTS (SELECT * FROM taman_wisata c1 WHERE c1.simple_location='". $Location  ."' AND c1.jarak <= c.jarak and c1.rating >= c.rating AND (c1.jarak < c.jarak OR c1.rating >c.rating)); 
            ");
        }

        // var_dump($QueryDataTaman);

        $Page = $request->input('page') ? (int)$request->input('page') : 1;
        $Size = 50;
        $Collection = collect($QueryDataTaman);
        $DataTaman = new LengthAwarePaginator(
            $Collection->forPage($Page, $Size),
            $Collection->count(), 
            $Size, 
            $Page,
            ['path' => url('/tempat-wisata')]
        );

        return view('wisata/index', [
            'data_taman' => $DataTaman,
            'DataSL' => $DataSL,
            'HighPrice' => $HighPrice,
            'LowPrice' => $LowPrice,
            'LocationVal' => $Location,
        ]);
    }

    public function detail(Request $request, $id) {
        $UserData = Session::get('users');

        if ( $UserData ) { 
            $DataDetail = DB::table('taman_wisata')->where('id', $id)->get()->first();
            $DataImages = DB::table('images')
                        ->where('type_table', 'taman_wisata')
                        ->where('type', 'images')
                        ->orWhere('type', 'imageslink')
                        ->where('relation_id', $DataDetail->id)
                        ->get();
            $DataComment = DB::table('comment')
                        ->join('users', 'users.id', '=', 'comment.users_id')
                        ->join('profile', 'profile.users_id', '=', 'comment.users_id')
                        ->get();
            $DataFasilitas = DB::table('fasilitas')
                        ->where('taman_id', $id)
                        ->get();

            $DataFavourites = DB::table('favourites')
                            ->where('taman_id', $id)
                            ->where('user_id', $UserData->id)
                            ->get();

            return view('wisata/detail',[  
                'data_detail' => $DataDetail,
                'data_images' => $DataImages,
                'data_comment' => $DataComment,
                'data_fasilitas' => $DataFasilitas,
                'data_favourites' => $DataFavourites
            ]);
        } else {
            $DataDetail = DB::table('taman_wisata')->where('id', $id)->get()->first();
            $DataImages = DB::table('images')
                        ->where('type_table', 'taman_wisata')
                        ->where('type', 'images')
                        ->orWhere('type', 'imageslink')
                        ->where('relation_id', $DataDetail->id)
                        ->get();
            $DataComment = DB::table('comment')
                        ->join('users', 'users.id', '=', 'comment.users_id')
                        ->join('profile', 'profile.users_id', '=', 'comment.users_id')
                        ->get();
            $DataFasilitas = DB::table('fasilitas')
                        ->where('taman_id', $id)
                        ->get();

            return view('wisata/detail',[  
                'data_detail' => $DataDetail,
                'data_images' => $DataImages,
                'data_comment' => $DataComment,
                'data_fasilitas' => $DataFasilitas,
                'data_favourites' => []
            ]);
        }
        
    }

    public function SeederDataTaman() {
        $Counted = 0;
        for ( $i = 0; $i < 250; $i++ ) {
            $models = new TamanModels;
            $models->users_id = 1;
            $models->title = 'Ini title ' . $i;
            
            if ( $i % 2 == 0 ) {
                $models->rating = 4;
                $models->jarak = 0;
                // $models->simple_location = 'tiptop';
                // $models->latitude = '-6.403005609582511';
                // $models->longitude = '106.83529018425048';
                // $models->price = $i * 100;
                $models->simple_location = 'nusantara';
                $models->latitude = '-6.393724041022173';
                $models->longitude = '106.80834472294565';
                $models->price = $i * 2500;
                
            } else {
                $models->rating = 2;
                $models->jarak = 0;
                // $models->simple_location = 'jembatan serong';
                // $models->latitude = '-6.416864724604323';
                // $models->longitude = '1106.7967449977435'; 
                // $models->price = $i * 200;
                $models->simple_location = 'citayam';
                $models->latitude = '-6.448703561458972';
                $models->longitude = '106.80243443934127';
                $models->price = $i * 1500;
            }
            
            $models->thumbnail = '';
            $models->excerpt = 'ini excerpt dari title ' . $i;
            $models->description = 'bla bla bla bla bla bla bla bla bla bla bla bla';
            $models->maps = '';
            $models->save();
        }
    }
}

/* 
    SELECT * FROM `comment` INNER JOIN users ON users.id = comment.users_id INNER JOIN profile on profile.users_id = comment.users_id WHERE taman_wisata_id = 1
    SELECT * FROM taman_wisata c WHERE c.price < 50000 AND NOT EXISTS ( SELECT * FROM taman_wisata c1 WHERE c1.price < c.price AND c1.rating LIKE '%bagus%' AND ( c1.price < c.price ) )
    SELECT * FROM taman_wisata WHERE taman_wisata.simple_location = 'sawangan' AND NOT EXISTS ( SELECT * FROM taman_wisata WHERE taman_wisata.simple_location = 'sawangan' AND taman_wisata.price > 0 AND taman_wisata.rating LIKE '%bagus%' )
    // SELECT * FROM taman_wisata WHERE price IN (SELECT MAX(price) FROM taman_wisata)
*/


/*
DB::table('tib_db.tb_request')
->join('tib_db.tb_cob', 'tib_db.tb_request.cob_code', '=', 'tib_db.tb_cob.id')
->join('tib_client.tb_client', 'tib_db.tb_request.client_id', '=', 'tib_client.tb_client.id')
->join('tib_db.tb_events_log', 'tib_db.tb_request.id', '=', 'tib_db.tb_events_log.req_id')
->join('tib_db.tb_events', 'tib_db.tb_events_log.event_id', '=', 'tib_db.tb_events.id')
->select('tib_db.tb_request.*', 'tib_db.tb_cob.cob_code', 'tib_client.tb_client.name', 'tib_db.tb_events.event_name', 'tib_db.tb_events_log.event_id')   
->get();

$DataTaman = DB::table('taman_wisata')
    ->where('title', 'like', '%' . $Query . '%')
    ->orWhere('excerpt', 'like', '%' . $Query . '%')
    ->orWhere('description', 'like', '%' . $Query . '%')
    ->simplePaginate(20);

echo json_encode($DataTaman);

SELECT * FROM taman_wisata tw1
    WHERE ( 
        tw1.title LIKE '%%'
        OR tw1.excerpt LIKE '%%'
        OR tw1.description LIKE '%%'
    )
    AND tw1.rating LIKE '%%'
    AND tw1.simple_location LIKE '%nusantara%'
    AND tw1.latitude LIKE '%%'
    AND tw1.longitude LIKE '%%'
    AND tw1.price > 0
    AND tw1.price < 50000
    AND NOT EXISTS (
        SELECT  * FROM taman_wisata tw2
        WHERE (
            tw2.title LIKE '%%'
            OR tw1.excerpt LIKE '%%'
            OR tw1.description LIKE '%%'
        )
        AND tw2.rating LIKE '%%'
        AND tw2.simple_location LIKE '%nusantara%'
        AND tw2.latitude LIKE '%%'
        AND tw2.longitude LIKE '%%'
        AND tw2.price >= tw1.price
        AND tw2.price <= tw1.price
        AND ( 
            tw2.price < tw1.price 
            OR tw2.price > tw1.price
        )
    )


    SELECT * FROM taman_wisata tw1
        WHERE ( 
            tw1.title LIKE '%%'
            OR tw1.excerpt LIKE '%%'
            OR tw1.description LIKE '%%'
        )
        AND tw1.rating LIKE '%%'
        AND tw1.jarak >= 0
        AND tw1.simple_location LIKE '%%'
        AND tw1.latitude LIKE '%%'
        AND tw1.longitude LIKE '%%'
        AND tw1.price >= 0
        AND tw1.price <= 50000
        AND NOT EXISTS (
            SELECT  * FROM taman_wisata tw2
                WHERE (
                    tw2.title LIKE '%%'
                    OR tw1.excerpt LIKE '%%'
                    OR tw1.description LIKE '%%'
                )
            AND tw2.rating LIKE '%%'
            AND tw2.jarak >= 0
            AND tw2.simple_location LIKE '%%'
            AND tw2.latitude LIKE '%%'
            AND tw2.longitude LIKE '%%'
            AND tw2.price >= tw1.price
            AND tw2.price <= tw1.price
            AND ( 
                tw2.price < tw1.price 
                OR tw2.price > tw1.price
            )
        )
        ORDER BY rating asc

    SELECT * FROM taman_wisata tw1
        WHERE ( 
            tw1.title LIKE '%%'
            OR tw1.excerpt LIKE '%%'
            OR tw1.description LIKE '%%'
        )
        AND tw1.rating <= 5
        AND tw1.jarak >= 0
        AND tw1.jarak <= 10000000
        AND tw1.simple_location LIKE '%%'
        AND tw1.latitude LIKE '%%'
        AND tw1.longitude LIKE '%%'
        AND tw1.price >= 0
        AND tw1.price <= 50000
        AND NOT EXISTS (
            SELECT  * FROM taman_wisata tw2
            WHERE (
                tw2.title LIKE tw1.title
                OR tw2.excerpt LIKE tw1.excerpt
                OR tw2.description LIKE tw1.description
            )
            AND tw2.rating <= tw1.rating
            AND tw2.jarak <= tw1.jarak
            AND tw2.simple_location LIKE tw1.simple_location
            AND tw2.latitude LIKE tw1.latitude
            AND tw2.longitude LIKE tw1.longitude
            AND tw2.price >= tw1.price
            AND tw2.price <= tw1.price
            AND ( 
                tw2.price < tw1.price 
                OR tw2.price > tw1.price 
                OR tw2.rating < tw1.rating
                OR tw2.jarak < tw1.jarak
            )
        )
        ORDER BY rating asc
*/