@php
    $errorCode = 419;
    $errorTitle = 'Session Expired';
    $errorMessage = 'Sesi kamu sudah berakhir. Silakan muat ulang halaman dan coba lagi.';
    $errorHint = 'Your session timed out for security reasons.';
@endphp

@extends('errors.layout', [
    'errorCode' => $errorCode,
    'errorTitle' => $errorTitle,
    'errorMessage' => $errorMessage,
    'errorHint' => $errorHint,
])
