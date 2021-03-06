@extends('layouts.front')
@section('title')
Home - nfoot.net, The Live Sports Channels Streaming Platform!
@endsection
@section('meta')
<meta property="og:title" content="Home - nfoot.net, The Live Sports Channels Streaming Platform!">
<meta property="og:description" content="Watch free Live Streaming of sports channels in HD and with no interruptions (beIN Sports, SKy Sports, RMC Sport, AlKaas, Movistar and more!)">
<meta property="og:image" content="{{url('/front/images/website_header.jpg')}}">
<meta property="og:url" content="https://nfoot.net">
<meta name="twitter:title" content="Home - nfoot.net, The Live Sports Channels Streaming Platform!">
<meta name="twitter:description" content="Watch free Live Streaming of sports channels in HD and with no interruptions (beIN Sports, SKy Sports, RMC Sport, AlKaas, Movistar and more!)">
<meta name="twitter:image" content="{{url('/front/images/website_header.jpg')}}">
<meta name="twitter:card" content="{{url('/front/images/website_header.jpg')}}">
@endsection
@section('content')
<section class="banner-section">
    <div class="container">
        <div class="banner-text">
            <h2>Your 24/7 Free Sports Channels Streaming Paradise!</h2>
            @foreach($channels_header->slice(0, 5) as $channel)
            <div class="button-banner">
                <div id="circle"></div>
                <a href="/channel/{{$channel->id}}">
                    <img src="{{url('/uploads/channels')}}/{{$channel->logo}}" alt="{{$channel->logo}}">
                </a>
            </div>
            @endforeach
            <a href="#channels-list" class="mt-3">See all channels</a>
        </div>
        <!--banner-text end-->
    </div>
</section>
<!--banner-section end-->

<section class="vds-main">
    <div class="container">
        <div class="vidz_sec">
            <h3>Highlighted Games Of The Day <a class="h3-seeall" href="{{ url('games') }}">(See All Highlighted Games)</a></h3>
            <div class="vidz_list">
                <div class="row">

                    <!-- Highlighted game -->
                    @forelse($games as $game)
                    <div data-toggle="modal" onclick="selectGame({{$game->channels}})" data-target="#channelSelectModal" class="button-game" style="background: url('{{url('/uploads/locations')}}/{{$game->location->image}}') no-repeat center center;">
                        <div class="highlighted-game">
                            <div class="team-logo">
                                <span class="helper"></span>
                                <img src="{{url('/uploads/logos')}}/{{$game->teamA->logo}}">
                            </div>

                            <div class="competition-details">
                                <div class="round-details">
                                    <img style="width:20px;" src="{{url('/uploads/competitions')}}/{{$game->competition->logo}}">
                                    <span>{{$game->competition->name}}
                                        ({{$game->competition->country}}) {{$game->round}}</span>
                                </div>
                                <div class="location-details">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{$game->location->name}}({{$game->location->town}}, {{$game->location->country}})</span>
                                </div>
                                <div class="date-details">
                                    <i class="far fa-clock"></i>
                                    <span id="remaining-time">{{$game->fullDate()}}
                                    @if($game->status() == 'Planned')
                                         (in {{$game->timeRemaining()}})
                                    @endif
                                    </span>
                                </div>
                                <div class="team-names">
                                    <div class="team-name">
                                        <span>{{$game->teamA->name}}</span>
                                    </div>
                                    <div class="middle-part">
                                        <div class="top-middle-part"></div>
                                        <div class="versus-symbol">
                                            <span>&times;</span>
                                        </div>
                                        @if($game->status() == 'Planned')
                                        <div class="bottom-middle-part"><span>Planned</span></div>
                                        @elseif($game->status() == 'On-going')
                                        <div class="bottom-middle-part"><span class="highlighted-live"><span><i class="fas fa-circle"></i> Live</span></div>
                                        @else
                                        <div class="bottom-middle-part"><span>Done</span></div>
                                        @endif
                                    </div>
                                    <div class="team-name">
                                        <span>{{$game->teamB->name}}</span>
                                    </div>
                                </div>

                                <div class="channels-details">
                                    <span class="helper"></span>
                                    @foreach($game->channels as $channel)
                                    <img src="{{url('/uploads/channels')}}/{{$channel->logo}}">
                                    @endforeach
                                </div>
                            </div>

                            <div class="team-logo">
                                <span class="helper"></span>
                                <img src="{{url('/uploads/logos')}}/{{$game->teamB->logo}}">
                            </div>
                        </div>
                    </div>
                    @empty
                    <!-- If no Highlighted game -->
                    <div class="button-game" id="button-game-none" onclick="window.location.href='#channels-list'">
                        <div class="none-highlighted-game">
                            <div class="no-game-text">
                                <span>No Highlighted Live Games at the time</span>
                            </div>
                            <div class="check-channels-text">
                                <span><i class="fas fa-arrow-circle-down"></i> You can still browse Live Channels to find your game <i class="fas fa-arrow-circle-down"></i></span>
                            </div>
                        </div>
                    </div>
                    <!-- End If no Highlighted game -->
                    @endforelse
                    <!-- End Highlighted game -->
                    <!-- Highlighted game -->
                </div>
                <div style="padding-bottom:30px;" id="channels-list"></div>
            </div>
        </div>
    </div>
