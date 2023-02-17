<?php

class Pagination
{
    var $baseURL = '';
    var $totalRows = '';
    var $perPage = 10;
    var $numLinks = 3;
    var $currentPage = 0;
    var $firstLink = '&lsaquo; First';
    var $nextLink = '&gt;';
    var $prevLink = '&lt;';
    var $lastLink = 'Last &rsaquo;';
    var $fullTagOpen = '<div class="pagination">';
    var $fullTagClose = '</div>';
    var $firstTagOpen = '';
    var $firstTagClose = '&nbsp;';
    var $lastTagOpen = '&nbsp;';
    var $lastTagClose = '';
    var $curTagOpen = '&nbsp;<b>';
    var $curTagClose = '</b>';
    var $nextTagOpen = '&nbsp;';
    var $nextTagClose = '&nbsp;';
    var $prevTagOpen = '&nbsp;';
    var $prevTagClose = '';
    var $numTagOpen = '&nbsp;';
    var $numTagClose = '';
    var $anchorClass = '';
    var $showCount = true;
    var $currentOffset = 0;
    var $contentDiv = '';
    var $additionalParam = '';
    var $link_func = '';

    function __construct($params = array())
    {
        if (count($params) > 0) {
            $this->initialize($params);
        }
        if ($this->anchorClass != '') {
            $this->anchorClass = 'class="'.$this->anchorClass.'" ';
        }
    }

    function initialize($params = array())
    {
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                if (isset($this->$key)) {
                    $this->$key = $val;
                }
            }
        }
    }

    // Generate the pagination links
    function createLinks()
    {
        // If total number of rows is zero, don't do anything.
        if ($this->totalRows == 0 || $this->perPage == 0) {
            return '';
        }

        // Calculate the total number of pages.
        $numPages = ceil($this->totalRows/$this->perPage);

        // If there is only 1 page, don't continue.
        if ($numPages == 1) {
            if ($this->showCount) {
                return '<p>Showing : ' . $this->totalRows.'</p>';
            } else {
                return '';
            }
        }

        // Determine the current page
        if (!is_numeric($this->currentPage)) {
            $this->currentPage = 0;
        }

        // Links content string variable
        $output = '';

        // Show link notification
        if ($this->showCount) {
            $currentOffset = $this->currentPage;
            $info = 'Showing ' . ($currentOffset + 1) . ' to ';

            if (($currentOffset + $this->perPage) < $this->totalRows) {
                $info .= $currentOffset + $this->perPage;
            } else {
                $info .= $this->totalRows;
            }

            $info .= ' products out of ' . $this->totalRows . ' total | ';

            $output .= $info;
        }

        $this->numLinks = (int)$this->numLinks;

        // Show last page if page number is beyond result range
        if ($this->currentPage > $this->totalRows) {
            $this->currentPage = ($numPages - 1) * $this->perPage;
        }

        $uriPageNum = $this->currentPage;

        $this->currentPage = floor(($this->currentPage/$this->perPage) + 1);

        // Calculate the start and end numbers
        $start = (($this->currentPage - $this->numLinks) > 0) ? $this->currentPage - ($this->numLinks - 1) : 1;
        $end = (($this->currentPage + $this->numLinks) < $numPages) ? $this->currentPage + $this->numLinks : $numPages;

        // Render the first link
        if ($this->currentPage > $this->numLinks) {
            $output .= $this->firstTagOpen . $this->getAJAXlink('', $this->firstLink) . $this->firstTagClose;
        }

        // Render the previous link
        if ($this->currentPage != 1) {
            $i = $uriPageNum - $this->perPage;
            if ($i == 0) {
                $i = '';
            }
            $output .= $this->prevTagOpen . $this->getAJAXlink($i, $this->prevLink) . $this->prevTagClose;
        }

        // Write the digit links
        for ($loop = $start - 1; $loop <= $end; $loop++) {
            $i = ($loop * $this->perPage) - $this->perPage;

            if ($i >= 0) {
                if ($this->currentPage == $loop) {
                    $output .= $this->curTagOpen.$loop.$this->curTagClose;
                } else {
                    $n = ($i == 0) ? '' : $i;
                    $output .= $this->numTagOpen . $this->getAJAXlink($n, $loop) . $this->numTagClose;
                }
            }
        }

        // Render the next link
        if ($this->currentPage < $numPages) {
            $output .= $this->nextTagOpen . $this->getAJAXlink($this->currentPage * $this->perPage, $this->nextLink)
                .$this->nextTagClose;
        }

        // Render the last link
        if (($this->currentPage + $this->numLinks) < $numPages) {
            $i = (($numPages * $this->perPage) - $this->perPage);
            $output .= $this->lastTagOpen . $this->getAJAXlink($i, $this->lastLink) . $this->lastTagClose;
        }

        // Remove double slashes
        $output = preg_replace("#([^:])//+#", "\\1/", $output);

        // Add the wrapper HTML if it exists
        $output = $this->fullTagOpen.$output.$this->fullTagClose;

        return $output;
    }

    function getAJAXlink($count, $text)
    {
        if ($this->link_func == '' && $this->contentDiv == '') {
            return '<a href="'.$this->baseURL . '?' . $count . '"' . $this->anchorClass . '>' . $text . '</a>';
        }

        $pageCount = $count ?: 0;
        if (!empty($this->link_func)) {
            $linkClick = 'onclick="' . $this->link_func . '(' . $pageCount . ')"';
        } else {
            $this->additionalParam = "{'page' : $pageCount}";
            //$linkClick="onclick=\"$.post('". $this->baseURL ."', ". $this->additionalParam .",function(data){
            //                $('#". $this->contentDiv. "').html(data); }); return false;\"";
            //$linkClick="onclick=searchFilter(5)";
        }

        return "<a href=\"javascript:void(0);\" " . $this->anchorClass . " " . $linkClick . ">" . $text . '</a>';
    }
}
