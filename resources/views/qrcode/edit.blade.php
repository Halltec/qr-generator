

<x-layouts.app :title="__('Editar QR Code')">
	<div class="flex items-center justify-between mt-8 mb-6">
		<h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Editar QR Code</h1>
	</div>

<section class="w-full">

		<form method="POST" action="{{ route('qrcode.update', $qrcode) }}" class="my-6 w-full space-y-6">
			@csrf
			@method('PATCH')
			<flux:input name="name" :label="__('Nombre')" type="text" required autofocus autocomplete="off" value="{{ old('name', $qrcode->name) }}" />

			<flux:input name="url" :label="__('URL')" type="text" required autocomplete="off" value="{{ old('url', $qrcode->url) }}" />

			<div>
				<label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Descripción</label>
				<textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-700 bg-gray-700 dark:bg-gray-700 text-gray-100 px-3 py-2 focus:border-gray-400 focus:ring-0" placeholder="Descripción opcional">{{ old('description', $qrcode->description) }}</textarea>
				@error('description')
					<p class="text-sm text-red-600 mt-1">{{ $message }}</p>
				@enderror
			</div>

			<div class="flex items-center gap-4">
				<div class="flex items-center justify-end">
					<flux:button variant="primary" type="submit" class="w-full cursor-pointer ">
						{{ __('Actualizar QR') }}
					</flux:button>
				</div>
			</div>
			<div class="mt-8 text-center">
				<label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Código QR actual</label>
				<img src="{{ $qrcode->qr_code }}" alt="QR Code" class="inline-block w-40 h-40 bg-white p-2 rounded shadow" />
			</div>
		</form>

</section>

</x-layouts.app>

