@extends('layouts.app')

@section('content')
    <div class="container shadow-sm  mb-5 bg-white rounded dashboard">
        <div class="row ">
            <div class="col-md-3 col-sm-12 sidebar align-items-stretch">
                <nav class="nav flex-column">
                    <a class="nav-link p-3 text-light" href="#"><i class="fas fa-home"></i> Dashboard</a>
                    <a class="nav-link p-3 text-light" href="?menu=staff"><i class="fas fa-users"></i> Staff</a>
                    <a class="nav-link p-3 text-light" href="?menu=client"><i class="fas fa-briefcase"></i> Client</a>
                    <a class="nav-link p-3 text-light" href="?menu=job"><i class="fas fa-list-ul"></i> Work/Job Assign</a>
                    <a class="nav-link p-3 text-light" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                      <i class="fas fa-sign-out-alt"></i>   {{ __('Logout') }}
                                    </a>
                  </nav>
            </div>
            <div class="col-md-9 col-sm-12 p-3">
               @switch(request()->menu)
                   @case('staff')
                     <manager-staff :roles="{{json_encode($roles)}}" :staffs="{{json_encode($staffs)}}"/>
                       @break
                   @case('client')
                        <manager-client :roles="{{json_encode($roles)}}" :clients="{{json_encode($clients)}}"/>
                       @break
                   @case('job')
                        <manager-job :clients="{{json_encode($cdd)}}"  :staffs="{{json_encode($staffs)}}"/>
                        @break
                   @default
                   <div class="row p-3">
                        <div class="col-md-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        Reports
                                    </h3>
                                    <h4 class="text-center">
                                        {{  \App\Models\Report::count()  }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h3 class="card-title">
                                            Clients
                                        </h3>
                                        <h4 class="text-center">
                                            {{  \App\Models\Client::count()  }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <h3 class="card-title">
                                                Staffs
                                            </h3>
                                            <h4 class="text-center">
                                                {{  \App\User::where('role_id', 2)->count()  }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                    </div>
               @endswitch
            </div>
        </div>
    </div>
@endsection