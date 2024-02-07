@extends('layouts.master')
@section('content')
    <div class="content">
        <div class="ui container">
            <h2>Edit {{$kid['name']}}</h2>
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
            <div class="ui grid">
                <div class="five wide column">
                    <div class="ui card">
                        <div class="image">
                            <img src="/assets/images/kids/{{$kid->image}}">
                        </div>
                        <div class="content">
                            <a class="header">{{$kid->name}}</a>
                            <div class="meta">
                                <span class="date">last updated on {{$kid->updated_at->format('M d Y')}}</span>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="eleven wide column">
                    <h4>Current Volunteers - to remove a volunteer from this child, click the trash can next to their name. The volunteer will not be notified.</h4>
                    <ul>
                        @if(count($kid->activegranters($kid->id)) < 1)
                            <p>There are no current volunteers</p>
                        @endif
                        @foreach($kid->activegranters($kid->id) as $granter)
                            <li>{{$granter->name}} - {{$granter->granter_type}} wish granter<a href="/children/{{$granter->id}}/unhook"><i class="trash icon"></i> </a></li>

                        @endforeach

                    </ul>
                </div>
            </div>

            <br><br>
            {{ Form::open(array('route' => ['children.update', $kid->id], 'class'=> 'ui form', 'files' => true, 'method' => 'patch') )  }}
            {{--<form action="/store" method="post" enctype="multipart/form-data" class="ui form">--}}
            <div class="three fields">
                <div class="field">
                    <label for="name">Child's name</label>
                    <input type="text" name="name" value="{{ $kid->name }}">

                </div>
                <div class="field">
                    <label for="sex">Sex:</label>
                    <select name="sex" id="" class="ui dropdown">
                        <option value="male" {{$sex['male']}} >Male</option>
                        <option value="female" {{$sex['female']}}>Female</option>
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
                    <input type="text" name="age" value="{{ $kid->age }}">

                </div>
                <div class="field">
                    <label for="illness">Illness</label>
                    <input type="text" name="illness" value="{{ $kid->illness }}">

                </div>
                <div class="field">
                    <label for="city">City</label>
                    <input type="text" name="city" value="{{ $kid->city }}">

                </div>
                <div class="field">
                    <label for="language">Language</label>
                    <input type="text" name="language" value="{{ $kid->language }}">

                </div>
            </div>

            <label for="bio">Wish Child Information</label>
            <textarea class="bio" name="bio">{{ $kid->bio }}</textarea>
            <br><br>
            <input type="submit" class='ui button blue' value="Submit">
            <a  href="#" class="ui red right floated button delete_button" value="Delete">Delete</a>
            {{Form::close()}}
            {{--</form>--}}
        </div>
    </div>

<div class="ui basic modal delete_modal">
  <i class="close icon"></i>
  <div class="header">
    Are you sure you want to delete {{$kid->name}}  You can't undo this!
  </div>

  <div class="actions">
    <div class="two fluid ui inverted buttons">

    <div class="ui green button close">
        Whoa! Cancel!
    </div>
      <div class="ui red button">
        <a href="/children/{{$kid->id}}/delete">
            <i class="checkmark icon"></i>
            Yes Delete
        </a>
      </div>
    </div>
  </div>
</div>
@endsection