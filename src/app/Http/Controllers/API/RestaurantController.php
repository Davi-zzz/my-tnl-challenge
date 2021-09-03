<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Restaurant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Restaurant::where('created_by',auth()->id())->get();
            return $this->sendResponse($data);
        } catch (\Exception $e) {
            return $this->sendError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requestuest
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:5',
                'cnpj'=> 'required|min:18',
                'phone'=> 'required|min:14',
                'address'=> 'required',
                'zip_code'=> 'required|min:9',
                'location'=> 'required',
                'state'=> 'required',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Erro de validação', $validator->errors(), 213);
            }          
            $inputs = $request->all();
            $inputs['created_by'] = auth()->id();
            $item = Restaurant::create($inputs);
            return $this->sendResponse([],'success', 201);
        }
        catch(Exception $e) {
            return $this->sendError($e, $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {   
        $item = Restaurant::findOrFail($id);
        return $this->sendResponse($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requestuest
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'cnpj'=> 'required|min:18',
            'phone'=> 'required|min:14',
            'address'=> 'required',
            'zip_code'=> 'required|min:9',
            'location'=> 'required',
            'state'=> 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Erro de validação', $validator->errors(), 213);
        }   
        $item = Restaurant::findOrFail($id);
        $item->fill($request->all())->save();
        return $this->sendResponse($item,'Item Atualizado com Sucesso');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $item = Restaurant::findOrFail($id);
            if($item->created_by == auth()->id()){
                $item->delete();
                return $this->sendResponse([],'Deletado com Sucesso');
            }
            return $this->sendError([],'Você não é dono deste restaurante');
        } catch (\Exception $e) {
            return $this->sendError($e, $e->getMessage(), 500);
        }
    }

}
