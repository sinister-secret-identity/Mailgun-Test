@extends('layouts.app')

@section('content')
        <div class="absolute top-0 right-0 mt-4 mr-4">
            <a href="{{ route('create-email') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Send Email</a>
            <a href="{{ route('history') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Show Emails</a>
        </div>

    <div class="container mt-4">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                Send a new email
            </div>
            <div class="card-body">
                <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('store-email')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">To:</label>
                        <input type="email" id="to" name="to" class="form-control" maxlength="100" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Subject</label>
                        <input type="text" id="subject" name="subject" class="form-control" maxlength="100" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Message</label>
                        <textarea name="message" class="form-control" maxlength="140" required=""></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>  
@endsection
