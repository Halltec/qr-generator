<x-layouts.app :title="$qrcode->name">
	<div class="max-w-xl mx-auto mt-10 bg-white dark:bg-zinc-800 rounded-lg shadow p-8">
		<h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">Detalle del QR</h1>

		<div class="mb-4">
			<label class="block text-md font-bold text-gray-700 dark:text-gray-200">Nombre</label>
			<div class="text-lg text-gray-900 dark:text-gray-100">{{ $qrcode->name }}</div>
		</div>

		<div class="mb-4">
			<label class="block text-md font-bold text-gray-700 dark:text-gray-200">URL</label>
			<div>
				<a href="{{ $qrcode->url }}" target="_blank" class="text-blue-600 dark:text-blue-400 underline">{{ $qrcode->url }}</a>
			</div>
		</div>

		<div class="mb-4">
			<label class="block text-md font-bold text-gray-700 dark:text-gray-200">Descripción</label>
			<div class="text-gray-900 dark:text-gray-100">{{ $qrcode->description ?? '—' }}</div>
		</div>

		<div class="mb-6 text-center">
			<label class="block text-md font-bold text-gray-700 dark:text-gray-200 mb-2">Código QR</label>
			<img src="{{ $qrcode->qr_code }}" alt="QR Code" class="inline-block w-48 h-48 bg-white p-2 rounded shadow" />
		</div>

		<div class="flex justify-between">
			<a href="{{ route('qrcode.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-zinc-700 text-gray-800 dark:text-gray-100 rounded hover:bg-gray-300 dark:hover:bg-zinc-600 transition">Volver</a>
			<a href="{{ route('qrcode.download', $qrcode) }}" class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded transition">
				Descargar QR
			</a>
		</div>
	</div>
</x-layouts.app>
