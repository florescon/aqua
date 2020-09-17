<?php

Breadcrumbs::for('admin.transaction.expense.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('labels.backend.access.expense.management'), route('admin.transaction.expense.index'));
});

Breadcrumbs::for('admin.transaction.income.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('labels.backend.access.income.management'), route('admin.transaction.income.index'));
});

Breadcrumbs::for('admin.transaction.cash.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('labels.backend.access.cash_out.management'), route('admin.transaction.cash.index'));
});

Breadcrumbs::for('admin.transaction.cash.indexcard', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('labels.backend.access.cash_out.management'), route('admin.transaction.cash.indexcard'));
});

Breadcrumbs::for('admin.transaction.cash.show', function ($trail, $cash) {
    $trail->parent('admin.transaction.cash.index');
    $trail->push(__('labels.backend.access.cash_out.show'), route('admin.transaction.cash.show', $cash));
});


Breadcrumbs::for('admin.transaction.cash.showforpayment', function ($trail, $cash, $payment) {
    $trail->parent('admin.transaction.cash.index');
    $trail->push(__('labels.backend.access.cash_out.show'), route('admin.transaction.cash.showforpayment', [$cash, $payment]));
});

Breadcrumbs::for('admin.transaction.cash.showcash', function ($trail, $cash) {
    $trail->parent('admin.transaction.cash.index');
    $trail->push(__('labels.backend.access.cash_out.show'), route('admin.transaction.cash.showcash', $cash));
});

Breadcrumbs::for('admin.transaction.cash.showcard', function ($trail, $cash) {
    $trail->parent('admin.transaction.cash.index');
    $trail->push(__('labels.backend.access.cash_out.show'), route('admin.transaction.cash.showcard', $cash));
});

Breadcrumbs::for('admin.transaction.cash.indexall', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('labels.backend.access.cash_out.management'), route('admin.transaction.cash.indexall'));
});

Breadcrumbs::for('admin.transaction.small.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('labels.backend.access.smallbox.management'), route('admin.transaction.small.index'));
});

