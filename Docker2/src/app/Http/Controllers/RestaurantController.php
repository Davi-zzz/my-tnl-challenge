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
        if(session()->has('token')){
            $token = session()->get('token');
            $data = Http::withHeaders(['Accept' => 'application/json', "Authorization" => "Bearer {$token}"])
            ->get('http://localhost:8081/api/auth/restaurant')->json();
            return view('index', \compact('data'));
        }
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
        if(session()->has('token')){

            return view('restaurant.create');
        }
        return redirect()->route('index');
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
        $user_id = session()->get('user_id');
        $data = Http::withHeaders(['Accept' => 'application/json', "Authorization" => "Bearer {$token}"])
        ->post('http://localhost:8081/api/auth/restaurant', [
            "name"=> $req['name'],
            "cnpj"=> $req['cnpj'],
            "phone"=> $req['phone'],
            "address"=> $req['address'],
            "zip_code"=> $req['zip_code'],
            "location"=> $req['location'],
            "state"=> $req['state'],
            "created_by" => $user_id
        ]);
        $error = $data['message'];
        if(!$data->failed()){

            return back()->withStatus('Restaurante Adicionado com Sucesso');
        }
        return back()->withError('Não foi possível salvar o item'+$error);

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
            if(session()->has('token')){
                $token = session()->get('token');
                $item = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => "Bearer {$token}"])
                ->get("http://localhost:8081/api/auth/restaurant/{$id}")->json();
                // dd($item);
                return view('restaurant.show', compact('item'));
            }
                $item = Http::get("http://localhost:8081/api/restaurant/{$id}")->json();
                if((isset($item['error']) && $item['error'] == true) || $item['data'] == null) {
                return redirect()->route('index')->withError('O Estabelecimento não existe!');
            }
            return view('restaurant.show', compact('item'));
        }
        catch(Exception $e){
            return redirect()->route('index')->withError($e->getMessage());
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
        $token = session()->get('token');
        $result = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => "Bearer {$token}"])
        ->get("http://localhost:8081/api/auth/restaurant/{$id}");
        if (isset($result['data'])){
            $item = $result['data'];
            return view('restaurant.edit', compact('item'));
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
        $result = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => "Bearer {$token}"])
        ->put("http://localhost:8081/api/auth/restaurant/{$id}", [
            'name' => $req->name,
            'cnpj' => $req->cnpj,
            'phone' => $req->phone,
            'address' => $req->address,
            'zip_code' => $req->zip_code,
            'location' => $req->location,
            'state' => $req->state,
            'status' => $req->status,
        ])->json();
        if($result['error'] == true){
            $cause = json_encode($result['data']);
            return back()->withError("Erro: {$result['message']}, Causa: {$cause}");
        }
            return redirect()->route('index')->withStatus($result['message']);
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
        ->delete("//localhost:8081/api/auth/restaurant/{$id}")->json();
        if ($result['error'] == false){
            return redirect()->route('index')->withStatus($result['message']);
        }
            return back()->withError($result['message']);
    }
}
