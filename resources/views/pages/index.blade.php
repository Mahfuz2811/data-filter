@extends('layouts.master')

@section('content')
    <div class="col-md-6">
        <form action="{{ route('index') }}" method="GET">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="title" class="control-label">Birth Year</label>
                    <input type="text" class="form-control" name="yob"
                           value="{{ $yob }}" autocomplete="off">
                </div>
                <div class="form-group col-md-4">
                    <label for="title" class="control-label">Birth Month</label>
                    <input type="text" class="form-control" name="mob"
                           value="{{ $mob }}" autocomplete="off">
                </div>
                <div class="form-group col-md-2">
                    <button style="margin-top: 52px;" class="btn btn-warning" type="submit">Filter</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <div style="display: flex; margin-top: 55px; float: right;">
            <a class="btn border-black {{ $page == 1 ? 'disabled' : '' }}"
               href="{{ route('index', ['yob' => $yob, 'mob' => $mob, 'page' => $page-1, 'perPage' => $perPage]) }}">
                Previous
            </a>
            <div style="margin: 5px 15px;">{{ (($page-1)*$perPage)+1 }} - {{ ($page*$perPage) > $totalData ? $totalData : ($page*$perPage) }} 0f {{ $totalData }}</div>
            <a class="btn border-black pd-custom {{ ($page*$perPage) >= $totalData ? 'disabled' : '' }}"
               href="{{ route('index', ['yob' => $yob, 'mob' => $mob, 'page' => $page+1, 'perPage' => $perPage]) }}">
                Next
            </a>
        </div>
    </div>
    <div class="box">
        <div class="box-body no-padding table-responsive">
            <table class="table table-condensed">
                <thead>
                <tr class="header">
                    <th>#</th>
                    <th>Email Address</th>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>IP</th>
                    <th>Country</th>
                </tr>
                </thead>
                <tbody>
                <?php $id = 1; ?>
                @foreach($data as $item)
                <tr class="border-bottom">
                    <td>{{ $id++ }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['dob'] }}</td>
                    <td>{{ $item['ip'] }}</td>
                    <td>{{ $item['country'] }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <div style="display: flex; float: right;">
                <a class="btn border-black {{ $page == 1 ? 'disabled' : '' }}"
                   href="{{ route('index', ['yob' => $yob, 'mob' => $mob, 'page' => $page-1, 'perPage' => $perPage]) }}">
                    Previous
                </a>
                <div style="margin: 5px 15px;">{{ (($page-1)*$perPage)+1 }} - {{ ($page*$perPage) > $totalData ? $totalData : ($page*$perPage) }} 0f {{ $totalData }}</div>
                <a class="btn border-black pd-custom {{ ($page*$perPage) >= $totalData ? 'disabled' : '' }}"
                   href="{{ route('index', ['yob' => $yob, 'mob' => $mob, 'page' => $page+1, 'perPage' => $perPage]) }}">
                    Next
                </a>
            </div>
        </div>
    </div>
@stop
