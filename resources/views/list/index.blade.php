@extends('app')

@section('content')
    <h2 class="text-center">All List</h2>
    <div class="row">

        @foreach($lists as $list)
            <div class="col-md-4 card-list">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('list.edit',$list->id)}}" class="link-head" >{{$list->title}}</a>
                        <a class="fa fa-plus float-right ic" href="{{route('card.create',$list->id)}}"></a>
                    </div>
                  <div class="card-body list-task">
                    <div class="list-group" data-list-id="LS{{ $list->id }}" >
                         @foreach($list->cards as $card)
                            <div class="list-group-item">
                                <h5 class="card-title">{{$card->title}}</h5>
                                <p class="card-text">{{str_limit($card->body,20)}}</p>
                                <small class="float-right">{{$card->created_at->diffForHumans()}}</small>
                                <a href="{{route('card.show',$card->id)}}" class="card-link">Read More</a>
                            </div>
                        @endforeach
                    </div>
                  </div>
                </div>
            </div>
        @endforeach

        <div class="col-md-4 card-list">
            <div class="card">
              <div class="card-body">
                <a href="{{route('list.create')}}" >Add New List</a>
              </div>
            </div>
        </div>

    </div>
@endsection