<?php

namespace M1guelpf\GhostAPI;

use GuzzleHttp\Client;

class Ghost
{
    /** @var \GuzzleHttp\Client */
    protected $client;

    /** @var string */
    protected $host;

    /** @var string */
    protected $apiToken;

    /**
     * @param \GuzzleHttp\Client $client
     * @param string             $host
     * @param string             $apiToken
     * @param string             $apiVersion
     */
    public function __construct($host, $apiToken = null, $apiVersion = 'v2')
    {
        $this->client = new Client();

        $this->apiToken = $apiToken;

        $this->baseUrl = "$host/ghost/api/$apiVersion/content/";
    }

    /**
     * @param string $apiToken
     *
     * @return string
     */
    public function connect($apiToken)
    {
        $this->apiToken = $apiToken;

        return $this;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param \GuzzleHttp\Client $client
     */
    public function setClient($client)
    {
        if ($client instanceof Client) {
            $this->client = $client;
        }

        return $this;
    }

    /**
     * @param string $include
     * @param string $fields
     * @param string $filter
     * @param string $limit
     * @param string $page
     * @param string $order
     * @param string $format
     *
     * @return array
     */
    public function getPosts($include = '', $fields = '', $filter = '', $limit = '', $page = '', $order = '', $format = '')
    {
        return $this->get('posts', compact('include', 'fields', 'filter', 'limit', 'page', 'order', 'format'));
    }

    /**
     * @param string $postId
     * @param string $include
     * @param string $fields
     *
     * @return array
     */
    public function getPost(string $postId, $include = '', $fields = '')
    {
        return $this->get("posts/$postId", compact('include', 'fields'));
    }

    /**
     * @param string $slug
     * @param string $include
     * @param string $fields
     *
     * @return array
     */
    public function getPostBySlug(string $slug, $include = '', $fields = '')
    {
        return $this->get("posts/slug/$slug", compact('include', 'fields'));
    }

    /**
     * @param string $include
     * @param string $fields
     * @param string $filter
     * @param string $limit
     * @param string $page
     * @param string $order
     *
     * @return array
     */
    public function getAuthors($include = '', $fields = '', $filter = '', $limit = '', $page = '', $order = '')
    {
        return $this->get('authors', compact('include', 'fields', 'filter', 'limit', 'page', 'order'));
    }

    /**
     * @param string $authorId
     * @param string $include
     * @param string $fields
     *
     * @return array
     */
    public function getAuthor(string $authorId, $include = '', $fields = '')
    {
        return $this->get("authors/$authorId", compact('include', 'fields'));
    }

    /**
     * @param string $slug
     * @param string $include
     * @param string $fields
     *
     * @return array
     */
    public function getAuthorBySlug(string $slug, $include = '', $fields = '')
    {
        return $this->get("authors/slug/$slug", compact('include', 'fields'));
    }

    /**
     * @param string $include
     * @param string $fields
     * @param string $filter
     * @param string $limit
     * @param string $page
     * @param string $order
     *
     * @return array
     */
    public function getTags($include = '', $fields = '', $filter = '', $limit = '', $page = '', $order = '')
    {
        return $this->get('tags', compact('include', 'fields', 'filter', 'limit', 'page', 'order'));
    }

    /**
     * @param string $tagsId
     * @param string $include
     * @param string $fields
     *
     * @return array
     */
    public function getTag(string $tagsId, $include = '', $fields = '')
    {
        return $this->get("tags/$tagsId", compact('include', 'fields'));
    }

    /**
     * @param string $slug
     * @param string $include
     * @param string $fields
     *
     * @return array
     */
    public function getTagBySlug(string $slug, $include = '', $fields = '')
    {
        return $this->get("tags/slug/$slug", compact('include', 'fields'));
    }

    /**
     * @param string $include
     * @param string $fields
     * @param string $filter
     * @param string $limit
     * @param string $page
     * @param string $order
     * @param string $format
     *
     * @return array
     */
    public function getPages($include = '', $fields = '', $filter = '', $limit = '', $page = '', $order = '', $format = '')
    {
        return $this->get('pages', compact('include', 'fields', 'filter', 'limit', 'page', 'order', 'format'));
    }

    /**
     * @param string $pageId
     * @param string $include
     * @param string $fields
     *
     * @return array
     */
    public function getPage(string $pageId, $include = '', $fields = '')
    {
        return $this->get("pages/$pageId", compact('include', 'fields'));
    }

    /**
     * @param string $slug
     * @param string $include
     * @param string $fields
     *
     * @return array
     */
    public function getPageBySlug(string $slug, $include = '', $fields = '')
    {
        return $this->get("pages/slug/$slug", compact('include', 'fields'));
    }

    /**
     * @return array
     */
    public function getSettings()
    {
        return $this->get('settings');
    }

    /**
     * @param string $resource
     * @param array  $query
     *
     * @return array
     */
    public function get($resource, array $query = [])
    {
        return $this->handleCall('GET', $resource, $query, []);
    }

    /**
     * @param string $resource
     * @param array  $rawdata
     *
     * @return array
     */
    public function post($resource, array $rawData = [])
    {
        return $this->handleCall('POST', $resource, [], $rawData);
    }

    /**
     * @param string $resource
     * @param array  $rawdata
     *
     * @return array
     */
    public function put($resource, array $rawData = [])
    {
        return $this->handleCall('PUT', $resource, [], $rawData);
    }

    /**
     * @param string $resource
     * @param array  $rawdata
     *
     * @return array
     */
    public function delete($resource, array $rawData = [])
    {
        return $this->handleCall('DELETE', $resource, [], $rawData);
    }

    /**
     * @param string $method   HTTP method
     * @param string $resource Resource to invoke at the HyperHost API
     * @param array  $query    Request query string to pass in the URL
     * @param array  $rawData  Request body
     *
     * @return array
     */
    protected function handleCall($method, $resource, array $query, array $rawData)
    {
        $data['headers'] = [
            'User-Agent' => 'php-ghost-api',
        ];

        if (! empty($query)) {
            $data['query'] = array_unique(array_merge($query, ['key' => $this->apiToken]), SORT_REGULAR);
        } else {
            $data['query'] = ['key' => $this->apiToken];
        }

        if (! empty($rawData)) {
            $data['json'] = $rawData;
        }

        $results = $this->client
      ->request($method, "{$this->baseUrl}/{$resource}", $data)
      ->getBody()
      ->getContents();

        return json_decode($results, true);
    }
}
