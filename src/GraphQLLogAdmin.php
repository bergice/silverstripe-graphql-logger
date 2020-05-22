<?php

use SilverStripe\Admin\ModelAdmin;

class GraphQLLogAdmin extends ModelAdmin
{
    private static $managed_models = [
        'GraphQLLog',
    ];

    private static $url_segment = 'graphqllogs';

    private static $menu_title = 'GraphQL Logs';
}
