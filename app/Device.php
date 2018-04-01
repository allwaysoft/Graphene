<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    const SNMP_VERSIONS = [
        "v1", "v2c", "v3"
    ];

    protected $fillable = [
        "name_override", "hostname", "port"
    ];

    public function getPort(): int
    {
        return $this->port;
    }

    public function getCommunity(): string
    {
        return $this->community;
    }

    public function getVersion(): int
    {
        return $this->snmp_version;
    }

    public function getVersionName(): string
    {
        return self::SNMP_VERSIONS[$this->getVersion()];
    }

    public static function canModify()
    {

    }
}
