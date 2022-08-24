@extends('layouts.app')
@section('title')  Employee Details | @endsection
@section('css')
  {{-- <style>
    .card{
       margin:0px 50px;
    }
  </style> --}}
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">User Details</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item "><a href="{{url('admin/dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">User Details
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section class="bs-validation">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Employee Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-user-information">
                                      <tbody>
                                        <tr>
                                            <td><strong>Employee FullName</strong></td>
                                            <td class="text-primary">{{$employee->first_name.' '.$employee->last_name}}</td>
                                        </tr>

                                        <tr>
                                            <td><strong>Employee Email</strong></td>
                                            <td class="text-primary">{{$employee->email}}</td>
                                        </tr>

                                        <tr>
                                            <td><strong>Employee Phone</strong></td>
                                            <td class="text-primary">{{$employee->country_code.' '.$employee->user_mobile}}</td>
                                        </tr>

                                        <tr>
                                            <td><strong>Company Name</strong></td>
                                            <td class="text-primary">
                                                @if(isset($employee->companyData))
                                                    {{$employee->companyData->name}}
                                                @else 
                                                    {{ '-' }}
                                                @endif
                                        
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><strong>status</strong></td>
                                            <td class="text-white">
                                              
                                                @if($employee->status == '1')
                                                   <a class="badge badge-success">Success</a>
                                                @else
                                                <a class="badge badge-danger">DeActive</a>                                          
                                                @endif
                                              </a>
                                            </td>
                                        </tr>
                                        
                                      </tbody>
                                    </table>
                                    <div class="col-sm-12">
                                        <div class="" style="border-top:0">
                                            <div class="box-footer">
                                                <a type="" href="{{url('/admin/employee')}}" id="cancelBtn" class="btn btn-primary pull-right">
                                                  Back
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection
