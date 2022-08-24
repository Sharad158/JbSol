@extends('layouts.app')
@section('title') Create Employee | @endsection

@section('content')

<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Create Employee</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item "><a href="{{url('admin/dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Create Employee
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
                                <h4 class="card-title">Create Employee</h4>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" id="userForm" role="form" action="{{url('admin/employee')}}" method="post" enctype="multipart/form-data" >
                                @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label  class="control-label" for="name">First Name <span class="colorRed"> *</span></label>
                                                <div class=" jointbox">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{old('name')}}"/>
                                                    @if ($errors->has('name'))
                                                    <span class="help-block alert alert-danger">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                             <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                                <label  class="control-label" for="last_name">Last Name <span class="colorRed"> *</span></label>
                                                <div class=" jointbox">
                                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{old('last_name')}}"/>
                                                    @if ($errors->has('last_name'))
                                                    <span class="help-block alert alert-danger">
                                                        <strong>{{ $errors->first('last_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
        
                                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label  class=" control-label" for="email">Email <span class="colorRed"> *</span></label>
                                                <div class="">
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{old('email')}}"/>
                                                    @if ($errors->has('email'))
                                                    <span class="help-block alert alert-danger">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
        
                                             
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('company_id') ? ' has-error' : '' }}">
                                                <label  class=" control-label" for="company_id">Company Name <span class="colorRed"> *</span></label>
                                                <div class="">
                                                    <select class="form-control select2" id="company_id" name="company_id">
                                                    {{-- <select id="company_id" name="company_id" class="form-control"> --}}
                                                        <option value="">Select company_id</option>
                                                        @foreach($company as $row)
                                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                                        @endforeach
                                                    </select>
        
                                                    @if ($errors->has('company_id'))
                                                    <span class="help-block alert alert-danger">
                                                        <strong>{{ $errors->first('company_id') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group {{ $errors->has('user_mobile') ? ' has-error' : '' }}">
                                                <label  class=" control-label" for="user_mobile">Mobile no <span class="colorRed"> *</span></label>
                                                <div class="">
                                                    <div class="" style="padding-right:0px;">
                                                    <input type="tel" maxlength="12" class="form-control padding" id="user_mobile" name="user_mobile" placeholder="Mobile number" value="{{old('user_mobile')}}"/>
                                                    @if ($errors->has('user_mobile'))
                                                    <span class="help-block alert alert-danger">
                                                        <strong>{{ $errors->first('user_mobile') }}</strong>
                                                    </span>
                                                    @endif
                                                    <span id="mobileValidate"></span>
                                                </div>
                                                <input type="hidden" class="form-control" id="country_code" name="country_code" value="+91" />
                                            </div> 
        
                                            {{-- <div class="form-group {{ $errors->has('vendor_id') ? ' has-error' : '' }}">
                                                <label  class=" control-label" for="vendor_id">Vendor</label>
                                                <select class="select2 form-control" multiple name="vendor_id[]" id="vendor_id">
                                                    @foreach($vendor as $data)
                                                        <option value="{{$data->id}}">{{$data->first_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="" style="border-top:0">
                                                <div class="box-footer">
                                                    <span class="help-block"> <span class="colorRed"> *</span> mentioned fields are mandatory.</span>
                                                    <button type="submit" id="createBtn" class="btn btn-primary pull-right" style="margin-left: 20px;float:right;">Create</button>
                                                    <button type="button" class="btn btn-info pull-right"  id="cancelBtn" style="float:right;">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
@section('script')
    @if(Session::has('message'))
        <script>
        $(function() {
            toastr.{{ Session::get('alert-class') }}('{{ Session::get('message') }}');
        });
        </script>
    @endif
<script>
    var today = new Date();
    $( '#dob' ).pickadate({
        max: new Date()
    });
</script>
<script>
var SITE_URL = "<?php echo URL::to('/'); ?>";
$.validator.addMethod("email", function(value, element) {
        return /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
    }, "Please enter valid email.");

    $(document.body).on('click', "#createBtn", function(){
        if ($("#userForm").length){
            $("#userForm").validate({
            errorElement: 'span',
                    errorClass: 'text-red text-danger',
                    ignore: [],
                    rules: {
                      "name":{
                          required:true,
                          minlength: 2,
                          maxlength: 20
                      },
                      "last_name":{
                          required:true,
                          minlength: 2,
                          maxlength: 20
                      },
                      "email":{
                        required:true,
                        email:true,
                        //   remote: {
                        //       url: SITE_URL + '/check-email-exsist',
                        //       type: "get"
                        //   }
                      },
                      "user_mobile":{
                        required:true,
                        number:true,
                        minlength:10,
                        maxlength:12,
                        //   remote: {
                        //       url: SITE_URL + '/check-number-exsist',
                        //       type: "get"
                        //   }
                      },                    
                      "company_id":{
                        required:true
                      },

                        
                  },
                  messages: {
                       "email":{
                            required:"Please enter email.",
                            remote:"Provided email already used by some one.",

                        },
                        "name":{
                            required:"Please enter first name.",
                        },
                        "last_name":{
                            required:"Please enter last name.",
                        },
                        "user_mobile":{
                            required:"Please enter mobile number.",
                            minlength: "Please enter at least 10 digits.",
                            maxlength: "Please do not enter more than 12 digits.",
                            remote:"Provided number has already been used by someone else.",
                        },                      
                        "company_id":{
                          required:"Please select company.",
                        },

                    },
                    errorPlacement: function(error, element) {
                      if(element.is('select')){
                            error.appendTo(element.closest("div"));
                        }else{
                            error.insertAfter(element.closest(".form-control"));
                        }
                        error.insertAfter(element.closest(".input-group"));
                      },
            });
        }
    });
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#company_id').on('change', function(){
        $("#company_id-error").hide();
    });
    $(document).ready(function() {
        $("#company_id").select2({
            placeholder: "Select a Company",
            allowClear: true,
        });
    });
    $("#cancelBtn").click(function () {
        window.location.href = "{{url('admin/employee')}}";
    });
    $(function() {
   
        $("#user_mobile").intlTelInput({
            separateDialCode: true,
            @if(!isset($user->country_code) || empty($user->country_code))
                initialCountry: 'in'
            @endif
        });
        $("#user_mobile").on("countrychange", function(e, countryData) {
            var countryData = $("#user_mobile").intlTelInput("getSelectedCountryData");
            $("#country_code").val(countryData.dialCode);
        });
    })
</script>
@endsection
