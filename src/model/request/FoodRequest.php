<?php

namespace app\model\request;

class FoodRequest
{
    public function __construct(
        public ?string $uuid,
        public string $name,
        public ?string $description,
        public ?string $image,
        public int $price
    ) {}

    public static function load(Request $request): FoodRequest
    {
        $post = json_decode($request->getContent());

        return new self(
            $post->uuid ?? null,
            $post->name,
            $post->description ?? null,
            $post->image ?? null,
            (int) $post->price
        );
    }
}