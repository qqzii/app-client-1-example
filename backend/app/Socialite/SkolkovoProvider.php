<?php

namespace App\Socialite;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use JsonException;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

final class SkolkovoProvider extends AbstractProvider implements ProviderInterface
{
    protected function getAuthUrl($state): string
    {
        return $this->buildAuthUrlFromBase(config('services.skolkovo.url') . '/oauth/authorize', $state);
    }

    protected function getTokenUrl(): string
    {
        return config('services.skolkovo.url') . '/oauth/token';
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()
            ->get(config('services.skolkovo.url') . '/api/user', $this->getRequestOptions($token));

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    protected function mapUserToObject(array $user): User
    {
        return (new User())->setRaw($user)->map([
            'id' => $user['id'],
            'name' => $user['name'] ?? '',
            'email' => $user['email'] ?? '',
        ]);
    }

    protected function getRequestOptions($token): array
    {
        return [
            RequestOptions::HEADERS => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ]
        ];
    }
}
