<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MenuController extends Controller
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
    public function create(Request $req)
    {
        //
        $item['data']['restaurant_id'] = $req->restaurant_id;
        return view('menu.create', compact('item'));
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
        ->post('http://localhost:8081/api/auth/menu', [
            'restaurant_id' => $req->restaurant_id,
            'name' => $req->name,
            'status'=> $req->status
        ]);
        if ($result->json()['error'] == false){
            return back()->withStatus($result->json()['message']);
        }
            return redirect()->route('index')->withError($result->json()['message']);

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
        ->get("http://localhost:8081/api/auth/menu/{$id}")->json();
        if ($item['error'] != true) {
            return view('menu.edit', compact('item'));
        }
        return back()->withError($item['message']);
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
        ->put("http://localhost:8081/api/auth/menu/{$id}",[
            "restaurant_id" => $req->restaurant_id,
            "name" => $req->name,
            "status" => $req->status
        ])->json();
        if ($item['error'] != true) {
            return back()->withStatus($item['message']);
        }
        return back()->withError('Erro'+json_encode($item['data']));
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
        $result = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => "Bearer {$token}"])
        ->delete("//localhost:8081/api/auth/menu/{$id}");

        if($result->json()['error'] == false){
            return back()->withStatus($result['message']);
        }
            return back()->withErro($result->json()['error']);
    }
}
