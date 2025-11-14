<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Activity Logs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-gray-900">All Activity Logs</h3>
                </div>

                <div class="space-y-4">
                    <p>This page will display all activity logs.</p>
                    {{-- You would typically loop through activity log data here --}}
                    {{-- Example:
                    @foreach($activityLogs as $log)
                        <div class="p-4 bg-gray-50 rounded-xl">
                            <p>{{ $log->description }} - {{ $log->created_at->format('d M Y H:i') }}</p>
                        </div>
                    @endforeach
                    --}}
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
