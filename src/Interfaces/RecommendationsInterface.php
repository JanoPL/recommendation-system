<?php

namespace Recommendations\Interfaces;

interface RecommendationsInterface
{
    public function filter(array $data): array;
}
