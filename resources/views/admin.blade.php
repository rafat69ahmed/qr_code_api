@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                  <div class="panel-body">
                      <ul class="nav nav-tabs">
                        <li class="active"><a href="#home">User</a></li>
                        <li><a href="#menu1">Merchant</a></li>
                      </ul>

                      <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                          <table  class="table table-striped client-table">
                            <!-- Table Headings -->
                            <thead>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Birthday</th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <!-- client Name -->
                                        <td class="table-text">
                                            <div>{{ $user->id }}</div>
                                        </td>
                                        <td class="table-text">
                                            <div>{{ $user->name }}</div>
                                        </td>
                                        <td class="table-text">
                                            <div>{{ $user->email }}</div>
                                        </td>
                                        <td class="table-text">
                                            <div>{{ $user->gender }}</div>
                                        </td>
                                        <td class="table-text">
                                            <div>{{ $user->birthday }}</div>
                                        </td>
                                        <td class="table-text">
                                            <button type="submit" class="btn btn-danger" title="delete" onClick="deleteModal('{{$user->id}}')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>





                                    {{-- __________deleteMOdal______________ --}}
                                    <div class="modal fade bs-example-modal-sm" id="deleteModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                      <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                          <div class="modal-body">
                                            <h2>Are you sure?</h2>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                            
                                                {{-- <form action="{{ url('merchant/app/delete/'.$app->id)}}" method="POST"> --}}
                                                <form action="{{ url('api/v1/delete/user/'.$user->id)}}" method="POST">
                                                {{-- <div>{{$user->id}}</div> --}}
                                            
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                          </div>
                                        </div>
                                        
                                      </div>
                                    </div>
                                    {{-- __________deleteMOdal______________ --}}







                                @endforeach
                            </tbody>
                          </table>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                          <table  class="table table-striped client-table">
                            <!-- Table Headings -->
                            <thead>
                                <th>ID</th>
                                <th>Merchant Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Birthday</th>
                            </thead>
                            <tbody>
                                @foreach ($merchants as $merchant)
                                    <tr>
                                        <!-- client Name -->
                                        <td class="table-text">
                                            <div>{{ $merchant->id }}</div>
                                        </td>
                                        <td class="table-text">
                                            <div>{{ $merchant->name }}</div>
                                        </td>
                                        <td class="table-text">
                                            <div>{{ $merchant->email }}</div>
                                        </td>
                                        <td class="table-text">
                                            <div>{{ $merchant->gender }}</div>
                                        </td>
                                        <td class="table-text">
                                            <div>{{ $merchant->birthday }}</div>
                                        </td>
                                        <td class="table-text">
                                            <button type="submit" class="btn btn-danger" title="delete" onClick="deleteModal('{{$merchant->id}}')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>



                                    {{-- __________deleteMOdal______________ --}}
                                    <div class="modal fade bs-example-modal-sm" id="deleteModal{{$merchant->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                      <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                          <div class="modal-body">
                                            <h2>Are you sure?</h2>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                            
                                                {{-- <form action="{{ url('merchant/app/delete/'.$app->id)}}" method="POST"> --}}
                                                <form action="{{ url('api/v1/delete/user/'.$merchant->id)}}" method="POST">
                                                {{-- <div>{{$merchant->id}}</div> --}}
                                            
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                          </div>
                                        </div>
                                        
                                      </div>
                                    </div>
                                    {{-- __________deleteMOdal______________ --}}



                                @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
