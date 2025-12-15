<?php
namespace App\Logging;

use Monolog\Formatter\LineFormatter;

class DomainFormatter extends LineFormatter
{
    public function format(array $record): string
    {
        $domain = request()->getHost() ?? 'cli';
        $record['context'] = array_intersect_key(
            $record['context'],
            array_flip(['exception', 'file', 'line'])
        );

        $record['message'] = "Domain: $domain | " . $record['message'];

        return parent::format($record);
    }
}

