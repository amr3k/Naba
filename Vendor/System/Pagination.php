<?php

namespace System;

class Pagination
{

    /**
     * Application Object
     *
     * @var \System\App
     */
    private $app;

    /**
     * Total Items
     *
     * @var int
     */
    private $totalItems;

    /**
     * Items Per Page
     *
     * @var int
     */
    private $itemsPerPage = 10;

    /**
     * Last Page Number => Total Pages
     *
     * @var int
     */
    private $lastPage;

    /**
     * Current Page Number
     *
     * @var int
     */
    private $page = 1;

    /**
     * Constructor
     *
     * @param \System\Application $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;

        $this->setCurrentPage();
    }

    /**
     * Set Current Page
     *
     * @return void
     */
    private function setCurrentPage()
    {
        // ?page=1
        // ?page=2
        // ?page=3
        $page = $this->app->request->get('page');

        // just to make sure that the passed query string parameter page
        // must be number and should be more or equal than 1
        if (!is_numeric($page) OR $page < 1) {
            $page = 1;
        }

        $this->page = $page;
    }

    /**
     * Get Current Page Number
     *
     * @return int
     */
    public function page()
    {
        return $this->page;
    }

    /**
     * Get Items Per Page
     *
     * @return int
     */
    public function itemsPerPage()
    {
        return $this->itemsPerPage;
    }

    /**
     * Get Total Items
     *
     * @return int
     */
    public function totalItems()
    {
        return $this->totalItems;
    }

    /**
     * Get Last Page
     *
     * @return int
     */
    public function last()
    {
        if ($this->page == $this->lastPage) {
            return $this->page;
        }
        return $this->lastPage;
    }

    /**
     * Get Next Page number
     *
     * @return int
     */
    public function next()
    {
        if ($this->page == $this->lastPage) {
            return $this->page;
        }
        return $this->page + 1;
    }

    /**
     * Get Previous Page number
     *
     * @return int
     */
    public function prev()
    {
        if ($this->page == 1) {
            return $this->page;
        }
        return $this->page - 1;
    }

    /**
     * Set Total Items
     *
     * @param int $totalItems
     * @return $this
     */
    public function setTotalItems($totalItems)
    {
        $this->totalItems = $totalItems;

        return $this;
    }

    /**
     * Set Items Per Page
     *
     * @param int $itemsPerPage
     * @return $this
     */
    public function setItemsPerPage($itemsPerPage)
    {
        $this->itemsPerPage = $itemsPerPage;

        return $this;
    }

    /**
     * Start Pagination
     *
     * @return $this
     */
    public function paginate()
    {
        $this->setLastPage();

        return $this;
    }

    /**
     * Set Last Page
     *
     * @return void
     */
    private function setLastPage()
    {
        $this->lastPage = ceil($this->totalItems / $this->itemsPerPage);
    }

}
