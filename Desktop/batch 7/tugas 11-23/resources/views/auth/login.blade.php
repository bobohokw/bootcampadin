<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" value="Alamat Email" />
            <x-text-input id="email" class="block mt-1 w-full focus:border-green-500 focus:ring-green-500" 
                          type="email" name="email" :value="old('email')" 
                          required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Kata Sandi" />
            <x-text-input id="password" class="block mt-1 w-full focus:border-green-500 focus:ring-green-500"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4 gap-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-green-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" href="{{ route('password.request') }}">
                    Lupa kata sandi?
                </a>
            @endif

            <div class="flex items-center bg-gray-100 rounded-lg px-3 py-2 border hover:border-green-500 transition shadow-sm">
                <button type="button" id="togglePassword" class="text-gray-500 focus:outline-none flex items-center gap-2">
                    <span class="text-xs font-medium">Lihat</span>
                    <i class="fas fa-eye" id="eyeIcon"></i>
                </button>
            </div>

            <x-primary-button class="bg-green-600 hover:bg-green-700 active:bg-green-800 focus:ring-green-500 py-2.5">
                Masuk Sekarang
            </x-primary-button>
        </div>
    </form>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle icon
            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
            
            // Ganti teks label (Opsional)
            const label = this.querySelector('span');
            label.textContent = type === 'password' ? 'Lihat' : 'Sembunyi';
        });
    </script>
</x-guest-layout>