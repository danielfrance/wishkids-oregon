@extends('layouts.master')
@section('content')
    <div class="content">
        <div class='ui container'>
            <div class="">
                <h2>Make-A-Wish</h2>
                <div class="content">
                    {{ Form::open(array('route' => ['content.update', 1], 'class'=> 'ui form', 'files' => true, 'method' => 'patch')) }}
                        <textarea name="content" class="ckeditor" >
                            {{$content->content}}
                        </textarea>
                    <br>
                    <input type="submit" class="ui button right floated green" value="Submit">
                    <br>
                    {{Form::close()}}

                </div>
            </div>
            <br>
            <hr>
            <br>
            <br>
            <a href='children/create' class="ui button blue right floated add">
                <i class="plus icon"></i>Add new child</a>
            <br>
            <br>
            <table class="ui celled striped table" style="padding-bottom:15em">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Illness</th>
                        <th>City</th>
                        <th>Lead Wish Granter</th>
                        <th>Second Wish Granter</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kids as $kid)
                    
                    <tr>
                    {{ Form::open(array('url' => ['/children/'.$kid->id.'/updateOrder'], 'class'=> 'ui form', 'files' => true, 'method' => 'post') )  }}
                        <td>
                            @if(!is_null($kid->image))
                            <img src="assets/images/kids/{{$kid->image}}" class="ui mini rounded image">
                            @endif
                        </td>
                        <td>{{$kid->name}}</td>
                        <td>{{$kid->illness}}</td>
                        <td>{{$kid->city}}</td>
                        <td>
                            @if($kid->leadGranter())
                            <a class='granter_info' data-id="{{$kid->leadGranter()->id}}">{{$kid->leadGranter()->name}}</a>
                            @else
                            <a class='granter_info' href="#">Needs Volunteer</a>
                            @endif
                        </td>
                        <td>
                            @if($kid->secondGranter())
                                <a class='granter_info' data-id="{{$kid->secondGranter()->id}}">{{$kid->secondGranter()->name}}</a>
                            @else
                                <a class='granter_info' href="#">Needs Volunteer</a>
                            @endif
                        </td>
                        <td><a href="children/{{$kid->id}}/edit"><i class="edit icon"></i></a></td>
                        {{Form::close()}}
                    </tr>
                     
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    </div>
   <div class="modals">
       @foreach($kids as $kid)

           @foreach($kid->granters as $granter)
               <div id="{{$granter->id}}" class="ui modal transition" >
                   <i class="close icon"></i>
                   <div class="header">Volunteer</div>
                   <div class="content">
                       <h3 class="name">{{$granter->name}}</h3>
                       <p class="cell">{{$granter->cell}}</p>
                       <p class="email"><a href="mailto:{{$granter->email}}">{{$granter->email}}</a></p>
                       <p class="home">{{$granter->home_phone}}</p>

                   </div>

               </div>



           @endforeach


       @endforeach
   </div>
    <script src= "/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>

    <script>
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
@endsection