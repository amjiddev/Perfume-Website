<x-auth-layout>

    <!--begin::Form-->
    <form class="form w-100" id="kt_password_reset_form" action="{{ route('password.email') }}" method="POST">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-10">
            <!--begin::Title-->
            <h1 class="text-gray-900 fw-bolder mb-3">
                Forgot Password ?
            </h1>
            <!--end::Title-->

            <!--begin::Link-->
            <div class="text-gray-500 fw-semibold fs-6">
                Enter your email to reset your password.
            </div>
            <!--end::Link-->

            <!--begin::Spam Notice-->
            <div class="text-warning fw-semibold fs-7 mt-2">
                <i class="bi bi-exclamation-triangle me-1"></i>
                If you did not receive the email, please check your spam folder.
            </div>
            <!--end::Spam Notice-->
        </div>
        <!--begin::Heading-->

        <!--begin::Status Messages-->
        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show mb-8" role="alert">
                <div class="alert-message">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('status') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!--end::Status Messages-->

        <!--begin::Input group--->
        <div class="fv-row mb-8">
            <!--begin::Email-->
            <input type="email" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent @error('email') is-invalid @enderror" value="{{ old('email') }}" required/>
            
            @error('email')
                <div class="fv-plugins-message-container mt-2">
                    <div class="fv-help-block text-danger fw-semibold">
                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                </div>
            @enderror
            <!--end::Email-->
        </div>

        <!--begin::Actions-->
        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            <button type="submit" id="kt_password_reset_submit" class="btn btn-primary me-4">
                Submit
            </button>

            <a href="{{ route('login') }}" class="btn btn-light">Cancel</a>
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('kt_password_reset_form');
            const submitButton = document.getElementById('kt_password_reset_submit');
            
            if (form) {
                form.addEventListener('submit', function(e) {
                    const email = form.querySelector('input[name="email"]').value.trim();
                    
                    // Basic email validation
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    
                    if (!email) {
                        e.preventDefault();
                        alert('Please enter your email address');
                        return false;
                    }
                    
                    if (!emailRegex.test(email)) {
                        e.preventDefault();
                        alert('Please enter a valid email address');
                        return false;
                    }
                    
                    // Show loading state
                    submitButton.disabled = true;
                    const originalText = submitButton.textContent;
                    submitButton.textContent = 'Sending...';
                    
                    // Allow form submission to continue
                    return true;
                });
            }
        });
    </script>
    @endpush

</x-auth-layout>
