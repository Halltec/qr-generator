<x-layouts.app :title="__('Create QR Code')">

    <div class="flex items-center justify-between mt-8 mb-6">
		<h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">QR Codes</h1>
	</div>


<section class="w-full">

        <form method="POST" action="{{ route('qrcode.store') }}" class="my-6 w-full space-y-6">
            @csrf
            <flux:input name="name" :label="__('Nombre')" type="text" required autofocus autocomplete="off" value="{{ old('name') }}" />

            <flux:input name="url" :label="__('URL')" type="text" required autocomplete="off" value="{{ old('url') }}" />

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Descripción</label>
                <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 bg-white dark:bg-greay-900 text-gray-900 dark:text-gray-100 shadow-sm focus:border-gray-400 focus:ring-0" placeholder="Descripción opcional">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full cursor-pointer ">
                        {{ __('Generar QR') }}
                    </flux:button>
                </div>
            </div>
        </form>

</section>

</x-layouts.app>
