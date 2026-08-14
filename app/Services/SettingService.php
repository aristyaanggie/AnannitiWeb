<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\SettingRepositoryInterface;

class SettingService
{
    public function __construct(
        protected SettingRepositoryInterface $settingRepository,
    ) {}

    public function get(string $key, ?string $default = null)
    {
        $setting = $this->settingRepository->getByKey($key);
        return $setting?->value ?? $default;
    }

    public function set(string $key, string $value)
    {
        return $this->settingRepository->set($key, $value);
    }

    public function setMany(array $settings)
    {
        $this->settingRepository->setMany($settings);
    }

    public function getGroup(string $group)
    {
        return $this->settingRepository->getByGroup($group);
    }

    public function getBrandSettings()
    {
        return $this->getGroup('brand');
    }

    public function getSocialSettings()
    {
        return $this->getGroup('social');
    }

    public function getSeoSettings()
    {
        return $this->getGroup('seo');
    }
}
