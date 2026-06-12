<?php

namespace PAS\Support;

class NavigationHelper
{
    public function __construct(
        private RequestHelper $requestHelper
    ) {
    }
    public function currentSubcategory(
        string $categoryParam,
        string $categoryValue,
        string $subcategoryParam,
        string $subcategoryValue
    ): string {
        if ($this->requestHelper->paramMatches($categoryParam, $categoryValue) && $this->requestHelper->paramMatches($subcategoryParam, $subcategoryValue)) {
            return 'aria-current="page"';
        }
        return '';
    }

    public function currentPage(string $url): string
    {
        if ($_SERVER['REQUEST_URI'] === $url) {
            return 'aria-current="page" href="#">';
        }
        return 'href="' . $url . '">';
    }
}
