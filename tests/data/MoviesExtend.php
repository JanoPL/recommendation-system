<?php

namespace Recommendations\Tests\Data;

class MoviesExtend
{
    public array $movies = [
        0 => [
            'name' => "Pulp Fiction",
            'type' => 'Movie',
            'genre' => 'Crime, Drama',
        ],
        1 => [
            'name' => "Breaking Bad",
            'type' => 'Series',
            'genre' => 'Crime, Drama, Thriller',
            'seasons_number' => 5
        ]
    ];

    private array $genres = [
        "Comedy",
        "Fantasy",
        "Crime",
        "Drama",
        "Music",
        "Adventure",
        "History",
        "Thriller",
        "Animation",
        "Family",
        "Mystery",
        "Biography",
        "Action",
        "Film-Noir",
        "Romance",
        "Sci-Fi",
        "War",
        "Western",
        "Horror",
        "Musical",
        "Sport"
    ];
}