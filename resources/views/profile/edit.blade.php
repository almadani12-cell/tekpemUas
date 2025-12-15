<x-learning-layout>
    @php $title = 'Profile'; @endphp

    {{-- Hero Section --}}
    <x-page-hero 
        :title="'Pengaturan'"
        titleHighlight="Profil"
        badge="👤 PROFILE"
        description="Kelola informasi profil dan keamanan akun Anda"
        :breadcrumb="[
            ['name' => 'Dashboard', 'url' => route('dashboard')],
            ['name' => 'Profile']
        ]"
    />

    {{-- Content --}}
    <section class="py-12 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            {{-- Profile Information Card --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow fade-in-up">
                <div class="p-6 sm:p-8">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Update Password Card --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow fade-in-up delay-100">
                <div class="p-6 sm:p-8">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Delete Account Card --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow fade-in-up delay-200">
                <div class="p-6 sm:p-8">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </section>
</x-learning-layout>
