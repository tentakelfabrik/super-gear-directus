<?php

namespace SuperGear\Directus\Repositories;

/**
 *  class for paginate request
 *
 *  @author Björn Hase
 *  @license http://opensource.org/licenses/MIT The MIT License
 *  @link https://gitlab.tentakelfabrik.de/super-gear/directus GitHub Repository
 *
 */
abstract class PaginationRepositoryAbstract extends RepositoryAbstract
{
    /** current page */
    protected $page;

    /** limit for request */
    protected $limit;

    /** max pages */
    protected $maxPages;

    /** pages that are visible */
    protected $showPages = 7;

    /**
     *  setting max pages
     *
     *  @param integer
     *  @param array
     *
     */
    protected function setMaxPages($limit, $results)
    {
        $this->maxPages = intval(round($results['meta']['filter_count'] / $limit));
    }

    /**
     *  getting offset for request
     *
     *  @param integer
     *  @return integer
     *
     */
    protected function getOffset($page, $limit)
    {
        return (($page - 1) * $limit);
    }

    /**
     *  get pages that are showing
     *
     *  @param integer
     *  @return array
     *
     */
    protected function getPages($page)
    {
        // results
        $pages = [];

        // count of pages that can be shown
        $showPages = $this->showPages;

        // get avarage value to show pages
        $averagePages = $this->showPages / 2;

        // run throw all pages
        for ($i = 1; $i <= $this->maxPages; $i++) {

            // check if $page has to show
            $show = false;

            // show always first and last page
            if ($i === 1 || $i === $this->maxPages) {
                $show = true;
            }

            // if showing pages are aviable check if page can be shown
            if ($show === false && $showPages > 0) {

                // if page from 1 to avarage
                if (($i <= $averagePages && $page <= $averagePages) ||

                    // if page is less than maxPages
                   (($i >= ($maxPages - $averagePages)) && $page >= ($maxPages - $averagePages)) ||

                   // put current pages as avarage value
                   ($i >= ($page - $averagePages) && $i <= ($page + $averagePages))) {
                    $showPages--;
                    $show = true;
                }
            }

            if ($show) {
                $pages[] = $i;
            }
        }

        return $pages;
    }

    /**
     *  if previous is possible
     *
     *  @param integer $page
     *
     */
    protected function getPrevious($page)
    {
        $result = NULL;

        if ($page > 1) {
            $result = $page - 1;
        }

        return $result;
    }

    /**
    *  if next is possible
    *
    *  @param integer $page
     *
     */
    protected function getNext($page)
    {
        $result = NULL;

        if ($page < $this->maxPages) {
            $result = $page + 1;
        }

        return $result;
    }

    /**
     *  prepare query to get limited items
     *
     *  @param integer $page
     *  @param integer $limit
     *  @param array $query
     *
     */
    protected function prepare($page, $limit, $query)
    {
        // setting page and limit
        $this->page = $page;
        $this->limit = $limit;

        return array_merge($query, [
            'offset' => $this->getOffset($this->page, $this->limit),
            'limit' => $this->limit,
            'meta' => 'result_count,filter_count,total_count'
        ]);
    }

    /**
     *  paginate results
     *
     *  @param integer $page
     *  @param integer $limit
     *  @param array $results
     *
     */
    protected function paginate($results)
    {
        $this->setMaxPages($this->limit, $results);

        $results['meta']['current'] = $this->page;
        $results['meta']['previous'] = $this->getPrevious($this->page);
        $results['meta']['next'] = $this->getNext($this->page);
        $results['meta']['pages'] = $this->getPages($this->page);
        $results['meta']['max_pages'] = $this->maxPages;

        return $results;
    }
}