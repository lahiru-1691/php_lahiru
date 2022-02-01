@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-5 offset-md-3 mt-3 ">
        <div class="card">
            <div class="card-header">Add Sales Person</div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{$message}}</p>
                    </div>
                @endif
                <div class="pull-right">
                    <a class="btn btn-info pull-right" href="{{route('list')}}" title="Add New Sales Person"> <i class="fas fa-plus-circle"></i> Sales Person List</a>
                </div>
                <form class="p-1" method="POST">
                    @csrf
                    <div class="mb-1">
                        <label for="Full Name" class="form-label">Full Name <span class="required">*</span></label>
                        <input type="name" class="form-control" id="name" name="name" value={{old('name')}}>
                        @if($errors->has('name'))
                            <label id="label-error" class="error" for="label">{{$errors->first('name')}}</label>
                        @endif
                    </div>
                    <div class="mb-1">
                        <label for="Email" class="form-label">Email Address <span class="required">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" value={{old('email')}}>
                        @if($errors->has('email'))
                            <label id="label-error" class="error" for="label">{{$errors->first('email')}}</label>
                        @endif
                    </div>
                    <div class="mb-1">
                        <label for="Telephone" class="form-label">Telephone <span class="required">*</span></label>
                        <input type="text" class="form-control" id="telephone" name="telephone" value={{old('telephone')}}>
                        @if($errors->has('telephone'))
                            <label id="label-error" class="error" for="label">{{$errors->first('telephone')}}</label>
                        @endif
                    </div>
                    <div class="mb-1">
                        <label for="Joined Date" class="form-label">Joined Date <span class="required">*</span></label>
                        <input type="date" class="form-control" id="date" name="date" value={{old('date')}}>
                        @if($errors->has('date'))
                            <label id="label-error" class="error" for="label">{{$errors->first('date')}}</label>
                        @endif
                    </div>
                    <div class="mb-1">
                        <label for="Current Route" class="form-label">Current Route <span class="required">*</span></label>
                        <select class="form-select" name="route">
                            <option value="">Select Working Route</option>
                            @if($workingRoutes && sizeof($workingRoutes) > 0)
                                @foreach($workingRoutes as $key => $value)
                                    <option value="{{$value->id}}" @if(old('route') == $value->id) selected @endif>{{$value->working_route}}</option>
                                @endforeach
                            @endif
                        </select>
                        @if($errors->has('route'))
                            <label id="label-error" class="error" for="label">{{$errors->first('route')}}</label>
                        @endif
                    </div>
                    <div class="mb-1">
                        <label for="Comments" class="form-label">Comments</label>
                        <textarea class="form-control" id="comments" rows="3" name="comments">{{old('comments')}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>