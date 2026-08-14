@php
    $errorCode = 403;
    $errorTitle = 'Forbidden';
    $errorMessage = 'Kamu tidak punya akses ke halaman ini.';
    $errorHint = 'If you believe this is a mistake, please contact the administrator.';
@endphp

@extends('errors.layout', [
    'errorCode' => $errorCode,
    'errorTitle' => $errorTitle,
    'errorMessage' => $errorMessage,
    'errorHint' => $errorHint,
])
