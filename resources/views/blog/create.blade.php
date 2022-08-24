@extends('layouts.app')
@section('title') Create Company | @endsection
@section('css')
<style>
    .red{
        color:#cc0000;
    }
</style>
@endsection
@section('content')

<div class="app-content content" >
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Create Company</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                {{-- <li class="breadcrumb-item "><a href="{{url('admin/dashboard')}}">Dashboard</a>
                                </li> --}}
                                <li class="breadcrumb-item active">Create Company
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
                                <h4 class="card-title">Create Company</h4>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" id="userForm" role="form" action="{{url('admin/company')}}" method="post" enctype="multipart/form-data" >
                                @csrf
                                    <div class="media mb-2 col-md-6 offset-3">
                                        <img src=" {{  URL::asset('/resources/assets/img/default.png')}} " class="gambar old_profile_imageSub user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" id="item-img-output"  name="avatar" style="object-fit: cover;" height="90" width="90"/>
                                        <div class="media-body mt-50">
                                            <div class="d-flex mt-1 px-0">
                                                {{-- <label class="btn btn-primary mr-75 mb-0" for="change-picture"> --}}
                                                    {{-- <input type="hidden" name="main_image" value="" id="main_image" style=""> --}}
                                                    {{-- <span class="d-none d-sm-block">Change</span> --}}
                                                    <input type="file" accept="image/png, image/jpeg, image/jpg" class="item-img file form-control " name="logo" id="logo" />
                                                {{-- </label> --}}
                                            </div>
                                            @if ($errors->has('logo'))
                                                <span class="red">
                                                    <strong>{{ $errors->first('logo') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        {{-- <div class="form-group {{ $errors->has('main_image') ? ' has-error' : '' }}">
                                            <div class="vc_column-inner ">
                                                <div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog  ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">
                                                            </div>
                                                            <div class="modal-body">
                                                                <div id="upload-demo" class="center-block"></div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-default" id="Flip">Flip</button>
       
                                                                <button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 offset-3">
                                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label  class="control-label" for="name">Company Name <span class="colorRed"> *</span></label>
                                                <div class=" jointbox">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{old('name')}}"/>
                                                    @if ($errors->has('name'))
                                                        <span class="red">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-sm-6 offset-3">
                                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label  class="control-label" for="email">Company Email <span class="colorRed"> *</span></label>
                                                <div class=" jointbox">
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Name" value="{{old('email')}}"/>
                                                    @if ($errors->has('email'))
                                                    <span class="red">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 offset-3">
                                            <div class="form-group {{ $errors->has('website') ? ' has-error' : '' }}">
                                                <label  class="control-label" for="website">Company Website <span class="colorRed"> *</span></label>
                                                <div class=" jointbox">
                                                    <input type="text" class="form-control" id="website" name="website" placeholder="Name" value="{{old('website')}}"/>
                                                    @if ($errors->has('website'))
                                                    <span class="red">
                                                        <strong>{{ $errors->first('website') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
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

@section('css')
    <style>
        /* .card{
            margin: 0px 100px;
        } */
    </style>
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
     var SITE_URL = "<?php echo URL::to('/'); ?>";
    $(document.body).on('click', "#createBtn", function(){
        if ($("#userForm").length){
            $("#userForm").validate({
            errorElement: 'span',
                    errorClass: 'text-red text-danger',
                    ignore: [],
                    rules: {
                    //   "name":{
                    //       required:true,
                    //       minlength: 2,
                    //       maxlength: 20
                    //   },
                    //   "email":{
                    //       required:true,
                    //   },
                    //  "website":{
                    //       required:true,
                    //   },
                    //   "logo":{
                    //         required:true,
                    //     },
                  },
                  messages: {
                        "name":{
                            required:"Please Enter Company Name.",
                        },
                        "email":{
                            required:"Please Enter Email",
                            email: true,
                        },
                        "website":{
                            required:"Please Enter Website",
                        },
                        "logo":{
                            required:"Please Enter Company Logo",
                        },
                    },
                    errorPlacement: function(error, element) {
                        if(element.is('select')){
                            error.appendTo(element.closest("div"));
                        }else{
                            error.insertAfter(element.closest(".form-control"));
                        }
                    },
            });
        }
    });

</script>

<script>
$(document).ajaxStart(function() { Pace.restart(); });
 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

</script>

<script>

$(document).ready(function() {
    $("#category_id").select2({
        placeholder: "Select a Category",
        allowClear: true,
    });
});
$("#cancelBtn").click(function () {
    window.location.href = "{{url('admin/company')}}";
});

</script>

<script>
    $(document).ready(function() {
        $('#logo').change(function(){
            const file = this.files[0];
            console.log(file);
            if (file){
            let reader = new FileReader();
            reader.onload = function(event){
                console.log(event.target.result);
                $('#item-img-output').attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection
