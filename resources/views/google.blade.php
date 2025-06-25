<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>


        <div class="flex items-center justify-end mt-4">
            <a href="{{ url('auth/google') }}">
                <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png"
                    style="margin-left: 3em;">
            </a>
        </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
