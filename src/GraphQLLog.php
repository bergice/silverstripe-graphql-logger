<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Member;

class GraphQLLog extends DataObject
{
    private static $db = [
        'Method' => 'Varchar(16)',
        'Headers' => 'Text',
        'Query' => 'Text',
        'Params' => 'Text',
    ];

    private static $searchable_fields = [
//        'CreatedBy',
        'Created',
        'Query',
        'Params',
    ];
//
    private static $has_one = [
        'CreatedBy' => Member::class,
    ];

    private static $summary_fields = [
        'Created',
        'CreatedBy.Email' => 'Created By',
        'Method',
        'Headers',
        'Query',
        'Params',
    ];

    private static $default_sort = 'Created DESC';
}
