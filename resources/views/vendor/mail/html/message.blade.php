@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url_front')])
            {{--{{ config('app.name') }}--}}
        @endcomponent
    @endslot

    @slot('greeting')
        {{$greeting ?? ''}}
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer', ['url' => config('app.url_front')])
            Copyright © {{ date('Y') }} {{ config('app.name') }} | Asociación Burgalesa de Ingenieros Informáticos |
            @lang('mail.common.rights')
        @endcomponent
    @endslot
@endcomponent
