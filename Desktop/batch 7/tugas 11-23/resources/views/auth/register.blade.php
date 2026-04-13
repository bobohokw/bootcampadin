<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" value="Nama Lengkap" />
            <x-text-input id="name" class="block mt-1 w-full focus:border-green-500 focus:ring-green-500" 
                          type="text" name="name" :value="old('name')" 
                          required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="Alamat Email" />
            <x-text-input id="email" class="block mt-1 w-full focus:border-green-500 focus:ring-green-500" 
                          type="email" name="email" :value="old('email')" 
                          required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Kata Sandi" />
            <div class="relative mt-1">
                <x-text-input id="password" class="block w-full focus:border-green-500 focus:ring-green-500 pr-10"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <button type="button" onclick="toggleVisibility('password', 'eyeIcon1')" 
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-green-600 focus:outline-none">
                    <i class="fas fa-eye" id="eyeIcon1"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Konfirmasi Kata Sandi" />
            <div class="relative mt-1">
                <x-text-input id="password_confirmation" class="block w-full focus:border-green-500 focus:ring-green-500 pr-10"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                <button type="button" onclick="toggleVisibility('password_confirmation', 'eyeIcon2')" 
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-green-600 focus:outline-none">
                    <i class="fas fa-eye" id="eyeIcon2"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-green-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" href="{{ route('login') }}">
                Sudah punya akun?
            </a>
            <x-primary-button class="ms-4 bg-green-600 hover:bg-green-700 active:bg-green-800 focus:ring-green-500">
                Daftar Sekarang
            </x-primary-button>
        </div>
    </form>

    <script>
        function toggleVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</x-guest-layout>