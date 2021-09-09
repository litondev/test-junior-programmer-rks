<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
    Employee,
    Location 
};
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = new Employee();

        if(request()->filled("location")){
            $employee = $employee->where("location_code",request()->location);
        }

        if(request()->filled("birth_date_start") && request()->filled("birth_date_end")){
            $employee = $employee->whereBetween("birth_date",
                [
                    now()->parse(request()->birth_date_start)->toDateTimeString(),
                    now()->parse(request()->birth_date_end)->toDateTimeString()
                ]
            );
        }

        $employee = $employee->orderBy(request()->order_by ?? 'name',request()->order ?? 'asc')
            ->paginate(10);

        return view("employee.index",compact("employee"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = null;
        $employeeCode = Location::select('name','code')->get();    
        return view("employee.form",compact("employee","employeeCode"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        try{
            \DB::beginTransaction();

            Employee::create($request->validated());

            \DB::commit();
            return redirect()
                ->route("employee.index")
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
    public function edit(Employee $employee)
    {
        $employeeCode = Location::select('name','code')->get();    
        return view("employee.form",compact("employee","employeeCode"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        try{
            \DB::beginTransaction();

            $employee->update($request->validated());

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
    public function destroy(Employee $employee)
    {
        try{
            \DB::beginTransaction();

            $employee->delete();

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
