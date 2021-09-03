<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class PublicController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listRestaurants()
    {
        //
        try {
            //code...
            $data = Restaurant::where('status', 1)->get();
            return $this->sendResponse($data);
        } catch (\Exception $e) {
            //throw $th;
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Show one restaurant by id
     *
     * @return \Illuminate\Http\Response
     */
    public function showRestaurant($id)
    {
        //
        try {
            //code...
            //using eager loader to get multiples relationship using conditionals
            $item = Restaurant::with(['menus' => function ($query){
                $query->with(['dishes' => function ($query){
                    $query->where('status', '=', 1)->get();
                }])->where('status', '=', 1);
            }])->find($id);
            $item  == '' || $item == null ? $message = 'this restaurant does not exist' : $message = 'sucess';
            return $this->sendResponse($item, $message);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
}
