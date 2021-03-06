@extends('layouts.layout')
@section('content')

<div id="content">

<!-- Bread crumb is created dynamically -->
<!-- row -->
<div class="row">

    <!-- col -->
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><!-- PAGE HEADER --><i class="fa-fw fa fa-file-o"></i>User Pages<span>>Profile </span></h1>
    </div>
    <!-- end col -->

</div>
<!-- end row -->

<!-- row -->

<div class="row">

<div class="col-sm-12">


<div class="well well-sm">

<div class="row">

<div class="col-sm-12 col-md-12 col-lg-6">
<div class="well well-light well-sm no-margin no-padding">

<div class="row">

    <div class="col-sm-12">
        <div id="myCarousel" class="carousel fade profile-carousel">
            <div class="air air-bottom-right padding-10">
                <a href="javascript:void(0);" class="btn txt-color-white bg-color-teal btn-sm"><i
                        class="fa fa-check"></i> Follow</a>&nbsp; <a href="javascript:void(0);"
                                                                     class="btn txt-color-white bg-color-pinkDark btn-sm"><i
                        class="fa fa-link"></i> Connect</a>
            </div>
            <div class="air air-top-left padding-10">
                <h4 class="txt-color-white font-md">Jan 1, 2014</h4>
            </div>
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                <li data-target="#myCarousel" data-slide-to="2" class=""></li>
            </ol>
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="item active">
                    <img src="{{asset('img/demo/s1.jpg')}}" alt="">
                </div>
                <!-- Slide 2 -->
                <div class="item">
                    <img src="{{asset('img/demo/s2.jpg')}}" alt="">
                </div>
                <!-- Slide 3 -->
                <div class="item">
                    <img src="{{asset('img/demo/m3.jpg')}}" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">

        <div class="row">

            <div class="col-sm-3 profile-pic">
                <img src="http://www.gravatar.com/avatar/{{$user->gravatar}}">

                <div class="padding-10">
<!--                    <h4 class="font-md"><strong>1,543</strong>-->
<!--                        <br>-->
<!--                        <small>Followers</small>-->
<!--                    </h4>-->
<!--                    <br>-->
<!--                    <h4 class="font-md"><strong>419</strong>-->
<!--                        <br>-->
<!--                        <small>Connections</small>-->
<!--                    </h4>-->
                </div>
            </div>
            <div class="col-sm-6">
                <h1>{{$user->contact->firstName}} <span class="semi-bold">{{$user->contact->lastName}}</span>
                    <br>
                    <small> Possible title zone</small>
                </h1>

                <ul class="list-unstyled">
                    <li>
                        <p class="text-muted">
                            <i class="fa fa-phone"></i>&nbsp;&nbsp;<span class="txt-color-darken">{{$user->parsedNumber}}</span>
                        </p>
                    </li>
                    <li>
                        <p class="text-muted">
                            <i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href="mailto:simmons@smartadmin">{{$user->email}}</a>
                        </p>
                    </li>
                    <li>
                        <p class="text-muted">
                            <i class="fa fa-skype"></i>&nbsp;&nbsp;<span class="txt-color-darken">john12</span>
                        </p>
                    </li>
                </ul>
                <br>

                <p class="font-md">
                    <i>A little about me...</i>
                </p>

                <p>

                    Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est
                    eligendi optio
                    cumque nihil impedit quo minus id quod maxime placeat facere

                </p>
                <br>
                <a href="javascript:void(0);" class="btn btn-default btn-xs"><i class="fa fa-envelope-o"></i> Send
                    Message</a>
                <br>
                <br>

            </div>
            <div class="col-sm-3">
                <h1>
                    <small>Sub-Users</small>
                </h1>
                <ul class="list-inline friends-list">
                    @foreach ($user->children as $child)
                    <li><img src="http://www.gravatar.com/avatar/{{md5(strtolower(trim($child->email)))}}"></li>
                    @endforeach
                </ul>

            </div>

        </div>

    </div>

</div>

</div>

