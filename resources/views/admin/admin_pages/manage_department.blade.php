@extends('admin.admin_master')

@section('content')
<h1 class='text-center' ><b style='color:Red'>Soft Delete</b> Or <b style='color:aqua'>Edit</b></h1>
<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Department Information Table</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            @if(session('update_message'))
            <h3 class="text-center" style="color:red">
                {{session('update_message')}}
            </h3>
            @endif
            @if(session('softdelete_message'))
            <h3 class="text-center" style="color:red">
                {{session('softdelete_message')}}
            </h3>
            @endif





            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Sri No.</th>
                        <th>Department ID</th>
                        <th>Department Name</th>
                        
                        <th>Department Title</th>
                        

                        <th>Department Image</th>
                        <th>Department Icon</th>
                        <th>Department Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>   
                <tbody>
                    @forelse($department_info as $v_department)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$v_department->id}}</td>
                        <td>{{$v_department->department_name}}</td>
                       
                        <td>{{$v_department->department_title}}</td>
                      


                        <td>

                            <img  width="80px" height="50px" src="{{asset('/')}}{{$v_department->department_image}}"> 
                        </td>
                          <td>

                            <img  width="50px" height="50px" src="{{asset('/')}}{{$v_department->department_icon}}"> 
                        </td>
                        <td class="center">
                           {{str_limit($v_department->department_description,20)}}
                        </td>
                        <td class="center">
                            <div class="btn-group">
                              
                                <a class="btn btn-info" href="{{url('admin/edit_department')}}/{{$v_department->id}}" onclick="return editDepartment()">
                                Edit
                                </a>
                                <a class="btn btn-danger" href="{{url('admin/department_softdelete')}}/{{$v_department->id}}" onclick="return deleteDepartment()">
                                  Softdelete
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class='center'style="color:red">
                        <td colspan="3">No available data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>            
        </div>
    </div><!--/span-->

</div><!--/row-->

<h1 class='text-center' ><b style='color:Red'>Parmanent Delete</b> Or <b style='color:green'>Restore</b></h1>
<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Department Information Table</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            @if(session('restore_message'))
            <h3 class="text-center" style="color:red">
                {{session('restore_message')}}
            </h3>
            @endif
            @if(session('parmanentdelete_message'))
            <h3 class="text-center" style="color:red">
                {{session('parmanentdelete_message')}}
            </h3>
            @endif





            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Sri No.</th>
                        <th>Department ID</th>
                        <th>Department Name</th>
                    
                        <th>Department Title</th>
                      
                      
                        <th>Department Image</th>
                          <th>Department Icon</th>
                        <th>Department Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>   
                <tbody>
                    @forelse($softdelete_department as $d_department)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$d_department->id}}</td>
                        <td>{{$d_department->department_name}}</td>
                        
                        <td>{{$d_department->department_title}}</td>


                        <td>

                            <img  width="50px" height="50px" src="{{asset('/')}}{{$d_department->department_image}}"> 
                        </td>

                        <td>

                            <img  width="50px" height="50px" src="{{asset('/')}}{{$d_department->department_icon}}"> 
                        </td>
                        <td class="center">
                           {{str_limit($d_department->department_description,20)}}
                        </td>
                        <td class="center">
                            <div class="btn-group">
                              
                                <a class="btn btn-danger" href="{{url('admin/department_parmanentdelete')}}/{{$d_department->id}}" onclick="return parmanentDoctor()">
                                    ParmanentDelete
                                </a>
                                <a class="btn btn-success" href="{{url('admin/department_restore')}}/{{$d_department->id}}"  onclick="return restoreDoctor() ">
                                   Restore
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class='center'style="color:red">
                        <td colspan="3">No available data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>            
        </div>
    </div><!--/span-->

</div><!--/row-->




@endsection		