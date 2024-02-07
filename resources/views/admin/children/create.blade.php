@extends('layouts.master')
@section('content')
    <div class="content">
        <div class="ui container">
            <h2>Create new child</h2>
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
            <br><br>
            {{ Form::open(array('route' => 'children.store', 'class'=> 'ui form', 'files' => true, 'method' => 'post')) }}
            {{--<form action="/store" method="post" enctype="multipart/form-data" class="ui form">--}}
                <div class="three fields">
                    <div class="field">
                        <label for="name">Child's name</label>
                        <input type="text" name="name" value="{{ old('name') }}">

                    </div>
                    <div class="field">
                        <label for="sex">Sex:</label>
                        <select name="sex" id="" class="ui dropdown">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="image">Add Image. File must be a square (ex. 300px X 300px)</label>
                        <input type='file' name='image' value="{{ old('image') }}">

                    </div>

                </div>

                <div class="four fields">
                    <div class="field">
                        <label for="age">Age</label>
                        <input type="text" name="age" value="{{ old('age') }}">

                    </div>
                    <div class="field">
                        <label for="illness">Illness</label>
                        <input type="text" name="illness" value="{{ old('illness') }}">

                    </div>
                    <div class="field">
                        <label for="city">City</label>
                        <input type="text" name="city" value="{{ old('city') }}">

                    </div>
                    <div class="field">
                        <label for="language">Language</label>
                        @if( null !== old('language'))
                            <input type="text" name="language" value="{{  old('language') }}">
                        @else
                            <input type="text" name="language" value="English">
                        @endif

                    </div>
                </div>
                <label for="bio">Wish Child Information</label>
                <textarea name="bio">{{ old('bio') }}</textarea>
                <br><br>
                <input type="submit" class='ui button blue' value="Submit">
            {{Form::close()}}
            {{--</form>--}}
        </div>
    </div>
@endsection