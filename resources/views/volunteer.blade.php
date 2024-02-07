
@extends('layouts.master')
@section('content')
<div class="volunteer">
    <div class="logo">
        <img src="/assets/images/logo.png" alt="">
    </div>
	<div class="hero">

	</div>
    <div class="content">
        <div class="dynamic"> {!! $content->content !!}</div>

        <br>
        <div class="kids_container ">
            <div class="ui three column equal height grid stackable">

                @for($i=0; $i < count($kids); $i++)
                    <?php
                        $blue;
                        if ($i % 2 == 0){
                            $blue = 'blue';
                        }
                        else{
                            $blue = 'blue_alt';
                        }
                    ?>
                    <div class='column'>
                        <div class='card {{$blue}} equal_height'>
                            <div class='intro'>
                                <img src='/assets/images/kids/{{$kids[$i]['image']}}' alt=''>
                                <p class='bold name'>{{$kids[$i]['name']}}</p>
                                <p class='age'>{{$kids[$i]['age']}} year old  {{$kids[$i]['sex']}}</p>
                                <p class='bio'>{{$kids[$i]['bio']}}</p>
                            </div>
                            <div class='info'>
                                <table class='ui very basic table'>
                                    <tbody>
                                    <tr class='illness'>
                                        <td>Illness</td>
                                        <td class='bold'>{{$kids[$i]['illness']}}</td>
                                    </tr>
                                    <tr class='city'>
                                        <td>City</td>
                                        <td class='bold'>{{$kids[$i]['city']}}</td>
                                    </tr>
                                    <tr class='language'>
                                        <td>Language</td>
                                        <td class='bold'>{{$kids[$i]['language']}}</td>
                                    </tr>
                                    <tr class='granter1'>
                                        <td>Lead Wish Granter</td>
                                        <td class='bold'>
                                            @if($kids[$i]->leadGranter())
                                                {{$kids[$i]->leadGranter()->name}}
                                            @else
                                            <span class='sign_up' data-text="lead" id='{{$kids[$i]['id']}}'>I'll do it! <i  class='edit icon signup'></i><span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class='granter2'>
                                        <td>Second Wish Granter</td>
                                        <td class='bold'>
                                            @if($kids[$i]->secondGranter())
                                                {{$kids[$i]->secondGranter()->name}}
                                            @else
                                            <span class='sign_up' data-text="second" id='{{$kids[$i]['id']}}'>I'll do it! <i  class='edit icon signup'></i></span>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endfor


            </div>
        </div>
    </div>
</div>
<div class="ui modal blue sign_up_form">
    <div class="content">
        <h2>Make-A-Wish Kids Sign Up</h2>
    </div>
    <div class="form">
        {{ Form::open(array('url' => 'volunteer/store', 'class'=> 'ui form', 'files' => true, 'method' => 'post') )  }}
            <input type='hidden' name="child" value="">
            <input type="hidden" name="granter_type" value="">
            <input type="hidden" name="honeypot">
            <label for="name">Full Name*</label><br>
            <input type="text" name="name" placeholder='i.e. John Smith (Will be visible on web)'><br>
            <label for="email">Email*</label><br>
            <input type="email" name="email" placeholder="name@domain.com"><br>
            <label for="cell"> Phone</label><br>
            <input type="tel" name="cell" placeholder="(555) 555-5555"><br>
            <input type="submit" class="ui button submit" value="Sign Up!">
        {{Form::close()}}

    </div>

    </div>
</div>



@endsection
