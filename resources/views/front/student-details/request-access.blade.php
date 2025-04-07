<!DOCTYPE html>
<html>

<head>
    <title>Student Access</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white shadow-md rounded p-6 space-y-6">
        <h2 class="text-xl font-semibold text-center text-gray-800">Request Access</h2>

        @if (session('error'))
            <div class="text-red-600 text-sm font-medium text-center">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="text-green-600 text-sm font-medium text-center">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('student.access.request') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-1">Admission Number:</label>
                <input type="text" name="admission_number" value="{{ old('admission_number') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-medium mb-1">Parent Contact (Email or Phone):</label>
                <input type="text" name="contact" value="{{ old('contact') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-300">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200">
                Send OTP
            </button>
        </form>

        @if (session('show_otp_form'))
            <hr class="border-t border-gray-200">

            <form method="POST" action="{{ route('student.access.verify') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-1">Enter OTP:</label>
                    <input type="text" name="otp" required
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-300">
                </div>

                <input type="hidden" name="contact" value="{{ session('contact') }}">

                <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition duration-200">
                    Verify OTP
                </button>
            </form>
        @endif
    </div>
</body>

</html>