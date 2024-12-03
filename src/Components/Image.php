<?php

namespace EightyNine\Reports\Components;

use Closure;
use EightyNine\Reports\Components\Concerns\CanBeAligned;
use EightyNine\Reports\Components\Concerns\CanModifyImageWidth;
use Illuminate\View\ComponentAttributeBag;

class Image extends Component
{
    use CanBeAligned;

    protected array $extraImgAttributes = [];

    protected bool|Closure $isCircular = false;

    protected int|Closure|null $ring = null;

    protected int|string|Closure|null $height = null;

    protected int|string|Closure|null $width = null;

    /**
     * @var view-string
     */
    protected string $view = 'filament-reports::components.image';

    public function __construct(public ?string $path = null) {}

    public function getPath(): ?string
    {
        return $this->path;
    }

    public static function make(?string $path): static
    {
        $static = app(static::class, ['path' => $path]);

        return $static;
    }

    public function extraImgAttributes(array|Closure $attributes, bool $merge = false): static
    {
        if ($merge) {
            $this->extraImgAttributes[] = $attributes;
        } else {
            $this->extraImgAttributes = [$attributes];
        }

        return $this;
    }

    public function getExtraImgAttributes(): array
    {
        $temporaryAttributeBag = new ComponentAttributeBag();

        foreach ($this->extraImgAttributes as $extraImgAttributes) {
            $temporaryAttributeBag = $temporaryAttributeBag->merge($this->evaluate($extraImgAttributes));
        }

        return $temporaryAttributeBag->getAttributes();
    }

    public function getExtraImgAttributeBag(): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->getExtraImgAttributes());
    }

    public function circular(bool|Closure $condition = true): static
    {
        $this->isCircular = $condition;

        return $this;
    }

    public function isCircular(): bool
    {
        return (bool)$this->evaluate($this->isCircular);
    }

    /**
     * @deprecated Use `isCircular()` instead.
     */
    public function isRounded(): bool
    {
        return $this->isCircular();
    }

    public function ring(int|Closure|null $ring): static
    {
        $this->ring = $ring;

        return $this;
    }

    public function getRing(): ?int
    {
        return $this->evaluate($this->ring);
    }

    public function getWidth(): ?string
    {
        $width = $this->evaluate($this->width);

        if ($width === null) {
            return null;
        }

        if (is_int($width)) {
            return "{$width}px";
        }

        return $width;
    }

    public function width(int|string|Closure|null $width): static
    {
        $this->width = $width;

        return $this;
    }

    public function size(int|string|Closure $size): static
    {
        $this->width($size);
        $this->height($size);

        return $this;
    }

    public function height(int|string|Closure|null $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getHeight(): ?string
    {
        $height = $this->evaluate($this->height);

        if ($height === null) {
            return null;
        }

        if (is_int($height)) {
            return "{$height}px";
        }

        return $height;
    }
}
