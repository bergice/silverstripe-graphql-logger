<?php
use GraphQL\Type\Schema;
use SilverStripe\GraphQL\Middleware\QueryMiddleware;

class LoggingMiddleware implements QueryMiddleware
{
    public function process(Schema $schema, $query, $context, $params, callable $next)
    {
        /** @var GraphQLLog $log */
        $log = GraphQLLog::create();

        $log->Query = $query;

        /** @var \SilverStripe\Security\Member $user */
        if ($user = $context['currentUser']) {
            $log->CreatedBy = $user;
        }
        if ($httpMethod = $context['httpMethod']) {
            $log->Method = $httpMethod;
        }
        if ($parameters = json_encode($params, JSON_PRETTY_PRINT)) {
            $log->Params = $parameters;
        }
        if ($headers = json_encode(getallheaders(), JSON_PRETTY_PRINT)) {
            $log->Headers = $headers;
        }

        $log->write();

        return $next($schema, $query, $context, $params);
    }
}
