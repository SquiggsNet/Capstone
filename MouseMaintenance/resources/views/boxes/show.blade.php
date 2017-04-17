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
                            <td>Freezer {{$box->storage->freezer}}</td>
                            @if($box->storage->compartment=="1")
                                <td>Top Compartment</td>
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
                            <td>{{$box->mouse_storages->count()}}/{{$box->capacity}}</td>
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
                <div class="whole bottom-buffer">
                    {{ Form::open(['action' => ['BoxController@showFiltered', $box], 'method' => 'POST']) }}
                    {{--{!! Form::open(['action' => 'BoxController@showFiltered', $box->id ]) !!}--}}
                    <div class="quarter">
                        <label class="form-label" >Tissue Region</label>
                        <select name="tissue_select" id="tissue_select" class="form-control">
                            <option value="0">All</option>
                            @foreach($tissues as $tissue)
                                <option value="{{ $tissue->id }}">
                                    {{$tissue->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="quarter">
                        <label class="form-label" >Strain</label>
                        <select name="strain_select" id="strain_select" class="form-control">
                            <option value="0">All</option>
                            @foreach($strains as $strain)
                                <option value="{{ $strain->id }}">
                                    {{$strain->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="quarter">
                        <label class="form-label" >Genotype</label>
                        <select name="geno_select" id="geno_select" class="form-control">
                            <option value="0">All</option>
                            <option value="1">
                                (+/+)
                            </option>
                            <option value="2">
                                (+/-)
                            </option>
                            <option value="3">
                                (-/-)
                            </option>
                        </select>
                    </div>
                    <div class="quarter last">
                        <label class="form-label" >Treatment</label>
                        <select name="treatment_select" id="treatment_select" class="form-control">
                            <option value="0">All</option>
                            @foreach($treatments as $treatment)
                                <option value="{{ $treatment->id }}">
                                    {{$treatment->title}}
                                </option>

                            @endforeach
                            <option value="untreated">Untreated</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    {!! Form::submit('Narrow Results',['class'=>'btn btn-default pull-right bottom-buffer']) !!}
                </div>
                {!! Form::close() !!}
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>
                            <a href="{{ action( 'BoxController@show', ['id' => $box->id]) }}">
                                Tissue Region
                            </a>
                        </th>
                        <th>Strain</th>
                        <th>Genotype</th>
                        <th>Treatment</th>
                        <th>Tag#</th>
                        <th>Isolation Date</th>
                        <th>Isolated By</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--@foreach ($tissues->sortByDesc('extraction_date') as $tissue)--}}
                    @foreach ($storedTissues->sortBy('extraction_date')as $tissue)
                        <tr>
                            <td>
                                <input type="checkbox" id="group_select_cb" name="group_select_cb[]" value="{{ $box->id }}"/>
                            </td>
                            <td>{{$tissue->tissue->name}}</td>
                            <td>{{$tissue->mouse->colony->name}}</td>
                            <td>{{$tissue->mouse->genoFormat($tissue->mouse->geno_type_a, $tissue->mouse->geno_type_b)}}</td>
                            @if(!$tissue->mouse->treatments->isEmpty())
                                <td>
                                @foreach ($tissue->mouse->treatments as $treatment)
                                    {{$treatment->title}}
                                @endforeach
                                </td>
                            @else
                                <td>N/A</td>
                            @endif
                            <td>{{ $tissue->mouse->tagPad($tissue->mouse->tags->last()->tag_num) }}</td>
                            <td>{{$tissue->extraction_date}}</td>
                            <td>{{$tissue->user->first_name . ' ' . $tissue->user->last_name}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
