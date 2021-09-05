<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class DisheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        dd('aki');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('dishes.create');
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
        dd('aki 2');
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
        dd('aki 3');
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
        $token = session()->get('token');
        $item = Http::withHeaders(['Accept' => 'application/json','Authorization' => "Bearer {$token}"])
        ->get("http://localhost:8081/api/auth/dishes/{$id}");
        if(!$item->failed() || $item['error'] != true){
            $item = $item['data'];
            return view('dishes.edit', compact('item'));
        }
        return redirect()->route('index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        //

            $token = session()->get('token');
            $item = Http::withHeaders(['Accept' => 'application/json','Authorization' => "Bearer {$token}"])
            ->put("http://localhost:8081/api/auth/dishes/{$id}", [
                'name' => $req->name,
                'menu_id' => $req->menu_id,
            'description' => $req->description,
            'type' => $req->type,
            'category' => $req->category,
            'status' => $req->status
        ]);
            dd($item->body());
        return redirect()->route('index');
    
        
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
        $token = session()->get('token');
        $link = 'http://localhost:8081';
        $result = Http::withHeaders(['Accept' => 'application/json','Authorization' => "Bearer {$token}"])
        ->delete("{$link}/api/auth/dishes/{$id}")->json();
        if ((isset($result['error']) != true) || $result['message'] == 'Deletado com Sucesso'){
            $sucess = $result['message'];
            return view('index', compact('sucess'));
        }   
        $error = $result['message'];
        return view('index', compact('error'));
    }
}
