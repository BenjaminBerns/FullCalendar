<?php

class Config
{
    public static function infoBdd(): array
    {
        return [
            'interface' => 'pdo',
            'type' => 'pgsql',
            'host' => 'localhost',
            'port' => 5432,
            'dbname' => 'ProjectDatabaseDispolen',
            'user' => 'postgres',
            'pass' => '951951',
        ];
    }
}