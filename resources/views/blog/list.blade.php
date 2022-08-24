@section('title') {{trans('messages.Company')}} | @endsection
@extends('layouts.app')
@section('css')
  <style>
     /* .table{
      color:black;
     } */
  </style>
@endsection
@section('content')
{{-- <div class="app-content content" style=""> --}}
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">{{trans('messages.Company')}}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                {{-- <li class="breadcrumb-item "><a href="{{url('admin/dashboard')}}">Admin</a>
                                </li> --}}
                                <li class="breadcrumb-item active">{{trans('messages.Company')}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="">
                <div class="row">
                  <div class="col-12">
                      <div class="card">
                        <div class="card-header ">
                          <h3 class="card-title"><strong>{{trans('messages.Company')}}</strong></h3>
                          <div class="col-sm-12 pull-right  " style="padding-bottom: 10px;">
                                    
                            <a href="{{route('company.create')}}" class="float-right">
                              <button type="button" class="btn btn-primary waves-effect waves-float waves-light">{{trans('messages.new_company')}}</button>
                            </a>

                          </div>
                        </div>
      
                        <div class="card-body">
                          <div>
                            <table class="table table-bordered table-hover ">
                              <thead style="">
                                <tr>
                                  <th>{{trans('messages.ID')}}</th>
                                  <th>{{trans('messages.Company_Name')}}</th>
                                  <th>{{trans('messages.Company_Email')}}</th>
                                  <th>{{trans('messages.Website')}}</th> 
                                  <th>{{trans('messages.Status')}}</th>
                                  <th>{{trans('messages.Logo')}}</th>  
                                  <th>{{trans('messages.Action')}}</th>
                                </tr>
                              </thead>
                              <tbody>
                        
                              @if(count($company) > 0)
                                  @foreach ($company as $data)
                                      <tr>
                                        <td>{{$data['id']}}</td> 
                                        <td>{{$data['name']}}</td>
                                        <td>{{$data['email']}}</td>        
                                        <td>{{$data['website']}}</td>
                                        <td>
                                        <?php  
                                        $id = $data['id'];
                                        $status = $data->status;
                                        $class='text-danger';
                                        $label='Deactive';
                                        if($status==1)
                                        {
                                            $class='text-success';
                                            $label='Active';
                                        }

                                        ?>
                                          <span class="{{$class}} actStatus" id = "user{{$id}}" data-sid="{{$id}}">{{$label}}</span>
                                        </td>
                                        <td> 
                                          @if(isset($data['logo']))<img src="{{$data['logo']}}" alt="logo" width="100" height="100">
                                          @else
                                            {{ "-" }}
                                          @endif
                                        </td>
                                        <td>
                                          <?php $id = $data->id; ?>
             <a class="label label-success badge badge-light-success" href="{{route('company.edit',$id)}}"  title="Update"><i class="fa fa-edit"></i>&nbsp</a>
             
             <a class="label label-danger badge badge-light-danger" href="javascript:;"  title="Delete" onclick="deleteConfirm({{$id}})"><i class="fa fa-trash"></i>&nbsp</a>

             <a class="label label-primary badge badge-light-primary" href="{{route('company.show',$id)}}"  title="View"><i class="fa fa-eye"></i>&nbsp</a>
                                        </td>
                                      </tr>
                                  @endforeach
                              @else
                                  <tr><td colspan="10" class="text-center">{{trans('messages.No_Record_Found')}}</td></tr>
                              @endif

                            </tbody>
                            </table>
                            
                          </div>
                          <div style="float:right;" class="pt-1">{!! $company->links() !!}</div>
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

  var SITE_URL = "<?php echo URL::to('/'); ?>";
// change user Status
  $(document.body).on('click', '.actStatus' ,function(event){
    var row = this.id;
    var dbid = $(this).attr('data-sid');
    bootbox.confirm({
      message: "Are you sure you want to change user status ?",
      buttons: {'cancel': { label: 'No',className: 'btn-danger'},
      'confirm': { label: 'Yes',className: 'btn-success'}
    },
    callback: function(result){
      if (result){
        $.ajax({
          type :'POST',
          data : {id:dbid, _token:'{{ csrf_token() }}'},
          url  : 'company/status-change',
          success  : function(response) {
            if (response == 'Active') {
                $('#'+row+'').text('Active').removeClass('text-danger').addClass('text-green');
            }
            else if(response == 'Deactive') {
                $('#'+row+'').text('Deactive').removeClass('text-green').addClass('text-danger');
            }
            else if(response == 'error') {
              bootbox.alert('Something Went to Wrong');
            }
          }
         });
        }
      }
    });
  });

  function deleteConfirm(id){
  
    bootbox.confirm({
      message: "Are you sure you want to delete ?",
      buttons: {'cancel': {label: 'No',className: 'btn-danger'},
                'confirm': {label: 'Yes',className: 'btn-success'}
      },
      callback: function(result){
        if (result){
          $.ajax({
            url: SITE_URL + '/admin/company/'+id,
            type: "DELETE",
            cache: false,
            data:{ _token:'{{ csrf_token() }}'},
            success: function (data, textStatus, xhr) {
              if(data== true && textStatus=='success' && xhr.status=='200')
              {
                  toastr.warning('Company Deleted !!');
                  window.location.href = "{{ route('company.index')}}";
              }
              else {  toastr.error(data); }
            }
          });
        }
      }
    });
  }
</script>

<script>
  $('.date').on('change', function(){
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();

    if(to_date && from_date > to_date){
      swal("End date should be greater or equal start date !!!")
    }
    
    console.log(from_date,to_date);
    $('#customers').on('preXhr.dt', function ( e, settings, data ) {
      data.from_date = from_date;
      data.to_date = to_date;
    });
    window.LaravelDataTables["customers"].draw();
  });
  </script>
@endsection
