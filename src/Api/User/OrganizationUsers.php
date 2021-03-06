<?php

namespace CybozuHttp\Api\User;

use CybozuHttp\Client;
use CybozuHttp\Api\UserApi;

/**
 * @author ochi51 <ochiai07@gmail.com>
 */
class OrganizationUsers
{
    const MAX_GET_USERS = 100;

    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get users and titles of organization
     * https://cybozudev.zendesk.com/hc/ja/articles/202124774#step2
     *
     * @param string $code
     * @return array
     */
    public function get($code, $offset = 0, $limit = self::MAX_GET_USERS)
    {
        $options = ['json' => [
            'code' => $code,
            'offset' => $offset,
            'size' => $limit
        ]];

        return $this->client
            ->get(UserApi::generateUrl('organization/users.json'), $options)
            ->getBody()->jsonSerialize()['userTitles'];
    }
}