<div class="flex items-center">
    <div class="flex-shrink-0 h-10 w-10">
        <img
            class="h-10 w-10 rounded-full"
            src="https://randomuser.me/api/portraits/thumb/men/{{ rand(1, 100) }}.jpg"
            dusk="test-image"
            alt=""
        >
    </div>
    <div class="ml-4">
        <div
            class="text-sm font-medium text-gray-900"
            dusk="test-name"
        >
            {{ $user->name }}
        </div>
        <div
            class="text-sm text-gray-500"
            dusk="test-email"
        >
            {{ $user->email }}
        </div>
    </div>
</div>
