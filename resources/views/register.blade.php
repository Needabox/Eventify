<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center text-gray-800">Eventify</h2>
        <h3 class="text-xl font-semibold text-center text-gray-600 mt-2">Register</h3>
        <form class="mt-6 space-y-4" action="{{ route('register-store') }}" method="POST">
            {{ csrf_field() }}
            <!-- Full Name -->
            <div class="relative">
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Full Name<span class="text-red-500">*</span>
                </label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    required
                    class="mt-1 block w-full border-2 border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 px-4 py-2"
                    placeholder="Enter your full name"
                />
            </div>

            <!-- Email Address -->
            <div class="relative">
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Email Address<span class="text-red-500">*</span>
                </label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    required
                    class="mt-1 block w-full border-2 border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 px-4 py-2"
                    placeholder="Enter your email"
                />
            </div>

            {{-- Phone Number --}}
            <div class="relative">
                <label for="phone_number" class="block text-sm font-medium text-gray-700">
                    Phone Number<span class="text-red-500">*</span>
                </label>
                <input
                    id="phone_number"
                    name="phone_number"
                    type="tel"
                    required
                    class="mt-1 block w-full border-2 border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 px-4 py-2"
                    placeholder="Enter your phone number"
                />
            </div>

            <!-- Password -->
            <div class="relative">
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Password<span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        class="mt-1 block w-full border-2 border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 px-4 py-2"
                        placeholder="Enter your password"
                    />
                    <button
                        type="button"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-500"
                    >
                    </button>
                </div>
            </div>

            <!-- Submit -->
            <button
                type="submit"
                class="w-full bg-orange-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
            >
                Register
            </button>
            <p class="text-sm text-center text-gray-600 mt-4">
                Already have an account? <a href="/login" class="text-orange-500 font-medium hover:underline">Sign in</a>
            </p>
        </form>
    </div>
</body>
</html>
