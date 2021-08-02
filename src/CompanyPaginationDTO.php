<?php declare(strict_types=1);

namespace App;

class CompanyPaginationDTO
{
    private string $previousLink;
    private int $previousId;
    private string $nextLink;
    private int $nextId;

    /**
     * @param string $previousLink
     * @return CompanyPaginationDTO
     */
    public function setPreviousLink(string $previousLink): CompanyPaginationDTO
    {
        $this->previousLink = $previousLink;
        return $this;
    }

    /**
     * @param int $previousId
     * @return CompanyPaginationDTO
     */
    public function setPreviousId(int $previousId): CompanyPaginationDTO
    {
        $this->previousId = $previousId;
        return $this;
    }

    /**
     * @param string $nextLink
     * @return CompanyPaginationDTO
     */
    public function setNextLink(string $nextLink): CompanyPaginationDTO
    {
        $this->nextLink = $nextLink;
        return $this;
    }

    /**
     * @param int $nextId
     * @return CompanyPaginationDTO
     */
    public function setNextId(int $nextId): CompanyPaginationDTO
    {
        $this->nextId = $nextId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPreviousLink(): string
    {
        return $this->previousLink;
    }

    /**
     * @return int
     */
    public function getPreviousId(): int
    {
        return $this->previousId;
    }

    /**
     * @return string
     */
    public function getNextLink(): string
    {
        return $this->nextLink;
    }

    /**
     * @return int
     */
    public function getNextId(): int
    {
        return $this->nextId;
    }

    /**
     * @param string $previousLink
     * @param int $previousId
     * @param string $nextLink
     * @param int $nextId
     * @return CompanyPaginationDTO
     */
    public static function create(string $previousLink, int $previousId, string $nextLink, int $nextId): CompanyPaginationDTO
    {
        $dto = new self();
        $dto->setPreviousLink($previousLink)
            ->setPreviousId($previousId)
            ->setNextLink($nextLink)
            ->setNextId($nextId);

        return $dto;
    }
}