<x-app-layout>
    <x-slot name="header">
        <h2 class=" font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">Update User</h2>
    </x-slot>
    <div class="my-10">
        <div class="m-auto rounded-md  p-7 w-2/6 bg-gray-300 dark:bg-gray-800 ">
            <form method="POST" action="{{route('update.user',$user->id)}}">
                @csrf
        
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$user->name}}" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
        
                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$user->email}}" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
        
                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
        
                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    autocomplete="new-password" />
        
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
        
                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" autocomplete="new-password" />
        
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <div class="mt-4">
                    
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                    <select id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Choose a role</option>
                        @foreach ($roles as $role)
                        <option value="{{$role->name}}" @if (in_array($role->id , $data)) @selected(true)  @endif>{{$role->name}}</option>
                        @endforeach
                        
                    </select>

                </div>
        
                    <div class="flex items-center justify-end mt-4">
                    {{-- <button type="submit" class="bg-green-700 text-white px-2 py-3 rounded">update User</button> --}}
                    <x-primary-button class="ml-4 dark:bg-green-400">
                        {{ __('update user') }}
                    </x-primary-button>
                    </div>
            </form>
        </div>
    </div>
</x-app-layout>