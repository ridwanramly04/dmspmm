@extends('layouts.app')

@section('content')
    <div class="container shadow-sm  mb-5 bg-white rounded dashboard">
        <div class="row ">
            <div class="col-md-3 col-sm-12 sidebar align-items-stretch">
                <nav class="nav flex-column">
                    <a class="nav-link p-3 text-light" href="#"><i class="fas fa-home"></i> Dashboard</a>
                    
                    <a class="nav-link p-3 text-light" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>   {{ __('Logout') }}
                        </a>                  
                </nav>
            </div>
            <div class="col-md-9 col-sm-12 p-3">
                <h1>Reports</h1>
                <div class="row">
                    @switch(request()->menu)
                        @case('full')
                            <div class="col-md-12">
                                <h3 class="text-center">{{ \App\Models\Report::find(request()->id)->title }} </h3>
                                <hr>
                                <h4>Assets</h4><br>
                                <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (\App\Models\Report::find(request()->id)->asset as $asset)
                                                <tr>
                                                    <td>
                                                        {{$asset->id}}
                                                    </td>
                                                    <td>
                                                        {{$asset->name}}
                                                    </td>
                                                    <td>
                                                        {{$asset->price}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table><hr> <br>
                                <h4>Liabilities</h4><br>
                                <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (\App\Models\Report::find(request()->id)->liability as $asset)
                                                <tr>
                                                    <td>
                                                        {{$asset->id}}
                                                    </td>
                                                    <td>
                                                        {{$asset->name}}
                                                    </td>
                                                    <td>
                                                        {{$asset->price}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                                <hr><br>
                                <h4>Document</h4>
                                <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (\App\Models\Report::find(request()->id)->document as $asset)
                                                <tr>
                                                    <td>
                                                        {{$asset->id}}
                                                    </td>
                                                    <td>
                                                        {{$asset->name}}
                                                    </td>
                                                    <td>
                                                    <a class="btn btn-outline-primary" href="{{$asset->name}}">
                                                                    <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table><br>
                                <h4>Upload Document</h4><br>
                                <form action="{{'/client/'.request()->id}}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="custom-file">
                                        <input type="file" name="documents[]" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div><br><br>
                                    <input type="submit" class="btn btn-primary" value="Upload">
                                </form>
                                <br><br><br>
                            </div>
                            @break
                        @default
                            <div class="col-md-12">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Dateline</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reports->report as $report)
                                                <tr>
                                                    <td>
                                                        {{$report->id}}
                                                    </td>
                                                    <td>
                                                        {{$report->title}}
                                                    </td>
                                                    <td>
                                                        {{$report->status}}
                                                    </td>
                                                    <td>
                                                        {{$report->dateline}}
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    <a href="?menu=full&id={{$report->id}}" class="btn btn-outline-primary">
                                                                <i class="fas fa-file"></i>
                                                        </a>
                                                    </td>
                                                </tr>
            
                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Report</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
            
                                                            <div class="form-group">
                                                                <label for="">Company Name</label>
                                                                <input type="text" class="form-control" value="{{$reports->company_name}}" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                    <label for="">Report Name</label>
                                                                <input type="text" class="form-control" value="{{$report->title}}" disabled>
                                                                </div>
                                                            <div class="form-group">
                                                                        <label for="">Message</label>
                                                                    <input type="text" class="form-control" value="{{$report->message}}" disabled>
                                                            </div>
                                                            <hr>
                                                            
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                    @endswitch
                </div>
            </div>
        </div>
    </div>
@endsection