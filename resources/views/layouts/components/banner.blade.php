<div class="position-relative mb-17">
    <div class="overlay overlay-show">

        @php
            $img = 'img-' . rand(1, 4) . '.jpg';
        @endphp

        <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-250px"
            style="background-image:url('{{ asset("assets/media/stock/1600x800/$img") }}')">
        </div>

        <div class="overlay-layer rounded bg-black" style="opacity: 0.6"></div>
    </div>
    <div class="position-absolute text-white mb-8 ms-10 bottom-0">
        <h3 class="text-white fs-2qx fw-bold mb-3 m">{{ $title ?? 'Alex' }}</h3>
        <div class="fs-5 fw-semibold">
            {{ $description ?? '' }}
        </div>
    </div>
</div>
