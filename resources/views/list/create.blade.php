@extends('app')
@section('content')
    <h3 class="text-center">Create List</h3>
    <form action="{{route('list.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="title">List Title</label>
            <input type="text" name="title" id="title" class="form-control {{$errors->has('title') ? 'is-invalid' : '' }}" value="{{old('title')}}" placeholder="Enter Title">
            @if($errors->has('title'))
                <span class="invalid-feedback">
                    {{$errors->first('title')}}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="description">List Description</label>
            <textarea name="description" id="description" rows="4" class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" placeholder="Enter List Description">{{old('description')}}</textarea>
            @if($errors->has('description')) {{-- <-check if we have a validation error --}}
                <span class="invalid-feedback">
                    {{$errors->first('description')}} {{-- <- Display the First validation error --}}
                </span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection