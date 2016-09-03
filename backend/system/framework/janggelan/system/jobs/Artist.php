<?php namespace system\jobs;

trait Artist {
    /**
    ***************************************************************************
    * Fungsi untuk mendapatkan data "Pagination"
    *
    * @param    array            $array
    * @param    integer|string   $paginate
    * @return   string
    *
    */
    public function PAGINATION_DATA(array $array, $paginate) {
        $array = is_array($array) ? $array : (array());
        $paginate = is_int($paginate) ? $paginate : (preg_match('/[a-zA-Z]*/',
            $paginate) ? $paginate : 0);
        $arrayChunk = array_chunk($array, $paginate);
        $arrayCombine = array_combine(array_map(function($a){return $a + 1;},
            array_keys($arrayChunk)), array_values($arrayChunk));
        return $arrayCombine;
    }

    /**
    ***************************************************************************
    * Fungsi untuk mendapatkan paginasi dengan gaya nomor
    *
    * @param    array            $array
    * @param    integer|string   $paginate
    * @return   string
    *
    */
    public function PAGINATION_STYLE_NUMBER($dataPagination, $paginate, $page, $offset = 5,
    $left = 2, $right = 2, $topLimit = 4) {
        $chunkKeys = array_keys($dataPagination);
        $totalKeys = count($chunkKeys);
        $pBottom = $page - $left;
        $pBottom = ($pBottom < 0) ? 0 : $pBottom;
        $pTop = $page + $right;
        $pTop = ($pTop > $totalKeys) ? $totalKeys : $pTop;
        $pTopLimit = $totalKeys - $topLimit;
        $pBottomLimit = $offset;
        $pagiIndex = $pagiIndexB = $pagiIndexT = $next = $prev = '';
        if($totalKeys == 1) {
            return '';
        }
        elseif($totalKeys > $offset) {
            $pageNext = $totalKeys;
            $pagePrev = 1;
            $next = "<span id='index-pagination-model-{$pageNext}-next' class='index-pagination-model'>
                <a id='index-page-ok-{$pageNext}-next' class='index-page-ok' href='?page={$pageNext}'
                style='padding:3px 8px;background:rgb(255, 255, 255);border-radius:5px;margin:0 1px;
                text-decoration:none;color:rgb(52, 52, 52);border:1px solid rgb(182, 182, 182)'>>></a></span>";
            $prev = "<span id='index-pagination-model-{$pagePrev}-prev' class='index-pagination-model'>
                <a id='index-page-ok-{$pagePrev}-prev' class='index-page-ok' href='?page={$pagePrev}'
                style='padding:3px 8px;background:rgb(255, 255, 255);border-radius:5px;margin:0 1px;
                text-decoration:none;color:rgb(52, 52, 52);border:1px solid rgb(182, 182, 182)'><<</a></span>";
            $styleNone = "padding:3px 8px;background:rgb(247, 247, 247);border-radius:5px;
                margin:0 1px;text-decoration:none;color:rgb(129, 129, 129);border:1px solid rgb(201, 201, 201);
                pointer-events:none";
            foreach($chunkKeys as $key) {
                $bg = ($key == $page) ? 'rgb(224, 221, 221)' : 'rgb(255, 255, 255)';
                $styleModel = "padding:3px 8px;background:{$bg};border-radius:5px;
                    margin:0 1px;text-decoration:none;color:rgb(52, 52, 52);border:1px solid rgb(182, 182, 182)";
                $model = "<span id='index-pagination-model-{$key}' class='index-pagination-model'>
                    <a id='index-page-ok-{$key}' class='index-page-ok' href='?page={$key}'
                    style='{$styleModel}'>{$key}</a></span>";
                $none = "<span id='index-pagination-none-{$key}' class='index-pagination-none'><span
                    id='index-page-none-{$key}' class='index-page-none' style='{$styleNone}'>...</span></span>";
                ($key < $pBottom) ? (($key < $pTopLimit) ? $pagiIndexB = $none : $pagiIndex .= $model )
                    : (($key > $pTop) ? (($key > $pBottomLimit) ? $pagiIndexT = $none : $pagiIndex .= $model)
                    : $pagiIndex .= $model);
            };
        }
        else {
            foreach($chunkKeys as $key) {
                $bg = ($key == $page) ? 'rgb(224, 221, 221)' : 'rgb(255, 255, 255)';
                $styleModel = "padding:3px 8px;background:{$bg};border-radius:5px;
                    margin:0 1px;text-decoration:none;color:rgb(52, 52, 52);border:1px solid rgb(182, 182, 182)";
                $model = "<span id='index-pagination-model-{$key}' class='index-pagination-model'>
                    <a id='index-page-ok-{$key}' class='index-page-ok' href='?page={$key}'
                    style='{$styleModel}'>{$key}</a></span>";
                $pagiIndex .= $model;
            };
        }
        return $prev . $pagiIndexB . $pagiIndex . $pagiIndexT . $next;
    }
}
