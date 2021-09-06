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
    public function index($id)
    {
        //
        $token = session()->get('token');
        $data = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => "Bearer {$token}"])
        ->get("http://localhost:8081/api/auth/dishe?menu_id{$id}");
        dd($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        //
        $menu_id = $req->menu_id;
        return view('dishes.create', compact('menu_id'));
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
        $token = session()->get('token');
        $result = Http::withHeaders(['Accep' => 'application/json', 'Authorization' => "Bearer {$token}"])
        ->post('http://localhost:8081/api/auth/dishes', [
            'menu_id' => $req->menu_id,
            'name' => $req->name,
            'description' => $req->description,
            'type' => $req->type,
            'category' => $req->category,
            'status' => $req->status
        ]);
        if ($result->json()['error'] == false){
            return back()->withStatus($result->json()['message']);
        }
        return back()->withError($result->json()['message']);
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
        $token = session()->get('token');
        $item = Http::withHeaders(['Accept' => 'application/json','Authorization' => "Bearer {$token}"])
        ->get("http://localhost:8081/api/auth/dishes/{$id}");
        if (!$item->failed() || $item['error'] != true) {
            $item = $item['data'];
            return view('dishes.edit', compact('item'));
        }
        return back()->withError($item->json()['message']);
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
        if($item['error'] == false){

            return redirect()->route('index')->withStatus($item['message']);
        }
            return back()->withError($item['error']);
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
        if ((isset($result['error']) != true) || $result['message'] == 'Deletado com Sucesso') {
            $sucess = $result['message'];
            return back()->withStatus($sucess);
        }
        $error = $result['message'];
        return back()->withError($error);
    }
}
