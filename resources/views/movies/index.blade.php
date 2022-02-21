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
            <li class="breadcrumb-item">قائمة الأفلام</li>
        </ul>

        <div class="row">

            <div class="col-md-12">

                <div class="tile shadow">

                    <div class="row mb-2">

                        <div class="col-md-12">


                            <form method="post" action="{{ route('movies.bulk_delete') }}"
                                style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="record_ids" id="record-ids">
                                <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true"><i
                                        class="fa fa-trash"></i> حذف الكل</button>
                            </form><!-- end of form -->


                        </div>

                    </div><!-- end of row -->

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" id="data-table-search" class="form-control" autofocus
                                    placeholder="ابحث">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <select id="genre" class="form-control select2" required>
                                    <option value="">كل الأنواع</option>
                                    @foreach ($genres as $genre)
                                        <option value="{{ $genre->id }}"
                                            {{ $genre->id == request()->genre_id ? 'selected' : '' }}>
                                            {{ $genre->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <select id="actor" class="form-control select2" required>
                                    <option value="">كل الفنانين</option>
                                    @foreach ($actors as $actor)
                                        <option value="{{ $actor->id }}"
                                            {{ $actor->id == request()->actor_id ? 'selected' : '' }}>
                                            {{ $actor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <select id="type" class="form-control select2" required>
                                    <option value="">كل الافلام</option>
                                    @foreach (['now_playing', 'upcoming'] as $type)
                                        <option value="{{ $type }}"
                                            {{ $type == request()->type ? 'selected' : '' }}>{{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div><!-- end of row -->

                    <div class="row">

                        <div class="col-md-12">

                            <div class="table-responsive">

                                <table class="table datatable" id="movies-table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="animated-checkbox">
                                                    <label class="m-0">
                                                        <input type="checkbox" id="record__select-all">
                                                        <span class="label-text"></span>
                                                    </label>
                                                </div>
                                            </th>
                                            <th>الملصقات</th>
                                            <th>العنوان</th>
                                            <th>النوع</th>
                                            <th>الأصوات</th>
                                            <th>عدد الأصوات</th>
                                            <th>تاريخ الاصدار</th>
                                            {{-- <th>@lang('movies.favourite_by')</th> --}}
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                </table>

                            </div><!-- end of table responsive -->

                        </div><!-- end of col -->

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
            //scope من اجل جلب الأفلام المتعلقة به
            let genre = "{{ request()->genre_id }}";
            let actor = "{{ request()->actor_id }}";
            let type = "{{ request()->type }}";

            let moviesTable = $('#movies-table').DataTable({
                dom: "tiplr",
                serverSide: true,
                processing: true,
                "language": {
                    "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
                },
                ajax: {
                    url: '{{ route('movies.data') }}',
                    //scope من اجل جلب الأفلام المتعلقة به
                    data: function(d) {
                        d.genre_id = genre;
                        d.actor_id = actor;
                        d.type = type;
                    }
                },
                columns: [{
                        data: 'record_select',
                        name: 'record_select',
                        searchable: false,
                        sortable: false,
                        width: '1%'
                    },
                    {
                        data: 'poster',
                        name: 'poster',
                        searchable: false,
                        sortable: false,
                        width: '10%'
                    },
                    {
                        data: 'title',
                        name: 'title',
                        width: '15%'
                    },
                    {
                        data: 'genres',
                        name: 'genres',
                        searchable: false
                    },
                    {
                        data: 'vote',
                        name: 'vote',
                        searchable: false
                    },
                    {
                        data: 'vote_count',
                        name: 'vote_count',
                        searchable: false
                    },
                    {
                        data: 'release_date',
                        name: 'release_date',
                        searchable: false
                    },
                    // {
                    //     data: 'favorite_by_users_count',
                    //     name: 'favorite_by_users_count',
                    //     searchable: false
                    // },
                    {
                        data: 'actions',
                        name: 'actions',
                        searchable: false,
                        sortable: false,
                        width: '20%'
                    },
                ],
                order: [
                    [5, 'desc']
                ],
                drawCallback: function(settings) {
                    $('.record__select').prop('checked', false);
                    $('#record__select-all').prop('checked', false);
                    $('#record-ids').val();
                    $('#bulk-delete').attr('disabled', true);
                }
            });

            $('#genre').on('change', function() {
                genre = this.value;
                moviesTable.ajax.reload();
            })

            $('#actor').on('change', function() {
                actor = this.value;
                moviesTable.ajax.reload();
            })

            $('#type').on('change', function() {
                type = this.value;
                moviesTable.ajax.reload();
            })

            $('#data-table-search').keyup(function() {
                moviesTable.search(this.value).draw();
            })

            // $('#actor').select2({
            //     ajax: {
            //         url: "",
            //         dataType: 'json',
            //         data: function(params) {
            //             return {
            //                 search: params.term,
            //             }
            //         },
            //         processResults: function(data) {
            //             return {
            //                 results: data
            //             };
            //         }
            //     }
            // });
        </script>
    @endsection
