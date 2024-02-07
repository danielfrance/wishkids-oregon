@extends('layouts.master')
@section('content')
    <div class="content">
        <div class='ui container'>
            <div class="messages">
                @if (count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <div class="ui negative message">
                            <i class="close icon"></i>
                            <div class="header">
                                {{$error}}
                            </div>

                        </div>
                    @endforeach
                @endif
                @if (Session::has('messages'))
                    <div class="ui success message">
                        <i class="close icon"></i>
                        <div class="header">
                            {{Session::get('messages')}}
                        </div>
                    </div>

                @endif

            </div>
            <div>
                <h2>Volunteers</h2>
                <a href='/volunteer/export' class="ui button green right floated add">
                    <i class="file excel outline icon"></i>Export to Excel</a>
            </div>
            <br><br>
            <table class="ui celled striped table" style="padding-bottom:15em">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Cell</th>
                    <th>Home Phone</th>
                    <th>Delete</th>

                </tr>
                </thead>
                <tbody>
                @foreach($volunteers as $volunteer)

                    <tr>
                        <td>{{$volunteer->name}}</td>
                        <td>{{$volunteer->email}}</td>
                        <td>{{$volunteer->cell}}</td>
                        <td>{{$volunteer->home_phone}}</td>
                        <td><a href="volunteer/destroy/{{$volunteer->id}}" class="ui tiny button red"><i class="icon trash"></i>Delete</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    </div>

@endsection