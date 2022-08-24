<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\CompanyDataTable;
use Yajra\DataTables\Html\Builder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $company = Company::paginate(5);
        return view('blog.list',compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('blog.create');
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
            'name' => 'required|min:3|max:45',
            'email' => 'required|email|unique:company',
            'website' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100'
            // 'logo' => 'required',
            // |dimensions:min_width=100,min_height=100
        );
        $messages = [
            'name.required' => 'Please Enter Company Name.',
            'email.required' => 'Please Enter Email.',
            'website.required' => 'Please Enter Website.',
            'logo.required' => 'Please Upload Company Logo.',
            'logo.dimensions' => 'Please Upload Company Logo Of Min 100 * 100 px',
            
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        // dd($validator->fails());
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        } else {

                $blog = new Company();
                $blog->name = $request['name'];
                $blog->email = $request['email'];
                $blog->website = $request['website'];
                $blog->status = '1';

            }
            if(!empty($request->logo) || $request->logo != ''){

                $file = $request->file('logo');
                $file->getClientOriginalName();
                $fileExtension = $file->getClientOriginalExtension();           
                $file->getRealPath();
                $file->getSize();
                $file->getMimeType();

                $fileName = md5(microtime() . Str::random(10)) . '.' . $fileExtension;
                $destinationPath = base_path().'/storage/app/public/logo/';

                $file->move(base_path('/storage/app/public/logo/'), $fileName);
                $blog->logo = $fileName;
                $image = url('/').'/storage/app/public/logo/'.$fileName;

            }else{
                $image='';
            }

            if ($blog->save()) {

                \Mail::to('admin@admin.com')->send(new \App\Mail\NewCompanyMail($blog));

                Session::flash('message', 'New Company added succesfully !');
                Session::flash('alert-class', 'success');
                return redirect('admin/company');

            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect('admin/company');
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
        $blog = Company::find($id);
        if(!empty($blog)){

            return view('blog.view')->with(compact('blog'));
        }else{
            Session::flash('message', 'Company not found!');
            Session::flash('alert-class', 'error');
            return redirect('admin/company');
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
        $blog = Company::find($id);
        // dd($blog);
        if(!empty($blog)){
            return view('blog.edit')->with(compact('blog'));
        }
        else{
            Session::flash('message', 'Company not found!');
            Session::flash('alert-class', 'error');
            return redirect('admin/company');
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
        // dd($request->all());
       $rules = array(
            'name' => 'required|min:3|max:45',
            'email' => 'required|email|unique:company,email,'.$id.',id',
            'website' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100'
            // 'logo' => 'required',
            // |dimensions:min_width=100,min_height=100
        );
        $messages = [
            'name.required' => 'Please Enter Company Name.',
            'email.required' => 'Please Enter Email.',
            'website.required' => 'Please Enter Website.',
            'logo.required' => 'Please Upload Company Logo.',
            'logo.dimensions' => 'Please Upload Company Logo Of Min 100 * 100 px',
            
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        } else {

                $blog = Company::find($id);
                $blog->name = $request['name'];
                $blog->email = $request['email'];
                $blog->website = $request['website'];
            }


            if(!empty($request->logo) || $request->logo != ''){
                $file = $request->file('logo');
                $file->getClientOriginalName();
                $fileExtension = $file->getClientOriginalExtension();           
                $file->getRealPath();
                $file->getSize();
                $file->getMimeType();

                $fileName = md5(microtime() . Str::random(10)) . '.' . $fileExtension;
                $destinationPath = base_path().'/storage/app/public/logo/';

                $file->move(base_path('/storage/app/public/logo/'), $fileName);
                $blog->logo = $fileName;
                $image = url('/').'/storage/app/public/logo/'.$fileName;
            }else{
                $image='';
            }


            if ($blog->save()) {
                Session::flash('message', 'Company Updated succesfully !');
                Session::flash('alert-class', 'success');
                return redirect('admin/company');

            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect('admin/company');
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

            $user = Company::find($id);

            if($user->delete())
            {
                 return true;
            }
             else
                return 'Something went to wrong';
        }
    }

    public function changeStatus(Request $request)
    {
        return $this->UpdateStatus($request->id,Company::class,'status');
    }
}
