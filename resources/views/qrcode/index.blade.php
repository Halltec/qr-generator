
<x-layouts.app :title="__('Qr Codes')">
	<div class="flex items-center justify-between mt-8 mb-6">
		<h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">QR Codes</h1>
			 <a href="{{ route('qrcode.create') }}"
				 class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-100 hover:text-black focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition">
			<svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
			   Crear QR
		</a>
	</div>
	<div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 mt-6">
		<table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
			<thead class="bg-gray-50 dark:bg-zinc-900">
				<tr>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">#</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">URL</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Description</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Created At</th>
				</tr>
			</thead>
			<tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
				@forelse($qrcodes as $qrcode)
					<tr>
						<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $qrcodes->firstItem() + $loop->index }}</td>
						<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $qrcode->name }}</td>
						<td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 dark:text-blue-400">
							@if($qrcode->url)
								<a href="{{ $qrcode->url }}" target="_blank" rel="noopener">{{ $qrcode->url }}</a>
							@else
								—
							@endif
						</td>
						<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $qrcode->description ?? '—' }}</td>
						<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $qrcode->created_at?->format('Y-m-d H:i') }}</td>
					</tr>
				@empty
					<tr>
						<td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">No QR codes found.</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>
	
	{{-- Pagination links --}}
	@if($qrcodes instanceof \Illuminate\Pagination\LengthAwarePaginator)
		<div class="px-4 py-3 bg-white dark:bg-zinc-800 border-t border-gray-200 dark:border-zinc-700">
			{{ $qrcodes->links() }}
		</div>
	@endif
</x-layouts.app>
