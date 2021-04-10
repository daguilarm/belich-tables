<div class="flex justify-end text-gray-400" >
    <a href="{{ routeAction($routeName, 'show', $model->id) }}" class="py-2 px-1 hover:text-green-600">
        @svg('heroicon-o-eye', ['class' => 'h-6 xl:h-5'])
    </a>

    <a href="{{ routeAction($routeName, 'edit', $model->id) }}" class="py-2 px-1 hover:text-blue-600">
        @svg('heroicon-o-pencil-alt', ['class' => 'h-6 xl:h-5'])
    </a>

    <a href="#" class="py-2 px-1 text-gray-300 hover:text-red-600">
        @svg('heroicon-o-trash', ['class' => 'h-6 xl:h-5'])
    </a>
</div>
