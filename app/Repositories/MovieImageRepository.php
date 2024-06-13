<?php

namespace App\Repositories;

use App\Models\MovieImage;
use App\Repositories\Interfaces\MovieImageInterface;
use Illuminate\Support\Collection;

class MovieImageRepository implements MovieImageInterface
{
    protected $movieImage;

    public function __construct(MovieImage $movieImage)
    {
        $this->movieImage = $movieImage;
    }

    public function storeMultiple($data): Collection
    {
        $createdMovieImages = new Collection();

        foreach ($data as $item) {
            $createdMovieImages->push($this->movieImage->create([
                'image_url' => $item['image_url'],
                'image_key' => $item['image_key'],
                'movie_id' => $item['movie_id'],
            ]));
        }

        return $createdMovieImages;
    }

    public function updateMultiple($data, $ids): bool
    {
        foreach ($data as $index => $item) {
            $movieImage = $this->movieImage->findOrFail($ids[$index]);

            $movieImage->fill([
                'image_url' => $item['image_url'],
                'image_key' => $item['image_key'],
                'movie_id' => $item['movie_id'],
            ]);

            $movieImage->save();
        }

        return true;
    }

    public function destroyMultiple($ids): bool
    {
        $this->movieImage->whereIn('id', $ids)->delete();

        return true;
    }
}