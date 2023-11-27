<?php

namespace Recommendations\Strategy\Interfaces;

interface FilterStrategyInterface
{

    public function filter(array $data = []): array;
}