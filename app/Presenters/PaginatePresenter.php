<?php

namespace App\Presenters;

use Illuminate\Pagination\LengthAwarePaginator;
use Jenssegers\Agent\Agent;

class PaginatePresenter
{
    const DESKTOP_PAGINATE_NUM = 5;
    const MOBILE_PAGINATE_NUM = 3;

    public function renderPage(LengthAwarePaginator $paginate, array $appends = [], string $anchor = null)
    {
        $agent = new Agent();
        $paginateNums = ($agent->isMobile()) ? self::MOBILE_PAGINATE_NUM : self::DESKTOP_PAGINATE_NUM;

        $paginate->appends(\Request::capture()->only($appends));

        $nowPage   = $paginate->currentPage();
        $lastPage  = $totalPage = $paginate->lastPage();

        $offset    = $paginateNums < $totalPage ? intval( $paginateNums / 2) : intval($totalPage / 2);
        if ($nowPage - $offset > 0) {
            $startPage = $nowPage - $offset;
            $endPage   = $nowPage + $offset;
            if ($endPage > $totalPage) {
                $startPage = abs($startPage - ($endPage - $totalPage));
                $endPage   = $totalPage;
            }
            $startPage = $startPage < 1 ? 1 : $startPage;
        } else {
            $startPage = 1;
            $endPage   = $nowPage + ($offset * 2);
            $endPage   = ($endPage > $totalPage) ? $totalPage : $endPage;
        }

        $presenter = '';
        $presenter .= '<ul class="pagination_wrapper">';

        // 第一頁
        $url = $paginate->url(1);
        if ( ! is_null($anchor)) $url .= '#' . $anchor;
        $presenter .=     '<li class="previous page-btn">';
        $presenter .=         '<a href="' . $url . '"><img src="' . asset('images/arrow-left-g.svg') . '" alt=""></a>';
        $presenter .=     '</li>';

        // 頁碼
        $count = 0;
        for ($i = $startPage; $i <= $endPage; $i++) {
            if ($count == 5) break;
            if ($i > 100) $i = 1;

            $url = $paginate->url($i);
            if ( ! is_null($anchor)) $url .= '#' . $anchor;

            if ($i == $nowPage) {
                $presenter .= '<li class="page-num">';
                $presenter .=     '<a class="active" href="' . $url . '">' . $i . '</a>';
                $presenter .= '</li>';
            } else {
                $presenter .= '<li class="page-num">';
                $presenter .=     '<a href="' . $url . '">' . $i . '</a>';
                $presenter .= '</li>';
            }
            $count++;
        }

        // 最後一頁
        if ($lastPage > 100) $lastPage = 100;
        $url = $paginate->url($lastPage);
        if ( ! is_null($anchor)) $url .= '#' . $anchor;

        $presenter .=     '<li class="previous page-btn">';
        $presenter .=         '<a href="' . $url . '"><img src="' . asset('images/arrow-right-g.svg') . '" alt=""></a>';
        $presenter .=     '</li>';
        $presenter .= '</ul>';

        return $presenter;
    }

}
