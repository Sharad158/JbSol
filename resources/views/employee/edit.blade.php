
@extends('layouts.app')
@section('title') Update Employee | @endsection

@section('content')

<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Update Employee</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item "><a href="{{url('admin/dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Update Employee
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
                                <h4 class="card-title">Update Employee</h4>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" id="empForm" action="{{url('admin/employee').'/'.$employee->id}}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                   <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label  class="control-label" for="name">First Name <span class="colorRed"> *</span></label>
                                                <div class=" jointbox">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="@if(!empty(old('name'))){{old('name')}}@else{{$employee->first_name}}@endif"/>
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
                                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="@if(!empty(old('last_name'))){{old('last_name')}}@else{{$employee->last_name}}@endif"/>
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
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="@if(!empty(old('email'))){{old('email')}}@else{{$employee->email}}@endif"/>
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
                                                            <option @if($row->id == $employee->company_id) selected @endif value="{{$row->id}}">{{$row->name}}</option>
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
                                                <label for="testimonialName" class=" control-label">Mobile No</label>
                                                <div class="">
                                                    <div class="" style="padding-right:0px;">
                                                        <input type="text" class="form-control" id="user_mobile" name="user_mobile" placeholder="Mobile No" value="{{!empty($employee->user_mobile)?$employee->country_code.''.$employee->user_mobile:old('user_mobile')}}" />
                                                        @if ($errors->has('user_mobile'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('user_mobile') }}</strong>
                                                            </span>
                                                        @endif
                                                        <span id="mobileValidate"></span>
                                                    </div>
                                                </div>
                                                <input type="hidden" class="form-control" id="country_code" name="country_code" value="{{!empty($employee->country_code)?$employee->country_code:old('country_code')}}" />
                                                @if(isset($employee->id) && !empty($employee->id))
                                                    <input type="hidden" class="form-control" id="phone_number" name="phone_number" value="<?php echo '+'.$employee->country_code.''.$employee->user_mobile?>" />
                                                @endif
                                            </div>
        
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="padding:20px">
                                        <div class="col-sm-12">
                                            <div class="" style="border-top:0">
                                                <div class="box-footer">
                                                    <span class="help-block"> <span class="colorRed"> *</span> mentioned fields are mandatory.</span>
                                                    <button type="submit" id="updateBtn" class="btn btn-primary pull-right" style="margin-left: 20px;float:right;">Update</button>
                                                    <button type="button" class="btn btn-info pull-right" id="cancelBtn" style="float:right;">Back</button>
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
    $("#cancelBtn").click(function () {
        window.location.href = "{{url('admin/employee')}}";
    });
$(document).ajaxStart(function() { Pace.restart(); });
 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    $.validator.addMethod("email", function(value, element) {
        return /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
    }, "Please enter valid email.");

    $(document.body).on('click', "#updateBtn", function(){
        var id = "{{$employee->id}}";
        if ($("#empForm").length){
            $("#empForm").validate({
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

    var SITE_URL = "<?php echo URL::to('/'); ?>";

$(document).ready(function() {
    $("#company_id").select2({
        placeholder: "Select a Company",
        allowClear: true,
    });
});
</script>

<script type="text/javascript">

    // End upload preview image
    $(function() {
        @if(!isset($employee->id) || empty($employee->id))
            $("#country_code").val('1');
        @endif
        $("#user_mobile").intlTelInput({
            separateDialCode: true,
            @if(!isset($employee->country_code) || empty($employee->country_code))
                initialCountry: 'jo'
            @endif
        });
        $("#user_mobile").on("countrychange", function(e, countryData) {
            var countryData = $("#user_mobile").intlTelInput("getSelectedCountryData");
            $("#country_code").val(countryData.dialCode);
        });
    });
</script>
@endsection