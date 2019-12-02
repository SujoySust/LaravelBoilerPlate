@extends('admin.master')
@section('content')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <h4 class="page-title">CRM</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Setting</li>
                    </ol>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="widgetbar">
                    <button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Actions</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbbar -->
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <div class="col-lg-12">
                <h5 class="text-center">{{Session::get('success')}}</h5>
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="card-title">Basic Setting</h5>
                    </div>
                    {{ Form::open(array('route' => 'adminBasicSetting','files'=> true,'id'=>'myForm')) }}
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="card-header">
                                        <h5 class="card-title text-center">{{__('Company Title')}}</h5>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Title" name="title" @if(isset($titles)) value="{{$titles->value}}" @endif>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- End col -->
                                <div class="col-lg-12">
                                    <div class="card m-b-30">
                                        <div class="card-header">
                                            <h5 class="card-title text-center">{{__('About')}}</h5>
                                        </div>
                                        <div class="card-body">

                                                <textarea id="tinymce-example" name="about">@if(isset($abouts)){{$abouts->value}}@endif</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- End col -->
                                <div class="col-lg-12">
                                    <div class="card m-b-30">
                                        <div class="card-header">
                                            <h5 class="card-title text-center">{{__('Terms & Conditions')}}</h5>
                                        </div>
                                        <div class="card-body">
                                            <textarea id="tinymce-example" name="privacy">@if(isset($terms)){{$terms->value}}@endif</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- End col -->
                                <div class="col-lg-12">
                                    <div class="card m-b-30">
                                        <div class="card-header">
                                            <h5 class="card-title text-center">{{__('Privacy & Policy')}}</h5>
                                        </div>
                                        <div class="card-body">

                                                <textarea id="tinymce-example" name="privacy">@if(isset($privacy)){{$privacy->value}}@endif</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Save">
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <!-- End row -->
        <div class="row">
                <div class="col-lg-12">

                    @if( Session::has('successImage'))
                        <h5 class="text-center text-success">{{Session::get('successImage')}}</h5>

                    @elseif(Session::has('dissmissImage'))
                        <h5 class="text-center text-danger"> {{Session::get('dissmissImage')}}</h5>

                    @endif
                    <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="card-title">Image Setting</h5>
                        </div>
                        {{ Form::open(array('route' => 'adminImageSetting','files'=> true,'id'=>'myForm'))}}
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile02" name="logo">
                                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="inputGroupFileAddon02">Logo</span>
                                            </div>
                                        </div>
                                        <img id="logo" width="100"  @if(isset($logos)) src="{{asset( $logos->value )}}" @endif class="upload_image" >
                                    </div>
                              </div>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Save">
                        {{Form::close()}}
                    </div>
                </div>
            </div>
            <!-- End row -->

    </div>
    <!-- End Contentbar -->

    <!-- Start js -->
    <script src="{{asset('admin/')}}/assets/js/jquery.min.js"></script>
    <script src="{{asset('admin/')}}/assets/js/popper.min.js"></script>
    <script src="{{asset('admin/')}}/assets/js/bootstrap.min.js"></script>
    <script src="{{asset('admin/')}}/assets/js/modernizr.min.js"></script>
    <script src="{{asset('admin/')}}/assets/js/detect.js"></script>
    <script src="{{asset('admin/')}}/assets/js/jquery.slimscroll.js"></script>
    <script src="{{asset('admin/')}}/assets/js/vertical-menu.js"></script>
    <!-- Switchery js -->
    <script src="{{asset('admin/')}}/assets/plugins/switchery/switchery.min.js"></script>
    <!-- Wysiwig js -->
    <script src="{{asset('admin/')}}/assets/plugins/tinymce/tinymce.min.js"></script>
    <!-- Summernote JS -->
    <script src="{{asset('admin/')}}/assets/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- Code Mirror JS -->
    <script src="{{asset('admin/')}}/assets/plugins/code-mirror/codemirror.js"></script>
    <script src="{{asset('admin/')}}/assets/plugins/code-mirror/htmlmixed.js"></script>
    <script src="{{asset('admin/')}}/assets/plugins/code-mirror/css.js"></script>
    <script src="{{asset('admin/')}}/assets/plugins/code-mirror/javascript.js"></script>
    <script src="{{asset('admin/')}}/assets/plugins/code-mirror/xml.js"></script>
    <script src="{{asset('admin/')}}/assets/js/custom/custom-form-editor.js"></script>
    <!-- Core js -->
    <script src="{{asset('admin/')}}/assets/js/core.js"></script>

@endsection
