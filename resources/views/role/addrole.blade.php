<x-app-layout>
    <x-slot name="header">
        <h2 class=" font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">Add Role</h2>
    </x-slot>
    <div class="my-10">
        <div class="m-auto rounded-md  p-7 w-2/6 bg-gray-300 dark:bg-gray-800 dark:text-white ">
            <form method="POST" action="{{route('store.role')}}">
                @csrf
        
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Add Role')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter role name"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="mt-5">
                @foreach ($permissions as $item)
                <div class="flex">
                    <div>
                        <input type="checkbox" name="permissions[]" id="permission{{$item->id}}" class=" bg-gray-900 border-blue-900 rounded m-2 " value="{{$item->id}}">
                        <label for="permission{{$item->id}}"></label>{{ $item->name}}
                    </div>
                </div>
                @endforeach
                </div>
                <div class="flex items-center justify-end mt-4">
        
                    <x-primary-button class="ml-4">
                        {{ __('Add Role') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>