<?php
Route::controller('FCMTokenController')->group(function () {
    Route::post('fcm-token', 'store');
});
