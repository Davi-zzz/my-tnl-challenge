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
                'dishes' => 'required|array|max:10|min:1',
                'dishes.*.name' => 'required',
                'dishes.*.description' => 'required',
                'dishes.*.type' => 'required|integer',
                'dishes.*.category' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Erro de validação', $validator->errors(), 213);
            }
            DB::beginTransaction();

            $item = Menu::create($request->all());
            foreach ($request->dishes as $dish) {
                $item->dishes()->create($dish);
            }

            DB::commit();
            return $this->sendResponse([], "Menu Criado com Sucesso");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), "Erro ao Salvar menu", 500);
            DB::rollBack();
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
                'dishes' => 'required|array|max:10|min:1',
                'dishes.*.name' => 'required',
                'dishes.*.description' => 'required',
                'dishes.*.type' => 'required|integer',
                'dishes.*.category' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Erro de validação', $validator->errors(), 213);
            }
            DB::beginTransaction();

            $item = Menu::findOrFail($id);
            $item->fill($request->all())->save();
            $item->dishes()->delete();
            foreach ($request->dishes as $dish) {
                $item->dishes()->create($dish);
            }

            DB::commit();
            return $this->sendResponse([], "Menu Criado com Sucesso");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), "Erro ao Salvar menu", 500);
            DB::rollBack();
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