</div>
<div class="col-sm-12 col-md-12 col-lg-6">
    {{ Form::open(array('action' => 'UserController@userProfilePost')) }}
        <textarea name="content" rows="2" class="form-control" placeholder="What are you thinking?"></textarea>
        {{ Form::hidden('pageId', $pageId) }}
        <div class="margin-top-10">
            <button type="submit" class="btn btn-sm btn-primary pull-right">
                Post
            </button>
        </div>
    {{ Form::close() }}

    @foreach ($user->postings as $post)

	<span class="timeline-seperator text-center"> <span>{{ date("g:i a F j, Y", strtotime($post->created_at)); }}</span> </span>

    <div class="chat-body no-padding profile-message">
        <ul>
            <li class="message">
                <img src="http://www.gravatar.com/avatar/{{md5(strtolower(trim($user->email)))}}" class="online" width="45px">
                <span class="message-text"> <a href="javascript:void(0);" class="username">
                        {{ $post->user->name }}
                    </a>
                    {{ $post->content }}
                </span>
                <ul class="list-inline font-xs">
                    @if (Auth::user()->id == $pageId)
                    <li>
                        <a href="javascript:void(0);" class="text-danger">Delete</a>
                    </li>
                    <li>
                    <small class="text-muted">
                        {{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}
                    </small>
                    </li>
                    @endif
                </ul>
            </li>
            <li class="message message-reply">
                <img src="img/avatars/4.png" class="online">
                <span class="message-text"> <a href="javascript:void(0);" class="username">Sadi Orlaf </a> Haha! Yeah I know what you mean. Thanks for the file Sadi! <i
                        class="fa fa-smile-o txt-color-orange"></i> </span>

                <ul class="list-inline font-xs">
                    <li>
                        <a href="javascript:void(0);" class="text-muted">a moment ago </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="text-danger"><i class="fa fa-thumbs-up"></i> Like</a>
                    </li>
                </ul>
                {{ Form::open(array('action' => 'UserController@userProfileComment')) }}
                {{ Form::hidden('commentParent', $post->id) }}
                {{ Form::text('comment', null, array('placeholder' => 'Type and enter', 'class' => 'form-control input-xs')) }}
                {{ Form::close() }}
            </li>
        </ul>

    </div>

    @endforeach
										<span
                                            class="timeline-seperator text-center"> <span>11:30PM November 27th, 2013</span>
											<div class="btn-group pull-right">
                                                <a href="javascript:void(0);" data-toggle="dropdown"
                                                   class="btn btn-default btn-xs dropdown-toggle"><span
                                                        class="caret single"></span></a>
                                                <ul class="dropdown-menu text-left">
                                                    <li>
                                                        <a href="javascript:void(0);">Hide this post</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Hide future posts from this
                                                            user</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Mark as spam</a>
                                                    </li>
                                                </ul>
                                            </div> </span>

    <div class="chat-body no-padding profile-message">
        <ul>
            <li class="message">
                <img src="img/avatars/1.png" class="online">
                <span class="message-text"> <a href="javascript:void(0);" class="username">John Doe
                        <small class="text-muted pull-right ultra-light"> 2 Minutes ago</small>
                    </a> Can't divide were divide fish forth fish to. Was can't form the, living life grass darkness very image let unto fowl isn't in blessed fill life yielding above all moved </span>
                <ul class="list-inline font-xs">
                    <li>
                        <a href="javascript:void(0);" class="text-info"><i class="fa fa-reply"></i> Reply</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="text-danger"><i class="fa fa-thumbs-up"></i> Like</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="text-muted">Show All Comments (14)</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="text-primary">Hide</a>
                    </li>
                </ul>
            </li>
            <li class="message message-reply">
                <img src="img/avatars/3.png" class="online">
                <span class="message-text"> <a href="javascript:void(0);" class="username">Serman Syla</a> Haha! Yeah I know what you mean. Thanks for the file Sadi! <i
                        class="fa fa-smile-o txt-color-orange"></i> </span>

                <ul class="list-inline font-xs">
                    <li>
                        <a href="javascript:void(0);" class="text-muted">1 minute ago </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="text-danger"><i class="fa fa-thumbs-up"></i> Like</a>
                    </li>
                </ul>

            </li>
            <li class="message message-reply">
                <img src="img/avatars/4.png" class="online">
                <span class="message-text"> <a href="javascript:void(0);" class="username">Sadi Orlaf </a> Haha! Yeah I know what you mean. Thanks for the file Sadi! <i
                        class="fa fa-smile-o txt-color-orange"></i> </span>

                <ul class="list-inline font-xs">
                    <li>
                        <a href="javascript:void(0);" class="text-muted">a moment ago </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="text-danger"><i class="fa fa-thumbs-up"></i> Like</a>
                    </li>
                </ul>

            </li>
            <li class="message message-reply">
                <img src="img/avatars/4.png" class="online">
                <span class="message-text"> <a href="javascript:void(0);" class="username">Sadi Orlaf </a> Haha! Yeah I know what you mean. Thanks for the file Sadi! <i
                        class="fa fa-smile-o txt-color-orange"></i> </span>

                <ul class="list-inline font-xs">
                    <li>
                        <a href="javascript:void(0);" class="text-muted">a moment ago </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="text-danger"><i class="fa fa-thumbs-up"></i> Like</a>
                    </li>
                </ul>

            </li>
            <li>
                <div class="input-group wall-comment-reply">
                    <input id="btn-input" type="text" class="form-control" placeholder="Type your message here...">
														<span class="input-group-btn">
															<button class="btn btn-primary" id="btn-chat">
                                                                <i class="fa fa-reply"></i> Reply
                                                            </button> </span>
                </div>
            </li>
        </ul>

    </div>


</div>
</div>

</div>


</div>

</div>

<!-- end row -->

</div>
@stop