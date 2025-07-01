<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>




            

   
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <!-- Only show these fields if the user is a guide -->
                    @if (auth()->user()->role === 'guide')
                        <form method="POST" action="{{ route('guide.profile.update') }}">
                            @csrf
                            @method('PUT')

                            <!-- Description -->
                            <div class="mt-4">
                                <x-input-label for="description" :value="('Description')" />
                                <textarea id="description" name="description" class="block mt-1 w-full" rows="4">{{ old('description', optional(auth()->user()->guide)->description ?? '') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <!-- Experience -->
                            <div class="mt-4">
                                <x-input-label for="experience" :value="('Experience')" />
                                <textarea id="experience" name="experience" class="block mt-1 w-full" rows="4">{{ old('experience', optional(auth()->user()->guide)->experience ?? '') }}</textarea>
                                <x-input-error :messages="$errors->get('experience')" class="mt-2" />
                            </div>

                            <!-- Availability -->
                            <div class="mt-4">
                                <x-input-label for="availability" :value="('Availability')" />
                                <textarea id="availability" name="availability" class="block mt-1 w-full" rows="4">{{ old('availability', optional(auth()->user()->guide)->availability ?? '') }}</textarea>
                                <x-input-error :messages="$errors->get('availability')" class="mt-2" />
                            </div>

                            <!-- Save Button -->
                            <div class="mt-4">
                                <x-primary-button>
                                    {{ __('Save Changes') }}
                                </x-primary-button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        




            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
