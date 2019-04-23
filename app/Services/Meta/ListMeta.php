<?php

namespace App\Services\Meta;

class ListMeta extends AbstractMeta
{
    private $list = [];
    private $searchData = [];
    private $currentPage = 1;

    public function setList(array $list)
    {
        $this->list = $list;
    }

    public function setSearchData(array $searchData)
    {
        $this->searchData = $searchData;
    }

    public function setCurrentPage(int $currentPage)
    {
        $this->currentPage = $currentPage;
    }

    protected function getTarget()
    {
        return $this->searchData['target'] ?? '';
    }

    protected function getTotal()
    {
        return $this->list['total'] ?? 0;
    }

    protected function getTitle()
    {
        $target = $this->getTarget();
        $total  = $this->getTotal();

        if ($total === 0) {
            $result = "{$target}列表中沒有搜尋到任何相關房源";
        } else {
            $result = "{$target}旅遊住宿，提供您多間優質房源";
        }

        $result .= " - 第{$this->currentPage}頁";

        return $result;
    }

    protected function getDescription()
    {
        $result = "{$this->getTarget()}列表中共有{$this->getTotal()}間房源。";

        return $result;
    }
}