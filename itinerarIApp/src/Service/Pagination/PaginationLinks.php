<?php

namespace App\Service\Pagination;

class PaginationLinks
{
    private const MAX_VISIBLE_PAGES = 5;

    /**
     * Generate pagination links.
     */
    public function generateLinks(int $totalPages, int $currentPage, string $route, array $queryParams = []): string
    {
        if ($totalPages <= 1) {
            return ''; // No need to display pagination if there's only one page.
        }

        $paginationHtml = '<div class="pagination">';

        // Add "Previous" button
        if ($currentPage > 1) {
            $paginationHtml .= $this->generateLink($currentPage - 1, 'Previous', $route, $queryParams);
        }

        // Display pages 1-4
        for ($page = 1; $page <= min(4, $totalPages); ++$page) {
            $activeClass = ($page === $currentPage) ? 'active' : '';
            $paginationHtml .= $this->generateLink($page, (string) $page, $route, $queryParams, $activeClass);
        }

        // If we're past page 4, add an ellipsis
        if ($totalPages > 4 && $currentPage > 4) {
            $paginationHtml .= '<span>...</span>';
        }

        // Add the current page and a couple of neighbors if we're past page 4
        $startPage = max(5, $currentPage);
        $endPage = min($currentPage + 1, $totalPages - 1);  // Stop one before the last page

        for ($page = $startPage; $page <= $endPage; ++$page) {
            $activeClass = ($page === $currentPage) ? 'active' : '';
            $paginationHtml .= $this->generateLink($page, (string) $page, $route, $queryParams, $activeClass);
        }

        // Add ellipsis before the last page, if necessary
        if ($endPage < $totalPages - 1) {
            $paginationHtml .= '<span>...</span>';
        }

        // Add the last page link
        if ($totalPages > 1) {
            $activeClass = ($totalPages === $currentPage) ? 'active' : '';
            $paginationHtml .= $this->generateLink($totalPages, (string) $totalPages, $route, $queryParams, $activeClass);
        }

        // Add "Next" button
        if ($currentPage < $totalPages) {
            $paginationHtml .= $this->generateLink($currentPage + 1, 'Next', $route, $queryParams);
        }

        $paginationHtml .= '</div>';

        return $paginationHtml;
    }

    /**
     * Helper function to generate a pagination link.
     */
    private function generateLink(int $page, string $label, string $route, array $queryParams, string $activeClass = ''): string
    {
        $queryParams['page'] = $page;
        $url = $route.'?'.http_build_query($queryParams);

        return sprintf('<a href="%s" class="%s">%s</a>', $url, $activeClass, $label);
    }
}
