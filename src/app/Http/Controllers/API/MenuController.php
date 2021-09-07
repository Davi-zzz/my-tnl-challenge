<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MenuController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Erro de validação', $validator->errors(), 213);
        }
        $data = Menu::where('restaurant_id', $request->restaurant_id)->get();
        return $this->sendResponse($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'restaurant_id' => 'required|exists:restaurants,id',
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Erro de validação', $validator->errors(), 213);
            }
            $result = Menu::where('restaurant_id', $request->restaurant_id, function($query){
                $query->where('status', 1)->get();
            })->get();
            if(count($result) >= 3){
                return $this->sendResponse([], "⚠ Este Restaurante já tem 3 menus ativos!, 
                desative ou exclua um antes de adicionar um novo! ⚠");
            }
            $item = Menu::create($request->all());

            return $this->sendResponse([], "Menu Criado com Sucesso");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), "Erro ao Salvar menu", 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Menu::with('dishes')->findOrFail($id);
        return $this->sendResponse($item);
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
        try {
            $validator = Validator::make($request->all(), [
                'restaurant_id' => 'required|exists:restaurants,id',
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Erro de validação', $validator->errors(), 213);
            }
            if($request->status == 1){

                $result = Menu::where('restaurant_id', $request->restaurant_id, function($query){
                    $query->where('status', 1)->get();
                })->get();
    
                if(count($result) >= 3){
                    return $this->sendResponse([], "⚠ Este Restaurante já tem 3 menus ativos!, 
                    desative ou exclua um antes de adicionar um novo! ⚠");
                }
            }
            $item = Menu::findOrFail($id);
            $item->fill($request->all())->save();

            return $this->sendResponse([], "Menu Salvo com Sucesso");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), "Erro ao Salvar menu", 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //TODO: Verificar se o Restaurante pertence ao usuario
    public function destroy($id)
    {
        try {
            $item = Menu::findOrFail($id);
            $item->delete();
            return $this->sendResponse([], 'Deletado com Sucesso');
        } catch (Exception $e) {
            return $this->sendError($e, $e->getMessage(), 500);
        }
    }
}
