<?php

namespace Recommendations\Filters;

abstract class BaseCriteria
{
    protected $specialChar = [
        "-",
        "_",
        "/",
        ":"
    ];

    /**
     * Removed special character from array string
     * @param array $data
     * @return array
     */
    public function removedSpecialChar(array $data): array
    {
        $specialChar = $this->specialChar;

        return array_map(function ($item) use ($data, $specialChar) {
            return str_replace($specialChar, "", $item);
        }, $data);
    }

    /**
     * Remove special characters from string
     * @param string $string
     * @return array|string|string[]
     */
    public function removedSpecialCharFromString(string $string): array|string
    {
        return str_replace($this->specialChar, "", $string);
    }

    /**
     * Remove special characters from string
     * @param string $string
     * @return array|string|string[]|null
     */
    public function removedWhiteSpaceCharFromString(string $string): array|string|null
    {
        return preg_replace('/\s+/', '', $string);
    }
}
