<?php

if (!function_exists('responseApi')) {
    function responseApi(string $status, ?string $message = null, $data = null, int $code = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'resource' => $data,
        ], $code);
    }
}

if (!function_exists('pagination')) {
    function pagination($paginated)
    {
        dd([
            'current_page' => $paginated->currentPage(),
            'last_page' => $paginated->lastPage(),
            'per_page' => $paginated->perPage(),
            'total' => $paginated->total(),
            'base_url' => $paginated->url(1),
            'next_url' => $paginated->nextPageUrl(),
            'prev_url' => $paginated->previousPageUrl(),
        ]);
        try {
            return [
                'current_page' => $paginated->currentPage(),
                'last_page' => $paginated->lastPage(),
                'per_page' => $paginated->perPage(),
                'total' => $paginated->total(),
                'base_url' => $paginated->url(1),
                'next_url' => $paginated->nextPageUrl(),
                'prev_url' => $paginated->previousPageUrl(),
            ];
        } catch (\Throwable $e) {
            return null;
        }
    }
}
