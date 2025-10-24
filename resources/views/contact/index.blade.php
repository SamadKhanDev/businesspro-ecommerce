@extends('layouts.app')

@section('title', 'Contact - BusinessPro')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Contact Us</h3>
                </div>
                <div class="card-body">
                    <p class="lead">We'd love to hear from you! Send us a message and we'll respond as soon as possible.</p>
                    
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                      id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                    </form>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="row mt-5">
                <div class="col-md-4 text-center">
                    <div class="mb-3">
                        <span style="font-size: 2rem;">📍</span>
                    </div>
                    <h5>Clifton</h5>
                    <p>B-149 Samu Street<br>Suite 100<br>Karachi, State 2400</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="mb-3">
                        <span style="font-size: 2rem;">📞</span>
                    </div>
                    <h5>Phone</h5>
                    <p>+92 3331290021<br>Mon-Fri: 9AM-6PM</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="mb-3">
                        <span style="font-size: 2rem;">✉️</span>
                    </div>
                    <h5>Email</h5>
                    <p>info@samfusion.com<br>support@samfusion.com</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection