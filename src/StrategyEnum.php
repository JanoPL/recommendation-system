<?php

namespace Recommendations;

enum StrategyEnum
{
    case All;
    case Even;
    case Genre;
    case MultiWords;
    case Random;
    case SeasonNumber;
    case WCriteria;
}
