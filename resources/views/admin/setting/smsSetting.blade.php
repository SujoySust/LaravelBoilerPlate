@extends('admin.master')
@section('content')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <h4 class="page-title">Sms Setting</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sms Setting</li>
                    </ol>
                </div>
            </div>
            <div class="modal fade" id="addMethod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Sms Method</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('route' => 'adminSmsSetting','files'=> true,'id'=>'myForm')) }}
                            @csrf
                            <div class="form-group">
                                <label for="formGroupExampleInput">Sms Methods Title</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Sms Methods Description</label>
                                <textarea class="form-control" placeholder="Description" type="text" name="description"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            {{ Form::close() }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="widgetbar">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMethod">
                        <i class="feather icon-plus mr-2"></i>Add New Method
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbbar -->
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-header">Sms Methods </h5>
                        <h5 class="card-header text-center">{{Session::get('success')}} </h5>
                        <div class="card">
                            <div class="col-lg-12">

                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Method Title</th>
                                        <th scope="col">Key Title</th>
                                        <th scope="col">Key Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($smsLists))
                                        <?php $i=1?>
                                        @foreach($smsLists as $smsList)
                                            <div class="modal fade" id="addKey{{$smsList->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Add New Key To: {{$smsList->title}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="addform" method="post" action="{{route('adminSmsSettingKey')}}">
                                                                {{ csrf_field() }}
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Title</label>
                                                                    <input type="hidden" name="sms_setting_id" value="{{$smsList->id}}">
                                                                    <input type="text" name="slug" class="form-control" >
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Description</label>
                                                                    <textarea class="form-control" name="value"></textarea>
                                                                </div>

                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="editMethod{{$smsList->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit : {{$smsList->title}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ Form::open(array('route' => 'adminSmsSettingUpdate','files'=> true,'id'=>'myForm')) }}
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Title</label>
                                                                <input type="hidden" name="id" value="{{$smsList->id}}">
                                                                <input type="text" class="form-control" id="recipient-name" value="{{$smsList->title}}" name="title" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">Description:</label>
                                                                <textarea class="form-control" id="message-text" name="description">{{$smsList->description}}</textarea>
                                                            </div>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                            {{ Form::close() }}
                                                        </div>
                                                        <div class="modal-footer">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$smsList->title}} <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addKey{{$smsList->id}}">
                                                        Add
                                                    </button>
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editMethod{{$smsList->id}}">
                                                        Edit
                                                    </button>
                                                </td>
                                                <td>
                                                    @foreach($smsList->smssettingkeys as $smsId)
                                                        <ul class="list-group">
                                                            <li class="list-group-item">{{$smsId->slug}}</li>
                                                        </ul>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($smsList->smssettingkeys as $smsId)
                                                        <ul class="list-group">
                                                            <li class="list-group-item">{{$smsId->value}}</li>
                                                        </ul>
                                                    @endforeach
                                                </td>
                                                <td>
                                                @foreach($smsList->smssettingkeys as $smsId)

                                                    <!-- Modal -->
                                                        <div class="modal fade" id="keyModal{{$smsId->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form id="addform" method="post" action="{{route('adminSettingKeyUpdate')}}">
                                                                            {{ csrf_field() }}
                                                                            <div class="form-group">
                                                                                <label for="exampleInputEmail1">Title</label>
                                                                                <input type="hidden" name="id" value="{{$smsId->id}}}">
                                                                                <input type="text" name="slug" class="form-control" value="{{$smsId->slug}}">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="exampleInputPassword1">Body</label>
                                                                                <textarea class="form-control" name="value">{{$smsId->value}}</textarea>
                                                                            </div>

                                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <ul class="list-unstyled">
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#keyModal{{$smsId->id}}">
                                                                Edit
                                                            </button>
                                                            <a href="{{route('adminSettingKeyDelete',['id'=>$smsId->id])}}" class="btn btn-danger">Delete</a>
                                                        </ul>

                                                    @endforeach
                                                </td>
                                            </tr>

                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


@endsection

