<?php

namespace App\Services\Meta;

class MetaGenerator
{
    private $indexMeta;
    private $hotelMeta;
    private $listMeta;

    public function __construct(IndexMeta $indexMeta, HotelMeta $hotelMeta, ListMeta $listMeta)
    {
        $this->indexMeta = $indexMeta;
        $this->hotelMeta = $hotelMeta;
        $this->listMeta  = $listMeta;
    }

    public function getIndexMeta()
    {
        return $this->indexMeta->getMeta(true, false);
    }

    public function getListMeta(array $list, array $searchData, int $currentPage)
    {
        $this->listMeta->setList($list);
        $this->listMeta->setSearchData($searchData);
        $this->listMeta->setCurrentPage($currentPage);

        return $this->listMeta->getMeta();
    }

    public function getHotelMeta(array $hotelView)
    {
        $this->hotelMeta->setHotel($hotelView);

        return $this->hotelMeta->getMeta();
    }
}