<?php declare(strict_types=1);

namespace App;

/**
 * Class CompanyPagination
 */
class CompanyPagination
{
    /**
     * List id parameter
     */
    private const PARAMETER_LIST_ID = 'listId';

    private CompanyServiceInterface $companyService;

    /**
     * CompanyPagination constructor.
     */
    public function __construct(CompanyServiceInterface $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Return company pagination dto object
     *
     * @param array $companyList
     * @param int $currentCompanyId
     * @param string $queryString
     * @param string $listId
     *
     * @return CompanyPaginationDTO
     *
     * @throws \Exception
     */
    public function getPagination(array $companyList, int $currentCompanyId, string $queryString, string $listId): CompanyPaginationDTO
    {
        return (new CompanyPaginationDTO())
            ->setPreviousLink($this->getPreviousLink($currentCompanyId, $companyList, $listId, $queryString))
            ->setPreviousId($this->getPreviousCompanyId($currentCompanyId, $companyList))
            ->setNextLink($this->getNextLink($currentCompanyId, $companyList, $listId, $queryString))
            ->setNextId($this->getNextCompanyId($currentCompanyId, $companyList));
    }

    /**
     * Return empty company pagination dto (for company preview)
     *
     * @return CompanyPaginationDTO
     */
    public function getPaginationEmpty(): CompanyPaginationDTO
    {
        return (new CompanyPaginationDTO())
            ->setPreviousLink('')
            ->setPreviousId(0)
            ->setNextLink('')
            ->setNextId(0);
    }

    /**
     * Return previous company link
     * (Will return empty string when first element of array is the current company id - as no previous element
     * available)
     *
     * @param int    $currentId
     * @param array  $list
     * @param string $listId
     * @param string $queryString
     *
     * @return string
     */
    private function getPreviousLink(int $currentId, array $list, string $listId, string $queryString): string
    {
        if (\reset($list) === $currentId) {
            return '';
        }

        $previousId = $this->getPreviousCompanyId($currentId, $list);

        return $this->getCompanySlugById($previousId, $listId, $queryString);
    }

    /**
     * Return next company link
     * (Will return empty string when last element of array is the current company id - as no next element available)
     *
     * @param int    $currentId
     * @param array  $list
     * @param string $listId
     * @param string $queryString
     *
     * @return string
     */
    private function getNextLink(int $currentId, array $list, string $listId, string $queryString): string
    {
        if (\end($list) === $currentId) {
            return '';
        }

        $nextId = $this->getNextCompanyId($currentId, $list);

        return $this->getCompanySlugById($nextId, $listId, $queryString);
    }

    /**
     * Return next company id
     *
     * @param int   $currentId
     * @param array $list
     *
     * @return int
     */
    private function getNextCompanyId(int $currentId, array $list): int
    {
        $nextIndex = $this->getCurrentCompanyIndex($currentId, $list);

        return $list[$nextIndex + 1] ?? 0;
    }

    /**
     * Return company slug by id (with parameters)
     *
     * @param int    $companyId
     * @param string $listId
     * @param string $queryString
     *
     * @return string
     */
    private function getCompanySlugById(int $companyId, string $listId, string $queryString): string
    {
        $slug = $this->companyService->getSlug($companyId);

        if (!$slug) {
            return '';
        }

        return \rtrim(
            \sprintf(
                '%s?%s=%s&%s',
                $slug,
                self::PARAMETER_LIST_ID,
                $listId,
                $queryString
            ),
            '&'
        );
    }

    /**
     * Return previous company id
     *
     * @param int   $currentId
     * @param array $list
     *
     * @return int
     */
    private function getPreviousCompanyId(int $currentId, array $list): int
    {
        $currentIndex = $this->getCurrentCompanyIndex($currentId, $list);

        return $list[$currentIndex - 1] ?? 0;
    }

    /**
     * Return current company index from list
     *
     * @param int   $currentId
     * @param array $list
     *
     * @return int
     */
    private function getCurrentCompanyIndex(int $currentId, array $list): int
    {
        return (int) \array_search($currentId, $list, true);
    }
}
