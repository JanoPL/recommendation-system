<?php

namespace Recommendations;

enum StrategyEnum
{
    case Even;
    case Genre;
    case MultiWords;
    case Random;
    case SeasonNumber;
    case WCriteria;
}
