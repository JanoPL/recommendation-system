<?php

namespace Recommendations\Tests\Data;

class MoviesExtend
{
    public array $movies = [];
    public function __construct() {
        $movies = new Movies();

        foreach ($movies->movies as $movieName) {
            $movie = new Movie();
            $movie->setName($movieName);
            $movie->setGenre('test');

            $this->movies[] = $movie;
        }

        $series = new SeriesList();

        foreach ($series->series as $seriesName) {
            $series = new Series();
            $series->setName($seriesName);
            $series->setSeasonNumber(1);

            $this->movies[] = $series;
        }
    }
}