<?php declare(strict_types=1);

namespace App;

interface CompanyServiceInterface
{
    /**
     * @param $companyId
     * @return string
     */
    public function getSlug($companyId): string;
}