</section>
<!--services-sec end-->

<section class="vds-main">
    <div class="vidz-row">
        <div class="container">
            <div class="vidz_sec">
                <h3>All Channels <a class="h3-seeall" href="{{ url('channels') }}"></a></h3>
                @if ($channels->where('language', 'English')->count() > 0)
                <div class="vidz_list" id="english-channels">
                    <h3>English</h3>
                    <div class="row">
                        @foreach($channels->where('language', 'English') as $channel)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6 full_wdth">
                            <div class="videoo">
                                <div class="vid_thumbainl">
                                    <a href="/channel/{{$channel->id}}" title="{{$channel->name}} ({{$channel->language}})">
                                        <img src="{{url('/uploads/channels')}}/{{$channel->banner}}" alt="">
                                        <span class="vid-lang">{{$channel->language}}</span>
                                        @foreach($channel->games as $game)
                                        @if ($game->status() == 'On-going')
                                        <!-- If game is on -->
                                        <span class="vid-game">
                                            <span>
                                                <i>Now playing</i><br>
                                                <img class="teamlogo" src="{{url('/uploads/logos')}}/{{$game->teamA->logo}}">
                                                {{$game->teamA->name}} &times; {{$game->teamB->name}}
                                                <img class="teamlogo" src="{{url('/uploads/logos')}}/{{$game->teamB->logo}}">
                                            </span>
                                        </span>
                                        <!-- End if game is on -->
                                        @endif
                                        @endforeach
                                        <span class="vid-live"><span><i class="fas fa-circle" style="font-size:10px;"></i> Live</span></span>
                                    </a>
                                </div>
                                <!--vid_thumbnail end-->
                                <div class="video_info">
                                    <h3><a href="/channel/{{$channel->id}}" title="">{{$channel->name}}</a></h3>
                                    <span><i class="fas fa-eye"></i> {{$channel->views}}</span>
                                </div>
                            </div>
                            <!--video end-->
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                <!--vidz_list end-->
                
                @if ($channels->where('language', 'French')->count() > 0)
                <div class="vidz_list mt-5" id="french-channels">
                    <h3>French</h3>
                    <div class="row">
                        @foreach($channels->where('language', 'French') as $channel)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6 full_wdth">
                            <div class="videoo">
                                <div class="vid_thumbainl">
                                    <a href="/channel/{{$channel->id}}" title="{{$channel->name}} ({{$channel->language}})">
                                        <img src="{{url('/uploads/channels')}}/{{$channel->banner}}" alt="">
                                        <span class="vid-lang">{{$channel->language}}</span>
                                        <!-- If game is on -->
                                        @foreach($channel->games as $game)
                                        @if ($game->status() == 'On-going')
                                        <!-- If game is on -->
                                        <span class="vid-game">
                                            <span>
                                                <i>Now playing</i><br>
                                                <img class="teamlogo" src="{{url('/uploads/logos')}}/{{$game->teamA->logo}}">
                                                {{$game->teamA->name}} &times; {{$game->teamB->name}}
                                                <img class="teamlogo" src="{{url('/uploads/logos')}}/{{$game->teamB->logo}}">
                                            </span>
                                        </span>
                                        <!-- End if game is on -->
                                        @endif
                                        @endforeach
                                        <!-- End if game is on -->
                                        <span class="vid-live"><span><i class="fas fa-circle" style="font-size:10px;"></i> Live</span></span>
                                    </a>
                                </div>
                                <!--vid_thumbnail end-->
                                <div class="video_info">
                                    <h3><a href="/channel/{{$channel->id}}" title="">{{$channel->name}}</a></h3>
                                    <span><i class="fas fa-eye"></i> {{$channel->views}}</span>
                                </div>
                            </div>
                            <!--video end-->
                        </div>
                        @endforeach
                    </div>
                </div>
                <!--vidz_list end-->
                @endif
                @if ($channels->where('language', 'Spanish')->count() > 0)
                <div class="vidz_list mt-5" id="spanish-channels">
                    <h3>Spanish</h3>
                    <div class="row">
                        @foreach($channels->where('language', 'Spanish') as $channel)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6 full_wdth">
                            <div class="videoo">
                                <div class="vid_thumbainl">
                                        <a href="/channel/{{$channel->id}}" title="{{$channel->name}} ({{$channel->language}})">
                                        <img src="{{url('/uploads/channels')}}/{{$channel->banner}}" alt="">
                                        <span class="vid-lang">{{$channel->language}}</span>
                                        <!-- If game is on -->
                                        @foreach($channel->games as $game)
                                        @if ($game->status() == 'On-going')
                                        <!-- If game is on -->
                                        <span class="vid-game">
                                            <span>
                                                <i>Now playing</i><br>
                                                <img class="teamlogo" src="{{url('/uploads/logos')}}/{{$game->teamA->logo}}">
                                                {{$game->teamA->name}} &times; {{$game->teamB->name}}
                                                <img class="teamlogo" src="{{url('/uploads/logos')}}/{{$game->teamB->logo}}">
                                            </span>
                                        </span>
                                        <!-- End if game is on -->
                                        @endif
                                        @endforeach
                                        <!-- End if game is on -->
                                        <span class="vid-live"><span><i class="fas fa-circle" style="font-size:10px;"></i> Live</span></span>
                                    </a>
                                </div>
                                <!--vid_thumbnail end-->
                                <div class="video_info">
                                    <h3><a href="/channel/{{$channel->id}}" title="">{{$channel->name}}</a></h3>
                                    <span><i class="fas fa-eye"></i> {{$channel->views}}</span>
                                </div>
                            </div>
                            <!--video end-->
                        </div>
                        @endforeach
                    </div>
                </div>
                <!--vidz_list end-->
            @endif
            @if ($channels->where('language', 'Arabic')->count() > 0)
            <div class="vidz_list mt-5" id="arabic-channels">
                <h3>Arabic</h3>
                <div class="row">
                    @foreach($channels->where('language', 'Arabic') as $channel)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-6 full_wdth">
                        <div class="videoo">
                            <div class="vid_thumbainl">
                                <a href="/channel/{{$channel->id}}" title="{{$channel->name}} ({{$channel->language}})">
                                    <img src="{{url('/uploads/channels')}}/{{$channel->banner}}" alt="">
                                    <span class="vid-lang">{{$channel->language}}</span>
                                    <!-- If game is on -->
                                    @foreach($channel->games as $game)
                                    @if ($game->status() == 'On-going')
                                    <!-- If game is on -->
                                    <span class="vid-game">
                                        <span>
                                            <i>Now playing</i><br>
                                            <img class="teamlogo" src="{{url('/uploads/logos')}}/{{$game->teamA->logo}}">
                                            {{$game->teamA->name}} &times; {{$game->teamB->name}}
                                            <img class="teamlogo" src="{{url('/uploads/logos')}}/{{$game->teamB->logo}}">
                                        </span>
                                    </span>
                                    <!-- End if game is on -->
                                    @endif
                                    @endforeach
                                    <!-- End if game is on -->
                                    <span class="vid-live"><span><i class="fas fa-circle" style="font-size:10px;"></i> Live</span></span>
                                </a>
                            </div>
                            <!--vid_thumbnail end-->
                            <div class="video_info">
                                <h3><a href="/channel/{{$channel->id}}" title="">{{$channel->name}}</a></h3>
                                <span><i class="fas fa-eye"></i> {{$channel->views}}</span>
                            </div>
                        </div>
                        <!--video end-->
                    </div>
                    @endforeach
                </div>
            </div>
            <!--vidz_list end-->
            @endif
        </div>
        <!--vidz_videos end-->
    </div>
    </div>
    <!--vidz-row end-->
</section>
<!--vds-main end-->

@endsection