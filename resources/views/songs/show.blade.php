@extends('layouts.songs')
@section('content')
  <div class="row">
      <div class="col-lg-12 margin-tb">
          <div class="pull-left">
              <h2>Show Song</h2>
          </div>
          <div class="pull-right">
              <br/>
              <a class="btn btn-primary" href="{{ route('songs.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
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
          <div class="form-group">
              <strong>Artist : </strong>         

                 @if ($song_data['song']->artists) 
                     @foreach( $song_data['song']->artists as $key => $artist)                       
                        @if ($song_data['artists']) 
                        {{$song_data['artists'][$artist]}}
                             {{ $loop->last ? '' : ', ' }}
                        @endif  
                    @endforeach 
                @endif  

          </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Lyrics : </strong>
              <pre>{{ $song_data['song']->lyrics}}</pre>
          </div>
      </div>
  </div>
@endsection