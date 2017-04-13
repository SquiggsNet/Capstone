@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="row-centered"> Box #{{$box->box}}</h1>
        <div class="panel panel-default whole">
            <div class="panel-heading">
                <h3>Location</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Freezer{{$box->storage->freezer}}</td>
                            @if($box->storage->compartment=="1")
                                <td>Top Section</td>
                            @else
                                <td>Bottom Section</td>
                            @endif
                        </tr>
                        <tr>
                            @if($box->storage->shelf=="1")
                                <td>Top Shelf</td>
                            @else
                                <td>Bottom Shelf</td>
                            @endif
                            <td>0/{{$box->capacity}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-default whole">
            <div class="panel-heading">
                <h3>Contents</h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Tissue Region</th>
                        <th>Strain</th>
                        <th>Genotype</th>
                        <th>Treatment</th>
                        <th>Tag#</th>
                        <th>Isolation Date#</th>
                        <th>Isolated By</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tissues as $tissue)
                        <tr>
                            <td>
                                <input type="checkbox" id="group_select_cb" name="group_select_cb[]" value="{{ $box->id }}"/>
                            </td>
                            <td>{{$tissue->tissue->name}}</td>
                            <td>{{$tissue->mouse->colony->name}}</td>
                            <td>{{$tissue->mouse->genoFormat($tissue->mouse->geno_type_a, $tissue->mouse->geno_type_b)}}</td>
                            <td>?</td>
                            <td>{{ $tissue->mouse->tagPad($tissue->mouse->tags->last()->tag_num) }}</td>
                            <td>?</td>
                            <td>?</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection