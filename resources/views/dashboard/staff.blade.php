@extends('layouts.app')

@section('content')
    <div class="container shadow-sm  mb-5 bg-white rounded dashboard">
        <div class="row ">
            <div class="col-md-3 col-sm-12 sidebar align-items-stretch">
                <nav class="nav flex-column">
                    <a class="nav-link p-3 text-light" href="/"><i class="fas fa-home"></i> Dashboard</a>
                    <a class="nav-link p-3 text-light" href="?menu=report"><i class="fas fa-list-ul"></i> Reports</a>
                    <a class="nav-link p-3 text-light" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                   <i class="fas fa-sign-out-alt"></i>   {{ __('Logout') }}
                 </a>                  
                </nav>
            </div>
            <div class="col-md-9 col-sm-12">
                @if (request()->menu == 'report')
                    <staff-report/>
                @else
                    <div class="row p-3">
                        <div class="col-md-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        Report Pending
                                    </h3>
                                    <h4 class="text-center">
                                        {{  \App\Models\Report::where([
                                            ['assign_id','=', Auth::user()->id],
                                            ['status', '=', 'pending']
                                        ])->count()  }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h3 class="card-title">
                                            Report Complete
                                        </h3>
                                        <h4 class="text-center">
                                            {{  \App\Models\Report::where([
                                                ['assign_id','=', Auth::user()->id],
                                                ['status', '=', 'complete']
                                            ])->count()  }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection