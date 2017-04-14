@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default whole">
            <div class="panel-heading">
                <h3>Freezer #{{$storage->freezer}}</h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Box #</th>
                            <th>Section</th>
                            <th>Shelf</th>
                            <th>Slide</th>
                            <th>Capacity</th>
                        </tr>
                    </thead>
                <tbody>
                @foreach ($boxes as $box)
                    <tr>
                        <td>
                            <input type="checkbox" id="group_select_cb" name="group_select_cb[]" value="{{ $box->id }}"/>
                        </td>
                        <td>
                            <a href="{{ action( 'BoxController@show', ['id' => $box->id]) }}">
                                {{$box->box}}
                            </a>
                        </td>
                        @if($box->storage->compartment=="1")
                            <td>Top</td>
                        @else
                            <td>Bottom</td>
                        @endif
                        @if($box->storage->shelf=="1")
                            <td>Top</td>
                        @else
                            <td>Bottom</td>
                        @endif
                        <td>{{$box->column}}-{{$box->row}}</td>
                        <td>{{$box->mouse_storages->count()}}/{{$box->capacity}}</td>
                    </tr>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection