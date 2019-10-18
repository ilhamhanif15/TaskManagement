@extends('app')

@section('content')
    <h2 class="text-center">All Card</h2>
    <div class="row">

        <!-- <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Task 1
                </div>
              <div class="card-body list-task">
                <div class="list-group" data-list-id="LS1" >

                    @forelse($card as $todo)
                        <div class="list-group-item">
                            <h5 class="card-title">{{$todo->title}}</h5>
                            <p class="card-text">{{str_limit($todo->body,20)}}</p>
                            <small class="float-right">{{$todo->created_at->diffForHumans()}}</small>
                            <a href="{{route('card.show',$todo->id)}}" class="card-link">Read More</a>
                        </div>
                    @empty
                        <h4 class="text-center">No Card Found!</h4>
                    @endforelse

                  </div>
              </div>
            </div>
        </div> -->

        <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <a href="{{route('list.create')}}" >Add New List</a>
              </div>
            </div>
        </div>

    </div>
    <!-- <ul class="list-group py-3 mb-3">
        @forelse($card as $todo)
            <li class="list-group-item my-2">
                <h5>{{$todo->title}}</h5>
                <p>{{str_limit($todo->body,20)}}</p>
                <small class="float-right">{{$todo->created_at->diffForHumans()}}</small>
                <a href="{{route('card.show',$todo->id)}}">Read More</a>
            </li>
        @empty
            <h4 class="text-center">No Card Found!</h4>
        @endforelse
    </ul> -->
    <!-- <div class="d-flex justify-content-center">
        {{$card->links('vendor.pagination.bootstrap-4')}}
    </div> -->
@endsection