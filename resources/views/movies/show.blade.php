@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection


@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div>

        <div>
            <h2>الأفلام</h2>
        </div>

        <ul class="breadcrumb mt-2">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
            <li class="breadcrumb-item"><a href="{{ route('movies.index') }}">قائمة الأفلام</a></li>
            <li class="breadcrumb-item">عرض</li>
        </ul>

        <div class="row">

            <div class="col-md-12">

                <div class="tile shadow">

                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ $movie->poster_path }}" class="img-fluid" alt="">
                        </div>

                        <div class="col-md-10">
                            <h2>{{ $movie->title }}</h2>

                            @foreach ($movie->genres as $genre)
                                <h5 class="d-inline-block"><span class="badge badge-primary">{{ $genre->name }}</span>
                                </h5>
                            @endforeach

                            <p style="font-size: 16px;">{{ $movie->description }}</p>

                            <div class="d-flex mb-2">
                                <i class="fa fa-star text-warning" style="font-size: 35px;"></i>
                                <h3 class="m-0 mx-2">{{ $movie->vote }}</h3>
                                <p class="m-0 align-self-center">عدد الأصوات {{ $movie->vote_count }}</p>
                            </div>

                            <p><span class="font-weight-bold">لغة الفيلم</span>: en</p>
                            <p><span class="font-weight-bold">تاريخ الاصدار</span>:
                                {{ $movie->release_date }}</p>

                            <hr>

                            <div class="row" id="movie-images">

                                @foreach ($movie->images as $image)
                                    <div class="col-md-3 my-2">
                                        <a href="{{ $image->image_path }}"><img src="{{ $image->image_path }}"
                                                class="img-fluid" alt=""></a>
                                    </div><!-- end of col -->
                                @endforeach

                            </div><!-- end of row -->

                            <hr>

                            <div class="row">

                                @foreach ($movie->actors as $actor)
                                    <div class="col-md-2 my-2">
                                        <a href="{{ route('movies.index', ['actor_id' => $actor->id]) }}">
                                            <img src="{{ $actor->image_path }}" class="img-fluid" alt="">
                                        </a>
                                    </div><!-- end of col -->
                                @endforeach

                            </div><!-- end of row -->

                        </div><!-- end of col  -->

                    </div><!-- end of row -->

                </div><!-- end of tile -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    @endsection

    @section('js')
        <!-- Internal Data tables -->
        <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ URL::asset('admin_assets/js/custom/index.js') }}"></script>
        <!--Internal  Datatable js -->
        <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
        <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
        <script>
            $(function() {

                $('#movie-images').magnificPopup({
                    delegate: 'a', // the selector for gallery item
                    type: 'image',
                    gallery: {
                        enabled: true
                    }
                });

            }); //end of document ready
        </script>
    @endsection
