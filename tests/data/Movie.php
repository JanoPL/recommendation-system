<?php

namespace Recommendations\Tests\Data;
class Movie
{
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Movie
    {
        $this->name = $name;
        return $this;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): Movie
    {
        $this->genre = $genre;
        return $this;
    }
    private string $genre;
}
