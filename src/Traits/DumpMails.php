<?php

namespace Thejenos\Laradump\Traits;

use Thejenos\Laradump\Helpers\StackTracer;

trait DumpMails
{
    public function mail($mailable)
    {
        $called_by = StackTracer::createTrace();

        $this->sendRequest([
            'view' => view('laradump::mail', [
                'mailable_class' => get_class($mailable),
                'from' => $this->convertToPersons($mailable->from),
                'subject' => $mailable->subject,
                'to' => $this->convertToPersons($mailable->to),
                'cc' => $this->convertToPersons($mailable->cc),
                'bcc' => $this->convertToPersons($mailable->bcc),
                'html' => $mailable->render(),
                'call' => $called_by,
            ])->render(),
        ]);
    }

    private function convertToPersons(array $persons): array
    {
        return collect($persons)
            ->map(function (array $person) {
                return [
                    'email' => $person['address'],
                    'name' => $person['name'] ?? '',
                ];
            })
            ->toArray();
    }
}
