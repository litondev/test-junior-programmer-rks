<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Http\Requests\LocationRequest;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $location = new Location();

        $location = $location->orderBy(request()->order_by ?? 'code',request()->order ?? 'asc')
            ->paginate(10);

        return view("location.index",compact("location"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = null;

        return view("location.form",compact("location"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        try{
            \DB::beginTransaction();

            Location::create($request->validated());

            \DB::commit();
            return redirect()
                ->route("location.index")
                ->with([
                    "fallback" => [
                        "status" => "success",
                        "message" => "Success"
                    ]
                ]);
        }catch(\Exception $e){            
            \DB::rollback();
            return back()->with([
                "fallback" => [
                    "status" => "failed",
                    "message" => "Something Wrong"
                ]
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        return view("location.form",compact("location"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequest $request, Location $location)
    {
        try{
            \DB::beginTransaction();

            $location->update($request->validated());

            \DB::commit();
            return back()->with([
                "fallback" => [
                    "status" => "success",
                    "message" => "Success"
                ]
            ]);
        }catch(\Exception $e){
           \DB::rollback();
            return back()->with([
                "fallback" => [
                    "status" => "failed",
                    "message" => "Something Wrong"
                ]
            ]);       
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        try{
            \DB::beginTransaction();

            $location->delete();

            \DB::commit();
            return back()->with([
                "fallback" => [
                    "status" => "success",
                    "message" => "Success"
                ]
            ]);
        }catch(\Exception $e){
            \DB::rollback();
            return back()->with([
                "fallback" => [
                    "status" => "failed",
                    "message" => "Something Wrong"
                ]
            ]);
        }
    }
}
