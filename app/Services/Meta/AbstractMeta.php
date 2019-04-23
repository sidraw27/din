<?php

namespace App\Services\Meta;

abstract class AbstractMeta
{
    protected $meta = [
        'title' => '',
        'description' => ''
    ];

    abstract protected function getTitle();
    abstract protected function getDescription();

    public function getMeta(bool $isPlusTitle = true, bool $isPlusDescription = true)
    {
        $this->setMeta($isPlusTitle, $isPlusDescription);

        return $this->meta;
    }

    protected function setMeta(bool $isPlusTitle = true, bool $isPlusDescription = true)
    {
        $title = $this->getTitle();
        $title .= $isPlusTitle ? ' | 盯房網 - 主動幫您追蹤最低房價' : '';
        $this->meta['title'] = $title;

        $description = $this->getDescription();
        $description .= $isPlusDescription ? '盯房網隨時幫您緊盯房價變化，讓您訂到最便宜划算的價格。' : '';
        $this->meta['description'] = $description;
    }
}