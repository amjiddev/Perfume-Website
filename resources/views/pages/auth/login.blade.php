<x-auth-layout>

    <!--begin::Form-->
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="{{ route('dashboard') }}"
        action="{{ route('login') }}" method="POST">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-gray-900 fw-bolder mb-3">
                Sign In
            </h1>
            <!--end::Title-->
        </div>

        <!--begin::Input group--->
        <div class="fv-row mb-8 position-relative">
            <!--begin::Email-->
            <input type="text" placeholder="Email" name="email" autocomplete="off"
                class="form-control bg-transparent" value="{{ old('email') }}" />
            @error('email')
                <div class="fv-plugins-message-container">
                    <div class="fv-help-block"><span role="alert">{{ $message }}</span></div>
                </div>
            @enderror
            <!--end::Email-->
        </div>

        <!--end::Input group--->
        <div class="fv-row mb-3 position-relative">
            <!--begin::Password-->
            <input type="password" placeholder="Password" name="password" autocomplete="off"
                class="form-control bg-transparent" value="" id="login_password" />
            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" 
                onclick="togglePasswordVisibility('login_password', this)" style="cursor: pointer; z-index: 10;">
                <i class="bi bi-eye-slash fs-2"></i>
                <i class="bi bi-eye fs-2 d-none"></i>
            </span>
            @error('password')
                <div class="fv-plugins-message-container">
                    <div class="fv-help-block"><span role="alert">{{ $message }}</span></div>
                </div>
            @enderror
            <!--end::Password-->
        </div>
        <!--end::Input group--->

        <!--begin::Wrapper-->
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
            <div></div>

            <!--begin::Link-->
            <a href="{{ route('password.request') }}" class="link-primary">
                Forgot Password ?
            </a>
            <!--end::Link-->
        </div>
        <!--end::Wrapper-->

        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                @include('partials/general/_button-indicator', ['label' => 'Sign In'])
            </button>
        </div>
        <!--end::Submit button-->

        <!--begin::Sign up-->
        <!-- Sign up functionality removed -->
        <!--end::Sign up-->
    </form>
    <!--end::Form-->

    @push('scripts')
    <script>
        function togglePasswordVisibility(inputId, button) {
            const input = document.getElementById(inputId);
            const eyeSlash = button.querySelector('.bi-eye-slash');
            const eye = button.querySelector('.bi-eye');
            
            if (input.type === 'password') {
                input.type = 'text';
                eyeSlash.classList.add('d-none');
                eye.classList.remove('d-none');
            } else {
                input.type = 'password';
                eyeSlash.classList.remove('d-none');
                eye.classList.add('d-none');
            }
        }
    </script>
    @endpush

</x-auth-layout>
