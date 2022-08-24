<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use App\Http\Controllers\Controller;
use App\DataTables\EmployeeDataTable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder, EmployeeDataTable $dataTable)
    {
        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id','title' => 'ID'],
            ['data' => 'name', 'name' => 'name','title' => 'Full Name'],
            ['data' => 'email', 'name' => 'email','title' => 'Email'],
            ['data' => 'user_mobile', 'name' => 'user_mobile','title' => 'Mobile Number'],
             ['data' => 'company_id', 'name' => 'company_id','title' => 'Company Name'],
            ['data' => 'status', 'name' => 'status','title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at','title' => 'Scaned At'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false,'title' => 'Action'],
        ])->parameters([
            'order' => [0,'desc'],
        ]);
        $employee = Employee::with('companyData')->get();
        if(request()->ajax()) {
            return $dataTable->dataTable($employee)->toJson();
        }
        return view('employee.list',compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Company::where('status','1')->get();
        return View('employee.create',compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',  
            'last_name' => 'required',  
            'company_id' => 'required',        
            'email' => 'required|email|unique:employee',
            'user_mobile' => 'required|numeric|unique:employee',
        );
        $messages = [
            'name.required' => 'Please enter name.',
            'user_mobile.required' => 'Please enter mobile number.',
            'user_mobile.numeric' =>'Please enter at least 10 -15 digits.' ,
            'user_mobile.unique' =>'Please enter another mobile number.',
            'email.required' =>'Please enter email.',
            'email.unique' => 'Provided email is already registered with us.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        } else {

            $employee = new Employee();
            $employee->first_name = $request['name'];
            $employee->last_name = $request['last_name'];
            $employee->email = $request['email'];
            $employee->company_id = $request['company_id'];
            $employee->country_code = isset($request['country_code']) ? '+'.str_replace('+','',$request['country_code']) : '+91';
            $employee->user_mobile = $request['user_mobile'];
             $employee->status = '1';
        }

            if ($employee->save()) {
                Session::flash('message', 'Employee added succesfully !');
                Session::flash('alert-class', 'success');
                return redirect('admin/employee');

            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect('admin/employee');
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
        $employee = Employee::with('companyData')->find($id);
        if(!empty($employee)){
            return view('employee.view')->with(compact('employee'));
        }else{
            Session::flash('message', 'Employee not found!');
            Session::flash('alert-class', 'error');
            return redirect('admin/employee');
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
        $employee = Employee::find($id);
        if(!empty($employee)){
            $company = Company::where('status','1')->get();
            return view('employee.edit')->with(compact('employee','company'));
        }
        else{
            Session::flash('message', 'Employee not found!');
            Session::flash('alert-class', 'error');
            return redirect('admin/employee');
        }
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
        $rules = array(
            'name' => 'required',  
            'last_name' => 'required',  
            'company_id' => 'required',        
            'user_mobile' => 'required|numeric|unique:employee,user_mobile,'.$id,
            'email' => 'required|email|unique:employee,email,'.$id,
        );
        $messages = [
            'name.required' => 'Please enter name.',
            'user_mobile.required' => 'Please enter mobile number.',
            'user_mobile.numeric' =>'Please enter at least 10 -15 digits.' ,
            'user_mobile.unique' =>'Please enter another mobile number.',
            'email.required' =>'Please enter email.',
            'email.unique' => 'Provided email is already registered with us.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $employee = Employee::find($id);
            $employee->first_name = $request['name'];
            $employee->last_name = $request['last_name'];
            $employee->email = $request['email'];
            $employee->company_id = $request['company_id'];
            $employee->country_code = isset($request['country_code']) ? '+'.str_replace('+','',$request['country_code']) : '+91';
            $employee->user_mobile = $request['user_mobile'];
            if ($employee->save()) {
                Session::flash('message', 'Employee Updated Succesfully !');
                Session::flash('alert-class', 'success');
                return redirect('admin/employee');
            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect('admin/employee');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(isset($id)){
            $employee = Employee::find($id);
            if($employee->delete())
            {
                 return true;
            }
             else
                return 'Something went to wrong';
        }
    }

    public function changeStatus(Request $request)
    {
        return $this->UpdateStatus($request->id,Employee::class,'status');
    }

    public function emailExsist(Request $request){
        // dd("hello");
        if(isset($request->type) && $request->type == '1'){
            // for update
            $user = Employee::where('id','<>',$request->id)->where('email','=',$request->email)->where('user_status','!=','-1')->first();
            if(!empty($user)){
                echo "false";
            }else{
                echo "true";
            }
        }else{
            $user = Employee::where('email','=',$request->email)->first();
            // dd($user);
            if(!empty($user)){
                echo "false";
            }else{
                echo "true";
            }
        }
    }
    public function mobilenumberExsist(Request $request){
        // dd('hello');
        if(isset($request->type) && $request->type == '1'){
            // for update
            $user = Employee::where('id','<>',$request->id)->where('user_mobile','=',$request->user_mobile)->where('user_status','!=','-1')->first();
            if(!empty($user)){
                echo "false";
            }else{
                echo "true";
            }
        }else{
            $user = Employee::where('user_mobile','=',$request->user_mobile)->first();
            if(!empty($user)){
                echo "false";
            }else{
                echo "true";
            }
        }

    } 
}
