@props(['status'])

<div {{ $attributes->merge(['class' => 'font-medium text-sm text-danger bg-danger/10 p-2 rounded-lg border border-danger']) }}>
    {{ $status }}
</div>
