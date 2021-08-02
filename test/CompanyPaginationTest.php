<?php declare(strict_types=1);

namespace Tests;

use App\CompanyPaginationDTO;
use PHPUnit\Framework\TestCase;
use App\CompanyPagination;

class CompanyPaginationTest extends TestCase
{
    /**
     * @dataProvider getPaginationDataProvider
     */
    public function testGetPagination(
        array $companyList,
        int $currentCompanyId,
        string $queryString,
        string $listId,
        CompanyPaginationDTO $expected
    )
    {
        $companyPagination = new CompanyPagination(new CompanyServiceMock());
        $actual = $companyPagination->getPagination($companyList, $currentCompanyId, $queryString, $listId);
        $this->assertEquals($expected, $actual);
    }

    public function getPaginationDataProvider()
    {
        return [
            [
                [45, 33, 121], // $companyList
                33, // $currentCompanyId
                'a=1&b=2&c=3', // $queryString
                'AWE12DJXZMA', // $listId
                CompanyPaginationDTO::create( // $expected
                    'slug-45?listId=AWE12DJXZMA&a=1&b=2&c=3',
                    45,
                    'slug-121?listId=AWE12DJXZMA&a=1&b=2&c=3',
                    121
                )
            ]
        ];
    }
}
