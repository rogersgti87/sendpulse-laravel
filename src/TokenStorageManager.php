<?php

namespace Rogertiweb\SendPulse;

use Illuminate\Support\Manager;
use Rogertiweb\SendPulse\Storage\FileTokenStorage;
use Rogertiweb\SendPulse\Storage\SessionTokenStorage;

class TokenStorageManager extends Manager
{
    /**
     * Get the default storage driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->config['sendpulse.token_storage'];

    }

    /**
     * @return FileTokenStorage
     */
    public function createFileDriver()
    {
        //dd(app()->make(\Illuminate\Contracts\Filesystem\Factory::class));
        return new FileTokenStorage(
            app()->make(\Illuminate\Contracts\Filesystem\Factory::class),
            $this->hashName()
        );
    }

    /**
     * @return SessionTokenStorage
     */
    public function createSessionDriver()
    {
        return new SessionTokenStorage(
            app()->make(\Illuminate\Session\Store::class),
            $this->hashName()
        );
    }

    /**
     * Get hash name
     *
     * @return string
     */
    protected function hashName()
    {
        $userId = $this->config->get('sendpulse.api_user_id');
        $secret = $this->config->get('sendpulse.api_secret');

        return md5($userId . '::' . $secret);
    }
}
