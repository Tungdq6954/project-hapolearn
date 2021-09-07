@extends('layouts.app')

@section('content')

    <div class="profile">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="avatar-div">
                        <img src="{{ asset($user->avatar) }}" alt="avatar" id="avatar" class="avatar">
                        <label for="avatar-input" class="camera">
                            <i class="fas fa-camera"></i>
                        </label>
                    </div>
                    <div class="mt-4 username">{{ $user->name }}</div>
                    <div class="email">{{ $user->email }}</div>
                    <div class="pr-4">
                        <div class="birthday-div">
                            <div class="icon-birthday">
                                <i class="fas fa-birthday-cake"></i>
                            </div>
                            <div class="birthday-content">{{ \Carbon\Carbon::parse($user->birthday)->format('d/m/Y') }}
                            </div>
                        </div>
                        <div class="phone-div">
                            <div class="icon-phone">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="phone-content">{{ $user->phone }}</div>
                        </div>
                        <div class="address-div">
                            <div class="icon-address">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="address-content">{{ $user->address }}</div>
                        </div>
                    </div>
                    <div class="pr-2 about-me">
                        {{ $user->aboutMe }}
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="my-course">
                        <div class="title">
                            My courses
                        </div>
                        <div class="list-courses">
                            @foreach ($courses as $course)
                                <a href="{{ route('courses.detail', ['courseId' => $course->id]) }}"
                                    class="list-courses-item">
                                    <img class="img-course" src="{{ $course->logo_path }}" alt="img course">
                                    <div class="mt-2 course-title">{{ $course->title }}</div>
                                </a>
                            @endforeach
                            <a href="{{ route('courses.index') }}" class="add-course-item">
                                <div class="add-course-button">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="mt-2 add-course-title">Add course</div>
                            </a>
                        </div>
                        <div class="edit-profile">
                            <div class="edit-profile-title">Edit profile</div>
                            <form action="{{ route('users.upload') }}" method="post" enctype="multipart/form-data"
                                class="mt-3">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username-input" class="input-label">Name:</label>
                                            <input type="text" class="form-control input-style" name="username_input"
                                                id="username-input" placeholder="Your name...">
                                            @error('username_input')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email-input" class="input-label">Email:</label>
                                            <input type="email" class="form-control input-style" name="email_input"
                                                id="email-input" placeholder="Your email...">
                                            @error('email_input')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="birthday-input" class="input-label">Date of birthday:</label>
                                            <input type="text" class="form-control input-style" name="birthday_input"
                                                id="birthday-input" placeholder="dd/mm/yyyy">
                                            <div class="calendar-icon"><i class="far fa-calendar-minus"></i></div>
                                            @error('birthday_input')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone-input" class="input-label">Phone:</label>
                                            <input type="tel" class="form-control input-style" id="phone-input"
                                                name="phone_input" placeholder="Your phone number...">
                                            @error('phone_input')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address-input" class="input-label">Address:</label>
                                            <input type="text" class="form-control input-style" name="address_input"
                                                id="address-input" placeholder="Your address...">
                                            @error('address_input')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="aboutme-input" class="input-label">About me:</label>
                                            <textarea class="form-control" name="aboutme_input" id="aboutme-input"
                                                rows="6" placeholder="About you..."></textarea>
                                            @error('aboutme_input')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="file" class="hidden" name="avatar_input" id="avatar-input">
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="float-right button-update">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
