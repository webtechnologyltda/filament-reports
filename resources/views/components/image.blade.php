@php
    $path = $getPath();
    $width = $getWidth();
    $isCircular = $isCircular();
    $ringClasses = $getRing();
    $height = $getHeight();
@endphp
<img src="{{ $path }}" alt=""
    {{
        $getExtraImgAttributeBag()
            ->class([
                'max-w-none object-cover object-center',
                'rounded-full' => $isCircular,
                $ringClasses,
            ])
            ->style([
                "height: {$height}" => $height,
                "width: {$width}" => $width,
            ])
    }}
>
