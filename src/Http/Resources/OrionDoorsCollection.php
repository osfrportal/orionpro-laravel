<?php
namespace Osfrportal\OrionproLaravel\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class OrionDoorsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Collection
     */
    public function toArray($request)
    {
        //return ['doorslog' => $this->collection];
        return $this->collection;
    }

    /**
     * Customize the outgoing response for the resource.
     *
     * @param   \Illuminate\Http\Request
     * @param   \Illuminate\Http\JsonResponse
     * @return void
     */
    public function withResponse($request, $response)
    {
        $charset = $request->header('Accept-Charset', 'utf-8');
        if ($charset === 'utf-8') {
            $response->header('Charset', 'utf-8');
            $response->header('Content-Type','application/json; charset=utf-8');
            $response->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    }
}
