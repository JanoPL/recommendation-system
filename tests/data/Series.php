<?php

namespace Recommendations\Tests\Data;

class Series
{
    private string $name;
    private int $seasonNumber;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Series
    {
        $this->name = $name;
        return $this;
    }

    public function getSeasonNumber(): int
    {
        return $this->seasonNumber;
    }

    public function setSeasonNumber(int $seasonNumber): Series
    {
        $this->seasonNumber = $seasonNumber;
        return $this;
    }
}
