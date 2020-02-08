<?php

Breadcrumbs::for('admin.subscription.subscription.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('labels.backend.access.subscription.management'), route('admin.subscription.subscription.index'));
});

Breadcrumbs::for('admin.subscription.subscription.show', function ($trail, $id) {
    $trail->parent('admin.subscription.subscription.index');
    $trail->push(__('labels.backend.access.subscription.view'), route('admin.subscription.subscription.show', $id));
});

Breadcrumbs::for('admin.subscription.subscription.print', function ($trail, $id) {
    $trail->parent('admin.subscription.subscription.index');
    $trail->push(__('labels.backend.access.subscription.print'), route('admin.subscription.subscription.print', $id));
});

Breadcrumbs::for('admin.subscription.payment.index', function ($trail) {
    $trail->parent('admin.subscription.subscription.index');
    $trail->push(__('labels.backend.access.payment.management'), route('admin.subscription.payment.index'));
});

Breadcrumbs::for('admin.subscription.tag.index', function ($trail) {
    $trail->parent('admin.subscription.subscription.index');
    $trail->push(__('labels.backend.access.tag.management'), route('admin.subscription.tag.index'));
});

Breadcrumbs::for('admin.subscription.tag.datatable', function ($trail) {
    $trail->parent('admin.subscription.subscription.index');
    $trail->push(__('labels.backend.access.tag.management'), route('admin.subscription.tag.datatable'));
});

Breadcrumbs::for('admin.subscription.subscription.search', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('labels.backend.access.subscription.management'), route('admin.subscription.subscription.search'));
});
