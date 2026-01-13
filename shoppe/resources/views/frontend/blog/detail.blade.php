@extends('frontend.layouts.app')

@section('title', $blog->title)

@section('content')
<section>
    <div class="container">
        <div class="row">

            {{-- LEFT SIDEBAR --}}
            <div class="col-sm-3">
                @include('frontend.layouts.menuleft')
            </div>

            {{-- BLOG DETAIL --}}
            <div class="col-sm-9">
                <div class="blog-post-area">
                    <h2 class="title text-center">Blog Detail</h2>

                    <div class="single-blog-post">
                        <h3>{{ $blog->title }}</h3>

                    <div class="post-meta">
                        <ul>
                            <li>
                                <i class="fa fa-user"></i>
                                Admin
                            </li>

                            {{-- TIME --}}
                            <li>
                                <i class="fa fa-clock-o"></i>
                                {{ optional($blog->created_at)->format('h:i a') }}
                            </li>

                            {{-- DATE --}}
                            <li>
                                <i class="fa fa-calendar"></i>
                                {{ optional($blog->created_at)->format('M d, Y') }}
                            </li>
                        </ul>
                    </div>


                        @if($blog->image)
                            <img
                                src="{{ asset($blog->image) }}"
                                alt=""
                                class="img-responsive"
                                style="max-width:100%; height:auto;"
                            >
                        @endif

                        {!! $blog->description !!}

                        {{-- PREV / NEXT --}}
                        <div class="pager-area">
                            <ul class="pager pull-right">

                                @if($prevBlog)
                                    <li>
                                        <a href="{{ route('member.blog.detail', $prevBlog->id) }}">
                                            Pre
                                        </a>
                                    </li>
                                @endif

                                @if($nextBlog)
                                    <li>
                                        <a href="{{ route('member.blog.detail', $nextBlog->id) }}">
                                            Next
                                        </a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </div><!--/blog-post-area-->

                {{-- RATING (GIỮ NGUYÊN) --}}
                <div class="rating-area">
                    <ul class="ratings">
                        <li class="rate-this">Rate this item:</li>
                        <li>
                            <i class="fa fa-star color"></i>
                            <i class="fa fa-star color"></i>
                            <i class="fa fa-star color"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </li>
                        <li class="color">(6 votes)</li>
                    </ul>
                    <ul class="tag">
                        <li>TAG:</li>
                        <li><a class="color" href="">Pink <span>/</span></a></li>
                        <li><a class="color" href="">T-Shirt <span>/</span></a></li>
                        <li><a class="color" href="">Girls</a></li>
                    </ul>
                </div><!--/rating-area-->

                {{-- SOCIAL SHARE --}}
                <div class="socials-share">
                    <a href="">
                        <img src="{{ asset('frontend/images/blog/socials.png') }}" alt="">
                    </a>
                </div><!--/socials-share-->

                {{-- COMMENTS (GIỮ NGUYÊN) --}}
                <div class="response-area">
                    <h2>3 RESPONSES</h2>
                    <ul class="media-list">
                        <li class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="{{ asset('frontend/images/blog/man-two.jpg') }}" alt="">
                            </a>
                            <div class="media-body">
                                <ul class="sinlge-post-meta">
                                    <li><i class="fa fa-user"></i>Janis Gallagher</li>
                                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                <a class="btn btn-primary" href="">
                                    <i class="fa fa-reply"></i>Replay
                                </a>
                            </div>
                        </li>
                    </ul>
                </div><!--/Response-area-->

                <div class="replay-box">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>Leave a replay</h2>
                            <div class="text-area">
                                <div class="blank-arrow">
                                    <label>Your Name</label>
                                </div>
                                <span>*</span>
                                <textarea name="message" rows="11"></textarea>
                                <a class="btn btn-primary" href="">post comment</a>
                            </div>
                        </div>
                    </div>
                </div><!--/Replay Box-->

            </div>
        </div>
    </div>
</section>
@endsection
