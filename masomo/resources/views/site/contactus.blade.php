@extends('layouts.app')

@section('content')
<title>Contact us, we are dedicated group of teachers and provide questions, answers and explanations for students to revise</title>
<meta name="description" content="" />
<div class="row">
    <h2 class="text-center">CONTACT US</h2><hr>
    <div class="container">
        <div class="col-lg-6">
            <h2>Lets connect</h2><hr>
            <p>For any inquiry, feel free to contact us and our team will respond within the shortest time possible</p>
            <p>For general information, email us at;<br>info@masomotrivia.com</p>
            <p>Call us on;</p>
            <p>+254-782 369220 <br>+254-739 150520</p>
            <p>Follow us on;</p>
            <p>
                <a href="https://www.facebook.com/masomotrivia" target="_blank" class="btn btn-icon btn-rounded btn-primary"><i class="fa fa-facebook"></i></a>
                <a href="https://twitter.com/eddumundia" target="_blank" class="btn btn-icon btn-rounded btn-info"><i class="fa fa-twitter"></i></a>
            </p>
        </div>
        <div class="col-lg-6">
            <h2>Drop a message</h2><hr>
            <form method="POST" action="{{ url('/mail') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email">Your email</label>
                      <input type="text" class="form-control" id="email" name="email"  value="{{ old('email') }}" placeholder="Email" required>
                    </div>
                    <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                      <label for="subject">Subject</label>
                      <input type="text" class="form-control" id="subject" name="subject"  value="{{ old('subject') }}" placeholder="Subject" required>
                    </div>
                    <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                      <label for="message">Your message</label>
                      <textarea id="contactus" class="form-control" name="message"   value="{{ old('message') }}" placeholder="Message us" ></textarea >
                    </div>
                <button type="submit" class="btn btn-primary">Send</button> 
            </form>
        </div>
    </div>
</div>


@endsection
