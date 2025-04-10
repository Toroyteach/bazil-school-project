@extends('layouts.front')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-2 text-white mb-4">Students Progress</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item text-white" aria-current="page">Students Progress</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-center bg-primary text-white">
                        <h4 class="mb-0">Student Access Request</h4>
                    </div>

                    <div class="card-body">
                        <div id="response-message"></div>

                        <div id="request-section">
                            <div class="mb-3">
                                <label class="form-label">Admission Number</label>
                                <input type="text" id="admission_number" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Parent Contact (Email or Phone)</label>
                                <input type="text" id="contact" class="form-control">
                            </div>

                            <button id="send-request" class="btn btn-primary w-100">Send OTP</button>
                        </div>

                        <div id="otp-section" class="mt-4 d-none">
                            <div class="mb-3">
                                <label class="form-label">Enter OTP</label>
                                <input type="text" id="otp" class="form-control">
                            </div>

                            <button id="verify-otp" class="btn btn-success w-100">Verify OTP</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        window.addEventListener('load', function () {
            $('#admission_number').val('');
            $('#contact').val('');
            $('#otp').val('');
        });

        $(document).ready(function () {
        
            $('#send-request').click(function () {
                var button = $(this);
                var admission_number = $('#admission_number').val().trim();
                var contact = $('#contact').val().trim();
                var messageBox = $('#response-message');

                messageBox.html('');

                if (!admission_number || !contact) {
                    messageBox.html('<div class="alert alert-danger">Please fill in all fields.</div>');
                    return;
                }

                // Disable the button immediately
                button.prop('disabled', true);
                button.html('Sending...'); // Optionally change button text

                $.ajax({
                    url: "{{ route('student.access.request') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        admission_number: admission_number,
                        contact: contact,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {

                        // Re-enable the button after a delay (e.g., 2 seconds)
                        button.prop('disabled', false);
                        button.html('Send OTP'); // Restore original button text

                        if (response.success) {
                            messageBox.html('<div class="alert alert-success">' + response.message + '</div>');
                            $('#otp-section').removeClass('d-none');

                            $('#admission_number').prop('disabled', true);
                            $('#contact').prop('disabled', true);
                        } else {
                            messageBox.html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function (xhr) {

                        button.prop('disabled', false);
                        button.html('Send OTP');

                        var err = xhr.responseJSON?.message || 'Something went wrong.';
                        messageBox.html('<div class="alert alert-danger">' + err + '</div>');
                    }
                });
            });

            $('#verify-otp').click(function () {
                var button = $(this);
                var otp = $('#otp').val().trim();
                var contact = $('#contact').val().trim();
                var admission_number = $('#admission_number').val().trim();
                var messageBox = $('#response-message');

                messageBox.html('');

                if (!otp) {
                    messageBox.html('<div class="alert alert-danger">Please enter the OTP.</div>');
                    return;
                }

                // Disable the button immediately
                button.prop('disabled', true);
                button.html('Sending...'); // Optionally change button text

                $.ajax({
                    url: "{{ route('student.access.verify') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        otp: otp,
                        contact: contact,
                        admission_number: admission_number,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {

                        button.prop('disabled', false);
                        button.html('Verify OTP'); // Restore original button text

                        if (response.success) {
                            messageBox.html('<div class="alert alert-success">' + response.message + '</div>');
                            $('#otp').prop('disabled', true);
                            $('#verify-otp').prop('disabled', true);

                            setTimeout(function () {
                                window.location.href = response.redirect;
                            }, 2000);
                        } else {
                            messageBox.html('<div class="alert alert-danger">' + response.message + '</div>');
                        }

                    },
                    error: function (xhr) {

                        button.prop('disabled', false);
                        button.html('Verify OTP');

                        var err = xhr.responseJSON?.message || 'Something went wrong.';
                        messageBox.html('<div class="alert alert-danger">' + err + '</div>');
                    }
                });
            });
        });
    </script>
@endsection