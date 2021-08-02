<?php

namespace Tests;

use App\CompanyServiceInterface;

class CompanyServiceMock implements CompanyServiceInterface
{
    public function getSlug($companyId): string
    {
        $map = [
            45 => 'slug-45',
            33 => 'slug-33',
            121 => 'slug-121',
        ];

        return array_key_exists($companyId, $map) ? $map[$companyId] : 'slug-not-exist';
    }
}
