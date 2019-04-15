<?php

namespace App\Elasticsearch;

abstract class Builder
{
    protected $connection;
    protected $client;

    /**
     * Builder constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->connection = new Connection(env('ES_HOST'));
        $this->client = $this->connection->getClient();
    }

    abstract protected function getIndex();

    public function set()
    {

    }

    private function getParams(array $option)
    {
        $params = [
            'index' => $this->getIndex(),
            'type'  => 'doc'
        ];

        $params = array_merge($params, $option);

        return $params;
    }

    protected function search(array $query, int $from = 0, int $size = 10)
    {
        $params = $this->getParams([
            'body' => [
                'from'  => $from,
                'size'  => $size,
                'query' => $query
            ]
        ]);

        $response = $this->client->search($params);

        return $response;
    }

    protected function multiSearch(array $query, array $sort, int $from = 1, int $size = 10)
    {
        $sortQuery = [];
        foreach ($sort as $field => $order) {
            $sortQuery[] = [$field => ['order' => $order]];
        }

        $params = $this->getParams([
            'body' => [
                'from'  => $from,
                'size'  => $size,
                'sort'  => $sortQuery,
                'query' => [
                    'bool' => $query
                ]
            ]
        ]);

        $response = $this->client->search($params);

        return $response;
    }

    protected function searchRandom(array $query, int $size = 10)
    {
        $params = $this->getParams([
            'body' => [
                'size'  => $size,
                'query' => [
                    'function_score' => [
                        'query' => $query,
                        'random_score' => (object) [],
                        'boost_mode'   => 'multiply'
                    ]
                ]
            ]
        ]);

        $response = $this->client->search($params);

        return $response;
    }

    public function delete(string $id)
    {
        $params = $this->getParams([
            'id' => $id
        ]);

        $this->client->delete($params);
    }

    public function update(string $id, array $newData)
    {
        $params = $this->getParams([
            'id'   => $id,
            'body' => [
                'doc'  => $newData,
            ]
        ]);

        $this->client->update($params);
    }

    public function index(array $document, $id = null)
    {
        $params = [
            'body' => $document
        ];

        if ( ! is_null($id)) {
            $params = array_merge($params, ['id' => $id]);
        }

        $params = $this->getParams($params);

        $response = $this->client->index($params);

        return $response;
    }
}