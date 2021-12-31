<?php

use Spatie\RouteDiscovery\Tests\TestClasses\Controllers\RouteAttribute\InvokableRouteGetTestController;
use Spatie\RouteDiscovery\Tests\TestClasses\Controllers\RouteAttribute\RouteGetTestController;
use Spatie\RouteDiscovery\Tests\TestClasses\Controllers\RouteAttribute\RouteMiddlewareTestController;
use Spatie\RouteDiscovery\Tests\TestClasses\Controllers\RouteAttribute\RouteMultiVerbTestController;
use Spatie\RouteDiscovery\Tests\TestClasses\Controllers\RouteAttribute\RouteNameTestController;
use Spatie\RouteDiscovery\Tests\TestClasses\Controllers\RouteAttribute\RoutePostTestController;
use Spatie\RouteDiscovery\Tests\TestClasses\Middleware\TestMiddleware;

test('the route annotation can register a get route', function () {
    $this->oldRouteRegistrar->registerClass(RouteGetTestController::class);

    $this
        ->assertRegisteredRoutesCount(1)
        ->assertRouteRegistered(RouteGetTestController::class, 'myGetMethod', 'get', 'my-get-method');
});

test('the route annotation can register a post route', function () {
    $this->oldRouteRegistrar->registerClass(RoutePostTestController::class);

    $this
        ->assertRegisteredRoutesCount(1)
        ->assertRouteRegistered(RoutePostTestController::class, 'myPostMethod', 'post', 'my-post-method');
});

test('the route annotation can register a multi verb route', function () {
    $this->oldRouteRegistrar->registerClass(RouteMultiVerbTestController::class);

    $this
        ->assertRegisteredRoutesCount(1)
        ->assertRouteRegistered(
            RouteMultiVerbTestController::class,
            'myMultiVerbMethod',
            ['get','post', 'delete'],
            'my-multi-verb-method'
        );
});

it('can add middleware to a method', function () {
    $this->oldRouteRegistrar->registerClass(RouteMiddlewareTestController::class);

    $this->assertRouteRegistered(
        controller: RouteMiddlewareTestController::class,
        middleware: TestMiddleware::class,
    );
});

it('can add a route name to a method', function () {
    $this->oldRouteRegistrar->registerClass(RouteNameTestController::class);

    $this->assertRouteRegistered(
        controller: RouteNameTestController::class,
        name: 'test-name',
    );
});

it('can add a route for an invokable', function () {
    $this->oldRouteRegistrar->registerClass(InvokableRouteGetTestController::class);

    $this
        ->assertRegisteredRoutesCount(1)
        ->assertRouteRegistered(
            controller: InvokableRouteGetTestController::class,
            controllerMethod: InvokableRouteGetTestController::class,
            uri: 'my-invokable-route'
        );
});
