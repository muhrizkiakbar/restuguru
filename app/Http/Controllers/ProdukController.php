<?php

namespace App\Http\Controllers;

use App\CProduks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function dataproduk(){
        $term = Input::get('term');
	
        $results = array();
        
        $queries = CProduks::where('nama_produk', 'LIKE', '%'.$term.'%')
            ->limit(10)
            ->get();
        
            foreach ($queries as $query)
            {
                $results[] = [ 'id' => encrypt($query->id), 'value' => $query->nama_produk ];
            }

        return response()->json($results);

    } 

    public function produkcari(Request $request)
    {
        $term = trim($request->q);
        if (empty($term)) {
            return response()->json([]);
        }
        $tags = CProduks::where('nama_produk','LIKE','%'.$term.'%')->limit(5)->get();
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->nama_produk];
        }
        return response()->json($formatted_tags);
    }

    public function produkharga(Request $request){

        $table=CProduks::where('id','=',$request->id)
                ->first();

        return $table->harga_jual;
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
