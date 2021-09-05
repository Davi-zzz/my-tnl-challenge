<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data = Http::get('http://localhost:8081/api/')->json();
        return view('index', \compact('data'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('restaurant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        //
        $req = $req->all();
        $token = session()->get('token');
        $data = Http::withHeaders(['Accept' => 'application/json', "Authorization" => "Bearer {$token}"])
        ->post('http://localhost:8081/api/auth/restaurant', [
            "name"=> $req['name'],
            "cnpj"=> $req['cnpj'],
            "phone"=> $req['phone'],
            "address"=> $req['address'],
            "zip_code"=> $req['zip_code'],
            "location"=> $req['location'],
            "state"=> $req['state']
        ]);
        $error = $data['message'];
        if(!$data->failed()){

            return back()->withStatus('Restaurante Adicionado com Sucesso');
        }
        return redirect()->route('index')->withErrors($error);

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
        try{
            $item = Http::get("http://localhost:8081/api/restaurant/{$id}")->json();
            if((isset($item['error']) && $item['error'] == true) || $item['data'] == null) {
                abort(404);
            }
            return view('restaurant.show', compact('item'));
        }
        catch(Exception $e){
            return redirect()->route('index')->withErrors($e->getMessage());
        }
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
