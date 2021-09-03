<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Dishe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DisheController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_id' => 'required|exists:menus,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Erro de validação', $validator->errors(), 213);
        }
        $data = Dishe::where('menu_id', $request->menu_id)->get();
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
                'menu_id' => 'required|exists:menus,id',
                'name' => 'required',
                'description' => 'required',
                'type' => 'required|integer',
                'category' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Erro de validação', $validator->errors(), 213);
            }

            $item = Dishe::create($request->all());
           
            return $this->sendResponse([], "Dishe Criado com Sucesso");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), "Erro ao Salvar dishe", 500);
            DB::rollBack();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dishe  $dishe
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Dishe::with('menu')->findOrFail($id);
        return $this->sendResponse($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dishe  $dishe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'menu_id' => 'required|exists:menus,id',
                'name' => 'required',
                'description' => 'required',
                'type' => 'required|integer',
                'category' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Erro de validação', $validator->errors(), 213);
            }
            DB::beginTransaction();

            $item = Dishe::findOrFail($id);
            $item->fill($request->all())->save();
            $item->dishes()->delete();

            DB::commit();
            return $this->sendResponse([], "Prato Criado com Sucesso");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), "Erro ao Salvar Prato", 500);
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dishe  $dishe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $item = Dishe::findOrFail($id);
            $item->delete();
            return $this->sendResponse([], 'Deletado com Sucesso');
        } catch (Exception $e) {
            return $this->sendError($e, $e->getMessage(), 500);
        }
    }
}
