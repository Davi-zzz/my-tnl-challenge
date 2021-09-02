<?php

namespace App\Http\Controllers;

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
        //
        try {
            //code...
            $data = Restaurant::all();
            return $this->sendResponse($data);
        } catch (\Exception $e) {
            //throw $th;
            return $this->sendError($e);
        }
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
        //
        
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        //
        try{

            $forms = Validator::make($req->all(), [
                'name' => 'required|min:5',
                'cnpj'=> 'required|min:18',
                'phone'=> 'required|min:14',
                'address'=> 'required',
                'zip_code'=> 'required|min:9',
                'location'=> 'required|',
                'state'=> 'required',
                // 'reponsible_id' => , //TODO resolver logica mais late
            ]);
            $item = Restaurant::create([$forms]);
            return $this->sendResponse($item, 'sucess', 201);
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
    public function show(Request $req)
    {
        //
        $id = Validator::make($req->all(),[
            'id' => 'required'
        ]);
        $item = Restaurant::where('id', $id)->first();
        isset($item) ? $msg = 'sucess' && $code = 200 : $msg = 'this restaurant does not exist!' && $code = 404;
        return $this->sendResponse($item, $msg, $code);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    // public function edit(Restaurant $restaurant)
    // {
        //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        //TODO fazer update
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        //
        //TODO  fazer destroy
        try {
            //code...
            $id = Validator::make($req->all(), ['id' => 'required']);
            $item = Restaurant::destroy($id);
            isset($item) ? $msg = 'sucess' && $code = 200 : $msg = 'this restaurant does not exist!' && $code = 404;
            return $this->sendResponse($item, $msg, $code);
        } catch (\Exception $e) {
            //throw $th;
            return $this->sendError($e, $e->getMessage(), 500);
        }
    }
}
