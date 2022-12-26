@extends('layouts.songs')
@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">              
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="{{ url('/admin/songs')}}">Dashboard</a>
                </li>
                <li class="active ml-3">
                    <i class="fa fa-table"></i> Song
                </li>
            </ol>

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ url()->previous() }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>
        </div>
    </div>

  <div class="row">
      <div class="col-lg-12 margin-tb">
          <div class="pull-left">
              <h2>Song:  {{ $song_data['song']->name}}</h2>
          </div>
          
      </div>
  </div>
  <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Title : </strong>
              {{ $song_data['song']->name}}
          </div>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Movie : </strong>         
              @php  
              $movies = $song_data['song']->movies;
             
              @endphp  
              {{$song_data['movies'][$movies]}}

          </div>
      </div> 

      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Music Directors : </strong>         

                 @if ($song_data['song']->music_directors) 
                     @foreach( $song_data['song']->music_directors as $key => $music_director)                       
                        @if ($song_data['music_directors']) 
                        {{$song_data['music_directors'][$music_director]}}
                             {{ $loop->last ? '' : ', ' }}
                        @endif  
                    @endforeach 
                @endif  

          </div>
      </div>


      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Lyricists : </strong>         

                 @if ($song_data['song']->lyricists) 
                     @foreach( $song_data['song']->lyricists as $key => $lyricist)                       
                        @if ($song_data['lyricists']) 
                        {{$song_data['lyricists'][$lyricist]}}
                             {{ $loop->last ? '' : ', ' }}
                        @endif  
                    @endforeach 
                @endif  

          </div>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Singers : </strong>         

                 @if ($song_data['song']->singers) 
                     @foreach( $song_data['song']->singers as $key => $singer)                       
                        @if ($song_data['singers']) 
                        {{$song_data['singers'][$singer]}}
                             {{ $loop->last ? '' : ', ' }}
                        @endif  
                    @endforeach 
                @endif  

          </div>
      </div>
      
      
    
    

      <div class="col-xs-12 col-sm-12 col-md-12">
         
        <div class="form-group"><strong>Lyrics : </strong>  </div>           

            <!-- Tabs navs -->
            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="lyrics_tamil-tab" data-bs-toggle="tab" data-bs-target="#lyrics_tamil" type="button" role="tab" aria-controls="home" aria-selected="true">Tamil</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="lyrics_english-tab" data-bs-toggle="tab" data-bs-target="#lyrics_english" type="button" role="tab" aria-controls="profile" aria-selected="false">English</button>
                </li>
            
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="lyrics_tamil" role="tabpanel" aria-labelledby="home-tab">
                            
                    <div class="form-group">
                        <pre>{{ $song_data['song']->lyrics_tamil}}</pre>
                    </div>
                </div>
                <div class="tab-pane fade" id="lyrics_english" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="form-group">
                        <pre>{{ $song_data['song']->lyrics_english}}</pre>
                    </div>
                </div> 
            </div>
            <!-- Tabs content -->


        </div>
     </div>
    
     @if ( $song_data['song']->youtube_url !== NULL ||  !empty($song_data['song']->youtube_url) )
     <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Youtube : </strong>         
                <div> 
                    {{-- Embed::make($song_data['song']->youtube_url)->parseUrl()->getIframe() --}}
                    <iframe width="420" height="315" src="{{$song_data['song']->youtube_url}}" frameborder="0" allowfullscreen></iframe>
                </div>
          </div>
      </div>
      @endif  
     
@endsection